<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuTranslation;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class MenuPermissionController extends Controller
{
    public function index()
    {
        return view('layouts.admin.setting.menu_permission.index');
    }
    public function fetchMenu()
    {
        $menus = Menu::with(['permissions.roles'])->where('parent_id', null)
            ->where('type', 'admin_side')
            ->where('is_active', 1)->get();

        return FormatResponseJson::success($menus, 'muncul menu');
    }
    public function fetchData()
    {
        try {
            $menus = Menu::where('parent_id', null)
            ->where('type', 'admin_side')
            ->where('is_active', 1)->get();
            $roles = Role::all();
            $data = [
                'menus'=> $menus,
                'roles'=> $roles
            ];
            $message = count($menus) > 0 ? 'Menu permissions fetched successfully.' : 'No menu permissions found.';
            return FormatResponseJson::success($data, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage());
        }
    }
    public function storeData(Request $request)
    {
        try {
            // 🔹 Validasi dulu sebelum simpan
            $validator = Validator::make(
                $request->all(),
                [
                    'menu_name'              => 'required|array',
                    'menu_name.*'            => 'required|string|max:100',
                    'menu_icon'              => 'required|string|max:50',
                    'menu_type'              => 'required|in:admin_side,client_side',
                    'parent_id'              => 'nullable|integer|exists:menus,id',
                ],
                [
                    'menu_name.required'     => 'Menu name wajib diisi.',
                    'menu_name.*.required'   => 'Menu name :attribute wajib diisi.',
                    'menu_name.*.string'     => 'Menu name :attribute harus berupa teks.',
                    'menu_name.*.max'        => 'Menu name :attribute maksimal 100 karakter.',

                    'menu_icon.required'     => 'Icon menu wajib diisi.',
                    'menu_icon.string'       => 'Icon menu harus berupa teks.',
                    'menu_icon.max'          => 'Icon menu maksimal 50 karakter.',

                    'menu_type.required'     => 'Tipe menu wajib dipilih.',
                    'menu_type.in'           => 'Tipe menu hanya boleh admin atau client.',

                    'parent_id.integer'      => 'Parent ID harus berupa angka.',
                    'parent_id.exists'       => 'Parent ID tidak valid.',
                ]
            );

            $validator->setAttributeNames([
                'menu_name.id' => 'Menu Name (ID)',
                'menu_name.en' => 'Menu Name (EN)',
                'menu_name.zh' => 'Menu Name (ZH)',
                'menu_name.ja' => 'Menu Name (JA)',
                'menu_name.ko' => 'Menu Name (KO)',
                'menu_name.tw' => 'Menu Name (TW)',
            ]);

            // 🔹 Kalau validasi gagal → kembalikan error JSON
            if ($validator->fails()) {
                // return FormatResponseJson::error(null, $validator->errors()->first());
                throw new ValidationException($validator);
            }

            // 🔹 Simpan pakai transaksi
            $menu = DB::transaction(function () use ($request) {
                $url = Str::of(strtolower($request->menu_name['en']))->slug('-');

                $menu = new Menu();
                $menu->name = $request->menu_name['en'];
                $menu->icon = $request->input('menu_icon');
                $menu->url = $url;
                $menu->type = $request->input('menu_type');
                $menu->parent_id = $request->input('parent_id');
                $menu->is_active = 1;

                // Hitung order otomatis
                if (empty($request->parent_id)) {
                    // Menu utama
                    $order = Menu::whereNull('parent_id')->max('order');
                } else {
                    // Submenu berdasarkan parent_id
                    $order = Menu::where('parent_id', $request->parent_id)->max('order');
                }

                $menu->order = $order ? $order + 1 : 1; // kalau belum ada = 1

                $menu->save();

                // 🔹 Simpan translations
                foreach ($request->menu_name as $locale => $name) {
                    MenuTranslation::create([
                        'menu_id' => $menu->id,
                        'locale'  => $locale,
                        'name'    => $name,
                    ]);
                }
                $menu->update([
                    'permission' => 'view_'.$url
                ]);
                $permission = Permission::firstOrCreate(['name' => 'view_'.$url]);

                if ($menu->permission && $request->user_role) {
                    $permission->syncRoles($request->user_role);
                }
                return $menu;
            });

            return FormatResponseJson::success($menu, 'Menu permission created successfully.');
        } catch (ValidationException $e) {
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 400);
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage());
        }
    }
    public function showData(Request $request)
    {
        try {
            $menu = Menu::with(['translations', 'permissions.roles'])->findOrFail($request->id);
            $roles = Role::all('id','name');
            // Susun data multilingual agar lebih rapi
            $menuData = [
                'id'          => $menu->id,
                'name'        => $menu->name,
                'icon'        => $menu->icon,
                'url'         => $menu->url,
                'type'        => $menu->type,
                'parent_id'   => $menu->parent_id,
                'order'       => $menu->order,
                'is_active'   => $menu->is_active,
                'permission'  => $menu->permission,
                'roles' => $menu->permissions->roles,
                'role_existing' => $roles,
                'translations'=> $menu->translations->mapWithKeys(function ($t) {
                    return [$t->locale => $t->name];
                }),
            ];
            return FormatResponseJson::success($menuData, 'Menu detail fetched successfully.');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }
    public function updateData(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'menu_name'              => 'required|array',
                    'menu_name.*'            => 'required|string|max:100',
                    'menu_icon'              => 'required|string|max:50',
                    'menu_type'              => 'required|in:admin_side,client_side',
                    'parent_id'              => 'nullable|integer|exists:menus,id',
                ],
                [
                    'menu_name.required'     => 'Menu name wajib diisi.',
                    'menu_name.*.required'   => 'Menu name :attribute wajib diisi.',
                    'menu_name.*.string'     => 'Menu name :attribute harus berupa teks.',
                    'menu_name.*.max'        => 'Menu name :attribute maksimal 100 karakter.',

                    'menu_icon.required'     => 'Icon menu wajib diisi.',
                    'menu_icon.string'       => 'Icon menu harus berupa teks.',
                    'menu_icon.max'          => 'Icon menu maksimal 50 karakter.',

                    'menu_type.required'     => 'Tipe menu wajib dipilih.',
                    'menu_type.in'           => 'Tipe menu hanya boleh admin atau client.',

                    'parent_id.integer'      => 'Parent ID harus berupa angka.',
                    'parent_id.exists'       => 'Parent ID tidak valid.',
                ]
            );

            $validator->setAttributeNames([
                'menu_name.id' => 'Menu Name (ID)',
                'menu_name.en' => 'Menu Name (EN)',
                'menu_name.zh' => 'Menu Name (ZH)',
                'menu_name.ja' => 'Menu Name (JA)',
                'menu_name.ko' => 'Menu Name (KO)',
                'menu_name.tw' => 'Menu Name (TW)',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $menu = DB::transaction(function () use ($request) {
                $menu = Menu::findOrFail($request->id);

                $url = Str::of(strtolower($request->menu_name['en']))->slug('-');

                $menu->update([
                    'name'       => $request->menu_name['en'],
                    'icon'       => $request->input('menu_icon'),
                    'url'        => $url,
                    'type'       => $request->input('menu_type'),
                    'parent_id'  => $request->input('parent_id'),
                    'permission' => 'view_'.$url,
                ]);

                // 🔹 Update atau buat translations
                foreach ($request->menu_name as $locale => $name) {
                    MenuTranslation::updateOrCreate(
                        ['menu_id' => $menu->id, 'locale' => $locale],
                        ['name'    => $name]
                    );
                }

                // 🔹 Update permissions
                $permission = Permission::firstOrCreate(['name' => 'view_'.$url]);

                if ($menu->permission && $request->user_role) {
                    $permission->syncRoles($request->user_role);
                }
                // if ($request->menu_type == 'admin_side' && $request->parent_child_menu == 'child_menu') {
                //     $baseName = Str::slug($request->menu_name['en'], '_');
                //     $actions = ['create', 'edit', 'delete'];

                //     foreach ($actions as $action) {
                //         Permission::firstOrCreate(['name' => "{$action}_{$baseName}"]);
                //     }
                // }

                return $menu;
            });
            DB::commit();
            return FormatResponseJson::success($menu, 'Menu permission updated successfully.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return FormatResponseJson::error(null, ['errors' => $e->errors()], 400);
        } catch (\Throwable $th) {
            DB::rollBack();
            return FormatResponseJson::error(null, $th->getMessage());
        }
    }
    public function getChildMenus(Request $request)
    {
        try {
            $menus = Menu::with('translations')
                ->where('parent_id', $request->parent_id)
                ->orderBy('order', 'asc')
                ->get();

            $data = $menus->map(function ($menu) {
                return [
                    'id'          => $menu->id,
                    'name'        => $menu->name,
                    'icon'        => $menu->icon,
                    'url'         => $menu->url,
                    'type'        => $menu->type,
                    'order'       => $menu->order,
                    'is_active'   => $menu->is_active,
                    'permission'  => $menu->permission,
                    'translations'=> $menu->translations->mapWithKeys(function ($t) {
                        return [$t->locale => $t->name];
                    }),
                ];
            });

            return FormatResponseJson::success($data, 'Child menus fetched successfully.');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage());
        }
    }
    public function showChildMenus(Request $request)
    {
        try {
            $childMenus = Menu::with('translations')
                ->where('parent_id', $request->parent_id)
                ->orderBy('order', 'asc')
                ->get();

            $data = $childMenus->map(function ($menu) {
                return [
                    'id'          => $menu->id,
                    'name'        => $menu->name,
                    'icon'        => $menu->icon,
                    'url'         => $menu->url,
                    'type'       => $menu->type,
                    'order'       => $menu->order,
                    'is_active'   => $menu->is_active,
                    'permission'  => $menu->permission,
                    'translations'=> $menu->translations->mapWithKeys(function ($t) {
                        return [$t->locale => $t->name];
                    }),
                ];
            });

            return FormatResponseJson::success($data, 'Child menus fetched successfully.');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage());
        }
    }
}
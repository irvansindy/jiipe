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
        try {
            $menus = Menu::with(['permissions.roles'])
                ->whereNull('parent_id')
                ->where('type', 'admin_side')
                ->orderBy('order', 'asc')
                ->get();

            return FormatResponseJson::success($menus, 'Menu fetched successfully');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage());
        }
    }

    public function fetchData()
    {
        try {
            $menus = Menu::whereNull('parent_id')
                ->where('type', 'admin_side')
                ->orderBy('order', 'asc')
                ->get();

            $roles = Role::all();

            $data = [
                'menus' => $menus,
                'roles' => $roles
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
            $this->validateMenuData($request);

            $menu = DB::transaction(function () use ($request) {
                $menu = $this->createMenu($request);
                $this->createMenuTranslations($menu->id, $request->menu_name);
                $this->syncMenuPermissions($menu, $request->user_role);
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
            $roles = Role::all('id', 'name');

            $menuData = $this->formatMenuData($menu, $roles);

            return FormatResponseJson::success($menuData, 'Menu detail fetched successfully.');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 404);
        }
    }

    public function updateData(Request $request)
    {
        try {
            DB::beginTransaction();

            $this->validateMenuData($request);

            $menu = $this->updateMenu($request);
            $this->updateMenuTranslations($menu->id, $request->menu_name);
            $this->syncMenuPermissions($menu, $request->user_role);

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

    public function toggleStatus(Request $request)
    {
        try {
            $menu = Menu::findOrFail($request->id);
            $menu->is_active = $request->is_active;
            $menu->save();

            $status = $menu->is_active ? 'activated' : 'deactivated';
            return FormatResponseJson::success($menu, "Menu has been {$status} successfully.");
        } catch (\Throwable $th) {
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
                return $this->formatChildMenuData($menu);
            });

            return FormatResponseJson::success($data, 'Child menus fetched successfully.');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage());
        }
    }

    // Private Helper Methods

    private function validateMenuData($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'menu_name'     => 'required|array',
                'menu_name.*'   => 'required|string|max:100',
                'menu_icon'     => 'required|string|max:50',
                'menu_type'     => 'required|in:admin_side,client_side',
                'parent_id'     => 'nullable|integer|exists:menus,id',
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
    }

    private function createMenu($request)
    {
        $url = Str::slug(strtolower($request->menu_name['en']), '-');
        $order = $this->getNextOrder($request->parent_id);

        $menu = Menu::create([
            'name'       => $request->menu_name['en'],
            'icon'       => $request->menu_icon,
            'url'        => $url,
            'type'       => $request->menu_type,
            'parent_id'  => $request->parent_id,
            'permission' => 'view_' . $url,
            'order'      => $order,
            'is_active'  => 1,
        ]);

        return $menu;
    }

    private function updateMenu($request)
    {
        $menu = Menu::findOrFail($request->id);
        $url = Str::slug(strtolower($request->menu_name['en']), '-');

        $menu->update([
            'name'       => $request->menu_name['en'],
            'icon'       => $request->menu_icon,
            'url'        => $url,
            'type'       => $request->menu_type,
            'parent_id'  => $request->parent_id,
            'permission' => 'view_' . $url,
        ]);

        return $menu;
    }

    private function createMenuTranslations($menuId, $translations)
    {
        foreach ($translations as $locale => $name) {
            MenuTranslation::create([
                'menu_id' => $menuId,
                'locale'  => $locale,
                'name'    => $name,
            ]);
        }
    }

    private function updateMenuTranslations($menuId, $translations)
    {
        foreach ($translations as $locale => $name) {
            MenuTranslation::updateOrCreate(
                ['menu_id' => $menuId, 'locale' => $locale],
                ['name' => $name]
            );
        }
    }

    private function syncMenuPermissions($menu, $roles)
    {
        if ($menu->permission) {
            $permission = Permission::firstOrCreate(['name' => $menu->permission]);

            if ($roles) {
                $permission->syncRoles($roles);
            }
        }
    }

    private function getNextOrder($parentId)
    {
        if (empty($parentId)) {
            $order = Menu::whereNull('parent_id')->max('order');
        } else {
            $order = Menu::where('parent_id', $parentId)->max('order');
        }

        return $order ? $order + 1 : 1;
    }

    private function formatMenuData($menu, $roles)
    {
        return [
            'id'           => $menu->id,
            'name'         => $menu->name,
            'icon'         => $menu->icon,
            'url'          => $menu->url,
            'type'         => $menu->type,
            'parent_id'    => $menu->parent_id,
            'order'        => $menu->order,
            'is_active'    => $menu->is_active,
            'permission'   => $menu->permission,
            'roles'        => $menu->permissions->roles ?? [],
            'role_existing'=> $roles,
            'translations' => $menu->translations->mapWithKeys(function ($t) {
                return [$t->locale => $t->name];
            }),
        ];
    }

    private function formatChildMenuData($menu)
    {
        return [
            'id'           => $menu->id,
            'name'         => $menu->name,
            'icon'         => $menu->icon,
            'url'          => $menu->url,
            'type'         => $menu->type,
            'order'        => $menu->order,
            'is_active'    => $menu->is_active,
            'permission'   => $menu->permission,
            'translations' => $menu->translations->mapWithKeys(function ($t) {
                return [$t->locale => $t->name];
            }),
        ];
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactOverview;
use App\Models\ContactOverviewTranslation;
use App\Models\ContactEmail;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index()
    {
        $contactOverview = ContactOverview::with(['translations'])->first();

        return view('layouts.admin.contact.index', compact('contactOverview'));
    }
    public function viewContactEmail()
    {
        return view('layouts.admin.contact.email.index');
    }
    public function viewContactBrochure()
    {
        return view('layouts.admin.contact.brochure.index');
    }
    public function fetchContactEmail()
    {
        try {
            $email = ContactEmail::orderBy('id','desc')->get;
            $message = count($email) > 0 ? 'Success' :'No data';
            return FormatResponseJson::success($email, $message);
        } catch (\Throwable $th) {
            return FormatResponseJson::error($th->getMessage(), 500);
        }
    }
    public function storeContactOverview(Request $request)
    {
        try {
            DB::beginTransaction();

            // Build validation rules
            $rules = [];
            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                $rules['title.' . $locale] = 'nullable|string|max:255';
                $rules['subtitle.' . $locale] = 'nullable|string|max:255';
                $rules['description.' . $locale] = 'nullable|string';
                $rules['office_name.' . $locale] = 'nullable|string|max:255';
                $rules['phone.' . $locale] = 'nullable|string|max:255';
                $rules['address.' . $locale] = 'nullable|string';
                $rules['map_link.' . $locale] = 'nullable|string';
            }

            // Image is required only on create
            if (!$request->id) {
                $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
            } else {
                $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Get or create contact overview
            if ($request->id) {
                $contactOverview = ContactOverview::findOrFail($request->id);
            } else {
                $contactOverview = new ContactOverview();
                // Set default value for image if creating new and no image uploaded
                if (!$request->hasFile('image')) {
                    // This shouldn't happen due to validation, but just in case
                    $contactOverview->image = '';
                }
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($contactOverview->image && Storage::disk('uploads')->exists($contactOverview->image)) {
                    Storage::disk('uploads')->delete($contactOverview->image);
                }
                $contactOverview->image = $request->file('image')->store('contact/overview', 'uploads');
            }

            // Save contact overview first to get ID
            $contactOverview->save();

            // Debug: Check if ID exists
            if (!$contactOverview->id) {
                throw new \Exception('Failed to create contact overview - ID is null');
            }

            // Save translations
            foreach (config('laravellocalization.supportedLocales') as $locale => $properties) {
                $translation = ContactOverviewTranslation::where('contact_overviews_id', $contactOverview->id)
                    ->where('locale', $locale)
                    ->first();

                if (!$translation) {
                    $translation = new ContactOverviewTranslation();
                    $translation->contact_overviews_id = $contactOverview->id;
                    $translation->locale = $locale;
                }

                $translation->title = $request->input('title')[$locale] ?? '';
                $translation->subtitle = $request->input('subtitle')[$locale] ?? '';
                $translation->description = $request->input('description')[$locale] ?? '';
                $translation->office_name = $request->input('office_name')[$locale] ?? '';
                $translation->phone = $request->input('phone')[$locale] ?? '';
                $translation->address = $request->input('address')[$locale] ?? '';
                $translation->map_link = $request->input('map_link')[$locale] ?? '';

                $translation->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Contact Overview berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Contact Overview gagal disimpan: ' . $e->getMessage());
        }
    }
}

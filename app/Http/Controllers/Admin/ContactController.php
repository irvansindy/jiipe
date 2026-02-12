<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactOverviewRequest;
use App\Services\ContactOverviewService;
use App\Helpers\FormatResponseJson;
use Illuminate\Http\Request;
use App\Models\ContactEmail;
use Exception;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactOverviewService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Display contact overview page
     */
    public function index()
    {
        try {
            $contactOverview = $this->contactService->getContactOverview();
            return view('layouts.admin.contact.index', compact('contactOverview'));
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Fetch contact overview data (AJAX)
     */
    public function fetchContactOverview()
    {
        try {
            $data = $this->contactService->getContactOverview();
            return FormatResponseJson::success($data, 'Contact overview fetched successfully');
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * Store or update contact overview
     */
    public function storeContactOverview(ContactOverviewRequest $request)
    {
        try {

            $data = $request->validated();

            // Decode description semua locale
            if (isset($data['description']) && is_array($data['description'])) {
                foreach ($data['description'] as $locale => $value) {
                    $data['description'][$locale] = base64_decode($value);
                }
            }

            $imageFile = $request->hasFile('image') ? $request->file('image') : null;

            $contact = $this->contactService->saveContactOverview(
                $data,
                $imageFile
            );

            return FormatResponseJson::success($contact, 'Contact overview saved successfully');

        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }

    /**
     * View contact email page
     */
    public function viewContactEmail()
    {
        return view('layouts.admin.contact.email.index');
    }

    /**
     * View contact brochure page
     */
    public function viewContactBrochure()
    {
        return view('layouts.admin.contact.brochure.index');
    }

    /**
     * Fetch contact emails
     */
    public function fetchContactEmail()
    {
        try {
            $emails = ContactEmail::orderBy('id', 'desc')->get();
            $message = $emails->isNotEmpty() ? 'Success' : 'No data';
            return FormatResponseJson::success($emails, $message);
        } catch (Exception $e) {
            return FormatResponseJson::error(null, $e->getMessage(), 500);
        }
    }
}
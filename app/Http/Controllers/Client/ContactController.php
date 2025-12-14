<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ContactOverview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    public function index()
    {
        // Cache data selama 24 jam (1440 menit)
        $locale = app()->getLocale();
        $cacheKey = "contact_overview_{$locale}";

        $contactData = Cache::remember($cacheKey, now()->addDay(), function () use ($locale) {
            return ContactOverview::with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale);
            }])
            ->first();
        });

        // Fallback jika tidak ada data
        if (!$contactData || $contactData->translations->isEmpty()) {
            $contactData = $this->getDefaultContactData();
        } else {
            // Ambil translation pertama
            $contactData->translation = $contactData->translations->first();
        }
        return view('layouts.client.contact.index', compact('contactData'));
    }

    /**
     * Get default contact data jika database kosong
     */
    private function getDefaultContactData()
    {
        return (object) [
            'image' => 'asset/images/static/3ec59cba31JIIPE Tower up.jpg',
            'translation' => (object) [
                'title' => 'Contact Us',
                'subtitle' => 'We are here to support you',
                'description' => 'Please contact our hotline for further information (Monday - Friday, 08.00 - 17.00 local time). For inquiries above operating hours, kindly fill in the contact form and we will be in touch with you at our earliest.',
                'office_name' => 'PT. Berkah Kawasan Manyar Sejahtera',
                'phone' => '+62 31 985 409 99',
                'address' => 'Jl. Raya Manyar Km. 11, Manyar-Gresik, East Java 61151',
                'map_link' => 'https://www.google.com/maps/place/JIIPE+Office/@-7.0856958,112.6046212,17z/data=!4m5!3m4!1s0x0:0xaee7dea2e8cb80a3!8m2!3d-7.0862954!4d112.6030116'
            ]
        ];
    }

    /**
     * Clear cache (untuk admin panel)
     */
    public function clearCache()
    {
        Cache::forget('contact_overview_en');
        Cache::forget('contact_overview_id');
        // Tambahkan locale lain jika ada

        return redirect()->back()->with('success', 'Contact cache cleared successfully');
    }
}
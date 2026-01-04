<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerHeaderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $locales = config('laravellocalization.supportedLocales');

        $headerExists = \App\Models\CareerHeader::exists();

        $rules = [
            // PERBAIKAN: Jika update dan tidak upload file baru, skip validasi image
            'cover_image' => ($headerExists && !$this->hasFile('cover_image'))
                ? 'nullable'
                : 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];

        foreach (array_keys($locales) as $locale) {
            $rules["cover_title.{$locale}"] = 'nullable|string|max:255'; // Ubah ke nullable
        }

        return $rules;
    }

    public function attributes(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $attributes = [];

        foreach ($locales as $locale => $props) {
            $attributes["cover_title.{$locale}"] = "Title ({$props['native']})";
        }

        return $attributes;
    }

    public function messages(): array
    {
        return [
            'cover_image.required' => 'Cover image is required for first time setup',
            'cover_image.image' => 'File must be an image',
            'cover_image.mimes' => 'Image must be jpeg, png, jpg, gif, or webp',
            'cover_image.max' => 'Image size must not exceed 2MB',
        ];
    }
}
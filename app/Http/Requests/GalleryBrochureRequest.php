<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryBrochureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        $isUpdate = $this->route('id') !== null;

        $rules = [
            'image' => $isUpdate ? 'nullable|file|mimes:pdf|max:5120' : 'required|file|mimes:pdf|max:5120',
            'is_active' => 'required|in:0,1',
        ];

        foreach ($locales as $locale) {
            $rules["title.{$locale}"] = 'required|string|max:255';
            $rules["subtitle.{$locale}"] = 'nullable|string|max:255';
            $rules["file.{$locale}"] = 'nullable|file|mimes:pdf|max:5120'; // 5MB max for PDF
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $attributes = [
            'image' => 'Main PDF File',
            'is_active' => 'Status',
        ];

        foreach ($locales as $locale => $properties) {
            $langName = $properties['native'] ?? strtoupper($locale);
            $attributes["title.{$locale}"] = "Title ({$langName})";
            $attributes["subtitle.{$locale}"] = "Subtitle ({$langName})";
            $attributes["file.{$locale}"] = "PDF File ({$langName})";
        }

        return $attributes;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'image.required' => 'Main PDF file is required',
            'image.file' => 'File must be a valid file',
            'image.mimes' => 'File must be in PDF format',
            'image.max' => 'PDF file size cannot exceed 5MB',
            'is_active.required' => 'Status is required',
            'is_active.in' => 'Status must be either Active (1) or Inactive (0)',
            'title.*.required' => 'Title field is required for all languages',
            'title.*.string' => 'Title must be a text',
            'title.*.max' => 'Title cannot exceed 255 characters',
            'subtitle.*.string' => 'Subtitle must be a text',
            'subtitle.*.max' => 'Subtitle cannot exceed 255 characters',
            'file.*.file' => 'File must be a valid file',
            'file.*.mimes' => 'Translation file must be in PDF format',
            'file.*.max' => 'Translation PDF file size cannot exceed 5MB',
        ];
    }
}
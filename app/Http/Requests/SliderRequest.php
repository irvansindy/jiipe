<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $locales = config('laravellocalization.supportedLocales');
        $isUpdate = $this->route('id') || $this->input('id');

        $rules = [
            'id' => 'nullable|exists:home_sliders,id',
            'slider_file' => [
                $isUpdate ? 'nullable' : 'required',
                'file',
                'mimetypes:image/jpeg,image/png,image/jpg,image/webp,video/mp4,video/ogg,video/webm',
                'max:20480', // 20MB
            ],
            'title' => 'required|array',
            'description' => 'required|array',
            'is_active' => 'nullable|boolean',
        ];

        // Add per-locale validation
        foreach (array_keys($locales) as $locale) {
            $rules["title.{$locale}"] = 'required|string|max:255';
            $rules["description.{$locale}"] = 'required|string';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'slider_file.required' => 'File (image or video) is required',
            'slider_file.file' => 'The uploaded item must be a valid file',
            'slider_file.mimetypes' => 'File must be an image (jpg, png, webp) or video (mp4, ogg, webm)',
            'slider_file.max' => 'File size must not exceed 20MB',
            'title.required' => 'Title is required',
            'title.array' => 'Title must be an array',
            'description.required' => 'Description is required',
            'description.array' => 'Description must be an array',
            'title.*.required' => 'Title is required for all languages',
            'title.*.string' => 'Title must be a string',
            'title.*.max' => 'Title must not exceed 255 characters',
            'description.*.required' => 'Description is required for all languages',
            'description.*.string' => 'Description must be a string',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $attributes = [];

        foreach ($locales as $locale => $properties) {
            $attributes["title.{$locale}"] = "Title ({$properties['native']})";
            $attributes["description.{$locale}"] = "Description ({$properties['native']})";
        }

        return $attributes;
    }
}
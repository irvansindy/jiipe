<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoneRequest extends FormRequest
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
            'zone_class' => 'required|exists:zone_classes,id',
            'zone_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB
        ];

        // Add per-locale validation
        foreach (array_keys($locales) as $locale) {
            $rules["zone_name.{$locale}"] = 'required|string|max:255';
            $rules["zone_subtitle.{$locale}"] = 'nullable|string|max:255';
            $rules["zone_description.{$locale}"] = 'required|string';
            $rules["zone_note.{$locale}"] = 'nullable|string|max:500';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'zone_class.required' => 'Zone class is required',
            'zone_class.exists' => 'Zone class is invalid',
            'zone_image.image' => 'File must be an image',
            'zone_image.mimes' => 'Image must be: jpeg, png, jpg, or webp',
            'zone_image.max' => 'Image size must not exceed 5MB',
            'zone_name.*.required' => 'Zone name is required for all languages',
            'zone_name.*.string' => 'Zone name must be a string',
            'zone_name.*.max' => 'Zone name must not exceed 255 characters',
            'zone_subtitle.*.string' => 'Subtitle must be a string',
            'zone_subtitle.*.max' => 'Subtitle must not exceed 255 characters',
            'zone_description.*.required' => 'Description is required for all languages',
            'zone_description.*.string' => 'Description must be a string',
            'zone_note.*.string' => 'Note must be a string',
            'zone_note.*.max' => 'Note must not exceed 500 characters',
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
            $attributes["zone_name.{$locale}"] = "Zone Name ({$properties['native']})";
            $attributes["zone_subtitle.{$locale}"] = "Subtitle ({$properties['native']})";
            $attributes["zone_description.{$locale}"] = "Description ({$properties['native']})";
            $attributes["zone_note.{$locale}"] = "Note ({$properties['native']})";
        }

        return $attributes;
    }
}
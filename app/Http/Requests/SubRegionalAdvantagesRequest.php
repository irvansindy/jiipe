<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubRegionalAdvantagesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        $isUpdate = $this->route('id') !== null;

        $rules = [
            'zone_id' => 'required|integer|exists:zones,id',
            'image' => $isUpdate ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024',
            'order' => 'nullable|integer|min:0',
        ];

        foreach ($locales as $locale) {
            $rules["name.{$locale}"] = 'required|string|max:255';
            $rules["description.{$locale}"] = 'nullable|string';
        }

        return $rules;
    }

    public function attributes(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $attributes = [
            'zone_id' => 'Zone',
            'image' => 'Image',
            'icon' => 'Icon',
            'order' => 'Display Order',
        ];

        foreach ($locales as $locale => $properties) {
            $langName = $properties['name'] ?? strtoupper($locale);
            $attributes["name.{$locale}"] = "Name ({$langName})";
            $attributes["description.{$locale}"] = "Description ({$langName})";
        }

        return $attributes;
    }

    public function messages(): array
    {
        return [
            'zone_id.required' => 'Zone is required',
            'zone_id.exists' => 'Selected zone does not exist',
            'image.required' => 'Image is required',
            'image.image' => 'File must be an image',
            'image.max' => 'Image size cannot exceed 2MB',
            'icon.image' => 'Icon file must be an image',
            'icon.max' => 'Icon size cannot exceed 1MB',
            'name.*.required' => 'Name field is required for all languages',
        ];
    }
}

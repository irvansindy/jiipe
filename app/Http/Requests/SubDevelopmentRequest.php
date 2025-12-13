<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubDevelopmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        $rules = [
            'zone_id' => 'required|integer|exists:zones,id',
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
        $attributes = ['zone_id' => 'Zone'];

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
            'name.*.required' => 'Name field is required for all languages',
        ];
    }
}

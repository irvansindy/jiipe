<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubResourceEnergyRequest extends FormRequest
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
        $rules = [
            'zone_id' => 'required|integer|exists:zones,id',
        ];

        foreach ($locales as $locale) {
            $rules["name.{$locale}"] = 'required|string|max:255';
            $rules["description.{$locale}"] = 'nullable|string';
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
            'zone_id' => 'Zone',
        ];

        foreach ($locales as $locale => $properties) {
            $langName = $properties['name'] ?? strtoupper($locale);
            $attributes["name.{$locale}"] = "Name ({$langName})";
            $attributes["description.{$locale}"] = "Description ({$langName})";
        }

        return $attributes;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'zone_id.required' => 'Zone is required',
            'zone_id.exists' => 'Selected zone does not exist',
            'name.*.required' => 'Name field is required for all languages',
        ];
    }
}
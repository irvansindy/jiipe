<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoneClusterRequest extends FormRequest
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
            'zone_id' => 'required|exists:zones,id',
        ];

        // Add validation for each locale
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
            'zone_id' => 'zone',
        ];

        foreach ($locales as $locale => $properties) {
            $attributes["name.{$locale}"] = "name ({$properties['native']})";
            $attributes["description.{$locale}"] = "description ({$properties['native']})";
        }

        return $attributes;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'zone_id.required' => 'Zone is required.',
            'zone_id.exists' => 'Selected zone does not exist.',
            'name.*.required' => 'The :attribute field is required.',
            'name.*.max' => 'The :attribute may not be greater than :max characters.',
        ];
    }
}
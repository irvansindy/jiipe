<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactOverviewRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $locales = array_keys(config('laravellocalization.supportedLocales'));
        $rules = [
            'contact_id' => 'nullable|exists:contact_overviews,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        ];

        // Add validation for each locale
        foreach ($locales as $locale) {
            $rules["title.{$locale}"] = 'nullable|string|max:255';
            $rules["subtitle.{$locale}"] = 'nullable|string|max:255';
            $rules["description.{$locale}"] = 'nullable|string';
            $rules["office_name.{$locale}"] = 'nullable|string|max:255';
            $rules["phone.{$locale}"] = 'nullable|string|max:50';
            $rules["address.{$locale}"] = 'nullable|string';
            $rules["map_link.{$locale}"] = 'nullable|string';
        }

        return $rules;
    }

    /**
     * Get custom attribute names for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $attributes = [
            'image' => 'image',
        ];

        foreach ($locales as $locale => $properties) {
            $localeName = $properties['native'];
            $attributes["title.{$locale}"] = "title ({$localeName})";
            $attributes["subtitle.{$locale}"] = "subtitle ({$localeName})";
            $attributes["description.{$locale}"] = "description ({$localeName})";
            $attributes["office_name.{$locale}"] = "office name ({$localeName})";
            $attributes["phone.{$locale}"] = "phone ({$localeName})";
            $attributes["address.{$locale}"] = "address ({$localeName})";
            $attributes["map_link.{$locale}"] = "map link ({$localeName})";
        }

        return $attributes;
    }

    /**
     * Get custom error messages for validator.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png, webp.',
            'image.max' => 'The image may not be greater than 2MB.',
            'contact_id.exists' => 'The selected contact overview is invalid.',
        ];
    }
}
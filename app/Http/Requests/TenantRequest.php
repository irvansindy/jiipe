<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $isUpdate = $this->route('tenant_id') || $this->input('tenant_id');

        $rules = [
            'tenant_id' => 'nullable|exists:tenants,id',
            'logo' => [$isUpdate ? 'nullable' : 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'is_active' => 'nullable|boolean',
            'name' => 'required|array',
        ];

        foreach (array_keys($locales) as $locale) {
            $rules["name.{$locale}"] = 'required|string|max:255';
            $rules["description.{$locale}"] = 'nullable|string';
        }

        return $rules;
    }

    public function messages(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $messages = [
            'logo.image' => 'File must be an image',
            'logo.mimes' => 'Logo must be jpeg, png, jpg, gif, or webp',
            'logo.max' => 'Logo size must not exceed 2MB',
        ];

        foreach ($locales as $locale => $properties) {
            $messages["name.{$locale}.required"] = "Tenant name ({$properties['native']}) is required";
        }

        return $messages;
    }
}

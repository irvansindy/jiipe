<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $rules = [];

        foreach (array_keys($locales) as $locale) {
            $rules["title.{$locale}"] = 'required|string|max:255';
            $rules["content.{$locale}"] = 'nullable|string';
        }

        return $rules;
    }

    public function attributes(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $attributes = [];

        foreach ($locales as $locale => $props) {
            $attributes["title.{$locale}"] = "Section Title ({$props['native']})";
            $attributes["content.{$locale}"] = "Section Content ({$props['native']})";
        }

        return $attributes;
    }
}

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
            $rules["section1_title.{$locale}"] = 'nullable|string|max:255';
            $rules["section1_content.{$locale}"] = 'nullable|string';
        }

        return $rules;
    }

    public function attributes(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $attributes = [];

        foreach ($locales as $locale => $props) {
            $attributes["section1_title.{$locale}"] = "Title ({$props['native']})";
            $attributes["section1_content.{$locale}"] = "Content ({$props['native']})";
        }

        return $attributes;
    }
}
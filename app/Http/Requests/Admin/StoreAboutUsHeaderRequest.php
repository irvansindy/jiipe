<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutUsHeaderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];
        foreach (config('laravellocalization.supportedLocales') as $locale => $props) {
            $rules["title_{$locale}"] = 'nullable|string|max:255';
            $rules["description_{$locale}"] = 'nullable|string';
        }

        if (! $this->input('id')) {
            $rules['cover_image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        } else {
            $rules['cover_image'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        }

        return $rules;
    }
}

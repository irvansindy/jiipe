<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutUsVisionMissionRequest extends FormRequest
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
        return $rules;
    }
}

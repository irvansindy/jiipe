<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutUsContentDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'icon' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer',
        ];

        foreach (config('laravellocalization.supportedLocales') as $locale => $props) {
            $rules["title_{$locale}"] = 'nullable|string|max:255';
            $rules["description_{$locale}"] = 'nullable|string';
        }
        return $rules;
    }
}

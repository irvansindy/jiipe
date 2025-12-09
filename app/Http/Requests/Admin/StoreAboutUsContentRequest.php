<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutUsContentRequest extends FormRequest
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
            $rules['content_image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        } else {
            $rules['content_image'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        }

        $rules['content_video_url'] = 'nullable|string|max:255';

        return $rules;
    }
}

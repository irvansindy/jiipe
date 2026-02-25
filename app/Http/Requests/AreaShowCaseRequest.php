<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaShowCaseRequest extends FormRequest
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
        $locales = config('laravellocalization.supportedLocales');
        $isUpdate = $this->route('id') || $this->input('id');

        $rules = [
            'id'           => 'nullable|exists:area_show_cases,id',
            'image'        => [
                $isUpdate ? 'nullable' : 'required',
                'file',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'image_mobile' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'position'  => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'title'       => 'required|array',
            'description' => 'required|array',
        ];

        foreach (array_keys($locales) as $locale) {
            $rules["title.{$locale}"]       = 'required|string|max:255';
            $rules["description.{$locale}"] = 'required|string';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'image.required'        => 'Image is required',
            'image.file'            => 'The uploaded item must be a valid file',
            'image.mimes'           => 'Image must be JPG, JPEG, PNG, or WEBP',
            'image.max'             => 'Image size must not exceed 2MB',
            'image_mobile.file'     => 'The uploaded item must be a valid file',
            'image_mobile.mimes'    => 'Mobile image must be JPG, JPEG, PNG, or WEBP',
            'image_mobile.max'      => 'Mobile image size must not exceed 2MB',
            'title.required'  => 'Title is required',
            'title.array'     => 'Title must be an array',
            'description.required' => 'Description is required',
            'description.array'    => 'Description must be an array',
            'title.*.required'       => 'Title is required for all languages',
            'title.*.string'         => 'Title must be a string',
            'title.*.max'            => 'Title must not exceed 255 characters',
            'description.*.required' => 'Description is required for all languages',
            'description.*.string'   => 'Description must be a string',
        ];
    }

    public function attributes(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $attributes = [];

        foreach ($locales as $locale => $properties) {
            $attributes["title.{$locale}"]       = "Title ({$properties['native']})";
            $attributes["description.{$locale}"] = "Description ({$properties['native']})";
        }

        return $attributes;
    }
}

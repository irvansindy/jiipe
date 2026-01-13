<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
        $locales = config('laravellocalization.supportedLocales');
        $isUpdate = $this->route('id') || $this->input('id');

        $rules = [
            'id' => 'nullable|exists:galleries,id',
            'gallery_topic' => 'required|exists:topics,id',
            'gallery_main_image' => [
                $isUpdate ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'gallery_status' => 'required|in:0,1',
            'gallery_video_url' => 'nullable|url|max:255',
            'news_title' => 'required|array',
            'news_title.*' => 'nullable|string|max:255',
            'gallery_image_detail' => 'nullable|array',
            'gallery_image_detail.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'gallery_topic.required' => 'Topic is required',
            'gallery_topic.exists' => 'Selected topic does not exist',
            'gallery_main_image.required' => 'Main image is required',
            'gallery_main_image.image' => 'Main image must be a valid image',
            'gallery_main_image.mimes' => 'Main image must be jpg, jpeg, png, or webp',
            'gallery_main_image.max' => 'Main image size must not exceed 2MB',
            'gallery_status.required' => 'Status is required',
            'gallery_status.in' => 'Status must be 0 or 1',
            'gallery_video_url.url' => 'Video URL must be a valid URL',
            'gallery_video_url.max' => 'Video URL must not exceed 255 characters',
            'news_title.required' => 'Title is required',
            'news_title.array' => 'Title must be an array',
            'news_title.*.max' => 'Title must not exceed 255 characters',
            'gallery_image_detail.array' => 'Detail images must be an array',
            'gallery_image_detail.*.image' => 'Detail image must be a valid image',
            'gallery_image_detail.*.mimes' => 'Detail image must be jpg, jpeg, png, or webp',
            'gallery_image_detail.*.max' => 'Detail image size must not exceed 2MB',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        $locales = config('laravellocalization.supportedLocales');
        $attributes = [];

        foreach ($locales as $locale => $properties) {
            $attributes["news_title.{$locale}"] = "Title ({$properties['native']})";
        }

        return $attributes;
    }
}

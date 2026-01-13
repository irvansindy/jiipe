<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FAQRequest extends FormRequest
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
        $rules = [
            'position' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ];

        // Validasi untuk setiap locale
        $locales = ['id', 'en', 'zh', 'ja', 'ko', 'tw'];

        foreach ($locales as $locale) {
            // Untuk bahasa wajib (id dan en)
            if (in_array($locale, ['id', 'en'])) {
                $rules["question_{$locale}"] = 'required|string|max:500';
                $rules["answer_{$locale}"] = 'required|string';
            } else {
                // Untuk bahasa opsional
                $rules["question_{$locale}"] = 'nullable|string|max:500';
                $rules["answer_{$locale}"] = 'nullable|string';
            }
        }

        return $rules;
    }

    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return [
            'position.required' => 'Position is required',
            'position.integer' => 'Position must be a number',
            'position.min' => 'Position must be at least 1',

            'question_id.required' => 'Question in Indonesian is required',
            'question_id.max' => 'Question in Indonesian cannot exceed 500 characters',
            'answer_id.required' => 'Answer in Indonesian is required',

            'question_en.required' => 'Question in English is required',
            'question_en.max' => 'Question in English cannot exceed 500 characters',
            'answer_en.required' => 'Answer in English is required',

            'question_zh.max' => 'Question in Chinese cannot exceed 500 characters',
            'question_ja.max' => 'Question in Japanese cannot exceed 500 characters',
            'question_ko.max' => 'Question in Korean cannot exceed 500 characters',
            'question_tw.max' => 'Question in Traditional Chinese cannot exceed 500 characters',
        ];
    }

    /**
     * Prepare the data for validation
     */
    protected function prepareForValidation(): void
    {
        // Convert checkbox value to boolean
        if ($this->has('is_active')) {
            $this->merge([
                'is_active' => filter_var($this->is_active, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false
            ]);
        } else {
            $this->merge(['is_active' => false]);
        }

        // Ensure position is an integer
        if ($this->has('position')) {
            $this->merge([
                'position' => (int) $this->position
            ]);
        }
    }

    /**
     * Get custom attributes for validator errors
     */
    public function attributes(): array
    {
        return [
            'question_id' => 'Question (Indonesian)',
            'answer_id' => 'Answer (Indonesian)',
            'question_en' => 'Question (English)',
            'answer_en' => 'Answer (English)',
            'question_zh' => 'Question (Chinese Simplified)',
            'answer_zh' => 'Answer (Chinese Simplified)',
            'question_ja' => 'Question (Japanese)',
            'answer_ja' => 'Answer (Japanese)',
            'question_ko' => 'Question (Korean)',
            'answer_ko' => 'Answer (Korean)',
            'question_tw' => 'Question (Chinese Traditional)',
            'answer_tw' => 'Answer (Chinese Traditional)',
        ];
    }
}
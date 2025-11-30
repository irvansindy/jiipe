<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FAQRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'position' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
            'question_id' => 'required|string|max:500',
            'question_en' => 'required|string|max:500',
            'question_zh' => 'nullable|string|max:500',
            'question_ja' => 'nullable|string|max:500',
            'question_ko' => 'nullable|string|max:500',
            'question_tw' => 'nullable|string|max:500',
            'answer_id' => 'required|string',
            'answer_en' => 'required|string',
            'answer_zh' => 'nullable|string',
            'answer_ja' => 'nullable|string',
            'answer_ko' => 'nullable|string',
            'answer_tw' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'position.required' => 'Position wajib diisi',
            'position.integer' => 'Position harus berupa angka',
            'position.min' => 'Position minimal 1',
            'question_id.required' => 'Pertanyaan (ID) wajib diisi',
            'question_id.max' => 'Pertanyaan (ID) maksimal 500 karakter',
            'question_en.required' => 'Pertanyaan (EN) wajib diisi',
            'question_en.max' => 'Pertanyaan (EN) maksimal 500 karakter',
            'answer_id.required' => 'Jawaban (ID) wajib diisi',
            'answer_en.required' => 'Jawaban (EN) wajib diisi',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'question_id' => 'Pertanyaan (Indonesian)',
            'question_en' => 'Pertanyaan (English)',
            'question_zh' => 'Pertanyaan (Chinese Simplified)',
            'question_ja' => 'Pertanyaan (Japanese)',
            'question_ko' => 'Pertanyaan (Korean)',
            'question_tw' => 'Pertanyaan (Chinese Traditional)',
            'answer_id' => 'Jawaban (Indonesian)',
            'answer_en' => 'Jawaban (English)',
            'answer_zh' => 'Jawaban (Chinese Simplified)',
            'answer_ja' => 'Jawaban (Japanese)',
            'answer_ko' => 'Jawaban (Korean)',
            'answer_tw' => 'Jawaban (Chinese Traditional)',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable|exists:career_emails,id',
            'position_id' => 'nullable|exists:careers,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'file_cv' => 'nullable|file|max:5120',
            'file_complementary_documents' => 'nullable|file|max:10240',
            'education' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'date' => 'nullable|date',
            'job_level' => 'nullable|string',
            'experience' => 'nullable|string',
        ];
    }
}

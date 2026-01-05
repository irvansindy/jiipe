<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'career_id' => 'nullable|exists:careers,id',
            'career_position' => 'required|string|max:255',
            'career_factory' => 'nullable|exists:factories,id',
            'career_location' => 'nullable|exists:master_company_locations,id',
            'career_job_level' => 'nullable|exists:master_job_levels,id',
            'career_range_salary' => 'nullable|string|max:255',
            'career_education' => 'nullable|exists:master_education,id',
            'career_experience' => 'nullable|string|max:255',
            'career_description' => 'nullable|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'career_position' => 'Position',
            'career_factory' => 'Factory',
            'career_location' => 'Location',
            'career_job_level' => 'Job Level',
            'career_range_salary' => 'Range Salary',
            'career_education' => 'Education',
            'career_experience' => 'Experience',
            'career_description' => 'Description',
        ];
    }
}

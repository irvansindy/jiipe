<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation
     */
    protected function prepareForValidation()
    {
        // Log untuk debugging
        \Log::info('Form data received', [
            'all_data' => $this->all(),
            'has_recaptcha' => $this->has('g-recaptcha-response')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'QuickAppointment.first_name' => 'required|string|max:255',
            'QuickAppointment.last_name' => 'required|string|max:255',
            'QuickAppointment.phone_number' => 'required|string|max:20',
            'QuickAppointment.email' => [
                'required',
                'email',
                'max:255',
                function ($attribute, $value, $fail) {
                    $blocked = [
                        'gmail.com',
                        'yahoo.com',
                        'hotmail.com',
                        'outlook.com'
                    ];

                    $domain = substr(strrchr($value, "@"), 1);

                    if (in_array(strtolower($domain), $blocked)) {
                        $fail('Gunakan email perusahaan, email publik tidak diperbolehkan.');
                    }
                },
            ],
            'QuickAppointment.company_name' => 'required|string|max:255',
            'QuickAppointment.country_origin' => 'required|in:Indonesia,Outside of Indonesia',
            'QuickAppointment.reason' => 'required|string',
            // reason_other wajib diisi jika reason = "Other"
            'QuickAppointment.reason_other' => 'required_if:QuickAppointment.reason,Other|nullable|string|max:255',
            'QuickAppointment.classification' => 'required|string',
            // classification_other wajib diisi jika classification = "Other"
            'QuickAppointment.classification_other' => 'required_if:QuickAppointment.classification,Other|nullable|string|max:255',
            'QuickAppointment.land_plot' => 'required|numeric|min:0',
            'QuickAppointment.timeline' => 'required|string',
            'QuickAppointment.power' => 'required|numeric|min:0',
            'QuickAppointment.industrial_water' => 'required|numeric|min:0',
            'QuickAppointment.natural_gas' => 'required|numeric|min:0',
            'QuickAppointment.throughput_via_seaport' => 'required|numeric|min:0',
            // Temporary disabled untuk testing - ENABLE kembali setelah testing selesai
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'QuickAppointment.first_name.required' => 'First Name is required',
            'QuickAppointment.last_name.required' => 'Last Name is required',
            'QuickAppointment.phone_number.required' => 'Phone Number is required',
            'QuickAppointment.email.required' => 'Email is required',
            'QuickAppointment.email.email' => 'Email must be a valid email address',
            'QuickAppointment.company_name.required' => 'Company Name is required',
            'QuickAppointment.country_origin.required' => 'Country Origin is required',
            'QuickAppointment.reason.required' => 'Reason is required',
            'QuickAppointment.reason_other.required_if' => 'Please specify other reason',
            'QuickAppointment.classification.required' => 'Industry Classification is required',
            'QuickAppointment.classification_other.required_if' => 'Please specify other industry classification',
            'QuickAppointment.land_plot.required' => 'Land Plot is required',
            'QuickAppointment.land_plot.numeric' => 'Land Plot must be a number',
            'QuickAppointment.timeline.required' => 'Timeline is required',
            'QuickAppointment.power.required' => 'Total Required Power is required',
            'QuickAppointment.power.numeric' => 'Total Required Power must be a number',
            'QuickAppointment.industrial_water.required' => 'Total Industrial Water is required',
            'QuickAppointment.industrial_water.numeric' => 'Total Industrial Water must be a number',
            'QuickAppointment.natural_gas.required' => 'Total Required Natural Gas is required',
            'QuickAppointment.natural_gas.numeric' => 'Total Required Natural Gas must be a number',
            'QuickAppointment.throughput_via_seaport.required' => 'Throughput via Seaport is required',
            'QuickAppointment.throughput_via_seaport.numeric' => 'Throughput via Seaport must be a number',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification',
            'g-recaptcha-response.captcha' => 'reCAPTCHA verification failed',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'QuickAppointment.first_name' => 'First Name',
            'QuickAppointment.last_name' => 'Last Name',
            'QuickAppointment.phone_number' => 'Phone Number',
            'QuickAppointment.email' => 'Email',
            'QuickAppointment.company_name' => 'Company Name',
            'QuickAppointment.country_origin' => 'Country Origin',
            'QuickAppointment.reason' => 'Reason',
            'QuickAppointment.classification' => 'Industry Classification',
            'QuickAppointment.land_plot' => 'Land Plot',
            'QuickAppointment.timeline' => 'Timeline',
            'QuickAppointment.power' => 'Total Required Power',
            'QuickAppointment.industrial_water' => 'Total Industrial Water',
            'QuickAppointment.natural_gas' => 'Total Required Natural Gas',
            'QuickAppointment.throughput_via_seaport' => 'Throughput via Seaport',
            'g-recaptcha-response' => 'reCAPTCHA',
        ];
    }
}
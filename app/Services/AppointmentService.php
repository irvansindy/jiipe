<?php

namespace App\Services;

use App\Models\PageAppointment;
use Illuminate\Support\Facades\DB;
use Exception;

class AppointmentService
{
    /**
     * Create new appointment
     */
    public function createAppointment(array $data): PageAppointment
    {
        DB::beginTransaction();

        try {
            $appointment = PageAppointment::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone_number'],
                'company_name' => $data['company_name'],
                'country_origin' => $data['country_origin'],
                'reason' => $data['reason'],
                'reason_other' => !empty($data['reason_other']) ? $data['reason_other'] : null,
                'classification' => $data['classification'],
                'classification_other' => !empty($data['classification_other']) ? $data['classification_other'] : null,
                'land_plot' => $data['land_plot'],
                'timeline' => $data['timeline'],
                'power' => $data['power'],
                'industrial_water' => $data['industrial_water'],
                'natural_gas' => $data['natural_gas'],
                'throughput_via_seaport' => $data['throughput_via_seaport'],
                'status' => 0, // 0 = pending, 1 = processed
            ]);

            DB::commit();

            return $appointment;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get all appointments
     */
    public function getAllAppointments()
    {
        return PageAppointment::orderBy('created_at', 'desc')->get();
    }

    /**
     * Get appointment by ID
     */
    public function getAppointmentById(int $id): PageAppointment
    {
        return PageAppointment::findOrFail($id);
    }

    /**
     * Update appointment status
     */
    public function updateStatus(int $id, int $status): PageAppointment
    {
        $appointment = PageAppointment::findOrFail($id);
        $appointment->status = $status;
        $appointment->save();

        return $appointment;
    }

    /**
     * Delete appointment
     */
    public function deleteAppointment(int $id): bool
    {
        $appointment = PageAppointment::findOrFail($id);
        return $appointment->delete();
    }
}
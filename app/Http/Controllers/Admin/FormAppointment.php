<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentTranslation;
use App\Models\BasicInformation;
use App\Models\BasicInformationTranslation;
use App\Models\Reason;
use App\Models\ReasonTranslation;
use App\Models\PageAppointment;
use App\Helpers\FormatResponseJson;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
class FormAppointment extends Controller
{
    public function index()
    {
        return view('layouts.admin.form_appointment.index');
    }
    public function formView()
    {
        $appointment = Appointment::with('translations')->first();
        $basicInfo = BasicInformation::with('translations')->first();
        $reason = Reason::with('translations')->first();
        return view('layouts.admin.form_appointment.form_view', compact('appointment', 'basicInfo', 'reason'));
    }
    public function fetchAppointment(Request $request)
    {
        try {
            $query = PageAppointment::query();

            // apply filters if provided
            if ($request->filled('reason')) {
                $query->where('reason', $request->input('reason'));
            }
            if ($request->filled('classification')) {
                $query->where('classification', $request->input('classification'));
            }
            if ($request->filled('land_plot')) {
                $query->where('land_plot', $request->input('land_plot'));
            }
            if ($request->filled('timeline')) {
                $query->where('timeline', $request->input('timeline'));
            }
            if ($request->filled('power')) {
                $query->where('power', $request->input('power'));
            }
            if ($request->filled('industrial_water')) {
                $query->where('industrial_water', $request->input('industrial_water'));
            }
            if ($request->filled('natural_gas')) {
                $query->where('natural_gas', $request->input('natural_gas'));
            }
            if ($request->filled('throughput_via_seaport')) {
                $query->where('throughput_via_seaport', $request->input('throughput_via_seaport'));
            }

            $appointments = $query->get(['first_name', 'last_name', 'phone', 'email', 'company_name', 'country_origin', 'reason', 'classification', 'industrial_water', 'land_plot', 'timeline', 'power', 'natural_gas', 'throughput_via_seaport', 'created_at']);

            return FormatResponseJson::success($appointments, 'Data fetched successfully.');
        } catch (\Throwable $th) {
            return FormatResponseJson::error(null, $th->getMessage(), 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');
            $validator = Validator::make($request->all(), [
                'title_quick_appointment'   => 'required|array',
                'appointment_description'   => 'required|array',
                'title_quick_appointment.*' => 'required|string|max:255',
                'appointment_description.*' => 'required|string',
            ]);
            $validator->setAttributeNames([
                'title_quick_appointment.id' => 'Title Quick Appointment (ID)',
                'title_quick_appointment.en' => 'Title Quick Appointment (EN)',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $appointment = Appointment::first();
            if (!$appointment) {
                $appointment = Appointment::create([
                    'title' => $request->title_quick_appointment['en']
                ]);
            } else {
                $appointment->update([
                    'title' => $request->title_quick_appointment['en']
                ]);
            }

            foreach ($locales as $locale => $properties) {
                AppointmentTranslation::updateOrCreate(
                    [
                        'appointment_id' => $appointment->id,
                        'locale' => $locale,
                    ],
                    [
                        'title_quick_appointment' => $request->title_quick_appointment[$locale] ?? null,
                        'appointment_description' => $request->appointment_description[$locale] ?? null,
                    ]
                );
            }

            return redirect()->back()->with('success', 'Appointment saved successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function storeBasicInformation(Request $request)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');
            $validator = Validator::make($request->all(), [
                // ...validation rules...
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $basicInfo = BasicInformation::first();
            if (!$basicInfo) {
                $basicInfo = BasicInformation::create();
            }

            foreach ($locales as $locale => $properties) {
                BasicInformationTranslation::updateOrCreate(
                    [
                        'basic_information_id' => $basicInfo->id,
                        'locale' => $locale,
                    ],
                    [
                        'title_basic_information' => $request->title_basic_information[$locale],
                        'label_full_name' => $request->label_full_name[$locale],
                        'placeholder_full_name_1' => $request->placeholder_full_name_1[$locale],
                        'placeholder_full_name_2' => $request->placeholder_full_name_2[$locale],
                        'label_phone_number' => $request->label_phone_number[$locale],
                        'placeholder_phone_number' => $request->placeholder_phone_number[$locale],
                        'label_email' => $request->label_email[$locale],
                        'placeholder_email' => $request->placeholder_email[$locale],
                        'label_company_name' => $request->label_company_name[$locale],
                        'placeholder_company_name' => $request->placeholder_company_name[$locale],
                        'label_company_origin_country' => $request->label_company_origin_country[$locale],
                        'placeholder_company_origin_country' => $request->placeholder_company_origin_country[$locale],
                    ]
                );
            }

            return redirect()->back()->with('success', 'Basic Information saved successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function storeReason(Request $request)
    {
        try {
            $locales = config('laravellocalization.supportedLocales');
            $validator = Validator::make($request->all(), [
                // ...validation rules...
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $reason = Reason::first();
            if (!$reason) {
                $reason = Reason::create();
            }

            foreach ($locales as $locale => $properties) {
                ReasonTranslation::updateOrCreate(
                    [
                        'reason_id' => $reason->id,
                        'locale' => $locale,
                    ],
                    [
                        'label_reason' => $request->label_reason[$locale],
                        'label_industry' => $request->label_industry[$locale],
                        'label_land_plot' => $request->label_land_plot[$locale],
                        'label_timeline_construction' => $request->label_timeline_construction[$locale],
                        'label_energy_utility' => $request->label_energy_utility[$locale],
                        'placeholder_industry' => $request->placeholder_industry[$locale],
                        'placeholder_land_plot' => $request->placeholder_land_plot[$locale],
                        'placeholder_timeline_construction' => $request->placeholder_timeline_construction[$locale],
                        'placeholder_total_power' => $request->placeholder_total_power[$locale],
                        'placeholder_total_water' => $request->placeholder_total_water[$locale],
                        'placeholder_total_gas' => $request->placeholder_total_gas[$locale],
                        'placeholder_throughput_seaport' => $request->placeholder_throughput_seaport[$locale],
                    ]
                );
            }

            return redirect()->back()->with('success', 'Reason saved successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function exportExcel(Request $request)
    {
        try {
            $query = PageAppointment::query();

            // Apply same filters as fetchAppointment for consistency
            if ($request->filled('reason')) {
                $query->where('reason', $request->input('reason'));
            }
            if ($request->filled('classification')) {
                $query->where('classification', $request->input('classification'));
            }
            if ($request->filled('land_plot')) {
                $query->where('land_plot', $request->input('land_plot'));
            }
            if ($request->filled('timeline')) {
                $query->where('timeline', $request->input('timeline'));
            }
            if ($request->filled('power')) {
                $query->where('power', $request->input('power'));
            }
            if ($request->filled('industrial_water')) {
                $query->where('industrial_water', $request->input('industrial_water'));
            }
            if ($request->filled('natural_gas')) {
                $query->where('natural_gas', $request->input('natural_gas'));
            }
            if ($request->filled('throughput_via_seaport')) {
                $query->where('throughput_via_seaport', $request->input('throughput_via_seaport'));
            }

            $appointments = $query->orderBy('created_at', 'desc')->get([
                'first_name', 'last_name', 'phone', 'email', 'company_name', 'country_origin',
                'reason', 'reason_other', 'classification', 'classification_other',
                'land_plot', 'timeline', 'power', 'industrial_water', 'natural_gas',
                'throughput_via_seaport', 'created_at',
            ]);

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Appointment List');

            // --- Header styling ---
            $headerStyle = [
                'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'name' => 'Arial', 'size' => 11],
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '1F4E79']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FFFFFF']]],
            ];

            $dataStyle = [
                'font'      => ['name' => 'Arial', 'size' => 10],
                'alignment' => ['vertical' => Alignment::VERTICAL_TOP, 'wrapText' => true],
                'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D0D0D0']]],
            ];

            $altRowStyle = [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'EBF3FB']],
            ];

            // --- Title row ---
            $sheet->mergeCells('A1:Q1');
            $sheet->setCellValue('A1', 'Appointment for Industrial Land Acquisition - Request for Proposal');
            $sheet->getStyle('A1')->applyFromArray([
                'font'      => ['bold' => true, 'size' => 13, 'name' => 'Arial', 'color' => ['rgb' => '1F4E79']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            ]);
            $sheet->getRowDimension(1)->setRowHeight(30);

            // Export date row
            $sheet->mergeCells('A2:Q2');
            $sheet->setCellValue('A2', 'Exported on: ' . now()->format('d F Y, H:i'));
            $sheet->getStyle('A2')->applyFromArray([
                'font'      => ['italic' => true, 'size' => 9, 'name' => 'Arial', 'color' => ['rgb' => '888888']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
            ]);
            $sheet->getRowDimension(2)->setRowHeight(18);

            // --- Column headers (row 3) ---
            $headers = [
                'A' => 'No.',
                'B' => 'First Name',
                'C' => 'Last Name',
                'D' => 'Phone',
                'E' => 'Email',
                'F' => 'Company Name',
                'G' => 'Country of Origin',
                'H' => 'Reason',
                'I' => 'Reason (Other)',
                'J' => 'Industry (Classification)',
                'K' => 'Classification (Other)',
                'L' => 'Land Plot',
                'M' => 'Timeline',
                'N' => 'Total Required Power',
                'O' => 'Industrial Water',
                'P' => 'Natural Gas',
                'Q' => 'Throughput via Seaport',
                // 'R' is Date — handled below
            ];

            // Add Date header separately since it comes after Q
            $allHeaders = array_merge($headers, ['R' => 'Date Submitted']);

            foreach ($allHeaders as $col => $label) {
                $sheet->setCellValue("{$col}3", $label);
            }
            $sheet->getStyle('A3:R3')->applyFromArray($headerStyle);
            $sheet->getRowDimension(3)->setRowHeight(40);

            // --- Column widths ---
            $colWidths = [
                'A' => 5, 'B' => 15, 'C' => 15, 'D' => 16, 'E' => 28,
                'F' => 25, 'G' => 20, 'H' => 22, 'I' => 18, 'J' => 25,
                'K' => 18, 'L' => 14, 'M' => 16, 'N' => 18, 'O' => 20,
                'P' => 20, 'Q' => 22, 'R' => 20,
            ];
            foreach ($colWidths as $col => $width) {
                $sheet->getColumnDimension($col)->setWidth($width);
            }

            // --- Data rows ---
            $rowNum = 4;
            foreach ($appointments as $index => $item) {
                $sheet->setCellValue("A{$rowNum}", $index + 1);
                $sheet->setCellValue("B{$rowNum}", $item->first_name);
                $sheet->setCellValue("C{$rowNum}", $item->last_name);
                $sheet->setCellValue("D{$rowNum}", $item->phone);
                $sheet->setCellValue("E{$rowNum}", $item->email);
                $sheet->setCellValue("F{$rowNum}", $item->company_name);
                $sheet->setCellValue("G{$rowNum}", $item->country_origin);
                $sheet->setCellValue("H{$rowNum}", $item->reason);
                $sheet->setCellValue("I{$rowNum}", $item->reason_other);
                $sheet->setCellValue("J{$rowNum}", $item->classification);
                $sheet->setCellValue("K{$rowNum}", $item->classification_other);
                $sheet->setCellValue("L{$rowNum}", $item->land_plot);
                $sheet->setCellValue("M{$rowNum}", $item->timeline);
                $sheet->setCellValue("N{$rowNum}", $item->power);
                $sheet->setCellValue("O{$rowNum}", $item->industrial_water);
                $sheet->setCellValue("P{$rowNum}", $item->natural_gas);
                $sheet->setCellValue("Q{$rowNum}", $item->throughput_via_seaport);
                $sheet->setCellValue("R{$rowNum}", $item->created_at ? $item->created_at->format('d/m/Y H:i') : '');

                $sheet->getStyle("A{$rowNum}:R{$rowNum}")->applyFromArray($dataStyle);

                // Alternating row color
                if ($index % 2 === 1) {
                    $sheet->getStyle("A{$rowNum}:R{$rowNum}")->applyFromArray($altRowStyle);
                }

                $sheet->getRowDimension($rowNum)->setRowHeight(20);
                $rowNum++;
            }

            // Center the "No." column
            $sheet->getStyle("A4:A{$rowNum}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Freeze panes: keep header visible while scrolling
            $sheet->freezePane('A4');

            // Auto-filter on headers
            $sheet->setAutoFilter("A3:R3");

            $filename = 'appointment_export_' . now()->format('Ymd_His') . '.xlsx';

            $writer = new Xlsx($spreadsheet);

            return response()->streamDownload(function () use ($writer) {
                $writer->save('php://output');
            }, $filename, [
                'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Cache-Control'       => 'max-age=0',
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Export failed: ' . $th->getMessage());
        }
    }
}

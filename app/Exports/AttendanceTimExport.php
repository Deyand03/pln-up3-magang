<?php

namespace App\Exports;

use App\Models\Applications;
use App\Models\Internships;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class AttendanceTimExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $timId;

    public function __construct($timId)
    {
        $this->timId = $timId;
    }

    public function array(): array
    {
        $tim = Applications::findOrFail($this->timId);

        $interns = Internships::with(['user', 'attendances'])
            ->where('application_id', $this->timId)
            ->get();

        $data = [];

        $startDate = Carbon::parse($tim->start_date);
        $endDate = Carbon::parse($tim->end_date);
        $period = CarbonPeriod::create($startDate, $endDate);

        foreach ($period as $date) {

            if ($date->isWeekend()) {
                continue;
            }

            $dateString = $date->format('Y-m-d');
            $displayDate = $date->translatedFormat('d M Y');

            foreach ($interns as $intern) {

                $attendance = $intern->attendances->firstWhere('date', $dateString);

                $status = '';
                $checkIn = '';
                $checkOut = '';
                $keterangan = '';

                if ($attendance) {
                    $status = ucfirst($attendance->status); // hadir, sakit, izin, alfa -> Hadir, Sakit, dsb

                    $checkIn = $attendance->check_in ? Carbon::parse($attendance->check_in)->format('H:i') : '-';
                    $checkOut = $attendance->check_out ? Carbon::parse($attendance->check_out)->format('H:i') : '-';

                    $keterangan = $attendance->notes ?? '';
                } else {
                    if ($date->isPast() && !$date->isToday()) {
                        $status = 'Alfa';
                        $checkIn = '-';
                        $checkOut = '-';
                        $keterangan = 'Tidak absen';
                    }
                }

                $data[] = [
                    'Tanggal'    => $displayDate,
                    'Nama'       => $intern->user->name,
                    'Kehadiran'  => $status,
                    'Jam Datang' => $checkIn,
                    'Jam Pulang' => $checkOut,
                    'Keterangan' => $keterangan,
                ];
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama',
            'Kehadiran',
            'Jam Datang',
            'Jam Pulang',
            'Keterangan'
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF3B82F6']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:A' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('C2:E' . $highestRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [];
    }
}

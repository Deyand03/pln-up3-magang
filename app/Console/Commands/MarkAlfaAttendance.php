<?php

namespace App\Console\Commands;

use App\Models\Attendances;
use App\Models\Internships;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('attendance:mark-alfa')]
#[Description('Otomatis menandai alfa bagi pemagang yang tidak absen hari ini')]
class MarkAlfaAttendance extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today('Asia/Jakarta');

        $activeInterns = Internships::where('status', 'active')->get();

        foreach ($activeInterns as $intern) {
            $hasAttendance = Attendances::where('internship_id', $intern->id)
                ->whereDate('date', $today)
                ->exists();

            if (!$hasAttendance) {
                Attendances::create([
                    'internship_id' => $intern->id,
                    'date' => $today,
                    'status' => 'alfa',
                    'notes' => 'Tanpa keterangan (Dibuat otomatis oleh sistem)',
                    'is_valid' => false,
                ]);
            }
        }

        $this->info('Pengecekan Alfa untuk tanggal ' . $today->toDateString() . ' berhasil dieksekusi!');
    }
}

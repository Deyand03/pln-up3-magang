<?php

namespace App\Console\Commands;

use App\Models\Applications;
use App\Models\Internships;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

#[Signature('magang:update-status')]
#[Description('Otomatis update status intern jadi completed jika end_date sudah lewat')]
class UpdateMagangStatus extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();

        // Cari ID pendaftaran yang masa magangnya sudah lewat
        $expiredAppIds = Applications::whereDate('end_date', '<', $today)->pluck('id');

        if ($expiredAppIds->isNotEmpty()) {
            // Update semua intern yang terkait dan statusnya masih aktif
            $updatedRows = Internships::whereIn('application_id', $expiredAppIds)
                ->where('status', 'active')
                ->update(['status' => 'completed']);

            $this->info("Berhasil mengupdate {$updatedRows} data intern menjadi completed.");
        } else {
            $this->info("Tidak ada data magang yang perlu diupdate hari ini.");
        }
    }
}

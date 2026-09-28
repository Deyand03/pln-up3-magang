<?php

namespace Database\Seeders;

use App\Models\Attendances;
use App\Models\Evaluation;
use App\Models\Internships;
use App\Models\Logbooks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $internship = Internships::first();

        if (!$internship) return;

        // 1. Data Dummy Presensi Harian
        Attendances::create([
            'internship_id' => $internship->id,
            'date' => '2026-09-01',
            'check_in' => '07:45:00',
            'check_out' => '16:30:00',
            'status' => 'hadir',
            'notes' => 'Hadir tepat waktu',
        ]);

        Attendances::create([
            'internship_id' => $internship->id,
            'date' => '2026-09-02',
            'check_in' => '07:50:00',
            'check_out' => '16:35:00',
            'status' => 'hadir',
            'notes' => 'Hadir tepat waktu',
        ]);

        // 2. Data Dummy Logbook Harian
        Logbooks::create([
            'internship_id' => $internship->id,
            'date' => '2026-09-01',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '16:00:00',
            'nama_kegiatan' => 'Orientasi Divisi TI',
            'deskripsi_kegiatan' => 'Orientasi divisi TI dan pengenalan arsitektur jaringan kantor PLN UP3 Jambi.',
        ]);

        Logbooks::create([
            'internship_id' => $internship->id,
            'date' => '2026-09-02',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '16:00:00',
            'nama_kegiatan' => 'Maintenance Server Lokal',
            'deskripsi_kegiatan' => 'Membantu maintenance server lokal dan monitoring traffic data harian.',
        ]);
    }
}

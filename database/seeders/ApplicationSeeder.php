<?php

namespace Database\Seeders;

use App\Models\Applications;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Applications::create([
            'registration_number' => 'PLN-MG-20260901',
            'name' => 'Defry',
            'email' => 'defry@gmail.com',
            'phone' => '089566778899',
            'nim_nisn' => '701210001',
            'institusi' => 'Universitas Jambi',
            'jurusan' => 'Sistem Informasi',
            'total_interns' => 3,
            'start_date' => '2026-08-03',
            'end_date' => '2026-10-17',
            'recommendation_letter' => 'uploads/proposals/surat_rekomendasi_unja.pdf',
            'proposal' => 'uploads/proposals/proposal_magang_unja.pdf',
            'registration_token' => 'PLN-UNJA-2026',
            'token_quota' => 3,
            'token_used' => 1,
            'status' => 'approved',
        ]);

        // Pengajuan 2: Masih Pending (Menunggu Verifikasi HRD)
        Applications::create([
            'registration_number' => 'PLN-MG-20260905',
            'name' => 'Megumi',
            'email' => 'megumi@gmail.com',
            'phone' => '081377889900',
            'nim_nisn' => 'F1E120045',
            'institusi' => 'Universitas Jambi',
            'jurusan' => 'Hukum',
            'total_interns' => 2,
            'start_date' => '2026-10-01',
            'end_date' => '2026-12-31',
            'recommendation_letter' => 'uploads/proposals/surat_rekomendasi_unja.pdf',
            'proposal' => 'uploads/proposals/proposal_magang_unja.pdf',
            'status' => 'pending',
        ]);
    }
}

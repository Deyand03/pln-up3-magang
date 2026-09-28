<?php

namespace Database\Seeders;

use App\Models\Applications;
use App\Models\Internships;
use App\Models\User;
use Illuminate\Database\Seeder;

class InternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $internUser = User::where('email', 'defry@gmail.com')->first();
        $mentorUser = User::where('email', 'k3@pln.co.id')->first();
        $application = Applications::where('registration_number', 'PLN-MG-20260901')->first();

        if ($internUser && $application) {
            Internships::create([
                'user_id' => $internUser->id,
                'mentor_id' => $mentorUser?->id,
                'application_id' => $application->id,
                'department' => 'K3 & Lingkungan',
                'start_date' => '2026-09-01',
                'end_date' => '2026-11-30',
                'status' => 'active',
            ]);
        }
    }
}

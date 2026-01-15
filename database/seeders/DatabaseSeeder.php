<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */
        for ($i = 1; $i <= 2; $i++) {
            User::create([
                'name' => "Admin $i",
                'email' => "admin$i@gmail.com",
                'nisn' => '12345678' . $i,
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CANDIDATES
        |--------------------------------------------------------------------------
        */
        $candidates = [
            ['name' => 'Kotak Kosong', 'election_number' => 1, 'kelas' => '-'],
            ['name' => 'Alex Johnson - Richard Henry', 'election_number' => 2, 'kelas' => 'XII RPL 1'],
            ['name' => 'Sarah Smith - David Johnson', 'election_number' => 3, 'kelas' => 'XII TKJ 2'],
        ];

        foreach ($candidates as $candidate) {

            $pictureFilename = Str::random(10) . '.jpg';
            $resumeFilename  = Str::random(10) . '.pdf';

            $picturePath = 'candidate-pictures/' . $pictureFilename;
            $resumePath  = 'candidate-resumes/' . $resumeFilename;

            // Generate dummy image
            $imageUrl = 'https://i.pravatar.cc/150?img=' . rand(1, 70);
            try {
                $imageContent = file_get_contents($imageUrl);
                Storage::disk('public')->put($picturePath, $imageContent);
            } catch (\Exception $e) {
                // Fallback jika internet mati/request gagal
                Storage::disk('public')->put($picturePath, 'dummy content');
            }

            // Generate dummy PDF
            $pdf = Pdf::loadHTML('<h1>Fake Resume</h1><p>Resume pendaftaran untuk ' . $candidate['name'] . '</p>');
            Storage::disk('public')->put($resumePath, $pdf->output());

            Candidate::create([
                'name'            => $candidate['name'],
                'kelas'           => $candidate['kelas'], // Menambahkan field kelas
                'election_number' => $candidate['election_number'],
                'picture'         => $picturePath,
                'resume'          => $resumePath,
                'visi'            => $faker->sentence(10), // Menambahkan visi dummy
                'misi'            => $faker->paragraph(3), // Menambahkan misi dummy
                'total_voter'     => 0,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VOTERS (MANUAL)
        |--------------------------------------------------------------------------
        */
        $voters = [
            [
                'name' => "Bagus Dwi Risnaldi",
                'email' => "bdwirisnaldi@gmail.com",
                'nisn' => '5520122099',
            ],
            [
                'name' => "Aling",
                'email' => "aling@gmail.com",
                'nisn' => '5520122098',
            ],
            [
                'name' => "Fauzy",
                'email' => "fauzy@gmail.com",
                'nisn' => '5520122100',
            ],
        ];

        foreach ($voters as $voter) {
            User::create([
                'name'     => $voter['name'],
                'email'    => $voter['email'],
                'nisn'     => $voter['nisn'],
                'password' => bcrypt('12345678'),
                'role'     => 'voter',
                'choice'   => null,
            ]);
        }
    }
}
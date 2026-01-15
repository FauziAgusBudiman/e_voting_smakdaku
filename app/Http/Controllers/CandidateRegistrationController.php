<?php

namespace App\Http\Controllers;

use App\Models\Candidate; // Pastikan Model di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateRegistrationController extends Controller
{
    /**
     * Menampilkan form pendaftaran untuk siswa
     */
    public function index() {
        return view('register-kandidat');
    }

    /**
     * Menyimpan data pendaftaran ke database
     */
    public function store(Request $request) {
    $request->validate([
        'nama' => 'required|string|max:255',
        'kelas' => 'required|string',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'bukti_organisasi' => 'required|file|mimes:pdf,jpg,png|max:2048',
        'visi' => 'required|string',
        'misi' => 'required|string',
    ]);

    // Simpan file
    $picturePath = $request->file('foto')->store('candidates/pictures', 'public');
    $resumePath = $request->file('bukti_organisasi')->store('candidates/resumes', 'public');

    \App\Models\Candidate::create([
        'name' => $request->nama,
        'kelas' => $request->kelas,
        'picture' => $picturePath,
        'resume' => $resumePath,
        'visi' => $request->visi,
        'misi' => $request->misi,
        'election_number' => null, // Diisi nanti oleh admin
        'total_voter' => 0,
    ]);

    return back()->with('success', 'Pendaftaran Anda berhasil dikirim!');
}

    /**
     * Menampilkan daftar kandidat untuk diverifikasi Admin
     */
    public function adminIndex() 
    {
        // Mengambil data asli dari database agar properti 'picture' dkk terbaca
        $candidates = Candidate::latest()->get();

        return view('admin.verifikasi-kandidat', compact('candidates'));
    }

    /**
     * Aksi Verifikasi: Memberikan nomor urut (election_number)
     */
    public function updateStatus(Request $request, $id)
{
    $candidate = Candidate::findOrFail($id);

    // Ambil semua nomor urut yang sudah terpakai
    $usedNumbers = Candidate::whereNotNull('election_number')
                            ->pluck('election_number')
                            ->toArray();

    // Cari nomor terkecil yang tersedia mulai dari 1
    $nextNumber = 1;
    while (in_array($nextNumber, $usedNumbers)) {
        $nextNumber++;
    }

    $candidate->update([
        'election_number' => $nextNumber
    ]);

    return back()->with('success', "Kandidat {$candidate->name} diverifikasi dengan No Urut {$nextNumber}");
}
}
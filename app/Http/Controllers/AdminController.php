<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::where('role', 'admin')->get();

        return view('admin.index', [
            'title' => 'E-Voting-SMAKDAKU | Admin List',
            'admin' => $admins,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
        ], [
            'email.unique' => 'Email is taken.',
        ]);

        $validatedData['password'] = Hash::make($request->password);
        $validatedData['role'] = 'admin';

        User::create($validatedData);

        return redirect()->route('admin.index')->with('message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admins = User::findOrFail($id);

        return response()->json($admins);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'required|min:8',
        ]);

        $admins = User::findOrFail($id);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        $admins->update($validatedData);

        return redirect()->route('admin.index')->with('message', 'Data sukses terupload!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $candidate = Candidate::findOrFail($id);

    // 1. Hapus foto & berkas agar tidak membebani storage
    if ($candidate->picture) {
        Storage::delete('public/' . $candidate->picture);
    }
    if ($candidate->resume) {
        Storage::delete('public/' . $candidate->resume);
    }

    // 2. Gunakan forceDelete() jika Anda menggunakan SoftDeletes 
    // agar nomor urut benar-benar hilang dari record database
    $candidate->forceDelete(); 

    return redirect()->back()->with('success', 'Kandidat berhasil dihapus permanen. Nomor urut kini tersedia kembali.');
}
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
class VotersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voters = User::where('role', 'voter')->get()->map(function ($user) {
            $status = $user->choice !== null ? 'Voted' : 'Not Voted';
            $user->status = $status;

            return $user;
        });

        return view('voters.index', [
            'title' => 'E-Voting-SMAKDAKU | Voters List',
            'voters' => $voters,
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
        $validatedData['role'] = 'voter';

        User::create($validatedData);

        return redirect()->route('voters.index')->with('message', 'Data added succesfully!');
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
        $voters = User::findOrFail($id);

        return response()->json($voters);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // 1. Validasi
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6', // password boleh kosong (nullable)
    ]);

    $voter = User::findOrFail($id);
    
    // 2. Persiapkan data update
    $data = [
        'name'  => $request->name,
        'email' => $request->email,
    ];

    // 3. Cek jika password diisi
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $voter->update($data);

    return redirect()->route('voters.index')->with('message', 'Voter updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     User::destroy($id);

    //     return redirect()->route('voters.index')->with('message', 'Data deleted successfully!');
    // }

    public function exportExcel()
    {
        $voters = User::where('role', 'voter')->get()->map(function ($user) {
            $status = $user->choice !== null ? 'Voted' : 'Not Voted';
            $user->status = $status;

            return $user;
        });

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        // Set header row
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Voting Status');

        // Make headers bold
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);

        // Add data rows
        $row = 2;
        foreach ($voters as $index => $voter) {
            $sheet->setCellValue('A'.$row, $index + 1);
            $sheet->setCellValue('B'.$row, $voter->name);
            $sheet->setCellValue('C'.$row, $voter->email);
            $sheet->setCellValue('D'.$row, $voter->status);
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'D') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'voters_list_'.date('Y-m-d').'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function exportPdf()
    {
        $voters = User::where('role', 'voter')->get()->map(function ($user, $index) {
            $status = $user->choice !== null ? 'Memilih' : 'Belum Memilih';
            $user->status = $status;
            $user->number = $index + 1;

            return $user;
        });

        $pdf = PDF::loadView('voters.export-pdf', [
            'voters' => $voters,
            'date' => date('Y-m-d'),
        ]);

        return $pdf->stream('voters_list_'.date('Y-m-d').'.pdf');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv'
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();

        $startRow = 2;

        $columns = [
            'A' => 'name',
            'B' => 'email',
            'C' => 'nisn',
            'D' => 'password'
        ];

        // Iterate through each row in the worksheet
        foreach ($worksheet->getRowIterator($startRow) as $row) {
            $userData = [];

            // Extract data from each relevant column
            foreach ($columns as $col => $field) {
                $cell = $worksheet->getCell($col . $row->getRowIndex());
                $userData[$field] = $cell->getCalculatedValue();
            }

            $userData['password'] = Hash::make($userData['password']);

            User::create($userData);
        }

        return redirect()->route('voters.index')->with('message', 'Data berhasil diimpor!');
    }


    public function destroy($id)
    {
        // 1. Cari user atau kembalikan 404 jika tidak ada
        $voter = User::findOrFail($id);

        // 2. Keamanan: Mencegah admin menghapus dirinya sendiri
        if (auth()->id() == $id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        try {
            // 3. Hapus data
            $voter->delete();

            return redirect()->back()->with('success', 'Data pemilih "' . $voter->name . '" berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika terjadi error database (misal: data berelasi)
            return redirect()->back()->with('error', 'Gagal menghapus data: Terjadi kesalahan sistem.');
        }
    }


   public function massDelete(Request $request)
{
    // 1. Ambil data dari request (sesuaikan dengan name di HTML: selected_ids)
    $ids = $request->input('selected_ids');

    // 2. Validasi: Jika tidak ada data yang dipilih
    if (!$ids || count($ids) === 0) {
        return redirect()->back()->with('error', 'Pilih minimal satu data untuk dihapus.');
    }

    try {
        // 3. Keamanan: Jangan hapus diri sendiri jika Admin terpilih
        $ids = array_diff($ids, [auth()->id()]);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'Tidak ada data valid yang bisa dihapus.');
        }

        // 4. Eksekusi Hapus
        $deletedCount = \App\Models\User::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', $deletedCount . ' data pemilih berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan sistem saat menghapus data.');
    }
}
}

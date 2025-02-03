<?php

namespace App\Http\Controllers;
use App\Models\User; // Pastikan model ini ada
use App\Models\Pegawai; // Pastikan model ini ada
use App\Imports\PegawaiImport;
use App\Models\TimProject;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        // Logika untuk mengambil data atau memproses sesuatu

        return view('admin.employee'); // Pastikan view ini ada
    }

    public function showEmployees()
    {
        $employees = Pegawai::get(); // Assuming you have an Employee model
        $users = User::all(); // Assuming you have a User model
        $teams = TimProject::all();
        return view('admin.employee', compact('employees', 'users', 'teams'));
    }

    public function create()
    {
        $users = User::all(); // Assuming you have a User model
        $teams = TimProject::all();



        return view('admin.employee.create', compact('users', 'teams'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'id_tim' => 'required', // Change 'tim' to 'tim_id'
            'no_hp' => 'required',
            'nip' => 'required',
            'name' => 'required', // Add 'name' field validation
            'email' => 'required|email|unique:users,email', // Add unique validation for email
        ]);



        $id_tim = $request->id_tim;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $employee = Pegawai::create([
            'name' => $request->name, // Add 'name' field
            'jabatan' => $request->jabatan,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
            'id_tim' => $id_tim, // Change 'tim' to 'tim_id'
            'no_hp' => $request->no_hp,
            'nip' => $request->nip,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.employee')
            ->with('success', 'Employee created successfully.');
    }

    public function destroy($user_id)
    {
        $user = User::find($user_id);
        // cari user id pada model pegawai emnggunakan where
        $pegawai = Pegawai::where('user_id', $user_id)->first();
        // dd($pegawai);
        $pegawai->delete();
        $user->delete();
        return redirect()->route('admin.employee')
            ->with('success', 'Employee deleted successfully.');
    }

    public function edit($id)
    {
        $employee = Pegawai::where('user_id', $id)->first();
        $user = User::find($id);
        if (!$employee) {
            return redirect()->route('admin.employee')->with('error', 'Employee not found.');
        }
        $teams = TimProject::all();

        return view('admin.employee.edit', compact('employee', 'user', 'teams'));
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'id_tim' => 'required',
            'no_hp' => 'required',
            'nip' => 'required',
            'name' => 'required', // Add 'name' field validation
        ]);

        $id_tim = $request->id_tim;
        $user = User::find($user_id);
        $employee = Pegawai::where('user_id', $user_id)->first();
        $user->update(
            [
                'name' => $request->name,
            ]
        );

        $employee->update(
            [
                'name' => $request->name, // Update 'nama_pegawai' field
                'jabatan' => $request->jabatan,
                'pangkat' => $request->pangkat,
                'golongan' => $request->golongan,
                'id_tim' => $id_tim,
                'no_hp' => $request->no_hp,
                'nip' => $request->nip,
            ]
        );

        return redirect()->route('admin.employee')
            ->with('success', 'Employee updated successfully.');
    }

    public function upload(Request $request)
    {
        // Validasi file yang diupload (harus berupa Excel)
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            // Import data dari file Excel menggunakan PegawaiImport
            Excel::import(new PegawaiImport, $request->file('excel_file'));

            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('admin.employee')->with('success', 'Employees imported successfully.');
        } catch (\Exception $e) {
            // Jika gagal, log error untuk memudahkan debugging
            Log::error('Error during import: ' . $e->getMessage());

            // Redirect dengan pesan error
            return redirect()->route('admin.employee')->with('error', 'Error importing employees.');
        }
    }

    public function downloadTemplate()
    {
        $filePath = public_path('data_pegawai_template.xlsx'); 
        $fileName = 'data_pegawai_template.xlsx';

        // Cek apakah file ada
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Kembalikan file untuk diunduh
        return response()->download($filePath, $fileName);
    }
}

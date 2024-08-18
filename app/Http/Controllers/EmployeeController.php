<?php

namespace App\Http\Controllers;
use App\Models\User; // Pastikan model ini ada
use App\Models\Pegawai; // Pastikan model ini ada
use App\Imports\PegawaiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

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
        return view('admin.employee', compact('employees', 'users'));
    }

    public function create()
    {
        $users = User::all(); // Assuming you have a User model


        return view('admin.employee.create', compact('users'));
    }

    public function store(Request $request)
    {
        //buatkan source code untuk random angka dalam 5 angka dan tanggal saat ini
        $random = rand(10000, 99999);
        $date = date('Ymd');
        $randomAngka = $date . $random;
        // dd($randomAngka);
        $request->validate([
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'tim' => 'required',
            'no_hp' => 'required',
            'nip' => 'required',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return redirect()->route('admin.employee.create')
                ->with('error', 'Email already exists.');
        }elseif(Pegawai::where('nip', $request->nip)->exists()){
            return redirect()->route('admin.employee.create')
                ->with('error', 'NIP already exists.');
        }else{
            User::create(
                [
                    'id' => $randomAngka,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($randomAngka),
                ]
            );
            Pegawai::create(
                [
                    'user_id' => $randomAngka,
                    'jabatan' => $request->jabatan,
                    'pangkat' => $request->pangkat,
                    'golongan' => $request->golongan,
                    'tim' => $request->tim,
                    'no_hp' => $request->no_hp,
                    'nip' => $request->nip,
                ]
            );
            return redirect()->route('admin.employee')
                ->with('success', 'Employee created successfully.');
        }
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

        return view('admin.employee.edit', compact('employee', 'user'));
    }

    public function update(Request $request, $user_id)
    {
        $request->validate([
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'tim' => 'required',
            'no_hp' => 'required',
            'nip' => 'required',
        ]);

            $user = User::find($user_id);
            $employee = Pegawai::where('user_id', $user_id)->first();
            $user->update(
                [
                    'name' => $request->name,
                ]
            );

            $employee->update(
                [
                    'jabatan' => $request->jabatan,
                    'pangkat' => $request->pangkat,
                    'golongan' => $request->golongan,
                    'tim' => $request->tim,
                    'no_hp' => $request->no_hp,
                    'nip' => $request->nip,
                ]
            );

            return redirect()->route('admin.employee')
                ->with('success', 'Employee updated successfully.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new PegawaiImport, $request->file('excel_file'));

        return redirect()->route('admin.employee')->with('success', 'Employees imported successfully.');
    }
}

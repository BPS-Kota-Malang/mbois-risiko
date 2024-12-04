<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LoginCustomizationController extends Controller
{
    public function index()
    {
        // Menampilkan halaman untuk upload logo
        return view('admin.custom-login');
    }

    public function update(Request $request)
    {
        // Validasi file logo
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        // Simpan logo yang di-upload di storage
        if ($request->hasFile('logo')) {
            // Simpan ke dalam folder public storage dengan nama 'logo.png'
            $path = $request->file('logo')->storeAs('public', 'logo.png');
        }

        // Redirect ke halaman custom-login dengan pesan sukses
        return redirect()->route('admin.custom-login')->with('success', 'Logo updated successfully!');
    }
}
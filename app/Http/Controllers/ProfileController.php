<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // untuk menampilkan halaman profile
    public function index()
    {
        return view('profile');
    }


    // untuk menampilkan halaman edit profile
    public function edit()
    {
        return view('profile-edit', [
            'data' => User::find(Auth::user()->id)
        ]);
    }


    // untuk memproses update profile
    public function update(Request $request)
    {
        // - upload file (foto profile)
        $data = $request->validate([
            'name' => 'required',
            'password' => 'nullable|min:6',
            'photo' => 'nullable|image|max:5120'
        ]);

        // Cari user berdasarkan ID
        $user = User::findOrFail(Auth::user()->id);

        // Proses upload file jika ada file baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Simpan foto baru dengan nama unik
            $path = $request->file('photo')->store('foto-profile', 'public');

            $data['photo'] = $path;
        }
        $user->update($data);

        return redirect('/profile');
    }
}

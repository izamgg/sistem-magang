<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah mahasiswa
        $jumlahMahasiswa = Mahasiswa::count();
    
        // Hitung jumlah dosen berdasarkan role 'dosen' pada tabel users
        $jumlahDosen = User::where('role', 'dosen')->count();
    
        // Hitung jumlah mahasiswa dengan status '1' (lulus) dan '2' (tidak lulus)
        $jumlahLulus = Mahasiswa::where('status', '2')->count(); // Lulus (status 1)
        $jumlahTidakLulus = Mahasiswa::where('status', '1')->count(); // Tidak Lulus (status 2)
    
        // Kirim data ke view
        return view('dashboard', compact('jumlahMahasiswa', 'jumlahDosen', 'jumlahLulus', 'jumlahTidakLulus'));
    }
}
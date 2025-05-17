<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SidangController extends Controller
{
    public function update_penjadwalan(string $id, Request $request)
    {
        // Batasi akses hanya untuk admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki izin untuk mengubah penjadwalan.');
        }

        // Validasi data
        $request->validate([
            'tanggal' => 'required|date',
            'tempat' => 'required|string|max:255',
            'jam' => 'required',
        ]);

        // Update jadwal
        $jadwal = Jadwal::where('mahasiswa_id', $id)->firstOrFail();
        $jadwal->update([
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
            'jam' => $request->jam,
        ]);

        return redirect()->back()->with('success', 'Penjadwalan berhasil diperbarui.');
    }
}


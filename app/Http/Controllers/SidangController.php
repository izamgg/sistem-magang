<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class SidangController extends Controller
{
    public function update_penjadwalan(string $id, Request $request)
    {
        $jadwal = Jadwal::where('mahasiswa_id', $id)->first();
        $jadwal->update([
            'tanggal' => $request->tanggal,
            'tempat' => $request->tempat,
            'jam' => $request->jam,
        ]);
        return redirect()->back();
    }
}

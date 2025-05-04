<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function update_nilai(string $id, Request $request)
    {
        $dataMhs = Nilai::where('mahasiswa_id', $id)->first();

        // Periksa setiap input nilai dan hanya perbarui kolom terkait
        if (!is_null($request->dospem_nilai)) {
            $dataMhs->update([
                'dospem_nilai' => $request->dospem_nilai,
                'dospem_nama' => $request->dospem_nama,
            ]);
        }

        if (!is_null($request->dospeng_1_nilai)) {
            $dataMhs->update([
                'dospeng_1_nilai' => $request->dospeng_1_nilai,
                'dospeng_1_nama' =>  $request->dospeng_1_nama,
            ]);
        }

        if (!is_null($request->dospeng_2_nilai)) {
            $dataMhs->update([
                'dospeng_2_nilai' => $request->dospeng_2_nilai,
                'dospeng_2_nama' => Auth::user()->name,
            ]);
        }

        if (!is_null($request->dospeng_3_nilai)) {
            $dataMhs->update([
                'dospeng_3_nilai' => $request->dospeng_3_nilai,
                'dospeng_3_nama' => Auth::user()->name,
            ]);
        }
        return redirect()->back();
    }
}

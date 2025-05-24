<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataMagangController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'user') {
            $dataMhs = Mahasiswa::where('user_id', Auth::user()->id)->first();
            $dataDosen = User::where('role', 'dosen')->get();
            $dataJadwal = Jadwal::where('mahasiswa_id', Auth::user()->mahasiswa->jadwal->mahasiswa_id ?? '')->first();
            $dataNilai = Nilai::where('mahasiswa_id', Auth::user()->mahasiswa->nilai->mahasiswa_id ?? '')->first();

            // Ambil nilai dari dosen penguji dan dosen pembimbing
            $dospeng1 = $dataNilai->dospeng_1_nilai ?? 0;
            $dospeng2 = $dataNilai->dospeng_2_nilai ?? 0;
            $dospeng3 = $dataNilai->dospeng_3_nilai ?? 0;
            $dospem = $dataNilai->dospem_nilai ?? 0;

            // Hitung rata-rata dosen penguji (bagi 3)
            $rataDospeng = ($dospeng1 + $dospeng2 + $dospeng3) / 3;

            // Hitung nilai akhir (rata dospeng + dospem) / 2
            $nilaiAkhir = ($rataDospeng + $dospem) / 2;

            // Evaluasi status kelulusan
            $statusKelulusan = $nilaiAkhir >= 70 ? 'Lulus' : 'Tidak Lulus';

            return view('formulir-daftar-magang', [
                'dataMhs' => $dataMhs,
                'dataDosen' => $dataDosen,
                'dataJadwal' => $dataJadwal,
                'dataNilai' => $dataNilai,
                'nilaiAkhir' => $nilaiAkhir,
                'statusKelulusan' => $statusKelulusan,
            ]);
        }

        if (Auth::user()->role == 'dosen' || Auth::user()->role == 'dosen_penguji' || Auth::user()->role == 'admin') {
            $dataMhs = Mahasiswa::all();
            return view('data-magang', [
                'dataMhs' => $dataMhs,
            ]);
        }
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|digits:10|unique:mahasiswas',
            'prodi' => 'required',
            'tgl_lahir' => 'required',
            'tempat_lahir' => 'required',
            'agama' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'dospem' => 'required',
        ]);

        $data['user_id'] = Auth::user()->id;

        DB::transaction(function () use ($data) {
            $mhs = Mahasiswa::create($data);
            Jadwal::create([
                'mahasiswa_id' => $mhs->id,
            ]);
            Nilai::create([
                'mahasiswa_id' => $mhs->id,
            ]);
        });

        return redirect()->route('data-magang')->with('success', 'Anda berhasil daftar magang');
    }

    public function show(string $id)
    {
        $dataMhs = Mahasiswa::find($id);
        $dataJadwal = Jadwal::where('mahasiswa_id', $id)->first();
        $dataNilai = Nilai::where('mahasiswa_id', $id)->first();

        $nilaiComponents = [$dataNilai->dospem_nilai ?? 0, $dataNilai->dospeng_1_nilai ?? 0, $dataNilai->dospeng_2_nilai ?? 0, $dataNilai->dospeng_3_nilai ?? 0];

        $totalNilai = array_sum($nilaiComponents);
        $jumlahNilai = count(array_filter($nilaiComponents, fn($nilai) => $nilai > 0));

        $rataRataNilai = $jumlahNilai > 0 ? $totalNilai / $jumlahNilai : 0;

        if ($rataRataNilai >= 70) {
            $dataMhs->update(['status' => '2']); // lulus
        }

        if ($rataRataNilai < 70 && $rataRataNilai > 0) {
            $dataMhs->update(['status' => '1']); // tidak lulus
        }

        // Ambil nilai dari dosen penguji dan dosen pembimbing
        $dospeng1 = $dataNilai->dospeng_1_nilai ?? 0;
        $dospeng2 = $dataNilai->dospeng_2_nilai ?? 0;
        $dospeng3 = $dataNilai->dospeng_3_nilai ?? 0;
        $dospem = $dataNilai->dospem_nilai ?? 0;

        $rataDospeng = ($dospeng1 + $dospeng2 + $dospeng3) / 3;

        $nilaiAkhir = ($rataDospeng + $dospem) / 2;

        $statusKelulusan = $nilaiAkhir >= 70 ? 'Lulus' : 'Tidak Lulus';

        return view('detail-data-mahasiswa', [
            'dataMhs' => $dataMhs,
            'dataJadwal' => $dataJadwal,
            'dataNilai' => $dataNilai,
            'nilaiRataRata' => $rataRataNilai,
            'nilaiAkhir' => $nilaiAkhir,
            'statusKelulusan' => $statusKelulusan,
        ]);
    }

    public function update_tempat_magang(string $id, Request $request)
    {
        $user = Auth::user();
        $mhs = Mahasiswa::findOrFail($id);

        // Batasi akses: hanya admin atau mahasiswa pemilik
        if ($user->role !== 'dosen' && $mhs->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit data ini.');
        }

        // Validasi input
        $validated = $request->validate([
            'tempat_magang' => 'required|string|max:255',
            'lokasi_magang' => 'required|string|max:255',
            'awal_magang' => 'required|date',
            'akhir_magang' => 'required|date|after_or_equal:awal_magang',
        ]);

        // Update data
        $mhs->update($validated);

        return redirect()->back()->with('success', 'Data tempat magang berhasil diperbarui.');
    }

    public function edit(string $id, Request $request)
    {
        $dataMhs = Mahasiswa::find($id);
        $dataDosen = User::where('role', 'dosen')->get();

        return view('edit-data-diri', [
            'dataMhs' => $dataMhs,
            'dataDosen' => $dataDosen,
        ]);
    }

    public function update(string $id, Request $request)
    {
        $mhs = Mahasiswa::find($id);

        $mhs->update([
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'tgl_lahir' => $request->tgl_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'agama' => $request->agama,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'dospem' => $request->dospem,
        ]);
        return redirect('data-magang');
    }
    //    perubahan
    public function tentukanKelulusan(Request $request, $id)
    {
        $mhs = Mahasiswa::findOrFail($id);

        // Hanya dosen pembimbing yang boleh menentukan
        if (Auth::user()->role !== 'dosen' || Auth::user()->name !== $mhs->dospem) {
            abort(403, 'Anda tidak memiliki izin.');
        }

        $status = $request->status_kelulusan;
        if (!in_array($status, ['Lulus', 'Tidak Lulus'])) {
            return back()->with('error', 'Status tidak valid');
        }

        $mhs->update([
            'status_kelulusan' => $status,
        ]);

        return back()->with('success', 'Status kelulusan berhasil ditentukan.');
    }
    // dikit
    // p2
    public function uploadLaporan(Request $request, $id)
    {
        $request->validate([
            'laporan_magang' => 'required|mimes:pdf|max:2048',
        ]);

        $mhs = Mahasiswa::findOrFail($id);

        // Batasi agar hanya pemilik atau admin yang bisa upload
        if (Auth::user()->id !== $mhs->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki izin.');
        }

        if ($request->hasFile('laporan_magang')) {
            // Hapus file lama jika ada
            if ($mhs->laporan_magang) {
                Storage::disk('public')->delete($mhs->laporan_magang);
            }

            // Simpan file di folder 'public/laporan_magang'
            $path = $request->file('laporan_magang')->store('laporan_magang', 'public');

            $mhs->update([
                'laporan_magang' => $path,
            ]);

            return back()->with('success', 'Laporan magang berhasil diupload.');
        }

        return back()->with('error', 'Gagal upload laporan.');
    }

    // p2
}

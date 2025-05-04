@extends('layouts.template')
@section('title', 'Detail Data Mahasiswa')

@section('content')
  <div class="page-heading">
    <h3>Detail Magang {{ $dataMhs->user->name ?? '' }}</h3>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-5 d-flex justify-content-center h-100">
                <img
                  src="{{ $dataMhs->user->photo !== 'avatar.webp' ? asset('storage/' . $dataMhs->user->photo) : asset('avatar.webp') }}"
                  alt="" class="w-100">
              </div>

              <div class="col-md-7">
                <div class="mb-3">
                  <Label class="fw-bold">Nama Lengkap</Label>
                  <p>{{ $dataMhs->user->name }}</p>
                </div>

                <div class="mb-3">
                  <Label class="fw-bold">NIM</Label>
                  <p>{{ $dataMhs->nim }}</p>
                </div>

                <div class="mb-3">
                  <Label class="fw-bold">Prodi</Label>
                  <p>{{ $dataMhs->prodi }}</p>
                </div>

                <div class="mb-3">
                  <Label class="fw-bold">Tempat, Tanggal Lahir</Label>
                  <p>{{ $dataMhs->tempat_lahir }}, {{ $dataMhs->tgl_lahir }}</p>
                </div>


                <div class="mb-3">
                  <Label class="fw-bold">Jenis Kelamin</Label>
                  <p>{{ $dataMhs->gender }}</p>
                </div>

                <div class="mb-3">
                  <Label class="fw-bold">Agama</Label>
                  <p>{{ $dataMhs->agama }}</p>
                </div>

                <div class="mb-3">
                  <Label class="fw-bold">Alamat</Label>
                  <p>{{ $dataMhs->alamat }}</p>
                </div>

                <div class="mb-3">
                  <Label class="fw-bold">Dosen Pembimbing</Label>
                  <p>{{ $dataMhs->dospem }}</p>
                </div>


                <div class="mb-3">
                  <label class="fw-bold d-block">Status</label>
                  <span class="badge 
                      {{ $statusKelulusan == 'Lulus' ? 'bg-success' : '' }}
                      {{ $statusKelulusan == 'Tidak Lulus' ? 'bg-danger' : '' }}">
                      {{ $statusKelulusan }}
                  </span>
              </div>
              
              
              
              <div class="mb-3">
                  <Label class="fw-bold">Nilai Rata-Rata</Label>
                  <p>{{ $nilaiAkhir }}</p>
              </div>
              
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h2 class="mb-4 text-center fw-bold">Form Edit Tempat Magang</h2>
                <form action="{{ route('update-tempat-magang', ['id' => $dataMhs->id]) }}" method="POST">
                  @csrf
                  @method('PATCH')
                  <div class="form-group">
                    <label for="tmp_magang">Tempat Magang</label>
                    <input type="text" class="form-control" name="tempat_magang" id="tmp_magang"
                      value="{{ $dataMhs->tempat_magang }}">
                    @error('tempat_magang')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="lokasi_magang">Lokasi Magang</label>
                    <input type="text" class="form-control" name="lokasi_magang" id="lokasi_magang"
                      value="{{ $dataMhs->lokasi_magang }}">
                    @error('lokasi_magang')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="lokasi_magang">Awal Magang</label>
                    <input type="date" class="form-control" name="awal_magang" id="lokasi_magang"
                      value="{{ $dataMhs->awal_magang }}">
                    @error('awal_magang')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="lokasi_magang">Akhir Magang</label>
                    <input type="date" class="form-control" name="akhir_magang" id="lokasi_magang"
                      value="{{ $dataMhs->akhir_magang }}">
                    @error('akhir_magang')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h2 class="mb-4 text-center fw-bold">Penilaian</h2>
                <form action="{{ route('update_nilai', ['id' => $dataMhs->id]) }}" method="POST">
                  @php
                    // Cek apakah user sudah memberikan nilai sebelumnya
                    $isDisabled =
                        $dataNilai->dospeng_1_nama === Auth::user()->name ||
                        $dataNilai->dospeng_2_nama === Auth::user()->name ||
                        $dataNilai->dospeng_3_nama === Auth::user()->name;
                  @endphp

                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="tmp_magang">Nilai Dosen Pembimbing</label>
                    <input type="hidden" class="form-control" name="dospem_nama" id="tmp_magang"
                      value="{{ Auth::user()->name }}" {{ Auth::user()->role !== 'dosen' ? 'disabled' : '' }}>
                    <input type="number" class="form-control" name="dospem_nilai" id="tmp_magang"
                      value="{{ $dataNilai->dospem_nilai }}" {{ Auth::user()->role !== 'dosen' ? 'disabled' : '' }}>
                    @error('dospem')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="lokasi_magang">Nilai Dosen Penguji 1</label>
                    <input type="hidden" class="form-control" name="dospeng_1_nama" id="tmp_magang"
                      value="{{ Auth::user()->name }}"
                      {{ $isDisabled || !is_null($dataNilai->dospeng_1_nama) ? 'disabled' : '' }}
                      {{ Auth::user()->role === 'dosen' ? 'disabled' : '' }}>
                    <input type="number" class="form-control" name="dospeng_1_nilai" id="lokasi_magang"
                      value="{{ $dataNilai->dospeng_1_nilai }}"
                      {{ $isDisabled || !is_null($dataNilai->dospeng_1_nilai) ? 'disabled' : '' }}
                      {{ Auth::user()->role === 'dosen' ? 'disabled' : '' }}>
                    @error('dospeng_1')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="lokasi_magang">Nilai Dosen Penguji 2</label>

                    <input type="hidden" class="form-control" name="dospeng_2_nama" id="tmp_magang"
                      value="{{ Auth::user()->name }}"
                      {{ $isDisabled || !is_null($dataNilai->dospeng_2_nama) ? 'disabled' : '' }}
                      {{ Auth::user()->role === 'dosen' ? 'disabled' : '' }}>
                    <input type="number" class="form-control" name="dospeng_2_nilai" id="lokasi_magang"
                      value="{{ $dataNilai->dospeng_2_nilai }}"
                      {{ $isDisabled || !is_null($dataNilai->dospeng_2_nilai) ? 'disabled' : '' }}
                      {{ Auth::user()->role === 'dosen' ? 'disabled' : '' }}>
                    @error('dospeng_2')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>


                  <div class="form-group">
                    <label for="lokasi_magang">Nilai Dosen Penguji 3</label>
                    <input type="hidden" class="form-control" name="dospeng_3_nama" id="tmp_magang"
                      value="{{ Auth::user()->name }}"
                      {{ $isDisabled || !is_null($dataNilai->dospeng_3_nama) ? 'disabled' : '' }}
                      {{ Auth::user()->role === 'dosen' ? 'disabled' : '' }}>
                    <input type="number" class="form-control" name="dospeng_3_nilai" id="lokasi_magang"
                      value="{{ $dataNilai->dospeng_3_nilai }}"
                      {{ $isDisabled || !is_null($dataNilai->dospeng_3_nilai) ? 'disabled' : '' }}
                      {{ Auth::user()->role === 'dosen' ? 'disabled' : '' }}>
                    @error('dospeng_3')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
              </div>
            </div>
          </div>


          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h2 class="mb-4 text-center fw-bold">Penjadwalan Sidang</h2>
                <form action="{{ route('update-penjadwalan', ['id' => $dataMhs->id]) }}" method="POST">
                  @csrf
                  @method('PATCH')

                  <div class="form-group">
                    <label for="tempat">Tempat</label>
                    <input type="text" class="form-control" name="tempat" id="tempat"
                      value="{{ $dataJadwal->tempat }}">
                    @error('tempat')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="tmp_magang">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" id="tanggal"
                      value="{{ $dataJadwal->tanggal }}">
                    @error('tanggal')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>


                  <div class="form-group">
                    <label for="jam">Jam</label>
                    <input type="time" class="form-control" name="jam" id="jam"
                      value="{{ $dataJadwal->jam }}">
                    @error('jam')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                  <button class="btn btn-primary" type="submit">Simpan</button>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

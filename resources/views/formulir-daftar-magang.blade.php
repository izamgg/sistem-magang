@extends('layouts.template')
@section('title', 'Daftar Magang')
@section('content')
    <div class="page-heading">
        <h3>Daftar Magang</h3>
    </div>
    <section class="section">
        <div class="row">
            @if (!$dataMhs)
                <div class="col-md-6">
                    <form action="{{ route('data-magang.post') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h2 class="mb-5 text-center fw-semibold">Formulir Daftar Magang</h2>


                                <div class="form-group">
                                    <div class="col-md-4 d-flex justify-content-center">
                                        <img src="{{ Auth::user()->photo !== 'avatar.webp' ? asset('storage/' . Auth::user()->photo) : asset('avatar.webp') }}"
                                            alt="" width="100%">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" name="name" id="nama"
                                        value="{{ Auth::user()->name }}" disabled>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control" name="nim" id="nim">
                                    @error('nim')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="prodi">Prodi</label>
                                    <input type="text" class="form-control" name="prodi" id="prodi">
                                    @error('prodi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="Tanggl Lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" id="Tanggl Lahir">
                                    @error('tgl_lahir')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tempat Lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat Lahir">
                                    @error('tempat_lahir')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-select" id="agama" name="agama">
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                    @error('agama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    @error('agama')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5"></textarea>
                                    @error('alamat')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="dospem">Pilih Dosen Pembimbing</label>
                                    <select class="form-select" id="dospem" name="dospem">
                                        @foreach ($dataDosen as $dosen)
                                            <option value="{{ $dosen->name }}">{{ $dosen->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('dospem')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="mt-3 btn btn-primary" type="submit">Daftar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif


            <div class="row">
                @if ($dataMhs)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="mb-5 text-center fw-semibold">Data Diri</h2>
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-5 d-flex justify-content-center h-100">
                                        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('avatar.webp') }}"
                                            alt="" class="w-100">
                                    </div>

                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <Label class="fw-bold">Nama Lengkap</Label>
                                            <p>{{ Auth::user()->name }}</p>
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
                                          <Label class="fw-bold d-block">Status</Label>
                                          <span
                                              class="badge 
                                                  {{ $statusKelulusan == 'Lulus' ? 'bg-success' : '' }}
                                                  {{ $statusKelulusan == 'Tidak Lulus' ? 'bg-danger' : '' }}">
                                              {{ $statusKelulusan }}
                                          </span>
                                      </div>
                                      
                                      <div class="mb-3">
                                          <Label class="fw-bold">Nilai Rata-Rata</Label>
                                          <p>{{ $nilaiAkhir }}</p>
                                      </div>

                                        <div class="mb-3">
                                            <a href="/data-magang/{{ $dataMhs->id }}" class="btn btn-primary">Edit Data
                                                Diri</a>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                @endif


                @if ($dataMhs)
                    <div class="col-md-6">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="mb-4 text-center fw-bold">Data Magang</h2>
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label for="tmp_magang">Tempat Magang</label>
                                                <input type="text" class="form-control" name="dospem"
                                                    id="tmp_magang" value="{{ $dataMhs->tempat_magang }}" readonly>
                                                @error('dospem')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="tmp_magang">Lokasi Magang</label>
                                                <input type="text" class="form-control" name="dospem"
                                                    id="tmp_magang" value="{{ $dataMhs->lokasi_magang }}" readonly>
                                                @error('dospem')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="tmp_magang">Awal Magang</label>
                                                <input type="text" class="form-control" name="dospem"
                                                    id="tmp_magang" value="{{ $dataMhs->awal_magang }}" readonly>
                                                @error('dospem')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="tmp_magang">Akhir Magang</label>
                                                <input type="text" class="form-control" name="dospem"
                                                    id="tmp_magang" value="{{ $dataMhs->akhir_magang }}" readonly>
                                                @error('dospem')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="mb-4 text-center fw-bold">Penilaian</h2>
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label for="tmp_magang">Nilai Dosen Pembimbing</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="dospem"
                                                            value="{{ $dataNilai->dospem_nama ?? '' }}" readonly>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="dospem"
                                                            id="tmp_magang" value="{{ $dataNilai->dospem_nilai ?? '' }}"
                                                            readonly>
                                                    </div>
                                                </div>

                                                @error('dospem')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="lokasi_magang">Nilai Dosen Penguji 1</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="dospem"
                                                            id="tmp_magang"
                                                            value="{{ $dataNilai->dospeng_1_nama ?? '' }}" readonly>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="dospem"
                                                            id="tmp_magang"
                                                            value="{{ $dataNilai->dospeng_1_nilai ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                @error('dospeng_1')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="lokasi_magang">Nilai Dosen Penguji 2</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="dospem"
                                                            id="tmp_magang"
                                                            value="{{ $dataNilai->dospeng_2_nama ?? '' }}" readonly>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="dospem"
                                                            id="tmp_magang"
                                                            value="{{ $dataNilai->dospeng_2_nilai ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                @error('dospeng_2')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="lokasi_magang">Nilai Dosen Penguji 3</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="dospem"
                                                            id="tmp_magang"
                                                            value="{{ $dataNilai->dospeng_3_nama ?? '' }}" readonly>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="dospem"
                                                            id="tmp_magang"
                                                            value="{{ $dataNilai->dospeng_3_nilai ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                @error('dospeng_3')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="mb-4 text-center fw-bold">Penjadwalan Sidang</h2>
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label for="tempat">Tempat</label>
                                                <input type="text" class="form-control" name="tempat" id="tempat"
                                                    value="{{ $dataJadwal->tempat ?? '' }}" readonly>
                                                @error('tempat')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="tmp_magang">Tanggal</label>
                                                <input type="text" class="form-control" name="tanggal" id="tanggal"
                                                    value="{{ $dataJadwal->tanggal ?? '' }}" readonly>
                                                @error('tanggal')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="jam">Jam</label>
                                                <input type="time" class="form-control" name="jam" id="jam"
                                                    value="{{ $dataJadwal->jam ?? '' }}" readonly>
                                                @error('jam')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </section>
@endsection

@extends('layouts.template')
@section('title', 'Edit Data Diri')
@section('content')
  <div class="page-heading">
    <h3>Daftar Magang</h3>
  </div>
  <section class="section">
    <div class="row">

      <div class="col-md-6">
        <form action="/data-magang/{{ $dataMhs->id }}" method="POST">
          @csrf
          @method('PATCH')
          <div class="card">
            <div class="card-body">
              <h2 class="mb-5 text-center fw-semibold">Formulir Daftar Magang</h2>


              <div class="form-group">
                <div class="col-md-4 d-flex justify-content-center">
                  <img
                    src="{{ Auth::user()->photo !== 'avatar.webp' ? asset('storage/' . Auth::user()->photo) : asset('avatar.webp') }}"
                    alt="" width="100%">
                </div>
              </div>
              <div class="form-group">
                <label for="nama">Nama Mahasiswa</label>
                <input type="text" class="form-control" name="name" id="nama" value="{{ Auth::user()->name }}"
                  disabled>
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" class="form-control" name="nim" id="nim" value="{{ $dataMhs->nim }}">

                @error('nim')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label for="prodi">Prodi</label>
                <input type="text" class="form-control" name="prodi" id="prodi" value="{{ $dataMhs->prodi }}">

                @error('prodi')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>


              <div class="form-group">
                <label for="Tanggl Lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir" id="Tanggl Lahir"
                  value="{{ $dataMhs->tgl_lahir }}">
                @error('tgl_lahir')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label for="tempat Lahir">Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" id="tempat Lahir"
                  value="{{ $dataMhs->tempat_lahir }}">
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
                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5">{{ $dataMhs->alamat }}</textarea>
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
                <button class="mt-3 btn btn-primary" type="submit">Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  @endsection

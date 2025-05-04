@extends('layouts.template')
@section('title', 'Tambah Data Akun Dosen')
@section('content')
  <div class="page-heading">
    <h3>Tambah Akun Dosen</h3>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-md-6">
        <form action="{{ route('data-akun-dosen.store') }}" method="POST">
          @csrf
          <div class="card">
            <div class="card-body">

              <div class="form-group">
                <label for="nama">Name</label>
                <input type="text" class="form-control" name="name" id="nama">
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email">
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password">
                @error('password')
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
  </section>
@endsection

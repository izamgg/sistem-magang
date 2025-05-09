@extends('layouts.template')
@section('title', 'Profile')

@section('content')
  <div class="page-heading">
    <h3>Profile</h3>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 h-100">
                <img
              
                  src="{{ Auth::user()->photo !== 'avatar.webp' ? asset('storage/' . Auth::user()->photo) : asset('avatar.webp') }}"
                  class="w-100" alt="">
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="">Nama Lengkap</label>
                  <p class="fw-light">{{ Auth::user()->name }}</p>
                </div>

                <div class="form-group">
                  <label for="">Email</label>
                  <p class="fw-light">{{ Auth::user()->email }}</p>
                </div>

                <div class="form-group">
                  <label for="">Role</label>
                  <p class="fw-light">{{ Auth::user()->role === 'user' ? 'Mahasiswa' : Auth::user()->role }}</p>
                </div>

                <div class="form-group">
                  <a href="/profile/edit" class="btn btn-primary">Edit Profil</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

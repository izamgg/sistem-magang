@extends('layouts.template')
@section('title', 'Dashboard')

@section('content')
  <div class="page-heading">
    <h3>Dashboard Statistics</h3>
  </div>
  <div class="page-content">
    <section class="row">
      <div class="col-12">
        <div class="row">
          <!-- Jumlah Mahasiswa -->
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="px-4 card-body py-4-5">
                <div class="row">
                  <div class="col-md-4 d-flex justify-content-start">
                    <div class="stats-icon purple">
                      <i class="iconly-boldAdd-User"></i>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <h6 class="text-muted">Jumlah Mahasiswa</h6>
                    <h6 class="mb-0">{{ $jumlahMahasiswa }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Jumlah Dosen -->
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="px-4 card-body py-4-5">
                <div class="row">
                  <div class="col-md-4 d-flex justify-content-start">
                    <div class="stats-icon blue">
                      <i class="iconly-boldUser"></i>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <h6 class="text-muted">Jumlah Dosen</h6>
                    <h6 class="mb-0">{{ $jumlahDosen }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Mahasiswa Lulus -->
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="px-4 card-body py-4-5">
                <div class="row">
                  <div class="col-md-4 d-flex justify-content-start">
                    <div class="stats-icon green">
                      <i class="iconly-boldTick-Square"></i>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <h6 class="text-muted">Mahasiswa Lulus</h6>
                    <h6 class="mb-0">{{ $jumlahLulus }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Mahasiswa Tidak Lulus -->
          <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
              <div class="px-4 card-body py-4-5">
                <div class="row">
                  <div class="col-md-4 d-flex justify-content-start">
                    <div class="stats-icon red">
                      <i class="iconly-boldClose-Square"></i>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <h6 class="text-muted">Mahasiswa Tidak Lulus</h6>
                    <h6 class="mb-0">{{ $jumlahTidakLulus }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

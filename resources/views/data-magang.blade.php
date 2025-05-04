@extends('layouts.template')
@section('title', 'Data Magang')
@section('content')
  <div class="page-heading">
    <h3>Data Magang</h3>
  </div>
  <section class="section">
    <div class="card">
      <div class="card-body">
        <table class="table table-striped" id="table1">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>NIM</th>
              <th>Prodi</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @foreach ($dataMhs as $mhs)
              @if (Auth::user()->role == 'dosen_penguji' || Auth::user()->role == 'admin' || $mhs->dospem == Auth::user()->name)
                <tr>
                  <td class="align-middle">{{ $no++ }}</td>
                  <td class="align-middle">{{ $mhs->user->name }}</td>
                  <td class="align-middle">{{ $mhs->nim }}</td>
                  <td class="align-middle">{{ $mhs->prodi }}</td>

                  <td class="align-middle">
                    <span
                      class="badge {{ $mhs->status == 0 ? 'bg-warning' : '' }} {{ $mhs->status == 1 ? 'bg-danger' : '' }} {{ $mhs->status == 2 ? 'bg-success' : '' }}">{{ $mhs->status == 0 ? 'Belum Sidang' : '' }}
                      {{ $mhs->status == 1 ? 'Tidak Lulus' : '' }} {{ $mhs->status == 2 ? 'Lulus' : '' }}</span>
                  </td>
                  <td class="align-middle">
                    <a href="{{ route('data-magang.detail-mahasiswa', ['id' => $mhs->id, 'name' => $mhs->user->name]) }}"
                      class="btn btn-primary">Detail</a>
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </section>
@endsection


@push('css')
  <link rel="stylesheet" href="/template/assets/extensions/simple-datatables/style.css">
  <link rel="stylesheet" href="/template/assets/css/pages/simple-datatables.css">
@endpush

@push('js')
  <script src="/template/assets/js/bootstrap.js"></script>
  <script src="/template/assets/js/app.js"></script>

  <script src="/template/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
  <script src="/template/assets/js/pages/simple-datatables.js"></script>
@endpush

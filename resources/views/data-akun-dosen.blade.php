@extends('layouts.template')
@section('title', 'Data Akun Dosen')
@section('content')
  <div class="page-heading">
    <h3>Data Akun Dosen</h3>
  </div>
  <section class="section">
    <a href="{{ route('data-akun-dosen.create') }}" class="mb-3 btn btn-primary">Tambah Akun</a>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table1">
            <thead>
              <tr>
                <th>No</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach ($datas as $dosen)
                <tr>
                  <td class="text-center align-middle">{{ $no++ }}</td>
                  <td class="align-middle">
                    <img
                      src="{{ $dosen->photo !== 'avatar.webp' ? asset('storage/' . $dosen->photo) : asset('avatar.webp') }}"
                      alt="" width="70px">
                  </td>
                  <td class="align-middle">{{ $dosen->name }}</td>
                  <td class="align-middle">{{ $dosen->email }}</td>
                  <td class="align-middle">{{ $dosen->password }}</td>
                  <td class="align-middle">{{ $dosen->role }}</td>
                  <td class="align-middle">

                    @if ($dosen->role === 'dosen')
                      <form method="POST" action="/data-akun-dosen/update-role/{{ $dosen->id }}">
                        @csrf
                        @method('PATCH')
                        <button class="badge bg-warning" type="submit">dosen penguji</button>
                      </form>
                    @endif

                    @if ($dosen->role === 'dosen_penguji')
                      <form method="POST" action="/data-akun-dosen/update-role/{{ $dosen->id }}">
                        @csrf
                        @method('PATCH')
                        <button class="badge bg-primary" type="submit">dosen</button>
                      </form>
                    @endif






                  </td>
                </tr>
              @endforeach


            </tbody>
          </table>
        </div>
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

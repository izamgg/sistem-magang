@extends('layouts.template')
@section('title', 'Profile Update')

@section('content')
    <div class="page-heading">
        <h3>Update Profile</h3>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="/profile/update" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group d-flex justify-content-center">
                                <img id="previewImage"
                                    src="{{ Auth::user()->photo !== 'avatar.webp' ? asset('storage/' . Auth::user()->photo) : asset('avatar.webp') }}"
                                    alt="Preview" class="w-25">
                            </div>
                            <div class="form-group">
                                <label for="name">Upload Foto</label>
                                <input type="file" class="form-control" name="photo" id="fileInput"
                                    accept="image/jpg,image/png,image/jpeg">
                                @error('photo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" value="{{ $data->name }}"
                                    {{ Auth::user()->role === 'dosen' ? 'readonly' : '' }}>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Email Address</label>
                                <input type="email" class="form-control" name="email" value="{{ $data->email }}"
                                    disabled>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="email" value="{{ $data->password }}">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                            <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Ambil elemen input file dan elemen preview
        const fileInput = document.getElementById('fileInput');
        const previewImage = document.getElementById('previewImage');
        const previewDiv = document.getElementById('preview');

        // Event listener ketika file diunggah
        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0]; // Ambil file pertama yang diunggah

            if (file) {
                // Pastikan itu adalah file gambar
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    // Fungsi callback saat file selesai dibaca
                    reader.onload = (e) => {
                        previewImage.src = e.target.result; // Set src gambar dengan data file
                        previewImage.style.display = 'block'; // Tampilkan gambar
                    };

                    // Membaca file sebagai URL Data
                    reader.readAsDataURL(file);
                } else {
                    // Jika bukan file gambar
                    alert('File yang diunggah harus berupa gambar!');
                    fileInput.value = ''; // Reset input
                    previewImage.style.display = 'none'; // Sembunyikan preview
                }
            }
        });
    </script>
@endpush

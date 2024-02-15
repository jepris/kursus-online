<!-- resources/views/kursus/update.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Update kursus</h1>

        <form action="{{ route('kursus.update', $kursus) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama kursus</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $kursus->nama) }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $kursus->deskripsi) }}</textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $kursus->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="cover">Gambar</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar">
                @if ($kursus->cover)
                    <p class="mt-2"><strong>Gambar Sekarang:</strong></p>
                    <img src="{{ asset('storage/kursus/' . $kursus->cover) }}" class="img-fluid" alt="{{ $kursus->nama }}">
                @else
                    <p class="mt-2">Tidak ada gambar</p>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection

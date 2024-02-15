<!-- resources/views/kurus/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Kursus</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $kursus->nama }}</h5>
                <p class="card-text"><strong>Deskripsi:</strong> {{ $kursus->deskripsi }}</p>
                <p class="card-text"><strong>Kategori:</strong> {{ $kursus->category->nama }}</p>

                @if ($kursus->cover)
                    <img src="{{ asset('storage/kursus/' . $kursus->cover) }}" class="img-fluid" alt="{{ $kursus->nama }}">
                @else
                    <p class="card-text">Tidak ada gambar</p>
                @endif
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('kursus.edit', $kursus) }}" class="btn btn-primary">Edit kursus</a>

            <form action="{{ route('kursus.destroy', $kursus) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kursus ini?')">Hapus kursus</button>
            </form>
        </div>
    </div>
@endsection

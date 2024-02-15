<!-- resources/views/kursus/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Data kursus</h1>

        <a href="{{ route('kursus.create') }}" class="btn btn-success mb-3">Tambah kursus</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama kursus</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kursus as $kursusItem)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $kursusItem->nama }}</td>
                        <td>{{ $kurusItem->description }}</td>
                        <td>{{ $kursusItem->category->nama }}</td>
                        <td>
                            <a href="{{ route('kursus.show', $kursusItem) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('kursus.edit', $kursusItem) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kursus.destroy', $kursusItem) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kursus ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada data kursus.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

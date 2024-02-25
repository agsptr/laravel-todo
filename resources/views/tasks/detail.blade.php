<!-- resources/views/tasks/detail.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Tugas</div>

                    <div class="card-body">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="card-text"><strong>Deskripsi:</strong> {{ $task->description }}</p>
                        <p class="card-text"><strong>Tanggal Jatuh Tempo:</strong> {{ $task->due_date }}</p>

                        @if (!$task->completed)
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success">Tandai Selesai</button>
                            </form>
                        @endif

                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">Hapus</button>
                        </form>

                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali ke Daftar Tugas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

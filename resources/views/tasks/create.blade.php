<!-- resources/views/tasks/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Tugas Baru</div>

                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Judul Tugas:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Deskripsi Tugas:</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="due_date">Tanggal Jatuh Tempo:</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Tugas</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('tasks.create') }}" class="btn btn-md btn-success mb-3">TAMBAH TODO</a>
                <div class="card">
                    <div class="card-header">
                        Daftar Tugas
                        <div class="float-right">
                            <form action="{{ route('tasks.index') }}" method="GET" class="form-inline">
                                <label class="mr-2">Filter:</label>
                                <select name="status" class="form-control mr-2" onchange="this.form.submit()">
                                    <option value="">Semua</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                        Selesai</option>
                                    <option value="uncompleted" {{ request('status') == 'uncompleted' ? 'selected' : '' }}>
                                        Belum Selesai</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($tasks as $task)
                                <li class="list-group-item {{ $task->completed ? 'list-group-item-success' : '' }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        {{ $task->title }}
                                        <div class="btn-group" role="group" aria-label="Task Actions">
                                            <a href="{{ route('tasks.show', $task->id) }}"
                                                class="btn btn-info btn-sm">Detail</a>
                                            <a href="{{ route('tasks.edit', $task->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if (session('success'))
            $(document).ready(function() {
                toastr.success("{{ session('success') }}");
            });
        @endif
    </script>
@endsection

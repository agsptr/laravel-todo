<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // fungsi untuk auth
        // $tasks = Task::where('user_id', Auth::id())->orderBy('due_date')->get();
        // return view('tasks.index', compact('tasks'));

        // $tasks = Task::orderBy('due_date')->get();
        // return view('tasks.index', compact('tasks'));

        //dengan filter
        $status = $request->input('status');

        if ($status === 'completed') {
            $tasks = Task::where('completed', true)->get();
        } elseif ($status === 'uncompleted') {
            $tasks = Task::where('completed', false)->get();
        } else {
            $tasks = Task::all();
        }

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan formulir pembuatan tugas baru
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Menyimpan tugas baru ke database
        $task = new Task;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->completed = false; // Default: Belum dikerjakan
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan detail tugas tertentu
        $task = Task::findOrFail($id);
        return view('tasks.detail', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan formulir pengeditan tugas
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Memperbarui informasi tugas di database
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->save();

        return redirect()->route('tasks.index')->with('info', 'Tugas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus tugas dari database
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('info', 'Tugas berhasil dihapus!');
    }


    //dipanggil ketika task selesai
    public function complete(Task $task)
    {
        $task->update(['completed' => true]);

        return redirect()->route('tasks.show', $task->id)->with('info', 'Tugas berhasil ditandai sebagai selesai.');
    }
}

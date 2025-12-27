@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <div class="container">
        <div class="flex items-center justify-between mt-6 mb-4">
            <h1 class="text-3xl font-semibold text-slate-900">Tasks</h1>
            @can ('create', App\Models\Task::class)
                <a href="{{ route('task.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Create Task</a>
            @endcan
        </div>

        @if (Auth::user()->is_admin)
        <form class="mb-6" method="POST">
            @csrf
            <div class="max-w-xl relative">
                <input class="w-full border border-gray-200 rounded-lg py-2 pl-4 pr-12 text-sm" type="search" name="search" placeholder="Search tasks">
                <button class="absolute right-1 top-1/2 -translate-y-1/2 bg-indigo-500 text-white px-3 py-1.5 rounded-md hover:bg-indigo-600" type="submit">
                    <i class="fa-solid fa-search"></i>
                </button>
            </div>
        </form>
        @endif

        <div class="space-y-4">
            @if (count($tasks) > 0)
                @foreach ($tasks as $task)
                    <a href="{{ route('task.show', $task->id) }}" class="block w-full p-4 bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-md">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <h2 class="text-lg font-semibold text-slate-900">{{ $task->title }}</h2>
                                <p class="text-sm text-gray-600 mt-1">{{ $task->description }}</p>
                                <div class="mt-3 text-sm text-gray-500 flex flex-wrap gap-4">
                                    <span>Priority: <strong class="text-slate-700">{{ ucfirst($task->priority) }}</strong></span>
                                    <span>Status: <strong class="text-slate-700">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</strong></span>
                                    <span>Assigned to: <strong class="text-slate-700">{{ $task->user->name }}</strong></span>
                                    <span>Team: <strong class="text-slate-700">{{ $task->team->name }}</strong></span>
                                </div>
                            </div>
                            <div class="shrink-0 self-center">
                                <svg class="h-5 w-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <p class="text-sm text-gray-500">No tasks found.</p>
            @endif
        </div>
    </div>
     @if (session('status') == 'done')
    <script>
        Swal.fire({
            title: 'Successfully',
            text: 'The operation was completed successfully',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
    @elseif (session('error'))
    <script>
        Swal.fire({
            title: 'Error',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
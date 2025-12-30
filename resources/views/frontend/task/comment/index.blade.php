@extends('layouts.app')

@section('title', 'My Comments')

@section('content')
    <div class="container">
        <div class="flex flex-col items-center justify-between mt-6 mb-4 md:flex-row">
            <h1 class="text-3xl font-semibold text-slate-900">Task Comments</h1>
            @if (Auth::user()->id == $task->user_id)
                <a href="{{ route('comment.create', ['task_id' => $task->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Create Comment</a>
            @endif
        </div>

        <div class="space-y-4">
            @if (count($comments) > 0)
                @foreach ($comments as $comment)
                    <div class="block w-full p-4 bg-white border border-gray-100 rounded-lg shadow-sm">
                        <div class="flex flex-col items-start justify-between gap-4 md:flex-row">
                            <div class="flex-1">
                                <p class="text-sm text-gray-600">{{ $comment->title }}</p>
                                <div class="mt-2 text-sm text-gray-500">
                                    <span>Task ID: <strong class="text-slate-700">{{ $comment->task_id }}</strong></span>
                                    <span class="ml-4">Created: <strong class="text-slate-700">{{ $comment->created_at?->format('Y-m-d H:i') }}</strong></span>
                                </div>
                            </div>
                            <div class="flex shrink-0 self-center gap-1">
                                <a href="{{ route('task.show', $comment->task_id) }}" class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-700 rounded-md">View Task</a>
                                @can('delete', $comment)
                                <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete</button>
                                </form>
                                @endcan
                                @can('update', $comment)
                                <a href="{{ route('comment.edit', $comment->id) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Edit</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-sm text-gray-500">No comments found.</p>
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

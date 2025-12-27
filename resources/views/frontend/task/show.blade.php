@extends('layouts.app')

@section('title', 'Task Details')

@section('content')
    <div class="container">
        <a class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 mt-4" href="{{ route('task.index') }}">
            <i class="fa-solid fa-arrow-left"></i>
            Home
        </a>

        <div class="max-w-3xl mx-auto mt-6 bg-white rounded-lg shadow-sm p-6">
            <h1 class="text-2xl font-semibold text-slate-900 mb-2">{{ $task->title }}</h1>
            <p class="text-sm text-gray-500 mb-4">Assigned to <strong class="text-slate-800">{{ $task->user->name }}</strong> • Team <strong class="text-slate-800">{{ $task->team->name }}</strong></p>

            @if ($errors->any())
                <div class="rounded-md bg-red-50 border border-red-100 p-3 mb-4">
                    <ul class="list-disc pl-5 text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="prose mb-4 text-slate-700">{{ $task->description }}</div>

            <div class="grid sm:grid-cols-3 gap-4 mb-4 text-sm text-gray-600">
                <div>Priority: <span class="text-slate-800 font-medium">{{ ucfirst($task->priority) }}</span></div>
                <div>Status: <span class="text-slate-800 font-medium">{{ ucfirst(str_replace('_', ' ', $task->status)) }}</span></div>
                <div>Task ID: <span class="text-slate-800">{{ $task->id }}</span></div>
            </div>

            @can('changeStatus', $task)
            <div class="mb-4">
                <form action="{{ route('task.change_status', $task->id) }}" method="POST" class="flex items-center gap-3">
                    @csrf
                    @method('PUT')
                    <label for="status" class="sr-only">Status</label>
                    <select name="status" id="status" class="border border-gray-200 rounded-md px-3 py-2 text-sm">
                        <option value="pending" {{ $task->status=='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $task->status=='in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $task->status=='completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Update Status</button>
                </form>
            </div>
            @endcan

            @can('uploadAttachment', $task)
            <form action="{{ route('task.uploadAttachments', $task) }}" method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf
                <label class="block text-sm font-medium text-slate-700 mb-2">Upload Attachment</label>
                <input type="file" name="attachments[]" multiple class="block w-full text-sm text-gray-600 file:bg-white file:border file:border-gray-200 file:rounded-md file:px-3 file:py-2">
                <div class="mt-3">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Upload File</button>
                </div>
            </form>
            @endcan
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
@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
    <div class="container">
        <a class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 mt-4" href="{{ route('task.index') }}">
            <i class="fa-solid fa-arrow-left"></i>
            Home
        </a>

        <div class="max-w-2xl mx-auto mt-6">
            <h1 class="text-2xl font-semibold text-slate-900 mb-4">Create Task</h1>

            @if ($errors->any())
                <div class="rounded-md bg-red-50 border border-red-100 p-4 mb-4">
                    <ul class="list-disc pl-5 space-y-1 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('task.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-sm space-y-4">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700">Title</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-slate-800" value="{{ old('title') }}" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                    <textarea id="description" name="description" class="mt-1 block w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-slate-800" required>{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-slate-700">Priority</label>
                    <select name="priority" id="priority" class="mt-1 block w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-slate-800">
                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                </div>

                <div>
                    <label for="user_id" class="block text-sm font-medium text-slate-700">Assign To</label>
                    <select name="user_id" id="user_id" class="mt-1 block w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-slate-800">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Create Task</button>
                </div>
            </form>
        </div>
    </div>
    @if (session('error'))
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
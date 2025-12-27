@extends('layouts.app')

@section('title', "Edit Team $team->id")

@section('content')
    <div class="container">
        <a class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 mt-4" href="{{ route('team.index') }}">
            <i class="fa-solid fa-arrow-left"></i>
            Home
        </a>

        <div class="max-w-2xl mx-auto mt-6">
            <h1 class="text-2xl font-semibold text-slate-900 mb-4">Edit Team — {{ $team->name }}</h1>

            @if ($errors->any())
                <div class="rounded-md bg-red-50 border border-red-100 p-4 mb-4">
                    <ul class="list-disc pl-5 space-y-1 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('team.update', $team->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-sm space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Team Name</label>
                    <input id="name" type="text" placeholder="Enter the team name" name="name" value="{{ $team->name }}" class="mt-1 block w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-300" required>
                </div>

                <div>
                    <label for="desc" class="block text-sm font-medium text-slate-700">Team Description</label>
                    <input id="desc" type="text" placeholder="Enter the team description" name="description" value="{{ $team->description }}" class="mt-1 block w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Team Members</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach ($team->users as $user)
                            <label class="inline-flex items-center gap-2 p-2 border border-gray-100 rounded-lg bg-slate-50">
                                <input type="checkbox" name="user_ids[]" checked value="{{ $user->id }}" class="h-4 w-4 text-indigo-600">
                                <span class="text-sm text-slate-700">{{ $user->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Add Team Members</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach ($users as $user)
                             @if (!$user->team_id)
                                <label class="inline-flex items-center gap-2 p-2 border border-gray-100 rounded-lg hover:bg-slate-50">
                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="h-4 w-4 text-indigo-600">
                                    <span class="text-sm text-slate-700">{{ $user->name }}</span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Update</button>
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
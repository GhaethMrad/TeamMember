@extends('layouts.app')

@section('title', "Team $team->id Details")

@section('content')
    <div class="container">
        <a class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 mt-4" href="{{ route('team.index') }}">
            <i class="fa-solid fa-arrow-left"></i>
            Home
        </a>

        <header class="mt-6 mb-6 text-center">
            <h1 class="text-2xl font-semibold text-slate-900">{{ $team->name }} — Team Details</h1>
            <p class="text-sm text-gray-500">Team ID: {{ $team->id }}</p>
        </header>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-medium text-slate-800 mb-4">Members</h2>

            <div class="flow-root">
                <ul class="divide-y divide-gray-100">
                    @foreach ($team->users as $user)
                    <li class="py-4 flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-slate-900">{{ $user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                        </div>
                        <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
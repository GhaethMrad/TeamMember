@extends('layouts.app')

@section('title', "Edit Team $team->id")

@section('content')
    <div class="container">
        <a class="block mt-[20px] text-indigo-400" href="{{ route('team.index') }}">
            <i class="fa-solid fa-arrow-left"></i>
            Home
        </a>
        <h1 class="w-fit mx-auto my-[50px] text-[#222] text-[50px] uppercase border-b-2 border-indigo-400 text-center">Edit ({{ $team->name }}) Teams</h1>
        @if ($errors->any())
            <div class="bg-red-400 p-5 my-5">
                <ul class="list-disc flex flex-col gap-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('team.update', $team->id) }}" method="POST" class="w-full flex flex-col gap-5">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-2">
                <label for="name">Team Name</label>
                <input id="name" type="text" placeholder="Enter The Team Name" name="name" value="{{ $team->name }}">
            </div>
            <div class="flex flex-col gap-2">
                <label for="desc">Team Descraption</label>
                <input id="desc" type="text" placeholder="Enter The Team Descraption" name="description" value="{{ $team->description }}">
            </div>
            <div class="flex flex-col gap-2">
                <label for="member">Team Members</label>
                @foreach ($team->users as $user)
                    <div class="flex items-center gap-1">
                        <input type="checkbox" name="user_ids[]" id="" checked value="{{ $user->id }}">
                        <label for="">{{ $user->name }}</label>
                    </div>
                @endforeach
            </div>
            <div class="flex flex-col gap-2">
                <label for="member">Add Team Members</label>
                @foreach ($users as $user)
                     @if (!$user->team_id)
                        <div class="flex items-center gap-1">
                            <input type="checkbox" name="user_ids[]" id="" value="{{ $user->id }}">
                            <label for="">{{ $user->name }}</label>
                        </div>
                    @endif
                @endforeach
            </div>
            <input class="bg-indigo-500 text-[#222] p-3 cursor-pointer mb-5" type="submit" value="UPDATE">
        </form>
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
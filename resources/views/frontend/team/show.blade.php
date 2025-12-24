@extends('layouts.app')

@section('title', "Team $team->id Details")

@section('content')
    <div class="container">
        <h1 class="w-fit mx-auto my-[50px] text-[#222] text-[50px] uppercase border-b-2 border-indigo-400 text-center">({{ $team->name }}) Teams Details</h1>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <th class="bg-[#222] text-white border-[1px] p-[8px] border-indigo-400">Team Id</th>
                    <th class="bg-[#222] text-white border-[1px] p-[8px] border-indigo-400">User Id</th>
                    <th class="bg-[#222] text-white border-[1px] p-[8px] border-indigo-400">Username</th>
                    <th class="bg-[#222] text-white border-[1px] p-[8px] border-indigo-400">Email</th>
                </thead>
                <tbody>
                    @foreach ($team->users as $user)
                    <tr>
                        <td class="text-center bg-[#333] p-[8px] text-[20px] text-white border-2 border-gray-300">{{ $team->id }}</td>
                        <td class="text-center bg-[#333] p-[8px] text-[20px] text-white border-2 border-gray-300">{{ $user->id }}</td>
                        <td class="text-center bg-[#333] p-[8px] text-[20px] text-white border-2 border-gray-300">{{ $user->name }}</td>
                        <td class="text-center bg-[#333] p-[8px] text-[20px] text-white border-2 border-gray-300">{{ $user->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
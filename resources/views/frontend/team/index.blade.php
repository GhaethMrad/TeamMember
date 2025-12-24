@extends('layouts.app')

@section('title', 'Teams')

@section('content')
    <div class="container">
        <h1 class="w-fit mx-auto my-[50px] text-[#222] text-[50px] uppercase border-b-2 border-indigo-400">Teams</h1>
        <a href="{{ route('team.create') }}" class="block w-fit mx-auto mb-[20px] px-[25px] py-[10px] bg-[#222] text-indigo-400 border-2 border-indigo-400 text-[20px] uppercase">Create</a>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <th class="bg-[#222] text-white border-[1px] p-[8px] border-indigo-400">Id</th>
                    <th class="bg-[#222] text-white border-[1px] p-[8px] border-indigo-400">Name</th>
                    <th class="bg-[#222] text-white border-[1px] p-[8px] border-indigo-400">Description</th>
                    <th class="bg-[#222] text-white border-[1px] p-[8px] border-indigo-400">Actions</th>
                </thead>
                <tbody>
                    @if (count($teams) == 0)
                        <td colspan="4" class="text-center bg-[#333] p-[8px] text-[20px] text-white">Teams Not Found</td>
                        @else
                        @foreach ($teams as $team)
                        <tr>
                            <td class="text-center bg-[#333] p-[8px] text-[20px] text-white border-2 border-gray-300">{{ $team->id }}</td>
                            <td class="text-center bg-[#333] p-[8px] text-[20px] text-white border-2 border-gray-300">{{ $team->name }}</td>
                            <td class="text-center bg-[#333] p-[8px] text-[20px] text-white border-2 border-gray-300">{{ $team->description }}</td>
                            <td class="text-center bg-[#333] p-[8px] text-[20px] text-white border-2 border-gray-300">
                                <div class="flex items-center gap-1">
                                    <a href="{{ route('team.show', $team->id) }}" class="border-b-2 border-indigo-400 text-indigo-400">Show</a>
                                    @if (Auth::user()->isAdmin())
                                        <a href="{{ route('team.create') }}" class="border-b-2 border-green-400 text-green-400">Create</a>
                                        <a href="{{ route('team.edit', $team->id) }}" class="border-b-2 border-blue-500 text-blue-500">Edit</a>
                                        <form action="{{ route('team.destroy', $team->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input class="border-b-2 border-red-500 text-red-500 cursor-pointer" type="submit" value="Delete">
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    @if (session('status') === 'done')
    <script>
        Swal.fire({
            title: 'Successfully',
            text: 'The operation was completed successfully',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
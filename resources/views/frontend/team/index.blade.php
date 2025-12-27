@extends('layouts.app')

@section('title', 'Teams')

@section('content')
    <div class="container">
        <h1 class="text-3xl font-semibold text-slate-900 text-center my-8">Teams</h1>
        @can ('create', App\Models\Team::class)
            <div class="text-center mb-6">
                <a href="{{ route('team.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Create Team</a>
            </div>
        @endcan

        <div class="overflow-x-auto bg-white rounded-lg shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @if (count($teams) == 0)
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">No teams found.</td>
                        </tr>
                    @else
                        @foreach ($teams as $team)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $team->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $team->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $team->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('team.show', $team->id) }}" class="text-indigo-600 hover:text-indigo-800">Show</a>
                                    @can ('update', $team)
                                        <a href="{{ route('team.edit', $team->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    @endcan
                                    @can('delete', $team)
                                        <form action="{{ route('team.destroy', $team->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    @endcan

                                    @if (!Auth::user()->team_id && !Auth::user()->is_admin)
                                        @can('join', [$team, Auth::user()])
                                        <form action="{{ route('team.join_user', ['team' => $team->id, 'user' => Auth::user()->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="text-green-600 hover:text-green-800">Join</button>
                                        </form>
                                        @endcan
                                    @elseIf (Auth::user()->team_id == $team->id && !Auth::user()->is_admin)
                                        @can('leave', [$team, Auth::user()])
                                        <form action="{{ route('team.leave_user', Auth::user()->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 underline">Leave</button>
                                        </form>
                                        @endcan
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
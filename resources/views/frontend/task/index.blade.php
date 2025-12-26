@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <div class="container">
        <h1 class="w-fit mx-auto my-[50px] text-[#222] text-[50px] uppercase border-b-2 border-indigo-400">Tasks</h1>
        @can ('create', App\Models\Task::class)
            <a href="{{ route('task.create') }}" class="block w-fit mx-auto mb-[20px] px-[25px] py-[10px] bg-[#222] text-indigo-400 border-2 border-indigo-400 text-[20px] uppercase">Create</a>
        @endcan
        <div>
            @if (Auth::user()->is_admin)
            <form class="search w-full" action="POST">
                @csrf
                <div class="relative">
                    <input class="w-full px-[20px]" type="search" name="search" id="" placeholder="Search Tasks">
                    <button class="absolute h-full bg-indigo-400 px-[20px] duration-300 hover:bg-indigo-500 top-[50%] translate-y-[-50%] right-0" type="submit">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </div>
            </form>
            @endif
            <div class="flex flex-col items-center mt-[20px]">
                @if (count($tasks) > 0)
                    @foreach ($tasks as $task)
                        <div class="w-full mb-[20px] p-[20px] border-2 border-indigo-400 rounded-lg">
                            <h2 class="text-[24px] font-bold mb-[10px]">{{ $task->title }}</h2>
                            <p class="mb-[10px]">{{ $task->description }}</p>
                            <p class="mb-[10px]">Priority: {{ ucfirst($task->priority) }}</p>
                            <p class="mb-[10px]">Status: {{ ucfirst(str_replace('_', ' ', $task->status)) }}</p>
                            <p class="mb-[10px]">Assigned to: {{ $task->user->name }}</p>
                            <p class="mb-[10px]">Team: {{ $task->team->name }}</p>
                            @can('changeStatus', $task)
                            <div>
                                <label for="">Status:</label>
                                <form action="{{ route('task.change_status', $task->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" id="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="pending">Pending</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 mt-4 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update</button>
                                </form>
                            </div>
                            @endcan
                        </div>
                    @endforeach
                    @else
                    <p class="text-[18px]">Not Tasks Found!</p>
                @endif
            </div>
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
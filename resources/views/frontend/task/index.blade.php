@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <div class="container">
        <h1 class="w-fit mx-auto my-[50px] text-[#222] text-[50px] uppercase border-b-2 border-indigo-400">Tasks</h1>
        <div>
            <form class="search w-full" action="POST">
                @csrf
                <div class="relative">
                    <input class="w-full px-[20px]" type="search" name="search" id="" placeholder="Search Tasks">
                    <button class="absolute h-full bg-indigo-400 px-[20px] duration-300 hover:bg-indigo-500 top-[50%] translate-y-[-50%] right-0" type="submit">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </div>
            </form>
            <div class="flex flex-col items-center mt-[20px]">
                @if (count($tasks) > 0)
                    
                    @else
                    <p class="text-[18px]">Not Tasks Found!</p>
                @endif
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Create Comment')

@section('content')
    <div class="container">
        <a class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 mt-4" href="{{ route('comment.index', ['task_id' => $comment->task_id]) }}">
            <i class="fa-solid fa-arrow-left"></i>
            Back to Comments
        </a>

        <div class="max-w-2xl mx-auto mt-6 bg-white rounded-lg shadow-sm p-6">
            <h1 class="text-2xl font-semibold text-slate-900 mb-4">Create Comment</h1>

            @if ($errors->any())
                <div class="rounded-md bg-red-50 border border-red-100 p-3 mb-4">
                    <ul class="list-disc pl-5 text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Comment</label>
                    <textarea name="title" rows="4" class="w-full border border-gray-200 rounded-md px-3 py-2 text-sm" placeholder="Write your comment...">{{ old('title') }}</textarea>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700">Create Comment</button>
                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

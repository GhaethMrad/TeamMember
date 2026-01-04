@extends('layouts.app')

@section('title', basename($attachment->file_path))

@section('content')
	<div class="container">
		<a class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 mt-4" href="{{ route('attachment.index') }}">
			<i class="fa-solid fa-arrow-left"></i>
			Back
		</a>

		<div class="max-w-3xl mx-auto mt-6 bg-white rounded-lg shadow-sm p-6">
			<h1 class="text-2xl font-semibold text-slate-900 mb-2">{{ basename($attachment->file_path) }}</h1>
			<p class="text-sm text-gray-500 mb-4">Type: {{ $attachment->file_type }} • Task: <a href="{{ route('task.show', $attachment->task_id) }}">#{{ $attachment->task_id }}</a></p>

			@if(str_starts_with($attachment->file_type, 'image'))
				<img src="{{ asset('storage/' . $attachment->file_path) }}" alt="{{ basename($attachment->file_path) }}" class="max-w-full h-auto rounded mb-4">
			@else
				<div class="mb-4 text-sm text-gray-700">This file cannot be previewed. Use the download button to open it.</div>
			@endif

			<div class="flex items-center gap-3">
				<a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Download</a>
				@can('delete', \App\Models\Attachment::class)
					<form action="{{ route('attachment.destroy', $attachment->id) }}" method="POST" onsubmit="return confirm('Delete attachment?');">
						@csrf
						@method('DELETE')
						<button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md">Delete</button>
					</form>
				@endcan
			</div>
		</div>
	</div>
@endsection
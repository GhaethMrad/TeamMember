@extends('layouts.app')

@section('title', 'Attachments')

@section('content')
	<div class="container">
		<a class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 mt-4" href="{{ route('task.index') }}">
			<i class="fa-solid fa-arrow-left"></i>
			Home
		</a>

		<div class="max-w-3xl mx-auto mt-6 bg-white rounded-lg shadow-sm p-6">
			<h1 class="text-2xl font-semibold text-slate-900 mb-4">All Attachments</h1>

			@if($attachments->isEmpty())
				<p class="text-sm text-gray-600">No attachments found.</p>
			@else
				<ul class="space-y-2">
					@foreach($attachments as $attachment)
						<li class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
							<div>
								<a href="{{ route('attachment.show', $attachment->id) }}" class="text-indigo-600 hover:underline">{{ basename($attachment->file_path) }}</a>
								<div class="text-sm text-gray-500">Task: <a href="{{ route('task.show', $attachment->task_id) }}" class="text-gray-700">#{{ $attachment->task_id }}</a> • {{ $attachment->file_type }}</div>
							</div>

							<div class="flex items-center gap-2">
								<a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-700 rounded-md">Download</a>
								@can('delete', \App\Models\Attachment::class)
									<form action="{{ route('attachment.destroy', $attachment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this attachment?');">
										@csrf
										@method('DELETE')
										<button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-md">Delete</button>
									</form>
								@endcan
							</div>
						</li>
					@endforeach
				</ul>
			@endif
		</div>
	</div>
@endsection
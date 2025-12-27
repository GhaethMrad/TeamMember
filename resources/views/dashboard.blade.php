@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
	<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
		<div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm text-gray-500">Users</p>
					<p class="mt-1 text-2xl font-semibold text-slate-900">{{ $usersCount ?? 0 }}</p>
				</div>
				<div class="text-indigo-600 bg-indigo-50 p-2 rounded-md">
					<i class="fa-solid fa-users"></i>
				</div>
			</div>
		</div>

		<div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm text-gray-500">Teams</p>
					<p class="mt-1 text-2xl font-semibold text-slate-900">{{ $teamsCount ?? 0 }}</p>
				</div>
				<div class="text-emerald-600 bg-emerald-50 p-2 rounded-md">
					<i class="fa-solid fa-people-group"></i>
				</div>
			</div>
		</div>

		<div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm text-gray-500">Tasks</p>
					<p class="mt-1 text-2xl font-semibold text-slate-900">{{ $tasksCount ?? 0 }}</p>
				</div>
				<div class="text-yellow-600 bg-yellow-50 p-2 rounded-md">
					<i class="fa-solid fa-list-check"></i>
				</div>
			</div>
		</div>

		<div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100">
			<div class="flex items-center justify-between">
				<div>
					<p class="text-sm text-gray-500">Attachments</p>
					<p class="mt-1 text-2xl font-semibold text-slate-900">{{ $attachmentsCount ?? 0 }}</p>
				</div>
				<div class="text-pink-600 bg-pink-50 p-2 rounded-md">
					<i class="fa-solid fa-paperclip"></i>
				</div>
			</div>
		</div>
	</div>
    
	<div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
		<div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
			<h3 class="text-md font-medium text-slate-900 mb-3">Tasks by Status</h3>
			<div class="flex flex-col sm:flex-row sm:items-center sm:gap-6 gap-4">
				<div class="flex-1">
					<div class="flex items-center justify-between p-4 rounded-md bg-gray-50 border border-gray-100">
						<div>
							<p class="text-sm text-gray-500">Pending</p>
							<p class="text-xl font-semibold text-slate-900">{{ $tasksByStatus['pending'] ?? 0 }}</p>
						</div>
						<div class="text-yellow-600 bg-yellow-50 p-2 rounded-md">
							<i class="fa-solid fa-clock"></i>
						</div>
					</div>
				</div>

				<div class="flex-1">
					<div class="flex items-center justify-between p-4 rounded-md bg-gray-50 border border-gray-100">
						<div>
							<p class="text-sm text-gray-500">In Progress</p>
							<p class="text-xl font-semibold text-slate-900">{{ $tasksByStatus['in_progress'] ?? 0 }}</p>
						</div>
						<div class="text-indigo-600 bg-indigo-50 p-2 rounded-md">
							<i class="fa-solid fa-spinner"></i>
						</div>
					</div>
				</div>

				<div class="flex-1">
					<div class="flex items-center justify-between p-4 rounded-md bg-gray-50 border border-gray-100">
						<div>
							<p class="text-sm text-gray-500">Completed</p>
							<p class="text-xl font-semibold text-slate-900">{{ $tasksByStatus['completed'] ?? 0 }}</p>
						</div>
						<div class="text-emerald-600 bg-emerald-50 p-2 rounded-md">
							<i class="fa-solid fa-check-circle"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<aside class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
			<h3 class="text-md font-medium text-slate-900 mb-3">Recent Users</h3>
			@if(isset($recentUsers) && $recentUsers->count() > 0)
				<ul class="space-y-3">
					@foreach($recentUsers as $user)
						<li class="flex items-center justify-between">
							<div>
								<div class="text-sm font-medium text-slate-900">{{ $user->name }}</div>
								<div class="text-xs text-gray-500">{{ $user->email }}</div>
							</div>
							<div class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
						</li>
					@endforeach
				</ul>
			@else
				<p class="text-sm text-gray-500">No recent users.</p>
			@endif
		</aside>
	</div>
@endsection
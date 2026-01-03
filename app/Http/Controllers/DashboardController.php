<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use App\Models\Task;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $teamsCount = Team::count();
        $tasksCount = Task::count();
        $attachmentsCount = Attachment::count();
        if (Auth::user()->isAdmin()) {
            $tasksByStatus = [
                'pending' => Task::where('status', 'pending')->count(),
                'in_progress' => Task::where('status', 'in_progress')->count(),
                'completed' => Task::where('status', 'completed')->count(),
            ];
        } else {
            $tasksByStatus = [
                'pending' => Task::where('status', 'pending')->where('user_id', Auth::id())->count(),
                'in_progress' => Task::where('status', 'in_progress')->where('user_id', Auth::id())->count(),
                'completed' => Task::where('status', 'completed')->where('user_id', Auth::id())->count(),
            ];

        }

        $recentUsers = User::orderBy('created_at', 'desc')->limit(5)->get(['id', 'name', 'email', 'created_at']);

        return view('dashboard', compact('usersCount', 'teamsCount', 'tasksCount', 'attachmentsCount', 'tasksByStatus', 'recentUsers'));
    }
}

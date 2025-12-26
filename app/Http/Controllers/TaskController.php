<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\TaskStoreRequest;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Task::class);
        $tasks = Auth::user()->isAdmin() ? Task::all() : Auth::user()->tasks()->get();
        return view('frontend.task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Task::class);
        return view('frontend.task.create', ['users' => User::whereNotNull('team_id')->get(), 'teams' => Team::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        try {
            $this->authorize('create', Task::class);

            Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority,
                'status' => 'pending',
                'user_id' => $request->user_id,
                'team_id' => User::find($request->user_id)->team_id,
            ]);
            return redirect()->route('task.index')->with('status', 'done');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the task.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }

    public function changeStatus(Request $request, Task $task)
    {
        try {
            $this->authorize('changeStatus', $task);

            $task->status = $request->status;
            $task->save();

            return redirect()->route('task.index')->with('status', 'done');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the task status.');
        }
    }
}

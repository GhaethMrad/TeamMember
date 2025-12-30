<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Comment::class);

        $taskID = request()->query('task_id');

        $comments = Comment::where('task_id', $taskID)->get();

        return view('frontend.task.comment.index', ['comments' => $comments, 'task' => Task::find($taskID)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task_id = request()->query('task_id');
        $task = Task::findOrFail($task_id);
        $this->authorize('create', [Comment::class, $task]);

        return view('frontend.task.comment.create', ['task' => $task]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentStoreRequest $request)
    {
        try {
            $task = Task::findOrFail($request->task_id);
            $this->authorize('create', [Comment::class, $task]);

            Comment::create([
                'title' => $request->title,
                'task_id' => $task->id,
                'user_id' => $request->user_id,
            ]);

            return redirect()->route('comment.index', ['task_id' => $task->id])->with('status', 'done');
        } catch (Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('frontend.task.comment.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        try {
            $this->authorize('update', $comment);
            
            $comment->update([
                "title" => $request->title,
                "user_id" => $comment->user_id,
                "task_id" => $comment->task_id
            ]);

            $comment->save();

            return redirect()->route('comment.index', ['task_id' => $comment->task_id])->with('status', 'done');
        } catch (Exception $error) {
            return redirect()->back()->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('comment.index', ['task_id' => $comment->task_id])->with('status', 'done');
    }
}

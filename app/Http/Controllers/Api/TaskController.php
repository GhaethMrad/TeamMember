<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();
        return response()->json([
            'status' => (count($tasks) > 0) 
            ? 'OK' 
            : 'Not Found' , 
            'tasks' => $tasks
        ], count($tasks) > 0 ? 200 : 404);
    }
    public function show($id) {
        $task = Task::find($id);
        return response()->json([
            'status' => $task ? 'OK' : 'Not Found', 
            'task' => $task
        ], $task ? 200 : 404);
    }
}

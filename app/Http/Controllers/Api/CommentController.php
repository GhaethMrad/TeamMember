<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index() {
        $comments = Comment::all();
        return response()->json([
            'status' => (count($comments) > 0) 
            ? 'OK' 
            : 'Not Found' , 
            'comments' => $comments
        ], count($comments) > 0 ? 200 : 404);
    }
    public function show($id) {
        $comment = Comment::find($id);
        return response()->json([
            'status' => $comment ? 'OK' : 'Not Found', 
            'comment' => $comment
        ], $comment ? 200 : 404);
    }
}

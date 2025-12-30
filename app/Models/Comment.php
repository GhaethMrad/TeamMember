<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'title',
        'task_id',
        'user_id'
    ];

    public function tasks() {
        return $this->belongsToMany(Task::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}

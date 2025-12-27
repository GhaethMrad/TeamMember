<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'task_id',
        'file_path',
        'file_type',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }    
}

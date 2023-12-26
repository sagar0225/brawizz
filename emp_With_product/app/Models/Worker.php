<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $table = 'workrs';
    protected $fillable = ['name','email','mobile ','task_id','password'];
    
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}

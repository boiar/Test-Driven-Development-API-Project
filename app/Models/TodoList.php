<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id'
    ];


    public static function boot()
    {
        parent::boot();
        self::deleting(function ($todoList) {
            $todoList->tasks()->delete(); // Ensure tasks are deleted before the todo list
        });
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'todo_list_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}

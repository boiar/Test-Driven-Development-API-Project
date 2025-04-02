<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Task extends Model
{
    use HasFactory;


    public const NOT_STARTED = 0;
    public const STARTED     = 1;
    public const PENDING     = 2;
    public const COMPLETED   = 3;
    public const CANCELED    = 4;

    protected $fillable = [
        'todo_list_id', 'title', 'status', 'desc', 'label_id'
    ];


    public function todoList(): BelongsTo
    {
        return $this->belongsTo(TodoList::class, 'todo_list_id');
    }


}

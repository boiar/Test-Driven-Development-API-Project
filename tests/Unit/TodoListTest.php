<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;


    public function test_a_todo_list_can_has_many_tasks()
    {

        $todo_obj = TodoList::factory()->create();

        $task_obj = Task::factory()->create(['todo_list_id' => $todo_obj->id, 'title' => 'first task title']);


        $this->assertInstanceOf(Collection::class, $todo_obj->tasks);
        $this->assertInstanceOf(Task::class, $todo_obj->tasks->first());

    }

}

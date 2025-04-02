<?php

namespace Tests\Unit;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;


    public function test_task_belongs_to_todo_list()
    {

        $list = $this->createTodoList();

        $task_obj = Task::factory()->create(['todo_list_id' => $list->id, 'title' => 'first task title']);


        $this->assertInstanceOf(TodoList::class, $task_obj->todoList);

    }

}

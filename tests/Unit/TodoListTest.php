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

        $todo_obj = $this->createTodoList();
        $task_obj = $this->createTask(['todo_list_id' => $todo_obj->id, 'title' => 'first task title']);


        $this->assertInstanceOf(Collection::class, $todo_obj->tasks);
        $this->assertInstanceOf(Task::class, $todo_obj->tasks->first());

    }

    public function test_if_todo_list_deleted_then_all_its_tasks_will_be_deleted()
    {
        $todo_obj = $this->createTodoList();
        $another_todo_obj =  $this->createTodoList();

        $task_obj = Task::factory()->create(['todo_list_id' => $todo_obj->id, 'title' => 'first task title']);
        $another_task_obj = Task::factory()->create(['todo_list_id' => $another_todo_obj->id, 'title' => 'another task title']);

        $todo_obj->delete();

        $this->assertDatabaseMissing('todo_lists', ['id' => $todo_obj->id]);
        $this->assertDatabaseMissing('tasks', ['id' => $task_obj->id]);

        $this->assertDatabaseHas('tasks', ['id' => $another_task_obj->id]);
    }

}

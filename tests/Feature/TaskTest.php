<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskTest extends TestCase
{

    use RefreshDatabase;


    public function setUp(): void
    {
        parent::setUp();
        $this->authUser();
    }

    public function test_fetch_all_tasks_of_a_todo_list(): void
    {

        // preparation (prepare)
        $todo_obj = $this->createTodoList();
        $task_obj = $this->createTask(['todo_list_id' => $todo_obj->id, 'title' => 'first task title']);

        //action (perform)
        $response = $this->getJson(route('task.index', $todo_obj->id));

        $response->assertOk();

        // assertion (predict)
        $this->assertEquals($task_obj->title, $response->json()[0]['title']);
        $this->assertEquals($task_obj->todo_list_id, $response->json()[0]['todo_list_id']);
    }


    public function test_create_tasks_of_a_todo_list(): void
    {
        // preparation (prepare)
        $todo_obj = $this->createTodoList();
        $task = $this->createTask();

        //action (perform)
        $response = $this->postJson(route('task.store', $todo_obj->id), [
            'todo_list_id' => $todo_obj->id,
            'title' => $task->title,
            'label_id' => $task->label_id
        ]);

        $response->assertCreated();

        // assertion (predict)
        $this->assertDatabaseHas('tasks', ['title' => $task->title, 'todo_list_id' => $todo_obj->id, 'label_id' => $task->label_id ]);
    }


    public function test_create_tasks_of_a_todo_list_without_label(): void
    {
        // preparation (prepare)
        $todo_obj = $this->createTodoList();
        $task = $this->createTask();

        //action (perform)
        $response = $this->postJson(route('task.store', $todo_obj->id), [
            'todo_list_id' => $todo_obj->id,
            'title' => $task->title,
        ]);

        $response->assertCreated();

        // assertion (predict)
        $this->assertDatabaseHas('tasks', ['title' => $task->title, 'todo_list_id' => $todo_obj->id]);
    }


    public function test_delete_task(): void
    {
        // preparation (prepare)
        $todo_obj = $this->createTodoList();
        $task_obj = $this->createTask(['todo_list_id' => $todo_obj->id, 'title' => 'first task title']);

        //action (perform)
        $response = $this->deleteJson(route('task.destroy', $task_obj->id));


        // assertion (predict)
        $this->assertDatabaseMissing('tasks', ['title' => $task_obj->title]);
    }

    public function test_update_task(): void
    {
        // preparation (prepare)
        $todo_obj = $this->createTodoList();
        $task_obj = $this->createTask(['todo_list_id' => $todo_obj->id, 'title' => 'first task title']);


        //action (perform)
        $response = $this->patchJson(route('task.update', $task_obj->id), ['title' => 'first task title (updated)']);


        // assertion (predict)
        $response->assertOk();
        $this->assertDatabaseHas('tasks', ['id' => $task_obj->id, 'title' => 'first task title (updated)']);
    }


    public function test_a_task_status_can_be_changed()
    {

        // preparation (prepare)
        $todo_obj = $this->createTodoList();
        $task_obj = $this->createTask(['todo_list_id' => $todo_obj->id, 'title' => 'first task title']);


        //action (perform)
        $response = $this->patchJson(route('task.change_status', $task_obj->id), ['status' => Task::STARTED]);


        // assertion (predict)
        $response->assertOk();
        $this->assertDatabaseHas('tasks', ['id' => $task_obj->id, 'status' => Task::STARTED]);
    }


}

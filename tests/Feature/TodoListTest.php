<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{

    use RefreshDatabase;

    private $list;

    public function setUp():void
    {
        parent::setUp();
        $user = $this->authUser();
        $this->list = $this->createTodoList([
            'name' => 'my list',
            'user_id' => $user->id
        ]);

    }

    public function test_fetch_todo_lists(): void
    {
        // preparation (prepare)


        //action (perform)
        $response = $this->getJson(route('todo-list.index'));

        // assertion (predict)
        $this->assertCount(1, $response->json());
    }


    public function test_single_fetch_todo_list(): void
    {
        // preparation (prepare)
        $todo_obj = $this->list;

        //action (perform)
        $response = $this->getJson(route('todo-list.show', $todo_obj->id));

        // assertion (predict)
        $response->assertStatus(200);
        $this->assertEquals($todo_obj->id, $response->json()['id']);
    }


    public function test_store_new_todo_list(): void
    {
        // preparation (prepare)
        $list = $this->list;

        //action (perform)
        $response = $this->postJson(route('todo-list.store'), ['name' => $list->name, 'user_id' => $list->user_id]);

        // assertion (predict)
        $response->assertCreated();

        $this->assertEquals($list->name, $response->json()['name']);
        $this->assertDatabaseHas('todo_lists', ['name' => $list->name]);
    }


    public function test_while_storing_todo_list_name_field_is_required(): void
    {
        // preparation (prepare)

        $this->withExceptionHandling();
        //action (perform)
        $response = $this->postJson(route('todo-list.store'));


        // assertion (predict)
        $response->assertUnprocessable()->assertJsonValidationErrors(['name']);
    }


    public function test_delete_todo_list(): void
    {
        // preparation (prepare)
        $list = $this->list;

        //action (perform)
        $response = $this->deleteJson(route('todo-list.destroy', $list->id));


        // assertion (predict)
        $this->assertDatabaseMissing('todo_lists', ['name' => $list->name]);
    }


    public function test_update_todo_list(): void
    {
        // preparation (prepare)
        $list = $this->createTodoList();

        //action (perform)
        $response = $this->patchJson(route('todo-list.update', $list->id), ['name' => 'updated name list']);


        // assertion (predict)
        $response->assertOk();
        $this->assertDatabaseHas('todo_lists', ['id' => $list->id, 'name' => 'updated name list']);
    }
}

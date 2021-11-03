<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_page_can_be_viewed()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/tasks');
        $response->assertStatus(200);
    }

    public function test_create_task_page_can_be_viewed()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get('/tasks/create');
        $response->assertStatus(200);
    }

    public function test_user_can_create_a_task()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->post('/tasks', ['description' => 'test']);
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', [
            'description' => 'test',
            'user_id' => auth()->id()
        ]);
    }

    public function test_user_can_view_details_only_about_their_tasks()
    {
        $task = Task::factory()->create();
        $task2 = Task::factory()->create();

        $this->actingAs($task->user);

        $response = $this->get('/tasks/' . $task2->id);
        $response->assertStatus(404);

        $response = $this->get('/tasks/' . $task->id);
        $response->assertStatus(200);
    }

    public function test_user_can_view_edit_form_of_only_their_tasks()
    {
        $task = Task::factory()->create();
        $task2 = Task::factory()->create();

        $this->actingAs($task->user);

        $response = $this->get('/tasks/' . $task2->id . 'edit');
        $response->assertStatus(404);

        $response = $this->get('/tasks/' . $task->id . 'edit');
        $response->assertStatus(200);
    }

    public function test_user_can_edit_only_their_tasks()
    {
        $task = Task::factory()->create();
        $task2 = Task::factory()->create();

        $this->actingAs($task->user);

        $response = $this->patch('/tasks/' . $task2->id, ['description' => 'test2']);
        $response->assertStatus(404);

        $response = $this->patch('/tasks/' . $task->id, ['description' => 'test2']);
        $response->assertStatus(302);

        $this->assertDatabaseHas('tasks', [
            'description' => 'test2',
            'user_id' => auth()->id()
        ]);
    }

    public function test_user_can_delete_only_their_tasks()
    {
        $task = Task::factory()->create();
        $task2 = Task::factory()->create();

        $this->actingAs($task->user);

        $response = $this->delete('/tasks/' . $task2->id);
        $response->assertStatus(404);

        $response = $this->delete('/tasks/' . $task->id);
        $response->assertStatus(302);

        $this->assertDatabaseMissing('tasks', [
            'description' => $task->description,
            'user_id' => auth()->id()
        ]);
    }

    public function test_user_can_update_only_their_tasks_status()
    {
        $task = Task::factory()->create()->refresh();
        $task2 = Task::factory()->create()->refresh();

        $this->actingAs($task->user);

        $response = $this->patch('/tasks/' . $task2->id . 'update-status');
        $response->assertStatus(404);

        $response = $this->patch('/tasks/' . $task->id . 'update-status');
        $response->assertStatus(302);
    }
}

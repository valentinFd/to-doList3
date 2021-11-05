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

    public function test_user_can_view_task_details()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $response = $this->get('/tasks/' . $task->id);
        $response->assertStatus(200);
    }

    public function test_user_cannot_view_details_of_a_task_they_are_not_the_owner_of()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $task2 = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $response = $this->get('/tasks/' . $task2->id);
        $response->assertStatus(404);
    }

    public function test_user_can_view_edit_form()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $response = $this->get('/tasks/' . $task->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_user_cannot_view_edit_form_of_a_task_they_are_not_the_owner_of()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $task2 = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $response = $this->get('/tasks/' . $task2->id . '/edit');
        $response->assertStatus(404);

    }

    public function test_user_can_update_a_task()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $response = $this->patch('/tasks/' . $task->id, ['description' => 'test2']);
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', [
            'description' => 'test2',
            'id' => $task->id
        ]);
    }

    public function test_user_cannot_update_a_task_they_are_not_the_owner_of()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $task2 = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $response = $this->patch('/tasks/' . $task2->id);
        $response->assertStatus(404);
    }

    public function test_user_can_soft_delete_a_task()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $response = $this->delete('/tasks/' . $task->id);
        $response->assertStatus(302);
        $this->assertSoftDeleted($task);
    }

    public function test_user_cannot_delete_a_task_they_are_not_the_owner_of()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $task2 = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $response = $this->delete('/tasks/' . $task2->id);
        $response->assertStatus(404);
    }

    public function test_user_can_update_task_status()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $response = $this->patch('/tasks/' . $task->id . '/update-status');
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
            'completed_at' => null
        ]);
    }

    public function test_user_cannot_update_status_of_a_task_they_are_not_the_owner_of()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $task2 = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $response = $this->patch('/tasks/' . $task2->id . '/update-status');
        $response->assertStatus(404);
    }

    public function test_user_can_restore_a_soft_deleted_task()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $this->delete('/tasks/' . $task->id);
        $this->assertSoftDeleted($task);
        $response = $this->patch('/tasks/trashed/' . $task->id);
        $response->assertStatus(302);
        $this->assertFalse($task->trashed());
    }

    public function test_user_can_force_delete_a_task()
    {
        $task = Task::factory()->create(['user_id' => User::factory()]);
        $this->actingAs($task->user);
        $this->delete('/tasks/' . $task->id);
        $this->assertSoftDeleted($task);
        $response = $this->delete('/tasks/trashed/' . $task->id);
        $response->assertStatus(302);
        $this->assertDeleted($task);
    }
}

<?php

namespace Database\Factories;

use App\Models\Label;
use App\Models\TodoList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'todo_list_id' => function () {
                return TodoList::factory()->create()->id;
            },
            'desc' => $this->faker->paragraph(),
            'label_id' => function () {
                return Label::factory()->create()->id;
            },
        ];
    }
}

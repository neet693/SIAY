<?php

namespace Database\Factories;

use App\Models\StudentParent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentParent>
 */
class StudentParentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = StudentParent::class;
    public function definition(): array
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 10),
            'dad_name' => $this->faker->name(),
            'mom_name' => $this->faker->name(),
            'dad_degree' => $this->faker->numberBetween(1, 5),
            'mom_degree' => $this->faker->numberBetween(1, 5),
            'dad_job' => $this->faker->name(),
            'mom_job' => $this->faker->name(),
            'dad_tel' => $this->faker->unique()->e164PhoneNumber(),
            'mom_tel' => $this->faker->unique()->e164PhoneNumber(),
        ];
    }
}

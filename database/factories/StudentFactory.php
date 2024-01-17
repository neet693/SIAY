<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Student::class;
    public function definition(): array
    {
        return [
            'school_information_id' => $this->faker->numberBetween(1, 10),
            'fullname' => $this->faker->name,
            'nickname' => $this->faker->firstName,
            'citizenship' => $this->faker->country,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'birth_place' => $this->faker->city,
            'birth_date' => $this->faker->date,
            'religion_id' => $this->faker->numberBetween(1, 5),
            'blood_type_id' => $this->faker->numberBetween(1, 4),
            'residence_status_id' => $this->faker->numberBetween(1, 3),
            'church_domicile' => $this->faker->word,
            'child_position' => $this->faker->numberBetween(1, 5),
            'child_number' => $this->faker->numberBetween(1, 5),
            'email' => $this->faker->unique()->safeEmail,
            'payment_method' => $this->faker->numberBetween(1, 2),
        ];
    }
}

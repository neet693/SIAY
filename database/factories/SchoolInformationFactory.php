<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\EducationLevel;
use App\Models\SchoolInformation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolInformation>
 */
class SchoolInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SchoolInformation::class;
    public function definition(): array
    {
        return [
            'education_level_id' => $this->faker->numberBetween(1, 4),
            'academic_year_id' => $this->faker->numberBetween(1, 3), // Menggunakan factory untuk mendapatkan ID yang valid
            'news_from' => $this->faker->word,
            'last_school' => $this->faker->word,
        ];
    }
}

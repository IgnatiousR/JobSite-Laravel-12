<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->jobTitle(),
            'description' => fake()->paragraph(2, true),
            'salary' => $this->faker->numberBetween(40_000, 120_000),
            'tags' => implode(',', $this->faker->words(3)),
            'job_type' => $this->faker->randomElement(['Full-Time', 'Part-Time', 'Contract', 'Intership', 'Volunteer', 'On-Call', 'Contract']),
            'remote' => $this->faker->boolean(),
            'requirements' => $this->faker->sentences(3, true),
            'benefits' => fake()->sentences(2, true),
            'address'=> fake()->streetAddress(),
            'city'=>fake()->city(),
            'zipcode'=>fake()->postcode(),
            'contact_email' => fake()->safeEmail(),
            'contact_phone' => fake()->phoneNumber(),
            'company_name' => fake()->company(),
            'company_description'=> fake()->paragraph(2, true),
            'company_logo'=> fake()->imageUrl(100, 100, 'business', true, 'logo'),
            'company_website'=> fake()->url(),
        ];
    }
}

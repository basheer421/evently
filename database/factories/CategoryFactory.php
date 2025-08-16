<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    private static $usedCategories = [];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Technology' => 'Events related to technology, programming, and digital innovation',
            'Business' => 'Professional networking, conferences, and business development events',
            'Entertainment' => 'Concerts, shows, festivals, and entertainment events',
            'Education' => 'Workshops, seminars, training sessions, and educational events',
            'Sports' => 'Athletic competitions, fitness events, and sports activities',
            'Health & Wellness' => 'Health seminars, wellness workshops, and medical conferences',
            'Arts & Culture' => 'Art exhibitions, cultural festivals, and creative events',
            'Food & Drink' => 'Culinary events, wine tastings, and food festivals',
            'Travel & Adventure' => 'Travel experiences, adventure activities, and outdoor events',
            'Community' => 'Local community gatherings, charity events, and social causes'
        ];

        // Get available categories (not used yet)
        $availableCategories = array_diff_key($categories, array_flip(self::$usedCategories));

        // If no more predefined categories available, generate a random one
        if (empty($availableCategories)) {
            return [
                'name' => $this->faker->unique()->words($this->faker->numberBetween(1, 3), true),
                'description' => $this->faker->sentence($this->faker->numberBetween(8, 15)),
            ];
        }

        $category = $this->faker->randomElement(array_keys($availableCategories));
        self::$usedCategories[] = $category;

        return [
            'name' => $category,
            'description' => $categories[$category],
        ];
    }

    /**
     * Create a category with a random name and description.
     */
    public function random(): static
    {
        return $this->state(fn(array $attributes) => [
            'name' => $this->faker->unique()->words($this->faker->numberBetween(1, 3), true),
            'description' => $this->faker->sentence($this->faker->numberBetween(8, 15)),
        ]);
    }

    /**
     * Reset the used categories tracker.
     */
    public static function resetUsedCategories(): void
    {
        self::$usedCategories = [];
    }
}

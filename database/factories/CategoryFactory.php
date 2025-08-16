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

        // Map categories to specific static image IDs (no people, appropriate for each category)
        $categoryImages = [
            'Technology' => 'https://picsum.photos/id/3/400/300',      // Technology/computers
            'Business' => 'https://picsum.photos/id/2/400/300',       // Architecture/professional
            'Entertainment' => 'https://picsum.photos/id/11/400/300', // Abstract/colorful
            'Education' => 'https://picsum.photos/id/8/400/300',      // Architecture/academic
            'Sports' => 'https://picsum.photos/id/17/400/300',        // Mountains/outdoor
            'Health & Wellness' => 'https://picsum.photos/id/6/400/300',  // Nature/peaceful
            'Arts & Culture' => 'https://picsum.photos/id/18/400/300', // Abstract/artistic
            'Food & Drink' => 'https://picsum.photos/id/4/400/300',   // Abstract/warm colors
            'Travel & Adventure' => 'https://picsum.photos/id/1/400/300', // Nature/landscape
            'Community' => 'https://picsum.photos/id/10/400/300',     // Nature/water
        ];

        // Get available categories (not used yet)
        $availableCategories = array_diff_key($categories, array_flip(self::$usedCategories));

        // If no more predefined categories available, generate a random one
        if (empty($availableCategories)) {
            return [
                'name' => $this->faker->unique()->words($this->faker->numberBetween(1, 3), true),
                'description' => $this->faker->sentence($this->faker->numberBetween(8, 15)),
                'image_link' => $this->faker->optional(0.8)->randomElement([
                    'https://picsum.photos/id/30/400/300',   // Architecture/modern
                    'https://picsum.photos/id/32/400/300',   // Technology/office
                    'https://picsum.photos/id/34/400/300',   // Abstract/patterns
                    'https://picsum.photos/id/36/400/300',   // Nature/landscape
                    'https://picsum.photos/id/38/400/300',   // Architecture/building
                ]),
            ];
        }

        $category = $this->faker->randomElement(array_keys($availableCategories));
        self::$usedCategories[] = $category;

        return [
            'name' => $category,
            'description' => $categories[$category],
            'image_link' => $categoryImages[$category],
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
            'image_link' => $this->faker->optional(0.8)->randomElement([
                'https://picsum.photos/id/40/400/300',   // Architecture/modern
                'https://picsum.photos/id/42/400/300',   // Technology/workspace
                'https://picsum.photos/id/44/400/300',   // Abstract/geometric
                'https://picsum.photos/id/46/400/300',   // Nature/peaceful
                'https://picsum.photos/id/48/400/300',   // Architecture/interior
            ]),
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

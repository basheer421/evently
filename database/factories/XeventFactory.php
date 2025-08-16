<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Xevent>
 */
class XeventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['online', 'offline']);
        $startTime = $this->faker->dateTimeBetween('now', '+3 months');
        $endTime = $this->faker->dateTimeBetween($startTime, $startTime->format('Y-m-d H:i:s') . ' +6 hours');

        // Event title templates based on type
        $titleTemplates = [
            'online' => [
                'Virtual %s Workshop',
                'Online %s Conference',
                '%s Webinar Series',
                'Digital %s Meetup',
                '%s Live Stream Event',
                'Virtual %s Summit'
            ],
            'offline' => [
                '%s Conference 2025',
                '%s Workshop',
                '%s Meetup',
                '%s Festival',
                '%s Exhibition',
                '%s Networking Event'
            ]
        ];

        $eventTypes = [
            'Tech',
            'Business',
            'Marketing',
            'Design',
            'Leadership',
            'Innovation',
            'Startup',
            'AI',
            'Data Science',
            'Programming',
            'Wellness',
            'Creative'
        ];

        $template = $this->faker->randomElement($titleTemplates[$type]);
        $eventType = $this->faker->randomElement($eventTypes);
        $title = sprintf($template, $eventType);

        return [
            'title' => $title,
            'type' => $type,
            'category_id' => Category::factory(),
            'description' => $this->faker->paragraphs(2, true),
            'about' => $this->faker->paragraphs(3, true),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'location' => $type === 'online'
                ? $this->faker->randomElement([
                    'Zoom Meeting Room',
                    'Microsoft Teams',
                    'Google Meet',
                    'Discord Server',
                    'YouTube Live',
                    'Twitch Stream'
                ])
                : $this->faker->address,
            'image_link' => $this->faker->optional(0.7)->randomElement([
                'https://picsum.photos/id/1/800/400',    // Nature/landscape
                'https://picsum.photos/id/2/800/400',    // Architecture
                'https://picsum.photos/id/3/800/400',    // Technology/office
                'https://picsum.photos/id/4/800/400',    // Abstract/patterns
                'https://picsum.photos/id/6/800/400',    // Nature/forest
                'https://picsum.photos/id/8/800/400',    // Architecture/building
                'https://picsum.photos/id/9/800/400',    // Technology/workspace
                'https://picsum.photos/id/10/800/400',   // Nature/water
                'https://picsum.photos/id/11/800/400',   // Abstract/art
                'https://picsum.photos/id/13/800/400',   // Architecture/modern
                'https://picsum.photos/id/15/800/400',   // Technology/devices
                'https://picsum.photos/id/17/800/400',   // Nature/mountains
                'https://picsum.photos/id/18/800/400',   // Abstract/geometric
                'https://picsum.photos/id/20/800/400',   // Architecture/interior
                'https://picsum.photos/id/21/800/400',   // Technology/equipment
            ]),
            'organizer_id' => User::factory(),
        ];
    }

    /**
     * Create an online event.
     */
    public function online(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'online',
            'location' => $this->faker->randomElement([
                'Zoom Meeting Room',
                'Microsoft Teams',
                'Google Meet',
                'Discord Server',
                'YouTube Live',
                'Twitch Stream'
            ]),
        ]);
    }

    /**
     * Create an offline event.
     */
    public function offline(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => 'offline',
            'location' => $this->faker->address,
        ]);
    }

    /**
     * Create an event happening soon.
     */
    public function upcoming(): static
    {
        $startTime = $this->faker->dateTimeBetween('now', '+1 week');
        $endTime = $this->faker->dateTimeBetween($startTime, $startTime->format('Y-m-d H:i:s') . ' +4 hours');

        return $this->state(fn(array $attributes) => [
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);
    }

    /**
     * Create an event with a specific category.
     */
    public function withCategory(Category $category): static
    {
        return $this->state(fn(array $attributes) => [
            'category_id' => $category->id,
        ]);
    }

    /**
     * Create an event with a specific organizer.
     */
    public function organizedBy(User $user): static
    {
        return $this->state(fn(array $attributes) => [
            'organizer_id' => $user->id,
        ]);
    }

    /**
     * Create an event without an image.
     */
    public function withoutImage(): static
    {
        return $this->state(fn(array $attributes) => [
            'image_link' => null,
        ]);
    }

    /**
     * Create a long duration event (more than 4 hours).
     */
    public function longDuration(): static
    {
        $startTime = $this->faker->dateTimeBetween('now', '+2 months');
        $endTime = $this->faker->dateTimeBetween($startTime, $startTime->format('Y-m-d H:i:s') . ' +2 days');

        return $this->state(fn(array $attributes) => [
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);
    }
}

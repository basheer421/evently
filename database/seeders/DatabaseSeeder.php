<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Xevent;
use Database\Factories\CategoryFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reset category tracker to ensure fresh start
        CategoryFactory::resetUsedCategories();

        // Create test user
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create additional users
        $users = User::factory(10)->create();

        // Create categories (using the predefined ones from factory)
        // There are 10 predefined categories, so we can safely create up to 10
        $categories = Category::factory(7)->create();

        // Create some random categories too
        Category::factory(3)->random()->create();

        // Create events with existing users and categories
        $allUsers = collect([$testUser])->merge($users);

        // Create a mix of different event types
        foreach (range(1, 20) as $i) {
            Xevent::factory()
                ->organizedBy($allUsers->random())
                ->withCategory($categories->random())
                ->create();
        }

        // Create some specific event types
        Xevent::factory(5)
            ->online()
            ->upcoming()
            ->organizedBy($allUsers->random())
            ->withCategory($categories->random())
            ->create();

        Xevent::factory(3)
            ->offline()
            ->longDuration()
            ->organizedBy($allUsers->random())
            ->withCategory($categories->random())
            ->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // remove existing data so we don't get an exception when trying to insert
        // the same value in a unique column
        Category::truncate();
        User::truncate();
        Post::truncate();

        // create one user with the already existing factory
        $user = User::factory()->create();

        // create 2 categories (we don't have a factory for these yet)
        $fun = Category::create([
            'name' => 'fun stuff',
            'slug' => 'fun'
        ]);
        $serious = Category::create([
            'name' => 'serious stuff!',
            'slug' => 'serious'
        ]);
        $work = Category::create([
            'name' => 'work stuff!',
            'slug' => 'work'
        ]);

        Post::create([
            'title' => 'Spray apache pool strength lying visited. ',
            'slug' => 'my-first-post',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'excerpt' => 'abc 1234 i am an expert in excerpts',
            'category_id' => $fun->id,
            'user_id' => $user->id
        ]);

        Post::create([
            'title' => 'Carnival katie synopsis enabled honey ',
            'slug' => 'my-second-post',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'excerpt' => 'abc 1234 i am an expert in excerpts',
            'category_id' => $serious->id,
            'user_id' => $user->id
        ]);

        Post::create([
            'title' => 'Barely advice returned reasonably markers judgment cross',
            'slug' => 'my-third-post',
            'body' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            'excerpt' => 'abc 1234 i am an expert in excerpts',
            'category_id' => $serious->id,
            'user_id' => $user->id
        ]);
    }
}

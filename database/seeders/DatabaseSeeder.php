<?php

namespace Database\Seeders;

use App\Models\{Admin, Category, Country, Tag, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::factory(20)->create();
        Category::factory(10)->create();
        Tag::factory(10)->create();
        User::factory(10)->create();
        Admin::factory(1)->create();
    }
}

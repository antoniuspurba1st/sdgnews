<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate([
            'name' => 'Web Design',
        ], [
            'slug' => 'web-design',
            'color' => 'bg-red-100'
        ]);

        Category::firstOrCreate([
            'name' => 'Web Programming',
        ], [
            'slug' => 'web-programming',
            'color' => 'bg-green-100'
        ]);

        Category::firstOrCreate([
            'name' => 'Artificial Intelligence',
        ], [
            'slug' => 'ai',
            'color' => 'bg-blue-100'
        ]);
    }
}

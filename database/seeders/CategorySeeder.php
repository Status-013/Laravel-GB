<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert($this->getCategories());
    }

    private function getCategories(): array
    {
        $categoryNames = ['movies', 'tv series', 'video games', 'off-topic'];
        $categories = [];

        foreach ($categoryNames as $categoryName) {
            $categories[] = [
                'name' => $categoryName,
                'created_at' => now(),
            ];
        }

        return $categories;
    }
}

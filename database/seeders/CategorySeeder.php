<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getCategoriesData() as $categoryData) {
            $category = new Category($categoryData);
            $category->save();
        }
    }

    private function getCategoriesData(): array
    {
        return [
            [
                'name' => 'video games'
            ],
            [
                'name' => 'entertainment'
            ]
        ];
    }
}

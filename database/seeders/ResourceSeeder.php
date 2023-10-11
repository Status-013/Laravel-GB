<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Resource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getResourcesData() as $resourceData) {
            $resource = new Resource($resourceData);
            $resource->save();
        }
    }

    private function getResourcesData(): array
    {
        $videoGamesCategory = Category::query()->where('name', 'video games')->first();
        $entertainmentCategory = Category::query()->where('name', 'entertainment')->first();

        return [
            [
                'url' => 'https://feeds.feedburner.com/ign/all',
                'category_id' => $videoGamesCategory->id,
            ],
            [
                'url' => 'https://www.cbsnews.com/latest/rss/entertainment',
                'category_id' => $entertainmentCategory->id,
            ]
        ];
    }
}

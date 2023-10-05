<?php

namespace Tests\Feature\Http\Admin;

use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    public function testReturnsSuccessOnIndexRequest(): void
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertSuccessful();
        $response->assertStatus(200);
    }

    public function testCorrectPageContentIsDisplayedForIndex(): void
    {
        $response = $this->get(route('admin.categories.index'));

        $response->assertSeeText('List of categories');
        $response->assertSeeText('Categories');
    }

    public function testReturnsSuccessOnCreateRequest(): void
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertSuccessful();
        $response->assertStatus(200);
    }

    public function testCorrectPageContentIsDisplayedForCreate(): void
    {
        $response = $this->get(route('admin.categories.create'));

        $response->assertSeeText('Name');
        $response->assertSeeText('Create');
    }
}

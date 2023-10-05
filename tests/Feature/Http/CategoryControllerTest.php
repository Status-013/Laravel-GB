<?php

namespace Tests\Feature\Http;

use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    public function testReturnsSuccessOnIndexRequest(): void
    {
        $response = $this->get(route('category.index'));

        $response->assertSuccessful();
        $response->assertStatus(200);
    }

    public function testCorrectPageContentIsDisplayedOnIndexRequest(): void
    {
        $response = $this->get(route('category.index'));

        $response->assertSeeText('Categories');
    }
}

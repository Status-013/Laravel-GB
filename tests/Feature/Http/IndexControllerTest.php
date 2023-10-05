<?php

namespace Tests\Feature\Http;

use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    public function testReturnsSuccessOnIndexRequest(): void
    {
        $response = $this->get(route('index'));

        $response->assertSuccessful();
        $response->assertStatus(200);
    }

    public function testCorrectWelcomeContentIsDisplayed(): void
    {
        $response = $this->get(route('index'));

        $response->assertSeeText('Welcome, this is the home page of this News portal');
    }
}

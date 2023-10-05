<?php

namespace Tests\Browser\Admin;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NewsCreateFormTest extends DuskTestCase
{
    public function testErrorIsDisplayedOnTooShortTitle(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('admin.news.create'))
                    ->type('title', 'four')
                    ->press('Create')
                    ->assertSee('ℹ️ Notification: Количество символов в поле заголовок должно быть не меньше 5.');
        });
    }

    public function testPostIsCreated(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('admin.news.create'))
                ->type('title', 'Some test title')
                ->type('content', 'Some test content')
                ->type('description', 'Some test description')
                ->select('category_id', '1')
                ->select('status', 'active')
                ->type('author', 'Some test author')
                ->press('Create')
                ->assertSee('Some test title')
                ->assertSee('Some test content')
                ->assertSee('Some test description')
                ->assertSee('Category: Movies')
                ->assertSee('Author: Some test author')
                ->assertPathBeginsWith('/news/1/');
        });
    }
}

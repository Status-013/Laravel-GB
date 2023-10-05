<?php

namespace Tests\Browser\Admin;

use App\Models\News;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NewsEditFormTest extends DuskTestCase
{
    public function testErrorIsDisplayedOnEmptyTitle(): void
    {
        $this->browse(function (Browser $browser) {
            $post = new News([
                'title' => 'Some test title',
                'content' => 'Some test content',
                'description' => 'Some test description',
                'category_id' => '1',
                'status' => 'active',
                'author' => 'Some test author',
            ]);

            $post->save();

            $browser->visit(route('admin.news.edit', ['post' => $post]))
                ->type('title', ' ')
                ->press('Edit')
                ->assertSee('ℹ️ Notification: Поле заголовок обязательно для заполнения.');
        });
    }

    public function testPostIsEdited(): void
    {
        $this->browse(function (Browser $browser) {
            $post = new News([
                'title' => 'Some test title',
                'content' => 'Some test content',
                'description' => 'Some test description',
                'category_id' => '1',
                'status' => 'active',
                'author' => 'Some test author',
            ]);
            $post->save();

            $browser->visit(route('admin.news.edit', ['post' => $post]))
                ->type('title', 'Some new test title')
                ->press('Edit')
                ->assertSee('Some new test title');
        });
    }
}

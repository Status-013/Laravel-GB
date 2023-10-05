<?php

namespace Tests\Browser\Admin;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryCreateFormTest extends DuskTestCase
{
    public function testErrorIsDisplayedOnTooShortName(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('admin.categories.create'))
                ->type('name', 'four')
                ->press('Create')
                ->assertSee('ℹ️ Notification: Количество символов в поле Название категории должно быть не меньше 5.');
        });
    }

    public function testCategoryIsCreated(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('admin.categories.create'))
                ->type('name', 'Some test category name')
                ->press('Create')
                ->assertSee('ℹ️ Notification: Category successfully created')
                ->assertRouteIs('admin.categories.index');
        });
    }
}

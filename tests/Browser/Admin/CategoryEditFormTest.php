<?php

namespace Tests\Browser\Admin;

use App\Models\Category;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryEditFormTest extends DuskTestCase
{
    public function testErrorIsDisplayedOnEmptyName(): void
    {
        $this->browse(function (Browser $browser) {
            $category = new Category(['name' => 'Some test category']);

            $category->save();

            $browser->visit(route('admin.categories.edit', ['category' => $category]))
                ->type('name', ' ')
                ->press('Edit')
                ->assertSee('ℹ️ Notification: Поле Название категории обязательно для заполнения.');
        });
    }

    public function testCategoryIsEdited(): void
    {
        $this->browse(function (Browser $browser) {
            $category = new Category(['name' => 'Some test category']);

            $category->save();

            $browser->visit(route('admin.categories.edit', ['category' => $category]))
                ->type('name', 'Some new category name')
                ->press('Edit')
                ->assertSee('ℹ️ Notification: Category successfully updated')
                ->assertRouteIs('admin.categories.index');
        });
    }
}

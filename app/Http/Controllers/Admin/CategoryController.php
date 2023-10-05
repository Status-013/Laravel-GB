<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::paginate(10);

        return view('admin.categories.index')->with('categories', $categories);
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $category = new Category($data);

        try {
            $category->save();

            return redirect(route('admin.categories.index'))->with('success', 'Category successfully created');
        } catch (QueryException) {
            return back()->with('error', 'Category was not created! Please try again.');
        }
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        $category->fill($data);

        try {
            $category->save();

            return redirect(route('admin.categories.index'))->with('success', 'Category successfully updated');
        } catch (QueryException) {
            return back()->with('error', 'Category was not updated! Please try again.');
        }
    }

    public function destroy(Category $category): RedirectResponse
    {
        try {
            $category->delete();

            return redirect(route('admin.categories.index'))->with('success', 'Category successfully deleted');
        } catch (QueryException) {
            return back()->with('error', 'Category was not deleted! Please try again.');
        }
    }
}

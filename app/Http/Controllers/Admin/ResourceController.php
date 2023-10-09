<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Resource\StoreResourceRequest;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResourceController extends Controller
{
    public function index(): View
    {
        $resources = Resource::paginate(10);

        return view('admin.resource.index')->with('resources', $resources);
    }

    public function create(): View
    {
        return view('admin.resource.create')->with('categories', Category::all());
    }

    public function store(StoreResourceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $resource = new Resource($data);

        if (!$resource->category) {
            $category = Category::firstOrCreate(['name' => 'Off-topic']);

            $resource->category_id = $category->id;
        }

        try {
            $resource->save();

            return redirect(route('admin.resources.index'))->with('success', 'Category successfully created');
        } catch (QueryException) {
            return back()->with('error', 'Resource was not created! Please try again.');
        }
    }

    public function destroy(Resource $resource): RedirectResponse
    {
        try {
            $resource->delete();

            return redirect(route('admin.resources.index'))->with('success', 'Resource successfully deleted');
        } catch (QueryException) {
            return back()->with('error', 'Resource was not deleted! Please try again.');
        }
    }
}

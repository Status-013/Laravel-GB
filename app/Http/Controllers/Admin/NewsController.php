<?php

namespace App\Http\Controllers\Admin;

use App\Enums\News\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\StoreNewsRequest;
use App\Http\Requests\Admin\News\UpdateNewsRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $filter = $request->input('filter');

        if ($filter === 'all') {
            return redirect(route('admin.news.index'));
        }

        $newsQuery = News::query();

        if ($filter) {
            $newsQuery = $newsQuery->where('status', $filter);
        }

        $news = $newsQuery->paginate(10)->withQueryString();

        return view('admin.news.index')->with('news', $news);
    }

    public function create(): View
    {
        return view('admin.news.create')
            ->with('categories', Category::all())
            ->with('statuses', Status::getEnums());
    }

    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $post = new News($data);

        if (isset($data['image'])) {
            $data['image']->move(public_path('storage'), $data['image']->getClientOriginalName());

            $post->image_url = 'storage/' . $data['image']->getClientOriginalName();
        }

        try {
            $post->save();

            return redirect(route('news.show', [
                'categoryId' => $post->category->id,
                'postId' => $post->id
            ]));
        } catch (QueryException) {
            return back()->with('error', 'The news post was not created! Please try again.');
        }
    }

    public function edit(News $post): View
    {
        return view('admin.news.edit')
            ->with('post', $post)
            ->with('categories', Category::all())
            ->with('statuses', Status::getEnums());
    }

    public function update(UpdateNewsRequest $request, News $post): RedirectResponse
    {
        $data = $request->validated();

        $post->fill($data);

        if (isset($data['image'])) {
            $data['image']->move(public_path('storage'), $data['image']->getClientOriginalName());

            $post->image_url = 'storage/' . $data['image']->getClientOriginalName();
        }

        try {
            $post->save();

            return redirect(route('news.show', [
                'categoryId' => $post->category->id,
                'postId' => $post->id
            ]));
        } catch (QueryException) {
            return back()->with('error', 'The news post was not edited! Please try again.');
        }
    }

    public function destroy(News $post): RedirectResponse
    {
        try {
            $post->delete();

            return redirect(route('admin.news.index'))->with('success', 'Post successfully deleted');
        } catch (QueryException) {
            return back()->with('error', 'Post was not deleted! Please try again.');
        }
    }
}

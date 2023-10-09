<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsingJob;
use App\Models\Resource;
use App\Services\Interfaces\Parser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    public function __invoke(Request $request, Parser $parserService): RedirectResponse
    {
        $resources = Resource::all();

        foreach ($resources as $resource) {
            dispatch(new NewsParsingJob($resource));
        }

        return redirect(route('admin.news.index'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Enums\News\Status;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ParserController extends Controller
{
    private array $resources = [
        'ign' => 'https://feeds.feedburner.com/ign/all',
        'cbsnews' => 'https://www.cbsnews.com/latest/rss/entertainment'
    ];

    public function __invoke(Request $request): RedirectResponse
    {
        foreach ($this->resources as $resourceName => $resourceUrl) {
            $xml = simplexml_load_file($resourceUrl);

            $postCategory = $this->getPostCategory($resourceName);

            foreach ($xml->channel->item as $postXml) {
                $postArray = (array) $postXml;
                $postXmlContent = (string) $postXml->children('content', true)->encoded;
                $postXmlImageUrl = (string) $postXml->children('media', true)->attributes()?->url;
                $postXmlAuthor = (string) $postXml->children('dc', true)->creator;

                $postArray = array_map('strval', $postArray);

                if (!$postXmlContent) {
                    $postXmlContent = $postArray['description'];
                    $postArray['description'] = null;
                }

                if (!$postXmlImageUrl) {
                    $postXmlImageUrl = $postArray['image'];
                }

                if (!$postXmlAuthor) {
                    $postXmlAuthor = $resourceName;
                }

                $postArray['content'] = $postXmlContent;
                $postArray['image_url'] = $postXmlImageUrl;
                $postArray['author'] = $postXmlAuthor;
                $postArray['category_id'] = $postCategory->id;

                $post = new News($postArray);

                $post->status = Status::ACTIVE->value;
                $post->save();
            }
        }

        return redirect(route('admin.news.index'));
    }

    private function getPostCategory(string $resourceName): Category
    {
        $postCategoryName = $this->definePostCategoryName($resourceName);

        try {
            $postCategory = Category::where('name', $postCategoryName)->firstOrFail();
        } catch (ModelNotFoundException) {
            $postCategory = new Category(['name' => $postCategoryName]);
            $postCategory->save();
        }

        return $postCategory;
    }

    private function definePostCategoryName(string $resourceName): string
    {
        return match ($resourceName) {
            'ign' => 'video games',
            'cbsnews' => 'entertainment',
            default => 'off-topic',
        };
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ArticleResource;
use App\Models\Article;
use App\Models\Category;

class ArticalController extends Controller
{

    public function index()
    {
        $articles = Article::latest()->get();

        return $this->success('Articles fetched successfully', [
            'articles' => ArticleResource::collection($articles),
        ]);
    }

    public function fetchAllCategories()
    {
        // Fetch all categories without the 'active' global scope filtering status
        $allCategories = Category::get();

        return $this->success('All categories fetched successfully', [
            'categories' => $allCategories,
        ]);
    }

}

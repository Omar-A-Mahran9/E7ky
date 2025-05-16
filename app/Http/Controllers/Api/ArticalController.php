<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ArticleResource;
use App\Models\Article;

class ArticalController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();

        return $this->success('Articles fetched successfully', [
            'articles' => ArticleResource::collection($articles),
        ]);
    }
}

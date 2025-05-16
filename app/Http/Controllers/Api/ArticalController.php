<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

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

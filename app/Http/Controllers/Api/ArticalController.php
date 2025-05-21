<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ArticleResource;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Article;
use App\Models\Category;

class ArticalController extends Controller
{

 public function index()
{
    $articles = Article::latest()->paginate(10);

    return $this->successWithPagination('Articles fetched successfully', ArticleResource::collection($articles)->response()->getData(true));
}


  public function fetchAllCategories()
{
    // Fetch categories with status = 1 (active)
    $activeCategories = Category::where('status', 1)->get();

    return $this->success('Active categories fetched successfully', [
        'categories' => CategoryResource::collection($activeCategories),
    ]);
}


}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AdminResource;
use App\Http\Resources\Api\ArticleResource;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticalController extends Controller
{

public function index(Request $request)
{
    $query = Article::query();

    if ($request->has('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->has('author_id')) {
        $query->where('admin_id', $request->author_id);
    }

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name_ar', 'like', "%$search%")
              ->orWhere('name_en', 'like', "%$search%")
              ->orWhere('description_ar', 'like', "%$search%")
              ->orWhere('description_en', 'like', "%$search%");
        });
    }

    $articles = $query->latest()->paginate(10);

    return $this->successWithPagination(
        'Articles fetched successfully',
        ArticleResource::collection($articles)->response()->getData(true)
    );
}

public function show($id)
{
    $article = Article::find($id);

    if (!$article) {
        return response()->json([
            'status' => false,
            'message' => 'Article not found',
        ], 404);
    }

    return $this->success(
        'Article fetched successfully',
        new ArticleResource($article)
    );
}


public function fetchAllCategories()
{
    $activeCategories = Category::where('status', 1)->paginate(10); // Adjust per-page as needed

    return $this->successWithPagination(
        'Active categories fetched successfully',
        CategoryResource::collection($activeCategories)->response()->getData(true)
    );
}
public function fetchAllAuthors()
{
    $authors = Admin::whereHas('articles') // Only fetch admins who have articles
                    ->paginate(10);        // Adjust the per-page number as needed

    return $this->successWithPagination(
        'Authors fetched successfully',
        AdminResource::collection($authors)->response()->getData(true)
    );
}



}

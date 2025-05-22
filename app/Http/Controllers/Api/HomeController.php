<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ArticleResource;
use App\Http\Resources\Api\EventResource;
use App\Models\Article;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

public function index()
{
    // Get featured events starting today or later
    $banners = Event::where('featured', 1)
        ->whereDate('start_day', '>=', Carbon::today())
        ->get();

    // Get latest 5 articles
    $articles = Article::latest()->take(10)->get();

    $cycle_tracking = [
        'title' => 'Cycle Tracking',
        'description' => 'Track your menstrual cycle and get insights into your fertility and overall health.',
        'image' => '',
    ];

    $invite_friend = [
        'title' => 'Invite a Friend',
        'description' => 'Invite your friends to join the app and enjoy exclusive features together.',
        'image' => '',
    ];

    return $this->success('Data fetched successfully', data: [
        'banners' => EventResource::collection($banners),
         'articles' => ArticleResource::collection($articles),
     ]);
}
}

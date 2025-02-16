<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\EventResource;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Event::where('featured', 1)
        ->whereDate('start_day', '>=', Carbon::today())
        ->get();
        $response = Http::get('https://e7kky.com/api/v1/app/articles');
        $data = $response->json();

        if ($data['status'] && isset($data['data']['articles']['data'])) {
            $articles = $data['data']['articles']['data'];
        } else {
            $articles = [];
        }

        $articles = collect($articles)->map(function ($article) {
            return [
                'id' => $article['id'],
                'title' => $article['name'],
                'description' => $article['description'],
                'name' => $article['name'],
                'image' => "https://e7kky.com/" . $article['image']
            ];
        })->take(5); // Limit to 5 articles

        $cycle_tracking = [
            'title' => 'Cycle Tracking',
            'description' => 'Track your menstrual cycle and get insights into your fertility and overall health.',
            'image' => ''
        ];

        $invite_friend = [
            'title' => 'Cycle Tracking',
            'description' => 'Track your menstrual cycle and get insights into your fertility and overall health.',
            'image' => ''
        ];

        $fully_data = [
            'banners' => EventResource::collection($banners) ,
            'cycle_tracking' => $cycle_tracking,
            'articles' => $articles,
            'invite_friend' => $invite_friend
        ];
        return $this->success([
            'banners' => EventResource::collection($banners),
            'cycle_tracking' => $cycle_tracking,
            'articles' => $articles,
            'invite_friend' => $invite_friend
        ]);
    }
}

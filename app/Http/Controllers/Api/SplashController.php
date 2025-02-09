<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SplashResource;
use App\Models\Splash;
use Illuminate\Http\Request;

class SplashController extends Controller
{
    public function index(Request $request)
    {

        $splashes = Splash::get();
        return $this->success(
            'Splashes',
            SplashResource::collection($splashes)
        );
    }
}

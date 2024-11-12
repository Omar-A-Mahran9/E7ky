<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateHomeSettingsRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.index');
        }
    }

    public function aboutUs(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.about-us');
        }
    }

    public function terms(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.terms');
        }
    }

    public function privacyPolicy(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.privacy-policy');
        }
    }
    public function returnPolicy(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.return-policy');
        }
    }
}

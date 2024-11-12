<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class GeneralInvokableController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $fastShippingCities = City::whereHas('vendors', function ($query) {
            // $query->where('vendor_has_fast_shipping', TRUE);
        })->select('id', 'name_ar', 'name_en')->get();
        $normalCities       = City::whereHas('vendors', function ($query) {
            // $query->where('vendor_has_fast_shipping', FALSE);
        })->select('id', 'name_ar', 'name_en')->get();
        $allCities          = City::select('id', 'name_ar', 'name_en')->get();

        return $this->success('', [
            'fastShippingCities' => CityResource::collection($fastShippingCities),
            'normalCities' => CityResource::collection($normalCities),
            'allCities' => CityResource::collection($allCities),
            'instagram_link' => setting('instagram_link'),
            'privacy_policy' => setting('privacy_policy_' . request()->header('Content-language')),
            'facebook_link' => setting('facebook_link'),
            'linkedin_link' => setting('linkedin_link'),
            'youtube_link' => setting('youtube_link'),
            'twitter_link' => setting('twitter_link'),
            'whatsapp_number' => setting('whatsapp_number'),
            'sms_number' => setting('sms_number'),
            'about_us' => [
                'label' => setting('label_' . request()->header('Content-language')),
                'description' => setting('about_us_' . request()->header('Content-language'))
            ],
            'terms' => setting('terms_' . request()->header('Content-language')),
            'return_policy' => setting('return_policy_' . request()->header('Content-language')),
            'tax' => (setting('tax') / 100),

        ]);
    }
}

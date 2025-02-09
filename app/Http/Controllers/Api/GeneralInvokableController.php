<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BrandResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\CustomerRateResource;
use App\Http\Resources\Api\packagesCategoryResources;
use App\Http\Resources\Api\Rate;
use App\Http\Resources\Api\RateResource;
use App\Http\Resources\Api\SkinColorResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\customers_rates;
use App\Models\PackageCategory;
use App\Models\SkinColor;
use Illuminate\Http\Request;

class GeneralInvokableController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $allCities          = City::select('id', 'name_ar', 'name_en')->get();
        $brands         = Brand::select('id', 'name_ar', 'name_en','description_en','description_ar')->get();
        $colors         = SkinColor::select('id', 'name_ar', 'name_en')->get();
        $rate         = customers_rates::select('id', 'customer_id','comment','rate','status')->get();
        $category         = Category::get();
        $packageCategry=PackageCategory::get();
          return $this->success('', [
          
            'allCities' => CityResource::collection($allCities),
            'brands' => BrandResource::collection( $brands),
            'colors' => SkinColorResource::collection( $colors),
            'Rate' => RateResource::collection( $rate),

            'Categories' => CategoryResource::collection(   $category ),
            'packageCategories'=>packagesCategoryResources::collection($packageCategry),

            'instagram_link' => setting('instagram_link'),
            'privacy_policy' => setting('privacy_policy_' . request()->header('Content-language')),
            'facebook_link' => setting('facebook_link'),
            'linkedin_link' => setting('linkedin_link'),
            'youtube_link' => setting('youtube_link'),
            'twitter_link' => setting('twitter_link'),
            'whatsapp_number' => setting('whatsapp_number'),
            'sms_number' => setting('sms_number'),
            'email' => setting('email'),
            'address_ar' => setting('address_ar'),
            'address_en' => setting('address_en'),

            'whatsapp_message_time' => setting('delay_time_seconds'),
            'whatsapp_message' => setting('whatsapp_message'),
            'whatsapp_show' => setting('whatsapp_notification_enabled'),


            'about_us' => [
                'label' => setting('label_' . request()->header('Content-language')),
                'description' => setting('about_us_' . request()->header('Content-language'))
            ],
            'terms_and_condition' => setting('terms_' . request()->header('Content-language')),
            'return_policy' => setting('return_policy_' . request()->header('Content-language')),
            'loyality' => setting('loyality_' . request()->header('Content-language')),

            'tax' => (setting('tax') / 100),

        ]);
    }
}

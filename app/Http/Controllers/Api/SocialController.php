<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Str;

use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        // dd(Socialite::driver($provider));

        // Generate the provider's authentication URL
        $authUrl = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();

        return response()->json([
            'auth_url' => $authUrl
        ]);
    }


    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        if (!$user->getEmail()) {
            return response()->json(['error' => 'Unable to retrieve email from provider.'], 422);
        }
        $fullName = $user->getName();
        $nameParts = explode(' ', trim($fullName), 2); // Split into at most 2 parts

        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';

        $userCreated = Customer::firstOrCreate(
            ['email' => $user->getEmail()],
            [
                'verified_at' => now(),
                'phone' => null,
                'phone_code' => null,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'image' => uploadFileFromOutside($user->getAvatar(), "ProfileImages"), // ✅ Correctly handles URLs
                'password' => bcrypt(Str::random(12)),
                'status' => 2,
                'created_by_social' => 1,

            ]
        );

        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );

        $token = $userCreated->createToken('token-name')->plainTextToken;

        return $this->success([
            'token' => $token,
            'message' => __('Thank You for verified'),
            'user' => [
                'id' => $userCreated->id,
                'name' => $userCreated->first_name,
                'email' => $userCreated->email,
                'image' => asset(getImagePathFromDirectory($userCreated->image, 'Splash', "default.svg")) ,
            ]
        ]);


            // Encode data in Base64 to avoid URL length issues
    //   $data = base64_encode(json_encode([
    //     'token' => $token,
    //     'message' => __('Thank You for verified'),
    //     'user' => [
    //         'id' => $userCreated->id,
    //         'name' => $userCreated->name,
    //         'email' => $userCreated->email,
    //         'image' => $userCreated->image
    //     ],
    //    ]));

      // Redirect with encoded data
    //   $redirectUrl = env('APP_URL') . "?data={$data}";

    //   return redirect()->to($redirectUrl);
    // return $data ;

    }


    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'github', 'google'])) {
            return response()->json(['error' => 'Please login using facebook, github or google'], 422);
        }
    }

}

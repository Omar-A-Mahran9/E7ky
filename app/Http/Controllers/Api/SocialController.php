<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

  // Redirect to Social Provider
  public function redirectToProvider($provider)
  {
        return Socialite::driver($provider)->redirect();
  }

  // Handle Social Provider Callback
  public function handleProviderCallback($provider)
  {
      try {
          $socialUser = Socialite::driver($provider)->user();

          // Check if user already exists
          $customer = Customer::where('email', $socialUser->getEmail())->first();

          if (!$customer) {
              $customer = Customer::create([
                  'first_name' => $socialUser->getName(), // Facebook/Google Name
                  'last_name' => '',
                  'email' => $socialUser->getEmail(),
                  'image' => $socialUser->getAvatar(),
                  "{$provider}_link_acc" => $socialUser->getId(), // Store provider ID
                  'password' => null,
              ]);
          }

          // Log the user in
          Auth::login($customer);

          return response()->json(['message' => 'Login successful', 'user' => $customer]);
      } catch (\Exception $e) {
          return response()->json(['error' => 'Something went wrong!'], 500);
      }
  }
}

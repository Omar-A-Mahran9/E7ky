<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\CustomerStatus;
use App\Rules\PasswordNumberAndLetter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\NotNumbersOnly;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CustomerResource;
use App\Mail\OtpMail;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function loginByEmail(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'exists:customers,email',
                function ($attribute, $value, $fail) {
                    $customer = Customer::whereEmail($value)->first();

                    if ($customer && $customer->block_flag === 1) {
                        $fail(__("Your account is blocked. Please contact support."));
                    }
                }
            ],
            'password' => 'required|min:6',
        ]);

        $customer = Customer::whereEmail($request->email)->first();

        // if ($customer->status !=  'approved' ) {
        //     return $this->validationFailure([
        //         __("Your account is not approved. Current status: :status", [
        //             'status' => $customer->status] ?? 'unknown')
        //         ]);
        // }
        // Check if OTP verification is required
        if ($customer->otp || $customer->otp_expires_at || $customer->otp_expires_at > now()) {
            // OTP is present and has not expired
            return $this->validationFailure([__("Please verify your OTP to proceed.")]);
        }

        if (Hash::check($request->password, $customer->password)) {
            $token = $customer->createToken('Personal access token to apis')->plainTextToken;

            return $this->success("Logged in successfully", [
                'token' => $token,
                "user" => new CustomerResource($customer)
            ]);
        } else {
            return $this->validationFailure(["password" => [__("Password mismatch")]]);
        }
    }


    public function loginOTP(Request $request, $data)
    {
        $customer = Customer::where('phone', $data)->orWhere('email', $data)->first();

        $request['phone'] = $customer->phone;
        $request->validate([
            'phone' => ['required', 'exists:customers'],
            'otp' => [
                'required',
                Rule::exists('customers')->where(function ($query) use ($customer) {
                    return $query->where('id', $customer->id);
                })
            ],
        ]);

        $customer->update([
            "otp" => null
        ]);

        $customer->update(['fcm_token' => $request->fcm_token]);
        $token = $customer->createToken('Personal access token to apis')->plainTextToken;

        return $this->success("logged in successfully", ['token' => $token, "customer" => new CustomerResource($customer)]);
    }

    public function register(Request $request)
    {
        $data  = $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'first_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'last_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'phone_code' => ['required', 'string'],
            'phone' => [
                'required',
                'string',
                'regex:/^\+?[1-9][0-9]{7,14}$/',
                'unique:customers,phone',
            ],
            'birth_date' => ['required', 'date'], // Ensures age is between 18 and 100
            'gender' => ['required', 'in:male,female,other'], // Restricts gender to specific values
            'email' => 'required|string|email|unique:customers',
            'password' => ['required', 'string', 'min:8', 'max:255', new PasswordNumberAndLetter()],
            'password_confirmation' => 'required|same:password',


        ]);



        if ($request->image) {
            $data['image'] = uploadImageToDirectory($request->file('image'), "Customers");
        }
        $data['otp_expires_at'] = now()->addMinute();

         $customer                 = Customer::create($data);
        $customer->remember_token = Str::random(10);
        $customer->save();

        $otp= $customer->sendOTP();
        if ($customer->email) {
            try {
                Mail::to($customer->email)->send(new OtpMail($otp));
            } catch (\Exception $e) {
                Log::error("OTP Email Error: " . $e->getMessage());
            }
        }


        return $this->success("Registered successfully. Please check your email for the OTP.", [
            "name" => $customer->first_name . ' ' . $customer->last_name,
            "email" => $customer->email,
            "otp" => $customer->otp,

        ]);
            }


    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return $this->success('You have been successfully logged out!');
    }

}

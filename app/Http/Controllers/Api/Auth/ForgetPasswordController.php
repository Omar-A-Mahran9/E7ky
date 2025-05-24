<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Customer;
use App\Rules\PasswordNumberAndLetter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\Api\CustomerResource;
use App\Mail\OtpMail;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    public function sendOtp(Request $request, $data)
    {
        $customer = $this->findCustomer($data);
        if (!$customer) {
            return $this->failure(__("This user does not exist"));
        }

        if ($customer->block_flag === 1) {
            return $this->failure(__("Your account is blocked. Please contact support."));
        }


        $otp = rand(1000, 9999);
        $customer->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinute()
        ]);

        // try {
        //     $this->sendOtpSms($customer->phone, $otp);
        // } catch (\Exception $e) {
        //     Log::error("OTP SMS Error: " . $e->getMessage());
        // }

        // Optionally send via email
        // try {
        //     Mail::to($customer->email)->send(new RegisterMail($otp));
        // } catch (\Exception $e) {
        //     Log::error("OTP Email Error: " . $e->getMessage());
        // }

        if ($customer->email) {
            try {
                Mail::to($customer->email)->send(new OtpMail($otp));
            } catch (\Exception $e) {
                Log::error("OTP Email Error: " . $e->getMessage());
            }
        }

        return $this->success("OTP sent successfully", ["customer" => new CustomerResource($customer)]);
    }

    public function reSendOtp(Request $request, $data)
    {
        $customer = $this->findCustomer($data);
        if (!$customer) {
            return $this->failure(__("This user does not exist"));
        }

        if ($customer->block_flag === 1) {
            return $this->failure(__("Your account is blocked. Please contact support."));
        }

        $otp = rand(1000, 9999);
        $customer->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5)
        ]);

        // try {
        //     $this->sendOtpSms($customer->phone, $otp);
        // } catch (\Exception $e) {
        //     Log::error("OTP SMS Error: " . $e->getMessage());
        // }

        if ($customer->email) {
            try {
                Mail::to($customer->email)->send(new OtpMail($otp));
            } catch (\Exception $e) {
                Log::error("OTP Email Error: " . $e->getMessage());
            }
        }

        return $this->success("OTP resent successfully", ["customer" => new CustomerResource($customer)]);
    }

    public function checkOTP(Request $request, $data)
    {
        $customer = $this->findCustomer($data);
        if (!$customer) {
            return $this->failure(__("This user does not exist"));
        }

        $request->validate([
            'otp' => ['required', 'string']
        ]);
        if ($customer->otp_expires_at < now()) {
            return $this->failure(__("OTP has expired"));
        }

        if (
            $customer->otp !== $request->otp ||
            !$customer->otp_expires_at ||
            now()->gt($customer->otp_expires_at)
        ) {
            return $this->failure(__("Invalid or expired OTP"));
        }

        $customer->update(['otp' => null, 'otp_expires_at' => null]);
        $token = $customer->createToken('Personal Access Token')->plainTextToken;

        return $this->success("OTP verified successfully", [
            'token' => $token,
            "customer" => new CustomerResource($customer)
        ]);
    }

public function changePassword(Request $request, $data)
{
    $customer = $this->findCustomer($data);

    if (!$customer) {
        return $this->failure(__("This user does not exist"));
    }

    // ✅ Check that both otp and otp_expires_at are NULL
    if (is_null($customer->otp) && is_null($customer->otp_expires_at)) {
        // proceed
    } else {
        if ($customer->otp_expires_at < now()) {
            return $this->failure(__("OTP has expired"));
        }
        return $this->failure(__("OTP is missing or not verified"));
    }

    // ✅ Validate input including old password
    $request->validate([
        'old_password' => ['required'],
        'password' => ['required', 'min:6', new PasswordNumberAndLetter()],
        'password_confirmation' => 'required_with:password|same:password',
    ]);

    // ✅ Check if old password matches
    if (!Hash::check($request->old_password, $customer->password)) {
        return $this->failure(__("The old password is incorrect"));
    }

    // ✅ Update password
    $customer->update([
        'password' => $request->password
    ]);

    return $this->success(__("Password changed successfully"));
}

public function changePasswordByEmail(Request $request, $data)
{
    $customer = $this->findCustomer($data);

    if (!$customer) {
        return $this->failure(__("This user does not exist"));
    }

    // ✅ Check that both otp and otp_expires_at are set
    if (is_null($customer->otp) || is_null($customer->otp_expires_at)) {
        return $this->failure(__("OTP is missing or not verified"));
    }

    if ($customer->otp_expires_at < now()) {
        return $this->failure(__("OTP has expired"));
    }

    // ✅ Validate new password and confirmation
    $request->validate([
        'password' => ['required', 'min:6', new PasswordNumberAndLetter()],
        'password_confirmation' => 'required_with:password|same:password',
    ]);

    // ✅ Update password
    $customer->update([
        'password' => $request->password,
        'otp' => null,
        'otp_expires_at' => null,
    ]);

    return $this->success(__("Password changed successfully"));
}



    private function findCustomer($data)
    {
        return Customer::where('phone', $data)->orWhere('email', $data)->first();
    }

    private function sendOtpSms($phone, $otp)
    {
        // Implement actual SMS logic
        Log::info("Sending OTP {$otp} to phone {$phone}");
    }
}

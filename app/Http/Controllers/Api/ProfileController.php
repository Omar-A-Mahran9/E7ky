<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateProfileInfoRequest;
use App\Http\Requests\Dashboard\UpdateProfileEmailRequest;
use App\Http\Requests\Dashboard\UpdateProfilePasswordRequest;
use App\Http\Resources\Api\AdminResource;
use App\Models\Admin;
use App\Models\Order;
use App\Rules\ExistPhone;
use App\Rules\NotNumbersOnly;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profileInfo()
    {
        $admin = auth()->user();
        return $this->success('', [
            'admin' => new AdminResource($admin),
        ]);
    }

    public function updateInfo(Request $request)
    {
        $admin = auth()->user();

        // Validate request data
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'phone' => [
                'nullable', 'string', 'max:20',
                new ExistPhone(new Admin(), $admin->id),
                Rule::unique('admins')->ignore($admin->id)
            ],
            'email' => ['nullable', 'string', 'email', Rule::unique('admins', 'email')->ignore($admin->id)],
            'job_description' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'age' => ['nullable', 'integer', 'min:1'],
            'gender' => ['nullable', 'in:male,female,other'],
            'facebook_link' => ['nullable', 'url'],
            'instagram_link' => ['nullable', 'url'],
            'X_link' => ['nullable', 'url'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:512'],
            'cover_picture' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:512'],
        ]);

        // Handle image upload
        if ($request->has('image')) {
            $data['image'] = uploadImageToDirectory($request->file('image'), "Customers");
        }

        // Handle cover picture upload
        if ($request->hasFile('cover_picture')) {
            $data['image'] = uploadImageToDirectory($request->file('image'), "Customers/Covers");
        }


        // Update admin details
        $admin->update($data);

        return response()->json([
            'message' => 'Profile updated successfully.',
            'admin' => new AdminResource($admin)
        ]);
    }


    public function updateProfileEmail(UpdateProfileEmailRequest $request)
    {
        $admin = auth()->user();

        $data = $request->validated();

        $admin->update([
            'email' => $data['email']
        ]);
        return response()->json(['message' => 'email updated successfully.']);

    }

    public function updatePassword(UpdateProfilePasswordRequest $request)
    {
        $admin = auth()->user();

        $data = $request->validated();

        $admin->update($data);
        return response()->json(['message' => 'password updated successfully.']);

    }
}

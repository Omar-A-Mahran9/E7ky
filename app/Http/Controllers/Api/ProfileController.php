<?php

namespace App\Http\Controllers\Api;

 use App\Http\Controllers\Controller;
 use App\Http\Requests\Dashboard\UpdateProfileEmailRequest;
use App\Http\Requests\Dashboard\UpdateProfilePasswordRequest;
use App\Http\Resources\Api\AdminResource;

use App\Rules\NotNumbersOnly;

use Illuminate\Http\Request;

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
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'cover_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'bio' => ['nullable', 'string', 'max:255'], // Ensures age is between 18 and 100
            'first_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'last_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'phone_code' => ['required', 'string'],
            'phone' => [
                'required',
                'string',
                 'unique:customers,phone,' . $admin->id,
            ],
            'birth_date' => ['required', 'date'], // Ensures age is between 18 and 100
            'gender' => ['required', 'in:male,female,other'], // Restricts gender to specific values
            'email' => 'required|string|email|unique:customers,email,' . $admin->id,

        ]);
         // Handle image upload
        if ($request->has('image')) {
            $data['image'] = uploadImageToDirectory($request->file('image'), "Customers");
        }

        // Handle cover picture upload
        if ($request->hasFile('cover_picture')) {
            $data['cover_picture'] = uploadImageToDirectory($request->file('cover_picture'), "Customers/Covers");
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

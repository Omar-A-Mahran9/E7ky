<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCustomerRequest;
use App\Http\Requests\Dashboard\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_customers');

        if ($request->ajax())
        {
            $data = getModelData(model: new Customer());
            return response()->json($data);
        }

        return view('dashboard.customers.index');
    }

    public function store(StoreCustomerRequest $request)
    {
        $data          = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "Customers");
        $data['cover_picture'] = uploadImageToDirectory($request->file('cover_picture'), "Customers/Covers");

        $data['block_flag']= false;
        Customer::create($data);

        return response(["Customer created successfully"]);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $data = $request->validated();
        if ($request->has('image'))
            $data['image'] = uploadImageToDirectory($request->file('image'), "Customers");

            if ($request->has('cover_picture'))

            $data['cover_picture'] = uploadImageToDirectory($request->file('cover_picture'), "Customers/Covers");

                    // ✅ Remove password if not provided
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                // Hash password if provided
                $data['password'] =  $data['password'];
            }

        $customer->update($data);

        return response(["Customer updated successfully"]);
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('block_customers');

        $customer->delete();

        return response(["Customer deleted successfully"]);
    }

    public function blockedSelected(Request $request)
    {
        $this->authorize('block_customers');

        // Customer::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected customers deleted successfully"]);
    }
    public function blocked(Request $request, Customer $customer)
    {
        $this->authorize('block_customers');
        if ($customer->block_flag === 0)
        {
            $customer->update([
                'block_flag' => true
            ]);
            return response(["Customer blocked successfully"]);
        }
        if ($customer->block_flag === 1)
        {
            $customer->update([
                'block_flag' => false
            ]);
            return response(["Customer un blocked successfully"]);
        }
    }


}

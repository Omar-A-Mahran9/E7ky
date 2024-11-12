<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreContactRequest;
use App\Http\Requests\Dashboard\UpdateContactRequest;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_contact_requests');

        if($request->ajax())
            return response(getModelData( model: new ContactRequest()));
        else
            return view('dashboard.contact-requests.index');
    }

    public function destroy(ContactRequest $contactRequest)
    {
        $this->authorize('delete_contact_requests');

        $contactRequest->delete();

        return response(["Contact request deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_contact_requests');

        ContactRequest::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected contact requests deleted successfully"]);
    }
}

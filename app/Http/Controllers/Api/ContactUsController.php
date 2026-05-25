<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'service' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            $contact = ContactUs::create([
                'name'    => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                'service' => $request->service,
                'message' => $request->message,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Contact Form Submitted Successfully',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something Went Wrong',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    public function index()
    {
        $contacts = ContactUs::latest()->get();
        return response()->json([
            'success' => true,
            'count'   => $contacts->count(),
            'data'    => $contacts
        ]);
    }

}

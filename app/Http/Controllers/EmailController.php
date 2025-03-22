<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email|unique:emails,email', // Change table name to 'emails'
        ]);

        // Create a new email record
        try {
            Email::create(['email' => $request->email]);
            return response()->json(['message' => 'Subscription successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Subscription failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function getAllEmails()
    {
        try {
            $emails = Email::all();
            return response()->json($emails, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve emails', 'error' => $e->getMessage()], 500);
        }
    }
}

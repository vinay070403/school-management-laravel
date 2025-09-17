<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/dashboard')->with('status', 'Logged in successfully at ' . now()->format('h:i A IST, d F Y'));
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('status', 'Password reset successfully at ' . now()->format('h:i A IST, d F Y'));
        }

        return back()->withErrors(['email' => 'No user found with this email.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('status', 'Logged out successfully at ' . now()->format('h:i A IST, d F Y'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.profile-edit', compact('user'))->render(); // Return HTML fragment
    }

    public function createUser()
    {
        return view('auth.user-create')->render(); // Return HTML fragment
    }

    // public function updateProfile(Request $request)
    // {
    //     $user = User::find(Auth::id());
    //     $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'phone' => 'nullable|string|max:20',
    //         'dob' => 'nullable|date',
    //         'address' => 'nullable|string|max:500',
    //         'interest' => 'nullable|string|max:255',
    //         'goal' => 'nullable|string|max:255',
    //     ]);

    //     $user->update([
    //         'first_name' => $request->first_name,   
    //         'last_name' => $request->last_name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'dob' => $request->dob,
    //         'address' => $request->address,
    //         'interest' => $request->interest,
    //         'goal' => $request->goal,
    //     ]);

    //     return response()->json(['status' => 'success', 'message' => 'Profile updated successfully at ' . now()->format('h:i A IST, d F Y')]);
    // }

    //     public function updateProfile(Request $request)
    //     {
    //         Log::info('Update Profile called for user ID: ' . Auth::id());
    //         $user = User::find(Auth::id());
    //         if (!$user) {
    //             Log::error('User not found for ID: ' . Auth::id());
    //             return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
    //         }

    //         Log::info('Validating request data: ' . json_encode($request->all()));
    //         $request->validate([
    //             'first_name' => 'required|string|max:255',
    //             'last_name' => 'required|string|max:255',
    //             'email' => 'required|email|unique:users,email,' . $user->id,
    //             'phone' => 'nullable|string|max:20',
    //             'dob' => 'nullable|date',
    //             'address' => 'nullable|string|max:500',
    //             'interest' => 'nullable|string|max:255',
    //             'goal' => 'nullable|string|max:255',
    //         ]);

    //         Log::info('Updating user with data: ' . json_encode($request->all()));
    //         $user->update([
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'email' => $request->email,
    //             'phone' => $request->phone,
    //             'dob' => $request->dob,
    //             'address' => $request->address,
    //             'interest' => $request->interest,
    //             'goal' => $request->goal,
    //         ]);

    //         Log::info('Profile updated successfully for user ID: ' . $user->id);
    //         return response()->json(['status' => 'success', 'message' => 'Profile updated successfully at ' . now()->format('h:i A IST, d F Y')]);
    //     }

    //     public function storeUser(Request $request)
    //     {
    //         $request->validate([
    //             'first_name' => 'required|string|max:255',
    //             'last_name' => 'required|string|max:255',
    //             'email' => 'required|email|unique:users,email',
    //             'phone' => 'nullable|string|max:20',
    //             'dob' => 'nullable|date',
    //             'address' => 'nullable|string|max:500',
    //             'student_id' => 'nullable|string|max:50',
    //             'country_id' => 'nullable|integer',
    //             'state_id' => 'nullable|integer',
    //             'zipcode' => 'nullable|string|max:10',
    //             'password' => 'required|min:8|confirmed',
    //             'interest' => 'nullable|string|max:255',
    //             'goal' => 'nullable|string|max:255',
    //         ]);

    //         $user = User::create(array_merge($request->all(), ['password' => Hash::make($request->password)]));
    //         Log::info('User created with ID: ' . $user->id);

    //         return response()->json(['status' => 'success', 'message' => 'User created successfully at ' . now()->format('h:i A IST, d F Y')]);
    //     }

    public function updateProfile(Request $request)
    {
        Log::info('Update Profile called for user ID: ' . Auth::id());
        $user = User::find(Auth::id());
        if (!$user) {
            Log::error('User not found for ID: ' . Auth::id());
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        Log::info('Received request data: ' . json_encode($request->all()));
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'interest' => 'nullable|string|max:255',
            'goal' => 'nullable|string|max:255',
        ]);

        Log::info('Validation passed, updating user with: ' . json_encode($request->only(['first_name', 'last_name', 'email', 'phone', 'dob', 'address', 'interest', 'goal'])));
        $updateData = $request->only(['first_name', 'last_name', 'email', 'phone', 'dob', 'address', 'interest', 'goal']);
        $user->update($updateData);

        Log::info('Profile updated successfully for user ID: ' . $user->id);
        return response()->json(['status' => 'success', 'message' => 'Profile updated successfully at ' . now()->format('h:i A IST, d F Y')]);
    }

    public function storeUser(Request $request)
    {
        Log::info('Store User called with data: ' . json_encode($request->all()));
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'student_id' => 'nullable|string|max:50',
            'country_id' => 'nullable|integer',
            'state_id' => 'nullable|integer',
            'zipcode' => 'nullable|string|max:10',
            'password' => 'required|min:8|confirmed',
            'interest' => 'nullable|string|max:255',
            'goal' => 'nullable|string|max:255',
        ]);

        $user = User::create(array_merge($request->all(), ['password' => Hash::make($request->password)]));
        Log::info('User created with ID: ' . $user->id);

        return response()->json(['status' => 'success', 'message' => 'User created successfully at ' . now()->format('h:i A IST, d F Y')]);
    }
    
}

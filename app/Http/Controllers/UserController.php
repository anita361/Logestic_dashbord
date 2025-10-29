<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login POST
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;


        $user->org_password = $request->password;

        $user->password = Hash::make($request->password);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->file = $filename;
        }

        $user->save();



        return redirect()->route('dashboard');
    }


    public function dashboard()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }



    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
       
    }
}

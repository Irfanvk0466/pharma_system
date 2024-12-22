<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Hash;
use App\Http\Requests\ValidateRegister;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function register() 
    {
        return view('auth.register');
    }

    /**
     * Handle the registration of a new employee.
     *
     * @param  ValidateEmployee  $request
     * @return RedirectResponse
     */
    public function employeeRegister(ValidateRegister $request)
    {
        $hashedPassword = Hash::make($request->password);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'role' => $request->role,
        ]);
        return back()->with('success', 'Registration Successful!..');
    }

    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function login() 
    {
        return view('auth.login');
    }

    /**
     * Handle the employee login.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function employeeLogin(Request $request)
    {
        $loginCredentials = $request->only('username', 'password');
        $user = User::where('name', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            if ($user->role == User::EMPLOYEE) {
                return redirect()->route('jobreports.index');
            } elseif ($user->role == User::DEPARTMENT_HEAD) {
                return redirect()->route('department_head.dashboard');
            } elseif ($user->role == User::ADMIN) {
                return redirect()->route('admin.dashboard');
            }
        }
        return back()->with('error', 'Invalid login credentials...');
    }
    
    /**
     * Log the user out of the application.
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}

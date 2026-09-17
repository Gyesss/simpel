<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login page.
     */
    public function showLogin()
    {
        return view('auth.login');
    }


    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login_type' => [
                'required',
                'in:login_id,nis_nip,email',
            ],

            'identifier' => [
                'required',
                'string',
            ],

            'password' => [
                'required',
            ],
        ]);


        $user = User::where(
            $credentials['login_type'],
            $credentials['identifier']
        )->first();


        if (
            $user &&
            Hash::check(
                $credentials['password'],
                $user->password
            )
        ) {

            Auth::login($user);

            $request->session()->regenerate();


            return match ($user->role) {

                'student' => redirect()->route('student.dashboard'),

                'hubin' => redirect()->route('hubin.dashboard'),

                'company' => redirect()->route('company.dashboard'),

                default => abort(403),
            };
        }


        return back()
            ->withErrors([
                'identifier' => 'The provided credentials do not match our records.',
            ])
            ->withInput(
                $request->only(
                    'login_type',
                    'identifier'
                )
            );
    }


    /**
     * Handle the logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/login');
    }
}

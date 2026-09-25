<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Show the authenticated user's profile.
     */
    public function show(Request $request)
    {
        $user = $request->user();

        return view('profile.show', compact('user'));
    }


    /**
     * Show the profile edit form.
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        return view('profile.edit', compact('user'));
    }


    /**
     * Update the authenticated user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $rules = [
            'full_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'phone_number' => [
                'nullable',
                'string',
                'max:20',
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Student Only
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'student') {
            $rules['class'] = [
                'nullable',
                'string',
                'max:50',
            ];
        }


        $validated = $request->validate($rules);


        /*
        |--------------------------------------------------------------------------
        | Update Profile Information
        |--------------------------------------------------------------------------
        */

        $user->full_name = $validated['full_name'] ?? null;
        $user->email = $validated['email'] ?? null;
        $user->phone_number = $validated['phone_number'] ?? null;


        /*
        |--------------------------------------------------------------------------
        | Student Class
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'student') {
            $user->class = $validated['class'] ?? null;
        }


        $user->save();


        return redirect()
            ->route('profile.show')
            ->with(
                'success',
                'Informasi profil berhasil diperbarui.'
            );
    }


    /**
     * Update the authenticated user's password.
     */
    public function updatePassword(Request $request)
    {
        $user = $request->user();


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [
                'current_password' => [
                    'required',
                    'string',
                ],

                'new_password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                ],
            ],
            [
                'current_password.required' =>
                'Password lama wajib diisi.',

                'new_password.required' =>
                'Password baru wajib diisi.',

                'new_password.min' =>
                'Password baru minimal 8 karakter.',

                'new_password.confirmed' =>
                'Konfirmasi password baru tidak cocok.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Validate Current Password
        |--------------------------------------------------------------------------
        */

        if (! Hash::check(
            $validated['current_password'],
            $user->password
        )) {

            throw ValidationException::withMessages([
                'current_password' =>
                'Password lama tidak sesuai.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Update Password
        |--------------------------------------------------------------------------
        */

        $user->password = $validated['new_password'];

        $user->save();


        return redirect()
            ->route('profile.show')
            ->with(
                'success',
                'Password berhasil diperbarui.'
            );
    }
}

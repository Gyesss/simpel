<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    /**
     * Show the company profile edit form.
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        if (! $user->company) {
            abort(404);
        }

        return view('company.profile.edit', compact('user'));
    }


    /**
     * Update the company profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        if (! $user->company) {
            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(
            [
                'company_name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'full_address' => [
                    'required',
                    'string',
                    'max:1000',
                ],

                'hr_contact' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'available_quota' => [
                    'required',
                    'integer',
                    'min:0',
                ],
            ],
            [
                'company_name.required' =>
                'Nama perusahaan wajib diisi.',

                'company_name.string' =>
                'Nama perusahaan harus berupa teks.',

                'company_name.max' =>
                'Nama perusahaan maksimal 255 karakter.',

                'full_address.required' =>
                'Alamat lengkap wajib diisi.',

                'full_address.string' =>
                'Alamat lengkap harus berupa teks.',

                'full_address.max' =>
                'Alamat lengkap maksimal 1000 karakter.',

                'hr_contact.required' =>
                'Kontak HR wajib diisi.',

                'hr_contact.string' =>
                'Kontak HR harus berupa teks.',

                'hr_contact.max' =>
                'Kontak HR maksimal 255 karakter.',

                'available_quota.required' =>
                'Kuota tersedia wajib diisi.',

                'available_quota.integer' =>
                'Kuota tersedia harus berupa angka.',

                'available_quota.min' =>
                'Kuota tersedia tidak boleh kurang dari 0.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Update Company Information
        |--------------------------------------------------------------------------
        */

        $company = $user->company;

        $company->company_name = $validated['company_name'];
        $company->full_address = $validated['full_address'];
        $company->hr_contact = $validated['hr_contact'];
        $company->available_quota = $validated['available_quota'];

        $company->save();


        return redirect()
            ->route('profile.show')
            ->with(
                'success',
                'Informasi perusahaan berhasil diperbarui.'
            );
    }
}

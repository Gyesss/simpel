<?php

namespace App\Http\Controllers\Hubin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display all companies.
     */
    public function index()
    {
        $companies = Company::orderBy('company_name')->get();

        return view('hubin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a company.
     */
    public function create()
    {
        return view('hubin.companies.create');
    }

    /**
     * Store a new company.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => [
                'required',
                'string',
                'max:255',
            ],

            'full_address' => [
                'required',
                'string',
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

            'partner_status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        Company::create($validated);

        return redirect()
            ->route('hubin.companies.index')
            ->with('success', 'Data perusahaan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing a company.
     */
    public function edit(Company $company)
    {
        return view('hubin.companies.edit', compact('company'));
    }

    /**
     * Update a company.
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'company_name' => [
                'required',
                'string',
                'max:255',
            ],

            'full_address' => [
                'required',
                'string',
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

            'partner_status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        $company->update($validated);

        return redirect()
            ->route('hubin.companies.index')
            ->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    /**
     * Delete a company.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()
            ->route('hubin.companies.index')
            ->with('success', 'Data perusahaan berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CompanyCollection;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$companies = Company::all()->load('employees');;
        //return Inertia::render('Company/Index', ['companies' => $companies]);

        return Inertia::render('Company/Data');
    }

    // API
    public function data(Request $request)
    {
        $companies = Company::query();

        // Apply search filters
        if ($request->has('search')) {
            $companies->where('name', 'like', '%' . $request->search . '%');
        }

        // Paginate the results
        $data = $companies->paginate($request->get('per_page', $request->get('results')));

        // Return a paginated resource collection
        return CompanyResource::collection($data);

        //return new CompanyCollection(Company::paginate($request->get('per_page', $request->get('results'))));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Company/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = new Company($request->all());
        $company->save();

        return redirect()->route('companies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return Inertia::render('Company/Edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->all());
        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        //return redirect()->back();
    }
}

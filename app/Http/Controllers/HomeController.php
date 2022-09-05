<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return $this->companies(true);
    }

    public function list()
    {
        return $this->companies(false);
    }

    private function companies(bool $redirect)
    {
        Cache::forget('cachedCompanyObject_'.Auth::user()->id);
        Cache::forget('cachedEmployeeObject_'.Auth::user()->id);

        $employees = Auth::user()->employees()->with('company')->notLocked()->get();

        if ($redirect && $employees->count() === 1) {
            return redirect()->route('welcome', ['company' => $employees->first()->company_id]);
        }

        $companiesCollection = $employees->map(function ($employee) {
            return [
                'company_name' => $employee->company->name,
                'company_id' => $employee->company_id,
                'number_of_employees' => $employee->company->employees()->count(),
                'joined_at' => $employee->created_at,
            ];
        });

        return Inertia::render('Home/Index', [
            'employees' => $companiesCollection,
        ]);
    }
}

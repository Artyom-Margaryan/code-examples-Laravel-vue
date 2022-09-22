<?php


namespace App\Http\Controllers;


use App\Models\Employee;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,email,established,employee_id'],
        ]);

        $query = Employee::query();

        if (request('employee_search')) {
            $query->where('first_name_english', 'LIKE','%'.request('employee_search').'%')
                ->orWhere('last_name_english', 'LIKE','%'.request('employee_search').'%');
        }

        return Inertia::render('Employee/Index', [
            'employees' => $query->with(['workingDepartment.faculty', 'addresses'])->paginate(10)
        ]);
    }
    //
}

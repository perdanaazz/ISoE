<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employee;
use App\Models\EmployeePhoto;
use App\Models\Level;
use App\Models\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::get();

            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('employee_id', function ($row) {
                    return str_replace('EMPLOYEE', '', $row->employee_id);
                })
                ->addColumn('gender', function ($row) {
                    return $row->gender == 1 ? 'Male' : 'Female';
                })
                ->addColumn('salary', function ($row) {
                    return 'Rp ' . number_format($row->salary, 0, ',', '.');
                })
                ->addColumn('action', 'employee.dt-action')
                ->rawColumns(['action', 'gender'])
                ->toJson();
        }

        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create', [
            'employee_id' => 'EMPLOYEE' . rand(),
            'rand'        => rand(),
            'divisions'   => Division::get(),
            'levels'      => Level::get(),
            'positions'   => Position::get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('employee.show', [
            'employee'      => Employee::where('employee_id', $id)->first(),
            'employeePhoto' => EmployeePhoto::where('employee_id', $id)->get(),
            'divisions'     => Division::get(),
            'levels'        => Level::get(),
            'positions'     => Position::get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('employee.edit', [
            'employee'  => Employee::where('employee_id', $id)->first(),
            'rand'      => rand(),
            'divisions' => Division::get(),
            'levels'    => Level::get(),
            'positions' => Position::get(),
        ]);
    }
}

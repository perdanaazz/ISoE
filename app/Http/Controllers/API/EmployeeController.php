<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Employee;
use App\Models\EmployeePhoto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Traits\deleteDBStorage;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use deleteDBStorage;

    public function list(Request $request)
    {
        try {
            $employee = Employee::with('employee_photos');

            // Fetch by Employee_id
            if ($request->has('employee_id')) {
                $employee->where('employee_id', $request->employee_id);
            }

            // Fetch by Gender
            if ($request->has('gender')) {
                $employee->where('gender', $request->gender);
            }

            // Fetch by Address
            if ($request->has('address')) {
                $employee->where('address', $request->address);
            }

            // Fetch by Division
            if ($request->has('division')) {
                $employee->where('division', $request->division);
            }

            // Fetch by Level
            if ($request->has('level')) {
                $employee->where('level', $request->level);
            }

            // Fetch by Position
            if ($request->has('position')) {
                $employee->where('position', $request->position);
            }

            // Fetch by Salary
            if ($request->has('salary')) {
                $employee->where('salary', $request->salary);
            }

            // Order by and type order
            if ($request->has('orderBy') || $request->has('typeOrder')) {
                $employee->orderBy($request->orderBy, $request->typeOrder);
            }

            return ResponseFormatter::success($employee->paginate(10), 'Success fetch employee');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            // Insert data to DB
            $employee = Employee::create([
                'employee_id' => $request->employee_id,
                'name'        => $request->name,
                'email'       => $request->email,
                'birth_date'  => Carbon::parse($request->birth_date)->format('Y-m-d'),
                'gender'      => $request->gender,
                'address'     => $request->address,
                'division'    => $request->division,
                'level'       => $request->level,
                'position'    => $request->position,
                'salary'      => $request->salary,
                'photo_id'    => $request->photo_id,
            ]);

            // Delete Photo Upload which not same with photo ID
            $employeePhoto = EmployeePhoto::where('employee_id', $request->employee_id)
                ->where('rand', '!=', $request->photo_id)
                ->get();
            $this->deleteDBS($employeePhoto); // From Traits
            DB::commit();

            return ResponseFormatter::success($employee, 'Success create data');
        } catch (\Exception $e) {
            DB::rollback();
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            // Update data in DB
            $employee = Employee::where('employee_id', $id)->first();
            $employee->update([
                'name'       => $request->name,
                'email'      => $request->email,
                'birth_date' => Carbon::parse($request->birth_date)->format('Y-m-d'),
                'gender'     => $request->gender,
                'address'    => $request->address,
                'division'   => $request->division,
                'level'      => $request->level,
                'position'   => $request->position,
                'salary'     => $request->salary,
            ]);

            // Delete Photo Upload which not same with photo ID
            $employeePhoto = EmployeePhoto::where('employee_id', $request->employee_id)
                ->where('rand', '!=', $request->photo_id)
                ->get();
            if ($request->photo) {
                $employee->update([
                    'photo_id' => $request->photo_id,
                ]);
                $this->deleteDBS($employeePhoto); // From Traits
            }
            DB::commit();

            return ResponseFormatter::success($employee, 'Success update data');
        } catch (\Exception $e) {
            DB::rollback();
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $employee = Employee::where('employee_id', $id)->first();

            if (!$employee) {
                return ResponseFormatter::error('Data not found', 404);
            }

            $employee->delete();

            // Employee Photo Delete in Storage
            $employeePhoto = EmployeePhoto::where('employee_id', $id)->get();
            $this->deleteDBS($employeePhoto); // From Traits

            return ResponseFormatter::success($employee, 'Success delete employee');
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}

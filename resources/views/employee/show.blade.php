@extends('layouts.layoutMaster')

@section('content')
    <div class="row mb-4 mt-4 pt-4">
        <div class="col-12">
            {{ Breadcrumbs::render('employee-show-id', str_replace('EMPLOYEE', '', $employee->employee_id)) }}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 text-start">
            <a href="{{ route('employee.index') }}" class="btn btn-primary btn-sm"><i class="ti ti-arrow-left me-2"></i>
                Back</a>
        </div>
    </div>

    <div class="row d-flex mb-4">
        <div class="col-12">
            <form id="employeeForm" action="{{ route('employee.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row d-flex">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                value="{{ old('name') ?? $employee->name }}" readonly>
                            <div class="form-text text-danger mt-2 errors" id="name_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{ old('email') ?? $employee->email }}" readonly>
                            <div class="form-text text-danger mt-2 errors" id="email_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="text" class="form-control" id="birth_date" name="birth_date"
                                placeholder="Birt Date" value="{{ old('birth_date') ?? $employee->birth_date }}" readonly>
                            <div class="form-text text-danger mt-2 errors" id="birth_date_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender"
                                value="{{ $employee->gender == 0 ? 'Female' : 'Male' }}" readonly>
                            <div class="form-text text-danger mt-2 errors" id="gender_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="division" class="form-label">Division</label>
                            <input type="text" class="form-control" id="division" name="division" placeholder="Division"
                                value="{{ $employee->division }}" readonly>
                            <div class="form-text text-danger mt-2 errors" id="division_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <input type="text" class="form-control" id="level" name="level" placeholder="Level"
                                value="{{ $employee->level }}" readonly>
                            <div class="form-text text-danger mt-2 errors" id="level_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position" placeholder="Position"
                                value="{{ $employee->position }}" readonly>
                            <div class="form-text text-danger mt-2 errors" id="position_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary"
                                placeholder="Salary"
                                value="{{ old('salary') ?? 'Rp ' . number_format($employee->salary, 0, ',', '.') }}"
                                readonly>
                            <div class="form-text text-danger mt-2 errors" id="salary_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="3" placeholder="Address"
                                readonly>{{ old('address') ?? $employee->address }}</textarea>
                            <div class="form-text text-danger mt-2 errors" id="address_error"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        @if ($employeePhoto->isNotEmpty())
                            @foreach ($employeePhoto as $ep)
                                <img class="img-fluid w-25" src="{{ asset('storage/' . $ep->path) }}" alt="">
                            @endforeach
                        @else
                            <span>Employee photo not found</span>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

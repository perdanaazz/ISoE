@extends('layouts.layoutMaster')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection

@section('content')
    <div class="row mb-4 mt-4 pt-4">
        <div class="col-12">
            {{ Breadcrumbs::render('employee-edit-id', str_replace('EMPLOYEE', '', $employee->employee_id)) }}
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
            <form id="employeeForm" action="{{ route('employee.update', $employee->employee_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row d-flex">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                value="{{ old('name') ?? $employee->name }}">
                            <div class="form-text text-danger mt-2 errors" id="name_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{ old('email') ?? $employee->email }}">
                            <div class="form-text text-danger mt-2 errors" id="email_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="text" class="form-control" id="birth_date" name="birth_date"
                                placeholder="Birt Date" value="{{ old('birth_date') ?? $employee->birth_date }}">
                            <div class="form-text text-danger mt-2 errors" id="birth_date_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control w-100" name="gender" id="gender">
                                <option value="">Select gender</option>
                                <option value="0" {{ (old('gender') || $employee->gender) == 0 ? 'selected' : '' }}>
                                    Female</option>
                                <option value="1" {{ (old('gender') || $employee->gender) == 1 ? 'selected' : '' }}>
                                    Male</option>
                            </select>
                            <div class="form-text text-danger mt-2 errors" id="gender_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="division" class="form-label">Division</label>
                            <select class="form-control w-100" name="division" id="division">
                                <option value="">Select division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->division }}"
                                        {{ (old('division') || $employee->division) == $division->division ? 'selected' : '' }}>
                                        {{ $division->division }}</option>
                                @endforeach
                            </select>
                            <div class="form-text text-danger mt-2 errors" id="division_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-control w-100" name="level" id="level">
                                <option value="">Select level</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level->level }}"
                                        {{ (old('level') || $employee->level) == $level->level ? 'selected' : '' }}>
                                        {{ $level->level }}</option>
                                @endforeach
                            </select>
                            <div class="form-text text-danger mt-2 errors" id="level_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <select class="form-control w-100" name="position" id="position">
                                <option value="">Select position</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->position }}"
                                        {{ (old('position') || $employee->position) == $position->position ? 'selected' : '' }}>
                                        {{ $position->position }}</option>
                                @endforeach
                            </select>
                            <div class="form-text text-danger mt-2 errors" id="position_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" class="form-control" id="salary" name="salary"
                                placeholder="Salary" value="{{ old('salary') ?? $employee->salary }}">
                            <div class="form-text text-danger mt-2 errors" id="salary_error"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="address" cols="30" rows="3" placeholder="Address">{{ old('address') ?? $employee->address }}</textarea>
                            <div class="form-text text-danger mt-2 errors" id="address_error"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <input type="text" hidden class="form-control" id="photo" name="photo">
                <input type="text" hidden class="form-control" id="photoId" name="photo_id"
                    value="{{ $rand }}">
            </form>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <label for="" class="form-label">Photo</label>
                    <form action="{{ route('photo-upload') }}" class="dropzone" id="my-great-dropzone" method="POST">
                        @csrf
                    </form>
                    <div class="form-text text-danger mt-2 errors" id="photo_error"></div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 text-end">
                    <button onclick="$('#employeeForm').submit()" class="btn btn-warning" id="submitBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"
        integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

    <script>
        var baseUrl = '{{ env('APP_URL') }}' + ':8000';

        $(document).ready(function() {
            $('#gender').select2({
                theme: 'bootstrap-5',
            });
            $('#division').select2({
                theme: 'bootstrap-5',
            });
            $('#level').select2({
                theme: 'bootstrap-5',
            });
            $('#position').select2({
                theme: 'bootstrap-5',
            });
            $("#birth_date").datepicker();
        });

        var rand = '{{ $rand }}';
        var employee_id = '{{ $employee->employee_id }}';
        var photo = 0;

        function photoCount(param) {
            if (param == 1) {
                photo = photo + 1;
                $('#photo').val(1);
            } else {
                photo = photo - 1;
            }

            // Change value photo when photo == 0
            if (photo == 0) {
                $('#photo').val('');
            }
        }

        Dropzone.options.myGreatDropzone = {
            paramName: "file",
            maxFilesize: 2,
            accept: function(file, done) {
                // Validasi jenis file
                if (file.type === "image/jpeg" || file.type === "image/jpg" || file.type ===
                    "image/png") {
                    done(); // Terima file
                } else {
                    done("Only JPEG and PNG files are allowed."); // Tolak file
                }
            },
            init: function() {
                var myDropzone = this;

                // Event addedfile: Menambahkan tombol hapus untuk setiap file yang diunggah
                myDropzone.on("addedfile", function(file) {
                    photoCount(1);

                    // Menggunakan hash (contoh: MD5) sebagai nama file baru
                    var newFileName = CryptoJS.MD5(file.name + new Date().toISOString()) + '.' +
                        file.name
                        .split('.').pop();
                    file.newFileName = newFileName; // Simpan nama file baru pada properti file
                    console.log(file.newFileName);
                    var removeButton = Dropzone.createElement(
                        "<div class='text-center'><button class='btn btn-danger btn-sm'><i class='ti ti-trash'></i></button><div>"
                    );

                    // Menetapkan event click pada tombol hapus
                    removeButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        // Panggil fungsi untuk menghapus file
                        myDropzone.removeFile(file);
                        deleteFileOnServer(file.newFileName);
                    });

                    // Menambahkan tombol hapus ke elemen file
                    file.previewElement.appendChild(removeButton);
                });

                myDropzone.on("sending", function(file, xhr, formData) {
                    formData.append('employee_id', employee_id);
                    formData.append('newFileName', file.newFileName);
                    formData.append('rand', rand);
                });
            }
        };

        function deleteFileOnServer(fileName) {
            photoCount(0);

            var url = "{{ route('photo-delete', ':id') }}";
            url = url.replace(':id', fileName);
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error("Error deleting file:", error);
                }
            });
        }

        $("form#employeeForm").submit(function(e) {
            $('#submitBtn').attr('disabled', true);

            e.preventDefault();
            var formData = new FormData(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.errors').html('');

            $.ajax({
                type: 'POST',
                url: baseUrl + '/api/employee/' + employee_id,
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#employeeForm').trigger('reset');
                    $('#submitBtn').attr('disabled', false);

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    $('.errors').html('');

                    window.location.replace('{{ route('employee.index') }}');
                },
                error: function(data) {
                    $('#submitBtn').attr('disabled', false);

                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Data gagal ditambahkan',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    for (const key in data.responseJSON.errors) {
                        $(`#${ key }_error`).html(
                            data.responseJSON.errors[key].map(err => {
                                return `<li>${ err }</li>`
                            }).join('')
                        )
                    }
                }
            });
        });
    </script>
@endsection

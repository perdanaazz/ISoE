@extends('layouts.layoutMaster')

@section('style')
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css">
    <style>
        thead input {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="row mb-4 mt-4 pt-4">
        <div class="col-12">
            {{ Breadcrumbs::render('employee-list') }}
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 text-end">
            <a href="{{ route('employee.create') }}" class="btn btn-primary btn-sm">Add Employee</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 table-responsive">
            <table class="table table-striped" id="employee_dt">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Division</th>
                        <th>Level</th>
                        <th>Position</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center"></tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var baseUrl = '{{ env('APP_URL') }}' + ':8000';
        var table;

        $('#employee_dt thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#employee_dt thead');

        $(document).ready(function() {
            table = $('#employee_dt').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            var isLastColumn = colIdx === api.columns().eq(0).length - 1;

                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            ).hide();

                            if (!isLastColumn) {
                                cell.show();

                                var title = $(cell).text();
                                $(cell).html('<input type="text" placeholder="' + title + '" />');

                                $(
                                        'input',
                                        $('.filters th').eq($(api.column(colIdx).header()).index())
                                    )
                                    .off('keyup change')
                                    .on('change', function(e) {
                                        $(this).attr('title', $(this).val());
                                        var regexr =
                                            '({search})';

                                        var cursorPosition = this.selectionStart;
                                        api
                                            .column(colIdx)
                                            .search(
                                                this.value != '' ?
                                                regexr.replace('{search}', '(((' + this.value +
                                                    ')))') :
                                                '',
                                                this.value != '',
                                                this.value == ''
                                            )
                                            .draw();
                                    })
                                    .on('keyup', function(e) {
                                        e.stopPropagation();

                                        $(this).trigger('change');
                                        $(this)
                                            .focus()[0]
                                            .setSelectionRange(cursorPosition, cursorPosition);
                                    });
                            }
                        });
                },
                processing: true,
                serverSide: true,
                ajax: '{{ route('employee.index') }}',
                columns: [{
                        data: 'employee_id',
                        name: 'employee_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'division',
                        name: 'division'
                    },
                    {
                        data: 'level',
                        name: 'level'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'salary',
                        name: 'salary'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                scrollCollapse: true,
                scrollX: true,
            });
        });

        function deleteData(id) {
            var url = baseUrl + '/api/employee/' + id;

            Swal.fire({
                title: 'Yakin ingin menghapus data?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonClass: 'me-2',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Data berhasil dihapus',
                                showConfirmButton: false,
                                timer: 1000
                            });

                            $('.errors').html('');

                            table.draw();
                        },
                        error: function(data) {
                            console.log(data);
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Data gagal dihapus',
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection

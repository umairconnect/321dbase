@extends('layouts.app', ['title' => 'Users'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Users</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Users</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">List</a>
                    </li>
                </ul>
                <!-- End Breadcrumb -->
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="javascript:;" class="btn btn-success font-weight-bolder mr-5" data-toggle="modal" data-target="#bulkAddUserModal">
                <span class="svg-icon svg-icon-white svg-icon-2x">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M8.95128003,13.8153448 L10.9077535,13.8153448 L10.9077535,15.8230161 C10.9077535,16.0991584 11.1316112,16.3230161 11.4077535,16.3230161 L12.4310522,16.3230161 C12.7071946,16.3230161 12.9310522,16.0991584 12.9310522,15.8230161 L12.9310522,13.8153448 L14.8875257,13.8153448 C15.1636681,13.8153448 15.3875257,13.5914871 15.3875257,13.3153448 C15.3875257,13.1970331 15.345572,13.0825545 15.2691225,12.9922598 L12.3009997,9.48659872 C12.1225648,9.27584861 11.8070681,9.24965194 11.596318,9.42808682 C11.5752308,9.44594059 11.5556598,9.46551156 11.5378061,9.48659872 L8.56968321,12.9922598 C8.39124833,13.2030099 8.417445,13.5185067 8.62819511,13.6969416 C8.71848979,13.773391 8.8329684,13.8153448 8.95128003,13.8153448 Z" fill="#000000"/>
                    </g>
                </svg></span>Bulk Add Users
            </a>
            <a href="javascript:;" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#addUserModal">
                <span class="svg-icon svg-icon-white svg-icon-2x">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg>
                </span>Add User
            </a>
        </div>
    </div>
</div>
<!-- End page header -->

<!-- Main Content -->
<div class="d-flex flex-column-fluid">
    <div class="container-fluid mx-lg-5">
        <div class="card card-custom">
            <div class="card-body">
                <div id="dtFilterPlace"></div>
                <button class="btn btn-danger btn-sm float-right btn-bulk-delete" id="btnBulkDelete" style="display: none"><i class="la la-trash"></i> Delete</button>
                <table class="table table-separate table-hover table-checkable" id="kt_datatable">
                    <thead>
                        <tr>
                            <th class="mass-clickable">
                                <label class="checkbox checkbox-single">
                                    <input type="checkbox" value="" class="group-checkable"/>
                                    <span></span>
                                </label>
                            </th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Mobile Number</th>
                            <th>DOB</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($users as $user)
                        <?php $i++; ?>
                        <tr>
                            <td>
                                <label class="checkbox checkbox-single">
                                    <input type="checkbox" value="{{ $user->id }}" class="checkable"/>
                                    <span></span>
                                </label> 
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50 flex-shrink-0">
                                        @if ($user->usr_picture)
                                            <img src="{{ $user->usr_picture }}" alt="photo">
                                        @elseif ($user->initial_avatar_text)
                                            <?php 
                                                $types = [
                                                    'text-primary bg-primary-o-30',
                                                    'text-warning bg-warning-o-30',
                                                    'text-success bg-success-o-30',
                                                    'text-danger bg-danger-o-30',
                                                    'text-dark bg-dakr-o-30',
                                                ];
                                            ?>
                                            <span class="symbol-label font-size-h5 font-weight-bold {{ $types[$i % 5] }}">{{ $user->initial_avatar_text }}</span>
                                        @else
                                            <img src="{{ asset('images/User.svg') }}" alt="photo">
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2 text-capitalize">{{ $user->usr_fullname }}</span>
                                        <!-- <a href="#" class="text-muted text-hover-primary">` + full[3] + `</a> -->
                                    </div>
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('m/d/Y') }}</td>
                            <td>{{ $user->usr_mobile }}</td>
                            <td>{{ \Carbon\Carbon::parse($user->usr_dob)->format('m/d/Y') }}</td>
                            <td>{{ $user->usr_temp_psw }}</td>
                            <td nowrap="nowrap">
                                <a href="{{ url('/group/users', [$user, 'edit']) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                    <i class="la la-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" data-action="{{ url('/group/users', $user) }}" data-toggle="modal" data-target="#deleteConfirmModal">
                                    <i class="la la-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal-->
<div class="modal fade" id="addUserModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" action="{{ url('/group/users') }}" data-parsley-validate>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- @error('email')
                    <div class="alert alert-danger" role="alert">
                        Email already used!
                    </div>
                    @enderror -->
                    @error('usr_mobile')
                    <div class="alert alert-danger" role="alert">
                        Mobile number already used!
                    </div>
                    @enderror
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>* First Name:</label>
                            <input type="text" name="usr_firstname" class="form-control" placeholder="Enter first name" required data-parsley-required-message="Please enter first name." value="{{ old('usr_firstname') }}" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label>* Full Name:</label>
                            <input type="text" name="usr_fullname" class="form-control" placeholder="Enter fullname" required data-parsley-required-message="Please enter fullname." value="{{ old('usr_fullname') }}" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label>* Mobile Number:</label>
                            <input type="text" name="usr_mobile" class="form-control" placeholder="Enter mobile number" required data-parsley-required-message="Please enter mobile number." value="{{ old('usr_mobile') }}" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label>* DOB:</label>
                            <input type="text" name="usr_dob" class="form-control date-picker" placeholder="Enter DOB" required data-parsley-required-message="Please enter dob." value="{{ old('usr_dob') }}" autocomplete="off" />
                        </div>
                        <!-- <div class="form-group col-lg-6">
                            <label>* Email:</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter email"
                                required
                                required data-parsley-type="email"
                                data-parsley-required-message="Please enter email."
                                data-parsley-email-message="Invalid email format."
                                value="{{ old('email') }}"
                            />
                        </div> -->
                        <div class="form-group col-lg-6">
                            <label>* Password:</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password" required data-parsley-required-message="Please enter password." value="{{ old('password') }}" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /. -->

<!-- Bulk Add Modal -->
<div class="modal fade" id="bulkAddUserModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" enctype="multipart/form-data" action="{{ url('/group/users/bulk-add') }}" id="bulkAddForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bulk Add Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <a href="{{ asset('file-models/bulk-add-users.xlsx') }}" class="text-dark"><i class="la la-file-excel-o text-success"></i> <span class="text-success">Click here</span> for downloading excel model for bulk add.</a>
                    <div class="form-group mt-5 pt-5">
                        <label>Please choose excel file. <span class="text-muted">(.xls, .csv, .xlsx)</span></label>
                        <div></div>
                        <div class="custom-file">
                            <input type="file" name="excel_file" class="custom-file-input" id="excelFile" accept=".xls, .csv, .xlsx" />
                            <label class="custom-file-label" for="excelFile">Choose file<span class="custom-file-browse">Browse</span></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
                    <button type="button" id="bulkSubmit" class="btn btn-success font-weight-bold">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /. -->

@include('layouts.components.modals.delete_confirm_modal', ['modalText' => 'Are you sure? User will be deleted permanently.'])

<!-- Bulk Delete Modal -->
@include('layouts.components.modals.bulk_delete_modal', ['modalText' => 'Are you sure? Selected user/users will be deleted permanetly.'])
<!-- /. -->
<!-- End Main Content -->
@endsection

@push('js')
<script src="{{ asset('plugins/datatables/datatables.bundle.js?v=1.0.0') }}"></script>
<script src="{{ asset('plugins') }}/parsleyjs/parsley.min.js"></script>
<script src="{{ asset('js/notify.js') }}"></script>

<!-- If validation error happnen while submiting form, back, show modal till -->
<script>
    @if ($errors->any()) $('#addUserModal').modal(); @endif
</script>

<script>
    $(function() {
        $('.date-picker').datetimepicker({
            format: "mm/dd/yyyy",
            todayHighlight: true,
            autoclose: true,
            startView: 2,
            minView: 2,
            forceParse: 0,
            // pickerPosition: 'bottom-left'
        });

        var dt = $('#kt_datatable').DataTable({
			responsive: true,
			paging: true,
            aoColumnDefs: [
                { bSortable: false, aTargets: [ -1, 0 ] }, 
                { bSearchable: false, aTargets: [ -1, 0 ] }
            ],
            language: globalVars.tdLanguage,
            dom: `<'text-left'f><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
        });

        // Redering dt filtering box
        $('#dtFilterPlace').html($(".kt_datatable_filter"));

        // Handle delete
        $('#delConfirm').on('click', function(e) {
            var action = $(this).attr('data-action');
            var loader = $('#loader');
            $.ajax({
                url: action,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                beforeSend: function() {
                    loader.show();
                },
                success: function(res) {
                    // Delete row from datatable
                    dt.row($('[data-action="'+action+'"]').parents('tr'))
                        .remove()
                        .draw();

                        loader.hide(); // Hide loading bar

                    // Notify
                    bsNotify(res.result, res.message);
                },
                error: function() {
                    loader.hide(); // Hide loading bar
                    bsNotify('danger', globalVars.messages.commonError); // Notify for any error
                }
            })
        });

        // Handle Bulk delete
        $('#btnBulkDelete').on('click', function() {
            var ids = [];
            var modal = $('#bulkDeleteModal');
            $('.checkable:checked').map(function() {
                ids.push($(this).val());
            });

            modal.find('form').attr('action', '{{ url("/group/users") }}/'+ids);
            modal.modal();
        });

        // Handle excel importing for bulk add
        var bulkAddForm = $('#bulkAddForm');
        var bulkAddModal = $('#bulkAddUserModal');
        var loader = $('#loader');

        $('#bulkSubmit').on('click', function() {
            // Hide Modal
            bulkAddModal.modal('hide');

            // Show Loading Bar
            loader.find('span').html(`<span style="font-size: 24px; color: #fff">${ globalVars.messages.importing }</span>`);
            loader.show();

            bulkAddForm.submit();
        });

        // bulkAddForm.on('submit', function(e) {
        //     e.preventDefault();

        //     $.ajax({
        //         url: bulkAddForm.attr('action'),
        //         method: 'POST',
        //         enctype: 'multipart/form-data',
        //         data: new FormData(this) ,
        //         processData: false,
        //         contentType: false,
        //         cache: false,
        //         beforeSend: function() {
        //             // Hide Modal
        //             bulkAddModal.modal('hide');

        //             // Show Loading Bar
        //             loader.find('span').html(`<span style="font-size: 24px; color: #fff">${ globalVars.messages.importing }</span>`);
        //             loader.show();
        //         },
        //         success: function(res) {
        //             // Hide Loading bar
        //             loader.hide();
        //             loader.find('span').html('');

        //             // Form rest
        //             bulkAddForm[0].reset();

        //             // Notify
        //             bsNotify(res.result, res.message);
        //         }
        //     })
        // });
    });
</script>
@endpush

@push('css')
<link href="{{ asset('plugins/datatables/datatables.bundle.css?v=1.0.0') }}" rel="stylesheet" type="text/css" />
@endpush
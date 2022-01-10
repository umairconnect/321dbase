@extends('layouts.app', ['title' => 'Operators'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Operators</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Operators</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">List</a>
                    </li>
                </ul>
                <!-- End Breadcrumb -->
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="javascript:;" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#addOperatorModal">
            <span class="svg-icon svg-icon-white svg-icon-2x">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                    </g>
                </svg>
            </span>Add Operator</a>
        </div>
    </div>
</div>
<!-- End page header -->

<!-- Main Content -->
<div class="d-flex flex-column-fluid">
    <div class="container-fluid mx-lg-5">
        <div class="card card-custom">
            <div class="card-body">
                <table class="table table-separate table-hover table-checkable" id="kt_datatable">
                    <thead>
                        <tr>
                            <th>Operator Name</th>
                            <th>Date</th>
                            <th>Operator Mobile</th>
                            <th>Operator Role</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($operators as $operator)
                        <tr>
                            <td>{{ $operator->opr_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($operator->created_at)->format('m/d/Y') }}</td>
                            <td>{{ $operator->opr_mobile }}</td>
                            <td class="font-weight-bold">
                                {{ $operator->role_name }}
                            </td>
                            <td>{{ $operator->opr_temp_psw }}</td>
                            <td nowrap="nowrap">
                                <a href="{{ route('operators.edit', $operator) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                    <i class="la la-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" data-action="{{ route('operators.destroy', $operator) }}" data-toggle="modal" data-target="#deleteConfirmModal">
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

<!-- Add Operator Modal-->
<div class="modal fade" id="addOperatorModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" action="{{ route('operators.store') }}" data-parsley-validate>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Operator</h5>
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
                    @error('opr_mobile')
                    <div class="alert alert-danger" role="alert">
                        Mobile number already used!
                    </div>
                    @enderror

                    <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif -->
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>* Operator Name:</label>
                            <input type="text" name="opr_name" class="form-control" placeholder="Enter operator name" required data-parsley-required-message="Please enter operator name." value="{{ old('opr_name') }}" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label>* Mobile Number:</label>
                            <input type="text" name="opr_mobile" class="form-control" placeholder="Enter mobile number" required data-parsley-required-message="Please enter mobile number." value="{{ old('opr_mobile') }}" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label>* Operator Role:</label>
                            <select class="form-control" name="opr_role_id" required data-parsley-required-message="Please select role." >
                                <option value="">Select role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" class="font-weight-bold" {{ $role->id == old('opr_role_id') ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
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

@include('layouts.components.modals.delete_confirm_modal', ['modalText' => 'Are you sure? Operator will be delete permanently.'])
<!-- End Main Content -->
@endsection

@push('js')
<script src="{{ asset('plugins/datatables/datatables.bundle.js?v=1.0.0') }}"></script>
<script src="{{ asset('plugins') }}/parsleyjs/parsley.min.js"></script>
<script src="{{ asset('js/notify.js') }}"></script>

<!-- If validation error happnen while submiting form, back, show modal till -->
<script>
    @if ($errors->any()) $('#addOperatorModal').modal(); @endif
</script>

<script>
    $(function() {
        var dt = $('#kt_datatable').DataTable({
			responsive: true,
			paging: true,
            aoColumnDefs: [
                { bSortable: false, aTargets: [ -1 ] }, 
                { bSearchable: false, aTargets: [ -1 ] }
            ],
            language: globalVars.tdLanguage
        });

        // Handle delete
        $('#delConfirm').on('click', function(e) {
            var action = $(this).attr('data-action');
            $.ajax({
                url: action,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken },
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(res) {
                    // Delete row from datatable
                    dt.row($('[data-action="'+action+'"]').parents('tr'))
                        .remove()
                        .draw();

                    $('#loader').hide(); // Hide loading bar

                    // Notify
                    bsNotify(res.result, res.message);
                },
                error: function() {
                    $('#loader').hide(); // Hide loading bar
                    bsNotify('danger', globalVars.messages.commonError); // Notify for any error
                }
            })
        });
        
    });
</script>
@endpush

@push('css')
<link href="{{ asset('plugins/datatables/datatables.bundle.css?v=1.0.0') }}" rel="stylesheet" type="text/css" />
@endpush
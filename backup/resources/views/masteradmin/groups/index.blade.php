@extends('layouts.app', ['title' => 'Groups'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Groups</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Groups</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">List</a>
                    </li>
                </ul>
                <!-- End Breadcrumb -->
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('groups.create') }}" class="btn btn-primary font-weight-bolder">
            <span class="svg-icon svg-icon-md">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <circle fill="#000000" cx="9" cy="15" r="6" />
                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                    </g>
                </svg>
            </span>New Group</a>
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
                            <th>Group Name</th>
                            <th>Date</th>
                            <th>Company</th>
                            <th>Wpp Group ID</th>
                            <!-- <th>State</th> -->
                            <th>City</th>
                            <!-- <th>District</th>
                            <th>Address</th>
                            <th>Zip Code</th>
                            <th>Legal Name</th>
                            <th>Legal ID</th> -->
                            <th>Password</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->gp_groupname }}</td>
                            <td>{{ \Carbon\Carbon::parse($group->created_at)->format('m/d/Y') }}</td>
                            <td>{{ $group->gp_company }}</td>
                            <td>{{ $group->gp_wpp_group_id }}</td>
                            <!-- <td>{{ $group->gp_state }}</td> -->
                            <td>{{ $group->gp_city }}</td>
                            <!-- <td>{{ $group->gp_district }}</td>
                            <td>{{ $group->gp_address }}</td>
                            <td>{{ $group->gp_zip }}</td>
                            <td>{{ $group->gp_legal_name }}</td>
                            <td>{{ $group->gp_legal_id }}</td> -->
                            <td>{{ $group->gp_temp_psw }}</td>
                            <td>
                                @if ($group->gp_status == 5)
                                    <span class="label label-outline-primary label-pill label-inline">New</span>
                                @elseif ($group->gp_status == 4)
                                    <span class="label label-outline-info label-pill label-inline">Demo</span>
                                @elseif ($group->gp_status == 3)
                                    <span class="label label-outline-dark label-pill label-inline">Canceled</span>
                                @elseif ($group->gp_status == 2)
                                    <span class="label label-outline-warning label-pill label-inline">Attention</span>
                                @elseif ($group->gp_status == 1)
                                    <span class="label label-outline-success label-pill label-inline">Active</span>
                                @endif
                            </td>
                            <td nowrap="nowrap">
                                <a href="{{ route('groups.edit', $group) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                    <i class="la la-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" data-action="{{ route('groups.destroy', $group) }}" data-toggle="modal" data-target="#deleteConfirmModal">
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

@include('layouts.components.modals.delete_confirm_modal', ['modalText' => 'Are you sure? Group will be delete permanently.'])
<!-- End Main Content -->

@endsection


@push('js')
<script src="{{ asset('plugins/datatables/datatables.bundle.js?v=1.0.0') }}"></script>
<script src="{{ asset('js/notify.js') }}"></script>
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
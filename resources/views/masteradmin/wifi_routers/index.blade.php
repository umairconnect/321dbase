@extends('layouts.app', ['title' => 'Wifi Routers'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Wifi Routers</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Wifi Routers</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">List</a>
                    </li>
                </ul>
                <!-- End Breadcrumb -->
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('wifi-routers.create') }}" class="btn btn-primary font-weight-bolder">
            <span class="svg-icon svg-icon-md">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M19.366142,13.9305937 L17.2619853,15.6656848 C15.9733542,14.1029531 14.0626842,13.1818182 11.9984835,13.1818182 C9.94104045,13.1818182 8.03600715,14.0968752 6.74725784,15.6508398 L4.64798148,13.9098472 C6.44949126,11.7375997 9.12064835,10.4545455 11.9984835,10.4545455 C14.8857906,10.4545455 17.5648042,11.7460992 19.366142,13.9305937 Z M23.5459782,10.4257575 L21.4473503,12.1675316 C19.1284914,9.37358605 15.6994058,7.72727273 11.9984835,7.72727273 C8.30267753,7.72727273 4.87785708,9.36900008 2.55893241,12.1563207 L0.462362714,10.4120696 C3.29407133,7.00838857 7.48378666,5 11.9984835,5 C16.519438,5 20.7143528,7.01399004 23.5459782,10.4257575 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M15.1189503,17.3544974 L13.0392442,19.1188213 L11.9619232,20 L10.9331836,19.1485815 L8.80489611,17.4431757 C9.57552634,16.4814558 10.741377,15.9090909 11.9984835,15.9090909 C13.215079,15.9090909 14.347452,16.4450896 15.1189503,17.3544974 Z" fill="#000000"/>
                    </g>
                </svg>
            </span>New Router</a>
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
                            <th>Mac Wan</th>
                            <th>Date</th>
                            <th>Mac Lan</th>
                            <th>Bss ID</th>
                            <th>Nas ID</th>
                            <th>Channel</th>
                            <th>City</th>
                            <th>Router OS</th>
                            <th>Firmware</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wifiRouters as $router)
                        <tr>
                            <td>{{ $router->mac_wan }}</td>
                            <td>{{ \Carbon\Carbon::parse($router->created_at)->format('m/d/Y') }}</td>
                            <td>{{ $router->mac_lan }}</td>
                            <td>{{ $router->bssid }}</td>
                            <td>{{ $router->nasid }}</td>
                            <td>{{ $router->channel }}</td>
                            <td>{{ $router->city }}</td>
                            <td>{{ $router->router_os }}</td>
                            <td>{{ $router->firmware }}</td>
                            <td nowrap="nowrap">
                                <a href="{{ route('wifi-routers.edit', $router) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                                    <i class="la la-edit"></i>
                                </a>
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" data-action="{{ route('wifi-routers.destroy', $router) }}" data-toggle="modal" data-target="#deleteConfirmModal">
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

@include('layouts.components.modals.delete_confirm_modal', ['modalText' => 'Are you sure? Wifi Router will be delete permanently.'])
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
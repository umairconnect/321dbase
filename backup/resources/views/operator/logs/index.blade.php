@extends('layouts.app', ['title' => 'Customers/Sales'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Customers/Sales</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Customers/Sales</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">List</a>
                    </li>
                </ul>
                <!-- End Breadcrumb -->
            </div>
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
                            <th>Customer Name</th>
                            <th>Mobile Number</th>
                            <th>Discount</th>
                            <th>Discount Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $row)
                        <tr>
                            <td>{{ $row->usr_fullname }}</td>
                            <td>{{ $row->usr_mobile }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content -->
@endsection

@push('js')
<script src="{{ asset('plugins/datatables/datatables.bundle.js?v=1.0.0') }}"></script>
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
    });
</script>
@endpush

@push('css')
<link href="{{ asset('plugins/datatables/datatables.bundle.css?v=1.0.0') }}" rel="stylesheet" type="text/css" />
@endpush
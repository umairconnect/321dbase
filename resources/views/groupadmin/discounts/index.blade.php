@extends('layouts.app', ['title' => 'Discounts'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Discounts</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Discounts</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">List</a>
                    </li>
                </ul>
                <!-- End Breadcrumb -->
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="javascript:;" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#addDiscountModal">
            <span class="svg-icon svg-icon-white svg-icon-2x">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000"/>
                </g>
            </svg>
            </span>Add Discount</a>
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
                            <th>Discount Name</th>
                            <th>Date</th>
                            <th>Duration</th>
                            <th>Discount Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $discount)
                        <tr>
                            <td>{{ $discount->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($discount->created_at)->format('m/d/Y') }}</td>
                            <td>{{ $discount->duration }} <span class="text-muted">@if ($discount->duration > 1) days @else day @endif</span></td>
                            <td>{{ $discount->description }}</td>
                            <td nowrap="nowrap">
                                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete" data-action="{{ route('discounts.destroy', $discount) }}" data-toggle="modal" data-target="#deleteConfirmModal">
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
<div class="modal fade" id="addDiscountModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ url('/group/discounts') }}" data-parsley-validate>
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Discount</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>* Discount Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter discount name" required data-parsley-required-message="Please enter discount name." value="{{ old('name') }}" />
                        </div>
                        <div class="form-group col-lg-6">
                            <label>* Duration <small class="text-muted">(days)</small>:</label>
                            <input type="number" name="duration" class="form-control" placeholder="Enter duration" required data-parsley-required-message="Please enter duration." value="{{ old('duration') }}" />
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="d-flex justify-content-between">Discount Comment: <span id="charactersCounter" class="text-muted" style="display: none">0/400 Characters</span></label>
                            <textarea
                                type="textarea"
                                name="description"
                                id="description"
                                rows="5"
                                class="form-control"
                                placeholder="Enter discount comment"
                                data-parsley-maxlength="400"
                                data-parsley-maxlength-message="Maximum must be 400 characters"
                            >{{ old('description') }}</textarea>
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

@include('layouts.components.modals.delete_confirm_modal', ['modalText' => 'Are you sure? Discount will be delete permanently.'])
<!-- End Main Content -->
@endsection

@push('js')
<script src="{{ asset('plugins/datatables/datatables.bundle.js?v=1.0.0') }}"></script>
<script src="{{ asset('plugins') }}/parsleyjs/parsley.min.js"></script>
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

        // Characters counter/limiter
        var textInput = $('#description');
        var counter = $('#charactersCounter');
        textInput.on('input', function () {
            var valLength = textInput.val().length;
            if (valLength > 0) {
                counter.show();
            } else {
                counter.hide();
            }

            counter.html(`${valLength}/400 Characters`);

            if (valLength > 400) {
                counter.removeClass('text-muted').addClass('text-danger');
            } else {
                counter.removeClass('text-danger').addClass('text-muted');
            }
        });
    });
</script>
@endpush

@push('css')
<link href="{{ asset('plugins/datatables/datatables.bundle.css?v=1.0.0') }}" rel="stylesheet" type="text/css" />
@endpush
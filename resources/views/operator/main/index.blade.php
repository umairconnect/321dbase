@extends('layouts.app', ['title' => 'Main'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Main</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Main</a>
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
            <form method="POST" action="{{ route('operator.main.store') }}" id="form" autocomplete="off" data-parsley-validate>
                @csrf
                <div class="card-body">
                <div class="row">
                    <div class="form-group custom-form-group col-sm-6">
                        <label>* Customer Name:</label>
                        <input type="text" name="usr_fullname" class="form-control" placeholder="Enter customer name" required data-parsley-required-message="Please enter customer name." value="{{ old('usr_fullname') }}" />
                    </div>
                    <div class="form-group custom-form-group col-sm-6">
                        <label>* Mobile Number:</label>
                        <input type="text" name="usr_mobile" class="form-control" placeholder="Enter mobile number" required data-parsley-required-message="Please enter mobile number." value="{{ old('usr_mobile') }}" />
                    </div>
                    <div class="form-group custom-form-group col-sm-6">
                        <label>* Discount:</label>
                        <select class="form-control" name="discount_id" required data-parsley-required-message="Please select discount." >
                            <option value="">Select discount</option>
                            @foreach ($discounts as $discount)
                            <option value="{{ $discount->id }}" {{ $discount->id == old('discount_id') ? 'selected' : '' }}>{{ $discount->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group custom-form-group col-sm-6">
                        <label>* Value:</label>
                        <input type="number" name="value" class="form-control" placeholder="Enter value" required data-parsley-required-message="Please enter value." value="{{ old('value') }}" />
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary mr-2" style="font-size: 16px">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Main Content -->

<div class="modal fade" id="updateConfirmModal" tabindex="-1" role="dialog" aria-labelledby="updateConfirmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-muted" id="deleteConfirmModal">ALERT</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                @error('user-already-exist-error') {!! $errors->first('user-already-exist-error') !!} @enderror
                <p>Do you want to update?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="updateConfirm" class="btn btn-danger font-weight-bold" data-dismiss="modal">Update</button>
                <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script src="{{ asset('plugins') }}/parsleyjs/parsley.min.js"></script>
<!-- <script src="{{ asset('plugins') }}/parsleyjs/i18n/pt-br.js"></script> -->

<script>
    @if ($errors->has('user-already-exist-error')) $('#updateConfirmModal').modal(); @endif
</script>

<script>
    $(function () {
        var form = $('#form');
        $('#updateConfirm').on('click', function () {
            form.attr('action', '{{ route("operator.main.update") }}');

            form.submit();
        });
    });
</script>
@endpush
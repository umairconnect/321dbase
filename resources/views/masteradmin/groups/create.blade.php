@extends('layouts.app', ['title' => 'New Group | Groups'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">New Group</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Groups</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">New</a>
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
            <form method="POST" action="{{ route('groups.store') }}" autocomplete="off" data-parsley-validate>
                @csrf
                <div class="card-body">
                    @error('gp_groupname')
                    <div class="alert alert-custom alert-outline-2x alert-outline-danger fade show mb-5" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">The group already exist!</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                            </button>
                        </div>
                    </div>
                    @enderror
                    <div id="group-detail">
                        <h3 class="border-bottom mb-5">Group Detail</h3>
                        <div class="row">
                            <div class="form-group col-lg-5 col-sm-8">
                                <label>* Group Name:</label>
                                <input type="text" name="gp_groupname" class="form-control" placeholder="Enter group name" required data-parsley-required-message="Please enter group name." value="{{ old('gp_groupname') }}" />
                            </div>
                            <div class="form-group col-lg-3 col-sm-4">
                                <label>* Status:</label>
                                <select class="form-control text-capitalize" name="gp_status" required data-parsley-required-message="Please select status." >
                                    <option value="">Select status</option>
                                    @foreach ($groupStatuses as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == old('gp_status') ? 'selected' : '' }}>{{ $row->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                                <label>* Company:</label>
                                <input type="text" name="gp_company" class="form-control" placeholder="Enter company name" required data-parsley-required-message="Please enter company name." value="{{ old('gp_company') }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                                <label>* WPP Group ID:</label>
                                <input type="text" name="gp_wpp_group_id" class="form-control" placeholder="Enter wpp group id" required data-parsley-required-message="Please enter wpp group id." value="{{ old('gp_wpp_group_id') }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-4">
                                <label>* State:</label>
                                <input type="text" name="gp_state" class="form-control" placeholder="Enter state" required data-parsley-required-message="Please enter state." value="{{ old('gp_state') }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-4">
                                <label>* City:</label>
                                <input type="text" name="gp_city" class="form-control" placeholder="Enter city" required data-parsley-required-message="Please enter city." value="{{ old('gp_city') }}" />
                            </div>
                            <div class="form-group col-lg-5 col-sm-4">
                                <label>* District:</label>
                                <input type="text" name="gp_district" class="form-control" placeholder="Enter district" required data-parsley-required-message="Please enter district." value="{{ old('gp_district') }}" />
                            </div>
                            <div class="form-group col-lg-7 col-sm-8">
                                <label>* Address:</label>
                                <input type="text" name="gp_address" class="form-control" placeholder="Enter address" required data-parsley-required-message="Please enter address." value="{{ old('gp_address') }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-4">
                                <label>* Zip Code:</label>
                                <input type="text" name="gp_zip" class="form-control" placeholder="Enter zip code" required data-parsley-required-message="Please enter zip code." value="{{ old('gp_zip') }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                                <label>* Legal Name:</label>
                                <input type="text" name="gp_legal_name" class="form-control" placeholder="Enter legal name" required data-parsley-required-message="Please enter legal name." value="{{ old('gp_legal_name') }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                                <label>* Legal ID:</label>
                                <input type="text" name="gp_legal_id" class="form-control" placeholder="Enter legal id" required data-parsley-required-message="Please enter legal id." value="{{ old('gp_legal_id') }}" />
                            </div>
                        </div>
                    </div>
                    <!-- Group manager account -->
                    <div id="credential-info" class="mt-5">
                        <!-- <h3 class="border-bottom mb-5 mt-5">Account Info</h3> -->
                        <h3 class="border-bottom mb-5 mt-5">Password</h3>
                        <div class="row">
                            <!-- <div class="form-group col-lg-6">
                                <label>* Account Email:</label>
                                <input
                                    type="text"
                                    name="email"
                                    class="form-control"
                                    placeholder="Enter account email"
                                    required data-parsley-type="email"
                                    data-parsley-required-message="Please enter account email."
                                    data-parsley-email-message="Invalid email format."
                                    value="{{ old('email') }}"
                                />
                            </div> -->
                            <div class="form-group col-lg-6">
                                <label>* Password:</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password" required data-parsley-required-message="Please enter password." value="{{ old('gp_psw') }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <a href="{{ route('groups.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Main Content -->
@endsection

@push('js')
<script src="{{ asset('plugins') }}/parsleyjs/parsley.min.js"></script>
<!-- <script src="{{ asset('plugins') }}/parsleyjs/i18n/pt-br.js"></script> -->
@endpush
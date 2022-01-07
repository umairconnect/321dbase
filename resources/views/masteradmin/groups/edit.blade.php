@extends('layouts.app', ['title' => 'Edit Group | Groups'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Edit Group</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Groups</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Edit</a>
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
            <form method="POST" action="{{ route('groups.update', $group) }}" autocomplete="off" data-parsley-validate>
                @csrf
                @method('put')

                <div class="card-body">
                    @error('gp_groupname')
                    <div class="alert alert-custom alert-outline-2x alert-outline-danger fade show mb-5" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Group already exist!</div>
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
                                <input
                                    type="text"
                                    name="gp_groupname"
                                    class="form-control"
                                    placeholder="Enter group name"
                                    required
                                    data-parsley-required-message="Please enter group name." 
                                    value="{{ old('gp_groupname', $group->gp_groupname) }}"
                                />
                            </div>
                            <div class="form-group col-lg-3 col-sm-4">
                                <label>* Status:</label>
                                <select class="form-control text-capitalize" name="gp_status" required data-parsley-required-message="Please select status." >
                                    <option value="">Select status</option>
                                    @foreach ($groupStatuses as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == old('gp_status', $group->gp_status) ? 'selected' : '' }}>{{ $row->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                                <label>* Company:</label>
                                <input type="text" name="gp_company" class="form-control" placeholder="Enter company name" required data-parsley-required-message="Please enter company name." value="{{ old('gp_company', $group->gp_company) }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                                <label>* WPP Group ID:</label>
                                <input type="text" name="gp_wpp_group_id" class="form-control" placeholder="Enter wpp group id" required data-parsley-required-message="Please enter wpp group id." value="{{ old('gp_wpp_group_id', $group->gp_wpp_group_id) }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-4">
                                <label>* State:</label>
                                <input type="text" name="gp_state" class="form-control" placeholder="Enter state" required data-parsley-required-message="Please enter state." value="{{ old('gp_state', $group->gp_state) }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-4">
                                <label>* City:</label>
                                <input type="text" name="gp_city" class="form-control" placeholder="Enter city" required data-parsley-required-message="Please enter city." value="{{ old('city', $group->gp_city) }}" />
                            </div>
                            <div class="form-group col-lg-5 col-sm-4">
                                <label>* District:</label>
                                <input type="text" name="gp_district" class="form-control" placeholder="Enter district" required data-parsley-required-message="Please enter district." value="{{ old('gp_district', $group->gp_district) }}" />
                            </div>
                            <div class="form-group col-lg-7 col-sm-8">
                                <label>* Address:</label>
                                <input type="text" name="gp_address" class="form-control" placeholder="Enter address" required data-parsley-required-message="Please enter address." value="{{ old('address', $group->gp_address) }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-4">
                                <label>* Zip Code:</label>
                                <input type="text" name="gp_zip" class="form-control" placeholder="Enter zip code" required data-parsley-required-message="Please enter zip code." value="{{ old('gp_zip', $group->gp_zip) }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                                <label>* Legal Name:</label>
                                <input type="text" name="gp_legal_name" class="form-control" placeholder="Enter legal name" required data-parsley-required-message="Please enter legal name." value="{{ old('gp_legal_name', $group->gp_legal_name) }}" />
                            </div>
                            <div class="form-group col-lg-4 col-sm-6">
                                <label>* Legal ID:</label>
                                <input type="text" name="gp_legal_id" class="form-control" placeholder="Enter legal id" required data-parsley-required-message="Please enter legal id." value="{{ old('gp_legal_id', $group->gp_legal_id) }}" />
                            </div>
                        </div>
                    </div>
                    <label class="checkbox checkbox-outline checkbox-success mt-5 mb-2">
                        <input type="checkbox" name="account_info_change" id="accountInfoChange" /> Password Change
                        <span></span>
                    </label>
                    <div id="account-info" class="mt-5" style="display: none">
                        <!-- <h3 class="border-bottom mb-5 mt-5">Account Info</h3> -->
                        <div class="row">
                            <!-- <div class="form-group col-md-4 col-sm-12">
                                <label>* Account Email:</label>
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Enter account email"
                                    data-parsley-type="email"
                                    data-parsley-required-message="Please enter account email."
                                    data-parsley-type-message="Invalid email format."
                                    value="{{ old('email', $group->email) }}"
                                />
                            </div> -->
                            <div class="form-group col-md-6 col-sm-6">
                                <label>Password:</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Enter new password"
                                    value="{{ old('password') }}"
                                />
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label>Confirm Password:</label>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm password"
                                    data-parsley-equalto="#password"
                                    data-parsley-equalto-message="Must be matched."
                                    value="{{ old('password_confirmation') }}"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success mr-2 mr-2">Save</button>
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

<script>
    $(function() {
        $('#accountInfoChange').on('change', function() {
            if ($(this).is(':checked')) {
                $('#account-info').show();
                $('#account-info').find('input[name="email"]').attr('required', true);
            } else {
                $('#account-info').hide();
                $('#account-info').find('input[name="email"]').attr('required', false);
            }
        });
    });
</script>
@endpush
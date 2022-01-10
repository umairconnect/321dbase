@extends('layouts.app', ['title' => 'Edit User | Users'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Edit User</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Users</a>
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
            <form method="POST" action="{{ url('/group/users', $user) }}" autocomplete="off" data-parsley-validate>
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
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
                        </div>
                        <div class="form-group col-sm-6">
                            <label>* First Name:</label>
                            <input type="text" name="usr_firstname" class="form-control" placeholder="Enter first name" required data-parsley-required-message="Please enter first name." value="{{ old('usr_firstname', $user->usr_firstname) }}" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label>* Full Name:</label>
                            <input type="text" name="usr_fullname" class="form-control" placeholder="Enter fullname" required data-parsley-required-message="Please enter fullname." value="{{ old('usr_fullname', $user->usr_fullname) }}" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label>* Mobile Number:</label>
                            <input type="text" name="usr_mobile" class="form-control" placeholder="Enter mobile number" required data-parsley-required-message="Please enter mobile number." value="{{ old('usr_mobile', $user->usr_mobile) }}" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label>* DOB:</label>
                            <input type="text" name="usr_dob" class="form-control date-picker" placeholder="Enter DOB" required data-parsley-required-message="Please enter dob." value="{{ old('usr_dob', $user->usr_dob) }}" autocomplete="off" />
                        </div>
                        <!-- <div class="form-group col-sm-4">
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
                                value="{{ old('email', $user->email) }}"
                            />
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Password:</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password" value="{{ old('password') }}" />
                        </div>
                        <div class="form-group col-sm-6">
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
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <a href="{{ route('wifi-routers.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Main Content -->
@endsection

@push('js')
<script src="{{ asset('plugins/parsleyjs/parsley.min.js?v=1.0.0') }}"></script>
<!-- <script src="{{ asset('js/widgets/forms/input-mask.min.js?v=1.0.0') }}"></script> -->

<script>
    $(function() {
        // phone number format
        $(".wifi-router-mac-mask").inputmask("mask", {
            "mask": "[A|9]{2}-[A|9]{2}-[A|9]{2}-[A|9]{2}-[A|9]{2}-[A|9]{2}"
        });
    });
</script>
@endpush
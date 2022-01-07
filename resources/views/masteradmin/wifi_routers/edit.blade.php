@extends('layouts.app', ['title' => 'Edit Wifi Router | Wifi Routers'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Edit Wifi Router</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Wifi Routers</a>
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
            <form method="POST" action="{{ route('wifi-routers.update', $wifiRouter) }}" autocomplete="off" data-parsley-validate>
                @csrf
                @method('put')
                <div class="card-body row">
                    <div class="form-group col-lg-4 col-sm-6">
                        <label>* Mac Wan:</label>
                        <input
                            type="text"
                            name="mac_wan"
                            class="form-control wifi-router-mac-mask"
                            placeholder="Enter Mac Wan"
                            required
                            data-parsley-pattern="^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})|([0-9a-fA-F]{4}\\.[0-9a-fA-F]{4}\\.[0-9a-fA-F]{4})$"
                            data-parsley-pattern-message="Please enter valid value."
                            data-parsley-required-message="Please enter mac wan."
                            value="{{ old('mac_wan', $wifiRouter->mac_wan) }}"
                        />
                    </div>
                    <div class="form-group col-lg-4 col-sm-6">
                        <label>* Mac Lan:</label>
                        <input
                            type="text"
                            name="mac_lan"
                            class="form-control wifi-router-mac-mask"
                            placeholder="Enter Mac Lan"
                            required
                            data-parsley-pattern="^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})|([0-9a-fA-F]{4}\\.[0-9a-fA-F]{4}\\.[0-9a-fA-F]{4})$"
                            data-parsley-pattern-message="Please enter valid value."
                            data-parsley-required-message="Please enter mac lan."
                            value="{{ old('mac_wan', $wifiRouter->mac_lan) }}"
                        />
                    </div>
                    <div class="form-group col-lg-4 col-sm-5">
                        <label>* Bss ID:</label>
                        <input type="text" name="bssid" class="form-control" placeholder="Enter bss id" required data-parsley-required-message="Please enter bss id." value="{{ old('bssid', $wifiRouter->bssid) }}" />
                    </div>
                    <div class="form-group col-lg-2 col-sm-4">
                        <label>* Nas ID:</label>
                        <input type="text" name="nasid" class="form-control" placeholder="Enter nas id" required data-parsley-required-message="Please enter nas id." value="{{ old('nasid', $wifiRouter->nasid) }}" />
                    </div>
                    <div class="form-group col-lg-2 col-sm-3">
                        <label>* Channel:</label>
                        <input type="text" name="channel" class="form-control" placeholder="Enter channel" required data-parsley-required-message="Please enter channel." value="{{ old('channel', $wifiRouter->channel) }}" />
                    </div>
                    <div class="form-group col-lg-3 col-sm-6">
                        <label>* City:</label>
                        <input type="text" name="city" class="form-control" placeholder="Enter city" required data-parsley-required-message="Please enter city." value="{{ old('city', $wifiRouter->city) }}" />
                    </div>
                    <div class="form-group col-lg-3 col-sm-3">
                        <label>* Router OS:</label>
                        <input type="text" name="router_os" class="form-control" placeholder="Enter router os" value="{{ old('router_os', $wifiRouter->router_os) }}" />
                    </div>
                    <div class="form-group col-lg-2 col-sm-3">
                        <label>* Firmware:</label>
                        <input type="text" name="firmware" class="form-control" placeholder="Enter firmware" value="{{ old('firmware', $wifiRouter->firmware) }}" />
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
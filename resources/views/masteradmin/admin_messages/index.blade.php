@extends('layouts.app', ['title' => 'Wifi Routers'])

@section('content')
<!-- Page header -->
<div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
    <div class="container-fluid mx-lg-5 d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline mr-5">
                <h5 class="text-dark font-weight-bold my-2 mr-5">Admin Messages</h5>
                <!-- Breadcrumb -->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">Admin Messages</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="" class="text-muted">List/Edit</a>
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
        @foreach ($adminMessages as $adminMessage)
        <div class="card card-custom mt-5">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label" title="Admin Message Type">
                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo7\dist/../src/media/svg/icons\Code\Compiling.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"/>
                                <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                        [{{ $adminMessage->msg_type }}]
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('admin-messages.update', $adminMessage) }}">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="image-input image-input-outline">
                                <div class="image-preview-wrapper">
                                    <img class="default-img" src="{{ $adminMessage->msg_img ? "/storage/{$adminMessage->msg_img}" : '/images/Picture.svg' }}" />

                                    <!-- Preview Image -->
                                    <img class="preview-img" src="" style="display: none" />
                                </div>

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change image">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel image">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-9 mt-5 mt-md-0">
                            <label>Message Body</label>
                            <textarea class="form-control" name="msg_body" rows="5">{{ old('msg_body', $adminMessage->msg_body) }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center pt-5">
                            <button type="submit" class="btn btn-success mr-2">Save</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- End Main Content -->
@endsection

@push('js')
<script>
    $(function() {
        $('input:file').on('change', function() {
            var imgUrl = window.URL.createObjectURL(this.files[0]);
            var $parentWrapper = $(this).parents('.image-input');

            $parentWrapper.find('.image-preview-wrapper .default-img').hide();
            $parentWrapper.find('.image-preview-wrapper .preview-img').attr('src', imgUrl).show();
            $parentWrapper.find('[data-action="cancel"]').show();
        });

        $('[data-action="cancel"]').on('click', function() {
            var $parentWrapper = $(this).parents('.image-input');

            $parentWrapper.find('.image-preview-wrapper .preview-img').attr('src', '').hide();
            $parentWrapper.find('.image-preview-wrapper .default-img').show();
            $parentWrapper.find('[data-action="cancel"]').hide();
            $parentWrapper.find('input:file').val('');
        });
    });
</script>
@endpush
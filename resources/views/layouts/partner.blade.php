@extends('layouts.app', ['title' => 'Partnner List'])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom">
                 <div class="card-body">
                <table class="table table-separate table-hover table-checkable dataTable no-footer dtr-inline" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Mobile</th>
                        <th>City</th>
                        <th>Description</th>
                        <th>Partnertype</th>
                        <th>Current Service</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lists as $list)
                        <tr>
                            <th>{{ $list['name'] }}</th>
                            <th>{{ $list['type'] }}</th>
                            <th>{{ $list['mobile'] }}</th>
                            <th>{{ $list['city'] }}</th>
                            <th>{{ $list['description'] }}</th>
                            <th>{{ $list['partnertype'] }}</th>
                            <th>{{ $list['currentservice'] }}</th>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                <span>
  {{ $lists->links() }}
</span>


        </div>
            </div>
    </div>
</div>


@endsection


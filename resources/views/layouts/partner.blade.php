@extends('layouts.app', ['title' => 'Partnner List'])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-custom">
                 <div class="card-body mb-4">
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
                            <td>{{ $list['name'] }}</td>
                            <td>{{ $list['type'] }}</td>
                            <td>{{ $list['mobile'] }}</td>
                            <td>{{ $list['city'] }}</td>
                            <td>{{ $list['description'] }}</td>
                            <td>{{ $list['partnertype'] }}</td>
                            <td>{{ $list['currentservice'] }}</td>
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


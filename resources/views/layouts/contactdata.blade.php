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
                                <th>Mobile</th>
                                <th>Comments</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lists as $list)
                                <tr>
                                    <td>{{ $list['name'] }}</td>
                                    <td>{{ $list['mobile'] }}</td>
                                    <td>{{ $list['Comments'] }}</td>

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


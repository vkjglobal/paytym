@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Meeting Details</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <div class="col-12 mb-2">Meeting Title : <strong>{{ optional($meeting)->name ?? 'No data' }}</strong></div>
                                <div class="col-12 mb-2">Location : <strong>{{ optional($meeting)->location ?? 'No data' }}</strong></div>
                                <div class="col-12 mb-2">Date : <strong>{{optional(\Carbon\Carbon::createFromFormat('Y-m-d', $meeting->date))->format('d-m-Y') ?? 'No data'}}</strong></div>
                                <div class="col-12 mb-2">Start Time : <strong>{{ optional( \Carbon\Carbon::createFromFormat('H:i', $meeting->start_time))->format('h:i A') ?? 'No data' }}</strong></div>
                                <div class="col-12 mb-2">End Time : <strong>{{ optional( \Carbon\Carbon::createFromFormat('H:i', $meeting->end_time))->format('h:i A') ?? 'No data' }}</strong></div>
                                <div class="col-12 mb-2">Agenda : <strong>{{ optional($meeting)->agenda ?? 'No data' }}</strong></div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                
                            </div>

</div>
                        <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">List of Attendees</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendees as $attendee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ optional($attendee->users)->first_name ?? 'No data' }}</td>
                                        <td>{{ optional($attendee->users)->email ?? 'No data' }}</td>
                                     
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></div></div></div>
   
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
   
@endpush
@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Meetings</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Location</th>
                                    <th>Agenda</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meetings as $meeting)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $meeting->name }}</td>
                                        <td>{{optional(\Carbon\Carbon::createFromFormat('Y-m-d', $meeting->date))->format('d-m-Y') ?? 'No data'}}</td>
                                        <td>{{ optional(\Carbon\Carbon::createFromFormat('H:i', $meeting->start_time))->format('h:i A') ?? 'No data'}}</td>
                                        <td>{{ optional(\Carbon\Carbon::createFromFormat('H:i', $meeting->end_time))->format('h:i A') }}? 'No data'</td>
                                        <td>{{ $meeting->location }}</td>
                                        <td>{{ $meeting->agenda }}</td>
                                       {{--<td>
                                            <input data-id="{{ $meeting->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $meeting->status ? 'checked' : '' }}>
                                        </td>--}} 
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <form method="GET" action ="{{route('employer.meeting.details',$meeting->id)}}">
                                                <button  type="submit"  class="mr-3"><span class="btn btn-success">View Attendees</span></button>
                                             </form>
                                                <!-- Edit button -->
                                                <a href="{{ Route('employer.meeting.edit', $meeting->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $meeting->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $meeting->id }}"
                                                    action="{{ route('employer.meeting.destroy', $meeting->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var event_id = $(this).data('id');
                console.log(event_id);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('employer.event.change.status') }}',
                    data: {
                        'status': status,
                        'event_id': event_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
@endpush
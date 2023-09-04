@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Advance Requests</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Sl #</th>
                                <th>Employee Name</th>
                                <th>Business</th>
                                <th>Requested Amount</th>
                                <th>Requested Date</th>
                                <th>Accept/Reject</th>
                                <th>Status</th>
                                <!-- <th>Actions</th> -->
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($advance_request as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $request->user->first_name }} {{ $request->user->last_name }}</td>
                                <td>@if($request->user->business->name)
                                    {{ $request->user->business->name }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>@if($request->advance_amount)
                                    {{ $request->advance_amount }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>@if($request->requested_date)
                                    {{ $request->requested_date }}
                                    @else
                                    -
                                    @endif
                                </td>

                              
                                <!-- <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <a href="{{ route('employer.advance.edit', $request->id) }}" class="mr-1 text-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i data-feather="edit"></i>
                                        </a>

                                        <button type="button" class="text-danger" onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $request->id }}').submit();}" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i data-feather="trash"></i>
                                        </button>
                                        <form id="delete-data-{{ $request->id }}" action="{{ route('employer.advance.destroy', $request->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </div>
                                </td> -->
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_{{ $request->id}}">
                                        Click
                                    </button>
                                </td>
                                <td>@if($request->status == '0')
                                    <span class="badge badge-warning">Requested</span>
                                    @elseif($request->status == '1')
                                    <span class="badge badge-success">Accepted</span>
                                    @else
                                    <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>

                            </tr>
                            <!-- The Modal -->
<div class="modal" id="myModal_{{ $request->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Title</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <!-- Your form goes here -->
                <form method="GET" action="{{ route('employer.advance.respond_advance_request') }}">
                    @csrf
                    <!-- Your form fields -->
                    <input type="hidden" id="request_id"  name="request_id" value="{{ $request->id }}" >
                    <div class="form-group">
                        <label for="exampleInputEmail1">Requested Amount</label>
                        <input type="text" readonly class="form-control" id="requested_amount" name="requested_amount" value="{{ $request->advance_amount }}" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <!-- Other form fields -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Requested Date</label>
                        <input type="text" readonly class="form-control" id="requested_date" name="requested_date" value="{{ $request->requested_date }}" aria-describedby="emailHelp" placeholder="Requested Date">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Reason For Request</label>
                        <textarea readonly class="form-control" id="reason" name="reason">{{ $request->description }}</textarea>
                    </div>

             

                    <!-- Submit button -->
                    <button type="submit"  name="action" value="1" class="btn btn-success">Accept</button>
                <button type="submit" name="action" value="2" class="btn btn-danger">Reject</button>
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
            var department_id = $(this).data('id');
            console.log(department_id);

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('employer.department.change.status') }}',
                data: {
                    'status': status,
                    'department_id': department_id
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        })
    })
</script>
@endpush





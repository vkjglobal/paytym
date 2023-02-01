@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Leave Requests</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <th>Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaveRequests as $leaveRequest)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $leaveRequest->user->first_name }}</td>
                                        <td>{{ $leaveRequest->title }}</td>
                                        <td>{{ $leaveRequest->start_date }}</td>
                                        <td>{{ $leaveRequest->end_date }}</td>
                                        <td>{{ $leaveRequest->type }}</td>
                                        <td class="status_{{$leaveRequest->id}}">
                                            @if ($leaveRequest->status == 1)
                                                <span class="btn btn-success">{{ $leaveRequest->statusCheck() }}</span>
                                            @elseif ($leaveRequest->status == 2)
                                                <span class="btn btn-danger">{{ $leaveRequest->statusCheck() }}</span>
                                            @else
                                                <span class="btn btn-secondary">{{ $leaveRequest->statusCheck() }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <!-- Change Status button -->
                                                <form method="GET" action="{{route('employer.leave.requests.status', $leaveRequest->id)}}">
                                                    {{-- <a type="button" id="approve" class="approve"
                                                        data-id="{{ $leaveRequest->id }}"
                                                        href="{{route('employer.leave.requests.status')}}"> 
                                                        <i data-feather="check" style="color:#4BB543;"></i>
                                                    </a> --}}
                                                    <button name="approve" type="submit" value="1"><i data-feather="check" style="color:#4BB543;"></i></button>

                                                    {{-- <a type="button" class="text-danger mr-2 reject" id="reject"
                                                    data-id="{{ $leaveRequest->id }}" > 
                                                        <i data-feather="x" ></i>
                                                    </a> --}}
                                                
                                                    <button name="reject" type="submit" value="2" class="text-danger mr-2"><i data-feather="x" ></i></button>

                                                </form>

                                                <!-- Change Status ends -->

                                                <!-- Delete button -->
                                                @if($leaveRequest->status != 0)
                                                    <button type="button" class="text-danger"
                                                        onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $leaveRequest->id }}').submit();}"
                                                        data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i data-feather="trash"></i>
                                                    </button>
                                                    <form id="delete-data-{{ $leaveRequest->id }}"
                                                        action="{{ route('employer.leave.requests.delete', $leaveRequest->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @else
                                                    <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); alert('Approve or Reject request before deleting')"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash" style="color:#D3D3D3;"></i>
                                                    </button>
                                                @endif
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
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
    {{-- <script>
        $(function() {
            $('.approve').on('click', function() {
                var status = 1;
                var req_id = $(this).data('id');
                console.log(req_id);
                $.ajax({
                    type:'GET',
                    url:'{{route('employer.leave.requests.status')}}',
                    data: {
                        'status': status,
                        'req_id': req_id,
                    },
                    success: function(result){
                        console.log(result);
                        // $(".status").html(data);  
                        $.each(result, function(index, item) {
                        if (item.id === req_id) {
                            $("#status_" + item.id).html(item.status);
                            return false;   
                        }
                    });
                    }
                }); 
            });
            $('.reject').on('click', function() {
                var status = 2;
                var req_id = $(this).data('id');
                console.log(req_id);
                $.ajax({
                    type:'GET',
                    url:'{{route('employer.leave.requests.status')}}',
                    data: {
                        'status': status,
                        'req_id': req_id,
                    },
                    sucess: function(data){
                        console.log(data);
                        $(".status").html(data);
                    }
                }); 
            });      
        })
    </script> --}}
@endpush

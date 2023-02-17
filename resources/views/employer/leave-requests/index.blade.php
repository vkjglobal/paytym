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
                                    <th>Reject Message</th>
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
                                                    <button name="approve" type="submit" value="1" title="Approve" >
                                                        <i data-feather="check" style="color:#4BB543;" ></i>
                                                    </button>
                                                    {{-- <a type="button" class="text-danger mr-2 reject" id="reject"
                                                    data-id="{{ $leaveRequest->id }}" > 
                                                        <i data-feather="x" ></i>
                                                    </a> --}}
                                                
                                                    <button name="reject" type="submit" value="2" class="text-danger mr-2" title="Reject">
                                                        <i data-feather="x" ></i>
                                                    </button>

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
                                        <td>
                                            @if($leaveRequest->status == 2)
                                            <button name="reject" type="submit" value="2" class="text-info mr-2" title="Reject"
                                                    data-toggle="modal" data-target="#exampleModal_{{$leaveRequest->id}}">
                                                        <i data-feather="message-square" ></i>
                                            </button>
                                            @else
                                            <button name="reject" type="button"  class="text-secondary mr-2" title="Reject">
                                                        <i data-feather="message-square" ></i>
                                            </button>
                                            @endif

                                            <!-- Send Reply Modal -->
                                            <div class="modal fade" id="exampleModal_{{$leaveRequest->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Send Contact Reply</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ route('employer.leave.requests.message', $leaveRequest->id) }}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="reply_message">Reply Message</label>
                                                                <textarea class="form-control" name="message" rows="3" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Send Reply</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Send Reply Modal Ends -->
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
    {{-- <script type="text/javascript">
        function deleteConfirmation(id) {
            swal.fire({
                title: "Delete?",
                icon: 'question',
                text: "Please ensure and then confirm!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: !0
            }).then(function (e) {
    
                if (e.value === true) {
                    let token = $('meta[name="csrf-token"]').attr('content');
                    let _url = `/users/delete/${id}`;
    
                    $.ajax({
                        type: 'POST',
                        url: _url,
                        data: {_token: token},
                        success: function (resp) {
                            if (resp.success) {
                                swal.fire("Done!", resp.message, "success");
                                location.reload();
                            } else {
                                swal.fire("Error!", 'Sumething went wrong.', "error");
                            }
                        },
                        error: function (resp) {
                            swal.fire("Error!", 'Sumething went wrong.', "error");
                        }
                    });
    
                } else {
                    e.dismiss;
                }
    
            }, function (dismiss) {
                return false;
            })
        }
    </script> --}}
@endpush

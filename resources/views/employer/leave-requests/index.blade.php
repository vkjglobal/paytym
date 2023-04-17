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
                                    <th>Message Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaveRequests as $leaveRequest)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@isset($leaveRequest->user->first_name)
                                            {{ $leaveRequest->user->first_name }}
                                        @endisset</td>
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

                                                <!-- Change Status button approve -->
                                                <button name="approve" type="submit" value="1" title="Approve" data-toggle="modal" data-target="#exampleModalApprove_{{$leaveRequest->id}}">
                                                    <i data-feather="check" style="color:#4BB543;" ></i>
                                                </button>

                                                <!-- Send Reply Modal Approve -->
                                                <div class="modal fade" id="exampleModalApprove_{{$leaveRequest->id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabelApprove">Leave Request Message</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="GET" action="{{ route('employer.leave.requests.status', $leaveRequest->id) }}">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="reply_message">Reply Message</label>
                                                                        <textarea class="form-control" name="message" rows="3" required></textarea>
                                                                        <input type="hidden" name="approve" value="1">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Send Reply Modal Ends Approve -->
                                            
                                                <!-- Change Status button Reject -->
                                                <button name="reject" type="submit" value="2" class="text-danger mr-2" title="Reject" data-toggle="modal" data-target="#exampleModalReject_{{$leaveRequest->id}}">
                                                    <i data-feather="x" ></i>
                                                </button>

                                                <!-- Send Reply Modal Reject -->
                                                <div class="modal fade" id="exampleModalReject_{{$leaveRequest->id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabelReject">Leave Request Message</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form method="GET" action="{{ route('employer.leave.requests.status', $leaveRequest->id) }}">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="reply_message">Reply Message</label>
                                                                        <textarea class="form-control" name="message" rows="3" required></textarea>
                                                                        <input type="hidden" name="reject" value="2">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger">Reject</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Send Reply Modal Ends Reject -->
                                                
                                                <form method="GET" action="{{route('employer.leave.requests.status', $leaveRequest->id)}}">
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
                                            @if($leaveRequest->status == 0)
                                            <button name="reject" type="button"  class=" text-secondary mr-2" title="Message">
                                                <i data-feather="message-square" ></i>
                                            </button>
                                            
                                            @else
                                            <button name="reject" type="submit" value="2" class="{{$leaveRequest->status == '1' ? 'text-success' : 'text-danger'}} mr-2" title="Message"
                                                    data-toggle="modal" data-target="#exampleModal_{{$leaveRequest->id}}">
                                                        <i data-feather="message-square" ></i>
                                            </button>
                                            @endif

                                            <!-- Send Reply Modal Show -->
                                            <div class="modal fade" id="exampleModal_{{$leaveRequest->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Leave Request Message</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form>
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="reply_message">Status</label>
                                                                <input type="text" class="form-control" value="{{$leaveRequest->status == '1' ? 'Approved' : 'Rejected'}}" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="reply_message">Reply Message</label>
                                                                <textarea class="form-control" name="message" rows="3" disabled>{{$leaveRequest->reason}}</textarea>
                                                            </div>
                                                        </div>
                                                        
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Send Reply Modal Ends Show -->
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

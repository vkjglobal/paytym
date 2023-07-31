@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Support Tickets</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Sl #</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supportTicket as $supportTicket)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $supportTicket->subject }}</td>
                                <td>{{ $supportTicket->message }}</td>
                                <!-- <td>
                                            <input data-id="{{ $supportTicket->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Open" data-off="Closed"
                                                {{ $supportTicket->status ? 'checked' : '' }}>
                                        </td> -->
                                <td>


                                    @if($supportTicket->status == 1)

                                    <input type="submit" class="btn btn-success" value="Open" />
                                    @else
                                    <input type="submit" class="btn btn-danger" value="Closed" />


                                </td>
                                @endif
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a data-toggle="modal" data-target="#sharePublicInfo{{ $supportTicket->id }}" class="mr-1 text-info share-info-btn" data-message="{{ $supportTicket->message }}" data-toggle="tooltip" data-placement="top" title="Share Information">
                                            <i data-feather="eye"></i>
                                        </a>
                                        <!-- Edit button -->
                                        <a href="{{ route('employer.supportticket.edit', $supportTicket->id) }}" class="mr-1 text-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i data-feather="edit"></i>
                                        </a>

                                        <!-- Delete button -->
                                        <button type="button" class="text-danger" onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $supportTicket->id }}').submit();}" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i data-feather="trash"></i>
                                        </button>
                                        <form id="delete-data-{{ $supportTicket->id }}" action="{{ route('employer.supportticket.destroy', $supportTicket->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            <!-- view message modal start-->
                            <div class="modal fade" id="sharePublicInfo{{ $supportTicket->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Send info</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="reply_message">View Message</label>
                                            </div>
                                            <p>
                                            {{$supportTicket->message}}
                                            </p><br>
                                            <div class="form-group">
                                                <label for="reply_message">Reply Message</label>
                                            </div>
                                            <p>
                                            {{ optional($supportTicket->reply()->latest()->first())->reply ?: 'No reply yet' }}

                                            </p>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- view message modal start-->
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
            var supportticket_id = $(this).data('id');
            console.log(supportticket_id);

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('employer.supportticket.change.status')}}',
                data: {
                    'status': status,
                    'supportticket_id': supportticket_id
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('.share-info-btn').click(function() {
            var msg = $(this).data('message');
            $("textarea#messages").val(msg);
            
        });
    });
</script>

@endpush
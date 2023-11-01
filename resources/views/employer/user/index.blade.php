@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Users</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Branch</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Medical</th>
                                    {{--<th>FRCS</th>--}}
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count() >0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ optional($user->business)->name ?? 'no data' }}</td>
                                        <td>@isset($user->branch->name)
                                            {{ $user->branch->name }}
                                        @endisset</td>
                                        

                                        <!-- <td>
                                            <input data-id="{{ $user->id }}" class="toggle-class" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $user->status ? 'checked' : '' }}>
                                        </td> -->
                                        <td>
                                        <button data-id="{{ $user->id }}" class="status-btn btn {{ $user->status ? 'btn-success' : 'btn-danger' }} btn-fixed-width">
                                            {{ $user->status ? 'Active' : 'Inactive' }}
                                        </button>
                                        </td>


                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <a data-toggle="modal" data-target="#sharePublicInfo" data-user-id="{{ $user->id }}"
                                                    class="mr-1 text-info share-info-btn" data-toggle="tooltip" data-placement="top"
                                                    title="Share Information">
                                                    
                                                    <i data-feather="share"></i>
                                                </a>
                                                <!-- Edit button -->
                                                <a href="{{ route('employer.user.edit', $user->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $user->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $user->id }}"
                                                    action="{{ route('employer.user.destroy', $user->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </div>
                                        </td>
                                        <td>
                                            {{-- @isset($user->extra_details)
                                            {{$user->extra_details}}
                                            @endisset --}}
                                            @if($user->extra_details)
                                            <a href="{{route('employer.medical.show', $user->id)}}"><i data-feather="eye"></i></a>
                                            @else
                                            <a href="{{route('employer.medical.add', $user->id)}}" class="text-success"><i data-feather="plus"></i></a>
                                            @endif
                                        </td>
                                        {{--<td>
                                          
                                            @if($user->frcs)
                                            <a href="{{route('employer.frcs.show', $user->id)}}"><i data-feather="eye"></i></a>
                                            @else
                                            <a href="{{route('employer.frcs.add', $user->id)}}" class="text-success"><i data-feather="plus"></i></a>
                                            @endif
                                        </td>--}}
                                    </tr>
                                    
                                @endforeach
                                   <!-- Add Modal -->
    <div class="modal fade" id="sharePublicInfo" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Send info</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('employer.user.user-shareinfo',$user->id) }}">
                                            @csrf
                                            <div class="modal-body">
                                                
                                                <div class="form-group">
                                                    <label for="reply_message">Recipient Mail</label>
                                                    <input type="email" class="form-control" name="recipient_mail"  required>
                                                </div>
                                                <input type="hidden" name="user_id" id="share-info-user-id" value="">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Modal Ends -->
                                @else
                                <tr><td> <span  style="color:red;">No data found</span></td></tr>
                                @endif
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
    $('.status-btn').click(function(event) {
        event.preventDefault(); // prevent default action

        var status = $(this).hasClass('btn-success') ? 0 : 1;
        var user_id = $(this).data('id');

        var confirmed = confirm("Are you sure you want to change the status?");
        if (confirmed) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('employer.user.changestatus') }}',
                data: {
                    'status': status,
                    'user_id': user_id
                },
                success: function(data) {
                    console.log(data.success);
                    var newStatus = (status == 1) ? 'Active' : 'Inactive';
                    var newClass = (status == 1) ? 'btn-success' : 'btn-danger';
                    $(this).text(newStatus).removeClass('btn-success btn-danger').addClass(newClass);
                }.bind(this)
            });
        }
    });
});


        // $(function() {
        //     $('.toggle-class').change(function() {
        //         var status = $(this).prop('checked') == true ? 1 : 0;
        //         var user_id = $(this).data('id');
        //         console.log(user_id);

        //         $.ajax({
        //             type: "GET",
        //             dataType: "json",
        //             url: '{{ route('employer.user.changestatus') }}',
        //             data: {
        //                 'status': status,
        //                 'user_id': user_id
        //             },
        //             success: function(data) {
        //                 console.log(data.success)
        //             }
        //         });
        //     })
        // })
    </script>
    <script>
    $(document).ready(function() {
        $('.share-info-btn').click(function() {
            var userId = $(this).data('user-id');
            $('#share-info-user-id').val(userId);
        });
    });
</script>
@endpush
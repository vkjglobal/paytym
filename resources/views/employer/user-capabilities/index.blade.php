@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">User Capabilities</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>User Role</th>
                                    <th>Wages</th>
                                    <th>Projects</th>
                                    <th>Attendance</th>
                                    <th>Approve Attendance</th>
                                    <th>Medical</th>
                                    <th>Contract Period</th>
                                    <th>Deductions</th>
                                    <th>Create chat groups</th>
                                    <th>create Meetings</th>
                                    <th>Approve Leaves</th>
                                    <th>View Payroll</th>
                                    <th>Approve Payroll</th>
                                    <th>Calculate Payroll</th>
                                    <th>Edit Deductions</th>

                                    <!-- <th>Status</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usercapability as $usercapability)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <th>{{$usercapability->role->role_name}}</th>
                                        <td>@if( $usercapability->wages == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->projects == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->attendance == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->approve_attendance == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->medical == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->contract_period == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->deductions == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->create_chat_groups == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->create_meetings == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->approve_leaves == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->view_payroll == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->approve_payroll == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->calculate_payroll == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        <td>
                                        @if( $usercapability->edit_deduction == 1)
                                            Yes
                                            @else
                                            No
                                            @endif
                                        </td>
                                        
                                        
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <!-- Edit button -->
                                                <a href="{{ route('employer.usercapabilities.edit', $usercapability->id) }}"
                                                    class="mr-1 text-warning" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i data-feather="edit"></i>
                                                </a>
                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $usercapability->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $usercapability->id }}"
                                                    action="{{ route('employer.usercapabilities.destroy', $usercapability->id) }}"
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
   <!--  <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var benefit_id = $(this).data('id');
                
                console.log(cms_id);

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('employer.benefit.change.status') }}',
                    data: {
                        'status': status,
                        'benefit_id': benefit_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script> -->
@endpush

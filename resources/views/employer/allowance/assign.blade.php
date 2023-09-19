@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title float-left m-2">Assign Allowance</h6>
                <button name="reject" type="submit" value="" class="btn btn-success m-3 float-right" title="ADD" data-toggle="modal" data-target="#assignallowance">
                    ADD
                </button>

                <!-- Add Modal -->
                <div class="modal fade" id="assignallowance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Allowance</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('employer.assignallowance.store') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label">Business<span class="text-danger"></span></label>
                                        <select name="business" id="business1" class="@if ($errors->has('business')) is-invalid @endif">
                                            <option selected="true" value="">-SELECT-</option>
                                            <option value="0">All Business</option>
                                            @foreach($businesses as $business)
                                            <option value="{{$business->id}}">{{$business->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                                    </div>
                                    <div class="form-group" id="branch_div">
                                        <label class="control-label">Branch<span class="text-danger"></span></label>
                                        <select name="branch" id="branch1" class="@if ($errors->has('branch')) is-invalid @endif">
                                            <option selected="true" value="">-SELECT-</option>
                                            <option value="0">All Branch</option>
                                            @foreach($branches as $branch)
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('branch') }}</div>
                                    </div>
                                    <div class="form-group" id="department_div">
                                        <label class="control-label">Department<span class="text-danger"></span></label>
                                        <select name="department" id="department" class="@if ($errors->has('department')) is-invalid @endif">
                                            <option selected="true" value="">-SELECT-</option>
                                            <option value="0">All Department</option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->dep_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                                    </div>
                                    <div class="form-group" id="user_div">
                                        <label for="reply_message">User</label>
                                        <select name="employee_id" id="user">
                                            <option disabled="disabled" selected>Select User</option>
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="reply_message">Allowance Type</label>
                                        <select name="allowance" id="">
                                            <option disabled="disabled" selected>Select Allowance</option>
                                            @foreach($allowances as $allowance)
                                            <option value="{{$allowance->id}}">{{$allowance->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="reply_message">Allowance Amount</label>
                                        <input type="number" class="form-control" name="rate" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">ADD</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Add Modal Ends -->
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Sl #</th>
                                <th>Name</th>
                                <th>Allowance Type</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assign_allowances as $assign_allowance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $assign_allowance->employee->first_name }}</td>
                                <td>{{ $assign_allowance->allowance->type }}</td>
                                <td>{{ $assign_allowance->rate }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <button name="reject" type="submit" value="2" class="text-warning mr-2" title="Reject" data-toggle="modal" data-target="#assignallowanceupdate{{$assign_allowance->id}}">
                                            <i data-feather="edit"></i>
                                        </button>

                                        <!-- Send Reply Modal -->
                                        <div class="modal fade" id="assignallowanceupdate{{$assign_allowance->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Update Allowance</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ route('employer.assignallowance.update', $assign_allowance->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="reply_message">User</label>
                                                                <select name="employee_id" required disabled>
                                                                    <datalist>
                                                                        <option disabled="disabled">Select User</option>
                                                                        @foreach($users as $user)
                                                                        <option {{ old('employee_id', $user->id)==$assign_allowance->user_id ? "selected" : "" }} value="{{$user->id}}" disabled="disabled">{{$user->first_name}}</option>
                                                                        @endforeach
                                                                    </datalist>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="reply_message">Allowance Type</label>
                                                                <select name="allowance" id="" required>
                                                                    <option disabled="disabled" selected>Select Allowance</option>
                                                                    @foreach($allowances as $allowance)
                                                                    <option {{ old('employee_id', $allowance->id)==$assign_allowance->allowance_id ? "selected" : "" }} value="{{$allowance->id}}">{{$allowance->type}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="reply_message">Allowance Amount</label>
                                                                <input type="number" class="form-control" name="rate" value="{{old('rate', $assign_allowance->rate)}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">UPDATE</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Send Reply Modal Ends -->

                                        <!-- Delete button -->
                                        <button type="button" class="text-danger" onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $assign_allowance->id }}').submit();}" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i data-feather="trash"></i>
                                        </button>
                                        <form id="delete-data-{{ $assign_allowance->id }}" action="{{ route('employer.assignallowance.destroy', $assign_allowance->id ) }}" method="POST">
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
<script type="text/javascript">
    let token = "{{csrf_token()}}";
    (function($) {
        $('#business1').change(function(e) {
            var id = $(this).val();
            $('#branch1').find('option').not(':first').remove();
            if (id == 0) {
                $("#branch_div").hide();
                $("#department_div").hide();
                $("#user_div").hide();

            } else {
                $("#branch_div").show();
                $("#department_div").show();
                $("#user_div").show();

                
                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_branch/' + id,
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response != null) {
                            len = response['data'].length;
                        }
                        if (len > 0) {
                            var option1="<option value='0'>All Branch</option>";
                            $('#branch1').append(option1);
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;
                                var option="<option value='" + id + "'>" + name + "</option>";
                                $('#branch1').append(option);
                            }
                        }
                    }
                });
            }
        });
        $('#branch1').change(function(e) {
            var id = $(this).val();
            $('#department').find('option').not(':first').remove();
            if (id == 0) {

                $("#department_div").hide();
                $("#user_div").hide();
               
            } else {
                $("#department_div").show();
                $("#user_div").show();

          
                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_department/' + id,
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response != null) {
                            len = response['data'].length;
                        }
                        if (len > 0) {
                            var option1="<option value='0'>All Department</option>";
                            $('#department').append(option1);
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].dep_name;
                                var option = "<option value='" + id + "'>" + name + "</option>";
                                $('#department').append(option);
                            }
                        }
                    }
                });
            }
        });

        $('#department').change(function(e) {
            var id = $(this).val();
            $('#user').find('option').not(':first').remove();

            if (id == 0) {
                $("#user_div").hide();
            } else {
                $("#user_div").show();

        
                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_user/' + id,
                    dataType: 'json',
                    success: function(response) {
                        var len = 0;
                        if (response != null) {
                            len = response['data'].length;
                        }
                        if (len > 0) {
                            var option1="<option value='0'>All User</option>";
                            $('#user').append(option1);
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].id;
                                var name = response['data'][i].first_name;
                                var option = "<option value='" + id + "'>" + name + "</option>";
                                $('#user').append(option);
                            }
                        }
                    }
                });
            }
        });
    })(jQuery);
</script>

@endpush
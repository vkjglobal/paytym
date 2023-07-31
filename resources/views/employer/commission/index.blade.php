@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                        <h6 class="card-title float-left m-2">Commission</h6>
                        <button name="reject" type="submit" value="" class="btn btn-success m-3 float-right" title="Reject"
                             data-toggle="modal" data-target="#addcommission">
                                ADD
                        </button>

                        <!-- Update Modal -->
                                <div class="modal fade" id="addcommission" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Commission</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('employer.commission.store') }}">
                                            @csrf
                                            <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label">Business<span class="text-danger">*</span></label>
                                <select name="type_id" id="business_id"  class="@if ($errors->has('type_id')) is-invalid @endif">
                                    <option selected="true" disabled="disabled" >Select Business</option>
                                    @foreach($businesses as $business)
                                        <option value="{{$business->id}}">{{$business->name}}</option>
                                    @endforeach
                                </select>                                
                                <div class="invalid-feedback">{{ $errors->first('type_id') }}</div>
                            </div>


                            <div class="form-group">
                                <label class="control-label">Branch<span class="text-danger">*</span></label>
                                <select name="type_id" id="branch_id" class="@if ($errors->has('type_id')) is-invalid @endif">
                                    <option selected="true"  >Select Branch</option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                </select>                                
                                <div class="invalid-feedback">{{ $errors->first('type_id') }}</div>
                            </div>



                            <div class="form-group">
                                <label class="control-label">Department<span class="text-danger">*</span></label>
                                <select name="type_id" id="department_id" class="@if ($errors->has('type_id')) is-invalid @endif">
                                    <option selected="true"  >Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->dep_name}}</option>
                                    @endforeach
                                </select>                                
                                <div class="invalid-feedback">{{ $errors->first('type_id') }}</div>
                            </div>



                                                <div class="form-group">
                                                    <label for="reply_message">User</label>
                                                    <select name="employee_id"  id="employee_id" required>
                                                        <option disabled="disabled" selected>Select User</option>
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->first_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">{{ $errors->first('employee_id') }}</div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="reply_message">Commission Amount</label>
                                                    <input type="number" step=any class="form-control" name="rate"  required>
                                                    <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">ADD</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Update Modal Ends -->
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl #</th>
                                    <th>Name</th>
                                    <th>Commission Amount</th>

                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commissions as $commission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>@isset($commission->employee->first_name)
                                            {{ $commission->employee->first_name }}
                                        @endisset</td>
                                        <td>{{ $commission->rate }}</td>
                                        
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <button name="reject" type="submit" value="2" class="text-warning mr-2" title="Reject"
                                                    data-toggle="modal" data-target="#commissionupdate{{$commission->id}}">
                                                        <i data-feather="edit" >ADD</i>
                                                </button>

                                                <!-- Edit Modal -->
                                                        <div class="modal fade" id="commissionupdate{{$commission->id}}" tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Update Commission</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="POST" action="{{ route('employer.commission.update', $commission->id) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="reply_message">User</label>
                                                                            <select name="employee_id" disabled>
                                                                                <option disabled="disabled">Select User</option>
                                                                                @foreach($users as $user)
                                                                                    <option {{ old('employee_id', $user->id)==$commission->user_id ? "selected" : "" }}
                                                                                         value="{{$user->id}}" disabled="disabled">{{$user->first_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="reply_message">Commission Rate</label>
                                                                            <input type="number" step=any class="form-control @if ($errors->has('user_rate')) is-invalid @endif" name="rate"  
                                                                            value="{{old('rate', $commission->rate)}}" required>
                                                                        </div>
                                                                        <div class="invalid-feedback">{{ $errors->first('rate') }}</div>                                
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Send Reply Modal Ends -->

                                                <!-- Delete button -->
                                                <button type="button" class="text-danger"
                                                    onclick="event.preventDefault(); if(confirm('Are you sure to delete ?')){
                                                        document.getElementById('delete-data-{{ $commission->id }}').submit();}"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i data-feather="trash"></i>
                                                </button>
                                                <form id="delete-data-{{ $commission->id }}"
                                                    action="{{ route('employer.commission.destroy', $commission->id) }}"
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

    let token = "{{csrf_token()}}";
            $('#business_id').change(function(e){
                var id = $(this).val();
                console.log('id====',id);
                $('#branch_id').find('option').not(':first').remove();

                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_branch/'+id,
                    dataType: 'json',
                    success: function(response){
                        var len = 0;
                        if(response != null){
                            len = response['data'].length;
                        }
                        if(len>0){
                            for(var i=0;i<len;i++){
                                var id = response['data'][i].id;
                                var name = response['data'][i].name;
                                var option = "<option value='"+id+"'>"+name+"</option>";
                                $('#branch_id').append(option);
                            }
                        }
                    }
                });
            });
            $('#branch_id').change(function(e){
                var id = $(this).val();
                $('#department_id').find('option').not(':first').remove();

                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_department/'+id,
                    dataType: 'json',
                    success: function(response){
                        var len = 0;
                        if(response != null){
                            len = response['data'].length;
                        }
                        if(len>0){
                            for(var i=0;i<len;i++){
                                var id = response['data'][i].id;
                                var name = response['data'][i].dep_name;
                                var option = "<option value='"+id+"'>"+name+"</option>";
                                $('#department_id').append(option);
                            }
                        }
                    }
                });
            });
            $('#department_id').change(function(e){
                var id = $(this).val();
                $('#employee_id').find('option').not(':first').remove();

                $.ajax({
                    type: 'get',
                    url: '/employer/report/employment_period/get_user/'+id,
                    dataType: 'json',
                    success: function(response){
                        var len = 0;
                        if(response != null){
                            len = response['data'].length;
                        }
                        if(len>0){
                            for(var i=0;i<len;i++){
                                var id = response['data'][i].id;
                                var name = response['data'][i].first_name;
                                var option = "<option value='"+id+"'>"+name+"</option>";
                                $('#employee_id').append(option);
                            }
                        }
                    }
                });
            });

</script>


@endpush
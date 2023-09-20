@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Bonus</h6>
                <form method="POST" action="{{ route('employer.bonus.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Type<span class="text-danger">*</span></label>
                                <select name="type" id="type" class="@if ($errors->has('type')) is-invalid @endif">
                                    <option selected="true" disabled="disabled" value="">Select Type</option>
                                    <option value="0">Employee</option>
                                    <option value="1">Department</option>
                                    <option value="2">Branch</option>
                                    <option value="3">Business</option>
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('type') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    
                    <!-- Row -->
                   <!-- Row -->
                   <!-- Row -->
                    <div class="row" id="tbusiness" style="display:none">
                        <div class="col-sm-6">
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
                        </div><!-- Col -->
                    </div>


                    <div class="row" id="tbranch" style="display:none">
                        <div class="col-sm-6">
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
                        </div><!-- Col -->
                    </div>

                    <div class="row" id="tdepartment" style="display:none">
                        <div class="col-sm-6">
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
                        </div><!-- Col -->
                    </div>
                    
                    <div class="row" id="temployee" style="display:none">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employee<span class="text-danger">*</span></label>
                                <select name="type_id" id="employee_id" class="@if ($errors->has('type_id')) is-invalid @endif">
                                    <option selected="true" disabled="disabled" >Select User</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->first_name}}</option>
                                    @endforeach
                                </select>                                
                                <div class="invalid-feedback">{{ $errors->first('type_id') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    
                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Rate Type<span class="text-danger">*</span></label>
                                <select name="rate_type" id="type" class="@if ($errors->has('rate_type')) is-invalid @endif">
                                    <option selected="true" disabled="disabled" value="">Select Rate Type</option>
                                    <option value="0">Percentage</option>
                                    <option value="1">Fixed</option>
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('rate_type') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Rate <span class="text-danger">*</span></label>
                                <input type="number" step=any
                                    class="form-control @if ($errors->has('rate')) is-invalid @endif"
                                    name="rate" value="" placeholder="Enter Rate" required>
                                <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
                            </div>
                        </div><!-- Col --> 
                    </div><!-- Row -->

                    <input type="submit" class="btn btn-primary submit" value="Submit">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@push('custom_js')
<script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
<script>
    $('#type').on('change',function(){
        var selection = $(this).val();
        switch(selection){
        case "0":
            $("#temployee").show()
            $("#tdepartment").show()
            $("#tbranch").show()
            $("#tbusiness").show()
            break;
        case "1":
            $("#tdepartment").show()
            $("#temployee").hide()
            $("#tbranch").show()
            $("#tbusiness").show()
            break;
        case "2":
            $("#tbranch").show()
            $("#temployee").hide()
            $("#tdepartment").hide()
            $("#tbusiness").show()
            break;
        case "3":
            $("#tbusiness").show()
            $("#temployee").hide()
            $("#tdepartment").hide()
            $("#tbranch").hide()
            break;
        default:
            $("#temployee").hide()
            $("#tdepartment").hide()
            $("#tbranch").hide()
            $("#tbusiness").hide()
        }
});

        let token = "{{csrf_token()}}";
            $('#business_id').change(function(e){
                var id = $(this).val();
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
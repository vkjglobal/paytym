@extends('employer.layouts.app')

@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add Provident fund</h6>
                <form method="POST" action="{{ route('employer.providentfund.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row" id="" >

                    <div class="col-sm-6">
                    <div class="form-group">
                                                    <label class="control-label">Business<span class="text-danger"></span></label>
                                                    <select name="business" id="business1" class="@if ($errors->has('business')) is-invalid @endif" >
                                                        <option selected="true" value=" ">All Business</option>
                                                        @foreach($business as $business)
                                                        <option value="{{$business->id}}">{{$business->name}}</option>
                                                        @endforeach
                                                    </select>                                
                                                    <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                                                </div></div>

                                                <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Branch<span class="text-danger"></span></label>
                                                    <select name="branch" id="branch1" class="@if ($errors->has('branch')) is-invalid @endif" >
                                                        <option selected="true" value=" ">All Branch</option>
                                                    </select>                                
                                                    <div class="invalid-feedback">{{ $errors->first('branch') }}</div>
                                                </div></div>
                                                

                                                <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="control-label">Department<span class="text-danger"></span></label>
                                                    <select name="department" id="department" class="@if ($errors->has('department')) is-invalid @endif" >
                                                        <option selected="true" value=" ">All Department</option>
                                                       
                                                    </select>                                
                                                    <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                                                </div>
                                                </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employee<span class="text-danger">*</span></label>
                                <select name="employee" id="user" class="@if ($errors->has('employee')) is-invalid @endif" >
                                    <option selected="true" disabled="disabled" >Select User</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->first_name}}</option>
                                    @endforeach
                                </select>                                
                                <div class="invalid-feedback">{{ $errors->first('employee') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                      
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">User Rate <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @if ($errors->has('user_rate')) is-invalid @endif"
                                    name="user_rate" value="" placeholder="Enter Rate" >
                                <div class="invalid-feedback">{{ $errors->first('user_rate') }}</div>
                            </div>
                        </div><!-- Col --> 
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employer Rate <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @if ($errors->has('employer_rate')) is-invalid @endif"
                                    name="employer_rate" value="" placeholder="Enter Rate" >
                                <div class="invalid-feedback">{{ $errors->first('employer_rate') }}</div>
                            </div>
                        </div><!-- Col --> 
                    </div><!-- Row -->

                    <input type="submit" class="btn btn-success submit" value="ADD">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@push('custom_js')
<script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
<script type="text/javascript">
        let token = "{{csrf_token()}}";
        (function($) {
            $('#business1').change(function(e){
                var id = $(this).val();
                $('#branch1').find('option').not(':first').remove();

                $.ajax({
                    type: 'get',
                    url:     '/employer/report/employment_period/get_branch/'+id,
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
                                $('#branch1').append(option);
                            }
                        }
                    }
                });
            });
            $('#branch1').change(function(e){
                var id = $(this).val();
                $('#department').find('option').not(':first').remove();

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
                                $('#department').append(option);
                            }
                        }
                    }
                });
            });
            $('#department').change(function(e){
                var id = $(this).val();
                $('#user').find('option').not(':first').remove();

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
                                $('#user').append(option);
                            }
                        }
                    }
                });
            });
        })(jQuery);
    </script>


@endpush
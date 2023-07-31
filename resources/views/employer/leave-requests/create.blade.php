@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create Employee Requests</h6>
                    <form method="POST" action="{{ route('employer.leave.requests.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Business<span class="text-danger"></span></label>
                                    <select name="business" id="business1" class="@if ($errors->has('business')) is-invalid @endif" >
                                        <option selected="true" value=" ">All Business</option>
                                        @foreach($businesses as $business)
                                        <option value="{{$business->id}}">{{$business->name}}</option>
                                        @endforeach
                                    </select>                                
                                    <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Branch<span class="text-danger"></span></label>
                                    <select name="branch" id="branch1" class="@if ($errors->has('branch')) is-invalid @endif" >
                                        <option selected="true" value=" ">All Branch</option>
                                        @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach
                                    </select>                                
                                    <div class="invalid-feedback">{{ $errors->first('branch') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Department<span class="text-danger"></span></label>
                                    <select name="department" id="department" class="@if ($errors->has('department')) is-invalid @endif" >
                                        <option selected="true" value=" ">All Department</option>
                                        @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->dep_name}}</option>
                                        @endforeach
                                    </select>                                
                                    <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reply_message">User</label>
                                    <select name="user" id="user" required>
                                        <option disabled="disabled" selected>Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->first_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Title<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('title')) is-invalid @endif"
                                        name="title" value="{{ old('title') }}" placeholder="Enter Title" required>
                                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Leave Type<span class="text-danger"></span></label>
                                    <select name="leave_type" id="leave_type" class="@if ($errors->has('leave_type')) is-invalid @endif" required>
                                        <option selected="true" value=" " disabled>All leave_type</option>
                                        @foreach($leave_types as $leave_type)
                                        <option value="{{$leave_type->id}}">{{$leave_type->leave_type}}</option>
                                        @endforeach
                                    </select>                                
                                    <div class="invalid-feedback">{{ $errors->first('leave_type') }}</div>
                                </div>
                            </div><!-- Col -->
                          
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Start_date<span class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                        class="form-control @if ($errors->has('start_date')) is-invalid @endif"
                                        name="start_date" value="{{ old('start_date') }}" placeholder="Enter Start Date" required>
                                    <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">End_date<span class="text-danger">*</span></label>
                                    <input type="datetime-local"
                                        class="form-control @if ($errors->has('end_date')) is-invalid @endif"
                                        name="end_date" value="{{ old('end_date') }}" placeholder="Enter End Date" required>
                                    <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Reason<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('reason')) is-invalid @endif"
                                        name="reason" value="{{ old('reason') }}" placeholder="Enter Reason" required>
                                    <div class="invalid-feedback">{{ $errors->first('reason') }}</div>
                                </div>
                            </div><!-- Col -->

                            
                            
                        </div><!-- Row -->

                      


                        <button type="submit" class="btn btn-primary submit">Submit</button>
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

@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Rosters</h6>
                        <div class="float-right mb-3">
                            <a  class="btn btn-primary btn-icon-text" href={{route('employer.roster.report')}}>
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Roster List
                            </a> 
                            
                        </div>

                        <div class="row mt-4 mb-4" id="" >
                            <div class="col-sm-2">
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
                            <div class="col-sm-2">
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
                            <div class="col-sm-2">
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
                            </div>
                            
                            <div class="col-sm-2"> 
                                <div class="form-group">
                                    <label class="control-label d-block">&nbsp;</label>
                                    <button class="btn btn-info p-2" id="filter_roster">Filter</button>
                                </div>
                            </div>
                        </div><!-- Row -->
                        <div class="datalist-table table-responsive">
                            <div id="employee_roster_table">
                                    @include('employer.roster.table.roster_list_table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

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
            // $('#department').change(function(e){
            //     alert("working");
            //     var id = $(this).val();
            //     $('#user').find('option').not(':first').remove();

            //     $.ajax({
            //         type: 'get',
            //         url: '/employer/report/employment_period/get_user/'+id,
            //         dataType: 'json',
            //         success: function(response){
            //             var len = 0;
            //             if(response != null){
            //                 len = response['data'].length;
            //             }
            //             if(len>0){
            //                 for(var i=0;i<len;i++){
            //                     var id = response['data'][i].id;
            //                     var name = response['data'][i].first_name;
            //                     var option = "<option value='"+id+"'>"+name+"</option>";
            //                     $('#user').append(option);
            //                 }
            //             }
            //         }
            //     });
            // });
            $('#filter_roster').on('click', function(e) {
                $.ajax({
                    type: "get",
                    url: "{{url('employer/roster/filter')}}",
                    async: true,
                    data: {
                        _token: token,
                        business: $('#business1').val(),
                        branch: $('#branch1').val(),
                        department: $('#department').val(),
                    },
                    // alert(data);
                    success: function(response) {
                        console.log(response);
                        $('#employee_roster_table').html(response);
                        console.log(response);
                    },
                    error: function(error_message) {
                        console.log(error_message); 
                    }
                });
            });
        })(jQuery);
    </script>
@endpush




            
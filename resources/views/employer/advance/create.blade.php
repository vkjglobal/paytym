@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"> Create Advance Request</h6>
                <form method="POST" action="{{ route('employer.advance.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Business<span class="text-danger"></span></label>
                                <select name="business" id="business1" class="@if ($errors->has('business')) is-invalid @endif">
                                    <option selected="true" value=" ">Choose Business</option>
                                    @foreach($businesses as $business)
                                    <option value="{{$business->id}}">{{$business->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Branch<span class="text-danger"></span></label>
                                <select name="branch" id="branch1" class="@if ($errors->has('branch')) is-invalid @endif">
                                    <option selected="true" value=" ">Choose Branch</option>
                                    @foreach($branches as $branch)
                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('branch') }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label class="control-label">Department<span class="text-danger"></span></label>
                                <select name="department" id="department" class="@if ($errors->has('department')) is-invalid @endif">
                                    <option selected="true" value=" ">Choose Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->dep_name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reply_message">User</label>
                                <select name="employee_id" id="user">
                                    <option disabled="disabled" selected>Select User</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reply_message">Request Advance</label>
                                <input type="number" step=any class="form-control" name="amount" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reason">Reason</label>
                                <textarea class="form-control" name="description" required></textarea>

                            </div>
                        </div>
                    </div>
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
        $('#business1').change(function(e) {
            var id = $(this).val();
            $('#branch1').find('option').not(':first').remove();

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
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].name;
                            var option = "<option value='" + id + "'>" + name + "</option>";
                            $('#branch1').append(option);
                        }
                    }
                }
            });
        });
        $('#branch1').change(function(e) {
            var id = $(this).val();
            $('#department').find('option').not(':first').remove();

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
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].dep_name;
                            var option = "<option value='" + id + "'>" + name + "</option>";
                            $('#department').append(option);
                        }
                    }
                }
            });
        });
        $('#department').change(function(e) {
            var id = $(this).val();
            $('#user').find('option').not(':first').remove();

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
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].first_name;
                            var option = "<option value='" + id + "'>" + name + "</option>";
                            $('#user').append(option);
                        }
                    }
                }
            });
        });
    })(jQuery);
</script>

@endpush
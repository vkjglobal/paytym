@extends('employer.layouts.app')

@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Group Chat</h6>
                <form method="POST" action="{{ route('employer.groupchat.update', $groupchat->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Group Name<span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @if ($errors->has('group_name]')) is-invalid @endif"
                                    name="group_name" value="{{old('group_name', $groupchat->group_name)}}" placeholder="Enter Group name" disabled="disabled">
                                    <input type="hidden" name="group_name" value="{{$groupchat->group_name}}">
                                    <div class="invalid-feedback">{{ $errors->first('group_name') }}</div>
                            </div>
                        </div><!-- Col --> 
                    </div><!-- Row -->

                    <div class="row" id="" >
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Admin<span class="text-danger">*</span></label>
                                <select name="employee" class="@if ($errors->has('employee')) is-invalid @endif" >
                                    <option selected="true" disabled="disabled" >Select Admin</option>
                                    @foreach($employees as $employee)
                                        <option {{ old('employee', $employee->employee->id) == $groupchat->admin_id ? "selected" : "" }}
                                        value="{{$employee->employee->id}}">{{$employee->employee->first_name}}</option>
                                    @endforeach
                                </select>                                
                                <div class="invalid-feedback">{{ $errors->first('employee') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                      


                    <button type="submit" class="btn btn-primary">UPDATE</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@push('custom_js')
<script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
@endpush
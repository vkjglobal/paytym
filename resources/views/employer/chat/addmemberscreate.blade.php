@extends('employer.layouts.app')

@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add group members</h6>
                <form method="POST" action="{{ route('employer.groupmember.store') }}" enctype="multipart/form-data">
                    @csrf
                    

                    <div class="row" id="" >
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Group<span class="text-danger">*</span></label>
                                <select name="group" class="@if ($errors->has('group')) is-invalid @endif" >
                                    <option selected="true" disabled="disabled" >Select Group</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->group_name}}</option>
                                    @endforeach
                                </select>                                
                                <div class="invalid-feedback">{{ $errors->first('group') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    <div class="row" id="" >
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Member<span class="text-danger">*</span></label>
                                <select name="employee" class="@if ($errors->has('employee')) is-invalid @endif" >
                                    <option selected="true" disabled="disabled" >Select Member</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}">{{$employee->first_name}}</option>
                                    @endforeach
                                </select>                                
                                <div class="invalid-feedback">{{ $errors->first('employee') }}</div>
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
@endpush
@extends('employer.layouts.app')

@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Group Members</h6>
                <form method="POST" action="{{ route('employer.groupmember.update', $groupmembers->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row" id="" >
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Group<span class="text-danger">*</span></label>
                                <select name="group" class="@if ($errors->has('group')) is-invalid @endif" disabled>
                                    <option selected="true" disabled="disabled" >Select Group</option>
                                    @foreach($groups as $group)
                                        <option {{ old('group', $group->id) == $groupmembers->group_chat_id ? "selected" : "" }}
                                        value="{{$group->id}}" disabled="disabled">{{$group->group_name}}</option>
                                    @endforeach
                              <input type="hidden" name="group" value="{{$groupmembers->group_chat_id}}">  
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
                                        <option {{ old('employee', $employee->id) == $groupmembers->member_id ? "selected" : "" }}
                                        value="{{$employee->id}}">{{$employee->first_name}}</option>
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
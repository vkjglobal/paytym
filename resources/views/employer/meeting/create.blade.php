@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create Meeting</h6>
                    <form method="POST" action="{{ route('employer.meeting.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Meeting Title <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="name" value="{{ old('name') }}" placeholder="Enter Meeting Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Location<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('location')) is-invalid @endif"
                                        name="location" value="{{ old('location') }}" placeholder="Enter Location" required>
                                    <div class="invalid-feedback">{{ $errors->first('location') }}</div>
                                </div>
                            </div><!-- Col -->
                           
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('date')) is-invalid @endif"
                                        name="date" value="{{ old('date') }}" placeholder="Choose Date" required>
                                    <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                                </div>
                            </div><!-- Col -->
               
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Start Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('postcode')) is-invalid @endif"
                                        name="start_time" value="{{ old('start_time') }}" placeholder="Choose Start Time" required>
                                    <div class="invalid-feedback">{{ $errors->first('start_time') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">End Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('end_time')) is-invalid @endif"
                                        name="end_time" value="{{ old('end_time') }}" placeholder="Choose End Time" required>
                                    <div class="invalid-feedback">{{ $errors->first('end_time') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Agenda <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('agenda')) is-invalid @endif"
                                        name="agenda" value="{{ old('agenda') }}" placeholder="Enter Agenda" required>
                                    <div class="invalid-feedback">{{ $errors->first('agenda') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Select Attendees<span class="text-danger">*</span></label>
                                <select id="attendees" class="form-control @if ($errors->has('user')) is-invalid @endif" name="users[]" value="{{ old('user') }}" multiple="multiple" required>
                                    
                                    @foreach ($employees as $user)
                                    <option value="{{$user->id}}">{{$user->id}} - {{$user->first_name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('user') }}</div>
                            </div>
                        </div><!-- Col -->
                        </div><!-- Row -->
                        {{--<div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Select Attendees<span class="text-danger">*</span></label>
                                <select id="attendees1" class="form-control @if ($errors->has('user')) is-invalid @endif" name="users[]" value="{{ old('user') }}" multiple="multiple" required>
                                    
                                    @foreach ($employees as $user)
                                    <option value="{{$user->id}}">{{$user->id}} - {{$user->first_name}}</option>
                                    @endforeach
                                </select>
                               
                                <div class="invalid-feedback">{{ $errors->first('user') }}</div>
                            </div>
                        </div><!-- Col -->
                        </div><!-- Row -->--}}


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
    
    
    
<script>
    $(document).ready(function () {
        $('#attendees').select2(
            {   placeholder: "--Select--",
                allowClear: true});
        
    });
</script>
  
@endpush

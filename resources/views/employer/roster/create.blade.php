@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create Roster</h6>
                    <form method="POST" action="{{ route('employer.roster.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Employee<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('employee')) is-invalid @endif" name="employee" value="{{ old('employee') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($users as $user )
                                    <option value="{{$user['id']}}">{{$user['first_name']." " . $user['last_name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('employee') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Project<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('project')) is-invalid @endif" name="project" value="{{ old('project') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($projects as $project )
                                    <option value="{{$project['id']}}">{{$project['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('project') }}</div>
                                </div>
                            </div><!-- Col -->


                            <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Job Type<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('project')) is-invalid @endif" name="job_type" value="{{ old('job_type') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($job_types as $job_type )
                                    <option value="{{$job_type['id']}}">{{$job_type['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('job_type') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Start Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('start_time')) is-invalid @endif"
                                        name="start_time" value="{{ old('start_time') }}">
                                    <div class="invalid-feedback">{{ $errors->first('start_time') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">End Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('end_time')) is-invalid @endif"
                                        name="end_time" value="{{ old('end_time') }}">
                                    <div class="invalid-feedback">{{ $errors->first('end_time') }}</div>
                                </div>
                            </div><!-- Col -->
                            
                        </div><!-- Row -->

                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('start_date')) is-invalid @endif"
                                        name="start_date" value="{{ old('start_date') }}" >
                                    <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">End Date<span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('end_date')) is-invalid @endif"
                                        name="end_date" value="{{ old('country') }}">
                                    <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
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
@endpush

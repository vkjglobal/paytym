@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Edit Event</h6>
                    <form method="POST" action="{{ route('employer.event.update',$event->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Business<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('business')) is-invalid @endif" name="business" value="{{ old('business') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($businesses as $business)
                                    <option value="{{$business->id}}" {{ $event->business_id == $business['id'] ? 'selected': ''}} >{{$business->name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Branch<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('branch')) is-invalid @endif" name="branch" value="{{ old('branch') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($branches as $key => $value)
                                    <option value="{{$value['id']}}" {{ $event->branch_id == $value['id'] ? 'selected': ''}} >{{$value['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Department<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('department')) is-invalid @endif" name="department" value="{{ old('department') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($departments as $key => $value)
                                    <option value="{{$value['id']}}" {{ $event->department_id == $value['id'] ? 'selected': ''}}>{{$value['dep_name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                            </div>
                        </div><!-- Col -->
                            
                           
                        </div><!-- Row -->

                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Event Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="name" value="{{ old('name',$event->name) }}" placeholder="Enter Event Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Place<span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                        name="place" value="{{ old('place',$event->place) }}" placeholder="Enter Place" required>
                                    <div class="invalid-feedback">{{ $errors->first('place') }}</div>
                                </div>
                            </div><!-- Col -->
                           
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('start_date')) is-invalid @endif"
                                        name="start_date" value="{{ old('start_date',$event->start_date) }}" placeholder="Enter Post Code">
                                    <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">End Date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                        name="end_date" value="{{ old('end_date',$event->end_date) }}" placeholder="Enter Country">
                                    <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">Start Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('start_time')) is-invalid @endif"
                                        name="start_time" value="{{ old('start_time',$event->start_time) }}" placeholder="Enter Bank Name">
                                    <div class="invalid-feedback">{{ $errors->first('start_time') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label">End Time <span class="text-danger">*</span></label>
                                    <input type="time"
                                        class="form-control @if ($errors->has('end_time')) is-invalid @endif"
                                        name="end_time" value="{{ old('end_time',$event->end_time) }}" placeholder="End Time">
                                    <div class="invalid-feedback">{{ $errors->first('end_time') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Description <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('country')) is-invalid @endif"
                                        name="description" value="{{ old('description',$event->description) }}" placeholder="Enter Description" required>
                                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
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

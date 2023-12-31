@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Edit Project</h6>
                    <form method="POST" action="{{ route('employer.project.update',$project->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label"> Project Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="name" value="{{ old('name',$project->name) }}" placeholder="Enter Project Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Business<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('business')) is-invalid @endif" name="business" value="{{ old('business') }}" required>
                                    <option value="">--SELECT--</option>
                                    @foreach ($businesses as $business)
                                    <option value="{{$business['id']}}" {{ $project->business_id == $business['id'] ? 'selected': ''}}>{{$business['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                            </div>
                        </div><!-- Col -->

                            <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Branch<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('branch')) is-invalid @endif" name="branch" value="{{ old('branch') }}" required>
                                    <option value="">--SELECT--</option>
                                    @foreach ($branches as $key => $value)
                                    <option value="{{$value['id']}}" {{$project->branch_id == $value['id'] ? 'selected':''}}>{{$value['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('branch') }}</div>
                            </div>
                        </div><!-- Col -->
                       

                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Description <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('description')) is-invalid @endif"
                                        name="description" value="{{ old('description',$project->description) }}" placeholder="Enter description" required>
                                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Start date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('start_date')) is-invalid @endif"
                                        name="start_date" value="{{ old('start_date',$project->start_date) }}"  required>
                                    <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">End date <span class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="end_date" value="{{ old('end_date',$project->end_date) }}"  required>
                                    <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Budget <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('budget')) is-invalid @endif"
                                        name="budget" value="{{ old('budget',$project->budget) }}" placeholder="Enter Budget" required>
                                    <div class="invalid-feedback">{{ $errors->first('budget') }}</div>
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

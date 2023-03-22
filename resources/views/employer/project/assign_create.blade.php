@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Assign Project</h6>
                    <form method="POST" action="{{ route('employer.assign.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Employee<span class="text-danger">*</span></label>
                            <select class="form-control select2 select2-bootstrap-prepend" name="employee" data-placeholder="Select an employee...">
                                <option></option>
                                @foreach ($users as $user)
                                    <option value="{{$user['id']}}">{{$user['first_name']." " . $user['last_name']}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('employee') }}</div>
                        </div>
                    </div><!-- Col -->


                            <div class="col-sm-6">
                            <div class="form-group">
                            <label class="control-label">Project<span class="text-danger">*</span></label>
                            <select class="form-control select2 select2-bootstrap-prepend @if ($errors->has('project')) is-invalid @endif" name="project" value="{{ old('project') }}" data-placeholder="Select a project...">
                                <option></option>
                                @foreach ($projects as $project )
                                <option value="{{$project['id']}}">{{$project['name']}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('project') }}</div>
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
    <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
@endpush

@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create Business</h6>
                    <form method="POST" action="{{ route('employer.uploads.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">File Type<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('branch')) is-invalid @endif" name="filetype" value="{{ old('filetype') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($filetypes as $filetype)
                                    <option value="{{$filetype['id']}}">{{$filetype['file_type']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('filetype') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Choose File <span class="text-danger">*</span></label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('file')) is-invalid @endif"
                                        name="file" value="{{ old('file') }}" placeholder="Enter Branch Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('file') }}</div>
                                </div>
                            </div><!-- Col -->

                           
                            
                            
                        </div><!-- Row -->
                        <input type="hidden" name="employee_id" value="{{$employee_id}}">



                       


                      


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

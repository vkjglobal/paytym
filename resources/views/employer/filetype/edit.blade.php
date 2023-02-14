@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create File Type</h6>
                    <form method="POST" action="{{ route('employer.file_type.update',$file_type->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">File Type <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('filetype')) is-invalid @endif"
                                        name="filetype" value="{{ old('filetype',$file_type->file_type) }}" placeholder="Enter File Type" required>
                                    <div class="invalid-feedback">{{ $errors->first('filetype') }}</div>
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

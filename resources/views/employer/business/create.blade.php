@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create Business</h6>
                    <form method="POST" action="{{ route('employer.business.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Business Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('business')) is-invalid @endif"
                                        name="name" value="{{ old('business') }}" placeholder="Enter Business Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                                </div>
                            </div><!-- Col -->

                           
                            
                            
                        </div><!-- Row -->

                        <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Description<span class="text-danger">*</span></label>
                                <!-- <select class="form-control" id="file_type" name="file_type">
                                    <option value="0">--SELECT--</option>

                                </select> -->
                                <textarea name="description" class="form-control @if ($errors->has('description')) is-invalid @endif" cols="30"
                                        rows="5" required>{{ old('description') }}</textarea>
                                    
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

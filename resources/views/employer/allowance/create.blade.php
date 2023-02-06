@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create Allowance</h6>
                    <form method="POST" action="{{ route('employer.allowance.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Allowance Type <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('type')) is-invalid @endif"
                                        name="type" value="{{ old('type') }}" placeholder="Enter Allowance Type" required>
                                    <div class="invalid-feedback">{{ $errors->first('type') }}</div>
                                </div>
                            </div><!-- Col -->

                           
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Rate <span class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control @if ($errors->has('rate')) is-invalid @endif"
                                        name="rate" value="{{ old('rate') }}" placeholder="Enter Rate" required>
                                    <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
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

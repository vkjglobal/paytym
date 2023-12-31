@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    @php
     use Illuminate\Support\Carbon;  
    @endphp
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create Payroll Budget</h6>
                    <form method="POST" action="{{ route('employer.payroll-budget.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Year <span class="text-danger">*</span></label>
                                    <input type="number" min="2000" max="2099" step="1" 
                                        class="form-control @if ($errors->has('year')) is-invalid @endif"
                                        name="year" value="{{ old('year') }}" placeholder="Enter Year" required>
                                    <div class="invalid-feedback">{{ $errors->first('year') }}</div>
                                </div>
                            </div><!-- Col -->

                           
                            
                            
                        </div><!-- Row -->

                        <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Budget<span class="text-danger">*</span></label>
                                <input type="number" step="any"
                                        class="form-control @if ($errors->has('budget')) is-invalid @endif"
                                        name="budget" value="{{ old('budget') }}" placeholder="Enter budget" required>
                                    
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

@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Edit Payroll Budget</h6>
                    <form method="POST" action="{{ route('employer.payroll-budget.update', $id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Year <span class="text-danger">*</span></label>
                                    <input type="number" min="2000" max="2099" step="1" 
                                        class="form-control @if ($errors->has('year')) is-invalid @endif"
                                        name="year" value="{{ old('year', $payroll_budget->year) }}" placeholder="Enter Year" disabled>
                                    <div class="invalid-feedback">{{ $errors->first('year') }}</div>
                                </div>
                            </div><!-- Col -->

                           
                            
                            
                        </div><!-- Row -->

                        <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Budget<span class="text-danger">*</span></label>
                                <input type="number"
                                        class="form-control @if ($errors->has('budget')) is-invalid @endif"
                                        name="budget" value="{{ old('budget', $payroll_budget->budget_amount) }}" placeholder="Enter budget" required>
                                    
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

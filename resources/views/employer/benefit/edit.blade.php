@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">CMS Edit</h6>
                <form method="POST" action="{{ route('employer.benefit.update', $benefit->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                       
                       <div class="col-sm-6">
                               <div class="form-group">
                                   <label class="control-label">Benefit Type <span class="text-danger">*</span></label>
                                   <input type="text"
                                       class="form-control @if ($errors->has('benefit_type')) is-invalid @endif"
                                       name="benefit_type" value="{{ old('benefit_type', $benefit->benefit_type) }}"
                                       placeholder="Enter Benefit Type" required>
                                   <div class="invalid-feedback">{{ $errors->first('benefit_type') }}</div>
                               </div>
                           </div><!-- Col -->
                   </div><!-- Row -->
                   <div class="row">
                   <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Description<span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control @if ($errors->has('description')) is-invalid @endif" cols="30"
                                        rows="5" required>{{ old('description', $benefit->description) }}</textarea>
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

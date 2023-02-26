@extends('admin.layouts.app')
@section('content')
@component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">CMS Edit</h6>
                <form method="POST" action="{{ route('admin.cms.update', $cm->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                       
                       <div class="col-sm-6">
                               <div class="form-group">
                                   <label class="control-label">CMS Type <span class="text-danger">*</span></label>
                                   <input type="text"
                                       class="form-control @if ($errors->has('cms_type')) is-invalid @endif"
                                       name="cms_type" value="{{ old('cms_type', $cm->cms_type) }}"
                                       placeholder="Enter Name" required>
                                   <div class="invalid-feedback">{{ $errors->first('cms_type') }}</div>
                               </div>
                           </div><!-- Col -->
                   </div><!-- Row -->
                   <div class="row">
                   <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Content<span class="text-danger">*</span></label>
                                <textarea name="content" class="form-control @if ($errors->has('content')) is-invalid @endif" cols="30"
                                        rows="5" required>{{ old('content', $cm->content) }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                                
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

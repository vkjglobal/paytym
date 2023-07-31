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
                                <input type="text" class="form-control @if ($errors->has('cms_type')) is-invalid @endif" name="cms_type" value="{{ old('cms_type', $cm->cms_type) }}" placeholder="Enter Name">
                                <div class="invalid-feedback">{{ $errors->first('cms_type') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Content<span class="text-danger">*</span></label>
                                <textarea name="content" class="form-control @if ($errors->has('content')) is-invalid @endif" cols="30" rows="5" required>{{ old('content', $cm->content) }}</textarea>
                                <div class="invalid-feedback">{{ $errors->first('content') }}</div>

                            </div>
                        </div><!-- Col -->


                    </div><!-- Row -->
                    <div class="row">
                        @if($cm->img)
                        <img style="width: 23%;" src="{{asset('uploads/cms/'.$cm->img )}}"  alt="Image">
                        @endif


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Image</label>
                                <input type="file" id="img" name="img" class="form-control">
                                <div class="invalid-feedback">{{ $errors->first('img') }}</div>
                            </div>
                        </div><!-- Col -->

                    </div><!-- Row -->
                    @if($cm->cms_type=='Testimonials')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Person Name</label>
                                <input name="person_name" id="person_name" value="{{ old('cms_type', $cm->content1) }}" placeholder="Enter Person Name" class="form-control @if ($errors->has('person_name')) is-invalid @endif" />
                                <div class="invalid-feedback">{{ $errors->first('person_name') }}</div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Company Name</label>
                                <input name="company_name" id="company_name" value="{{ old('cms_type', $cm->content2) }}" placeholder="Enter Company Name" class="form-control @if ($errors->has('company_name')) is-invalid @endif" />
                                <div class="invalid-feedback">{{ $errors->first('company_name') }}</div>
                            </div>
                        </div>
                    </div>
                    @endif

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
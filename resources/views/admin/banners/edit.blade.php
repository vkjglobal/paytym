@extends('admin.layouts.app')
@section('content')
@component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Banner Edit</h6>
                <form method="POST" action="{{ route('admin.banner.update', $banner->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                       
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Banner Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="name" value="{{ old('name', $banner->name) }}"
                                        placeholder="Enter Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label class="control-label">Image<span class="text-danger">*</span></label>
                                    <!-- <input type="file"
                                        class="form-control @if ($errors->has('image')) is-invalid @endif"
                                        name="image" value="{{ old('image',$banner->image) }}" placeholder="Choose Image">

                                    <img src="{{ asset('storage/' . $banner->image) }}" class="img-thumbnail mt-2" width="100" alt=""> -->
                                    
                                    <input type="file"
                                            class="form-control @if ($errors->has('image')) is-invalid @endif"
                                            name="image" value="{{old('image', $banner->image) }}" placeholder="Enter Image">
                                    <div class="invalid-feedback">{{ $errors->first('image') }}</div>
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

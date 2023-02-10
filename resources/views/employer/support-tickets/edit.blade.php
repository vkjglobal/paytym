@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit Support Ticket</h6>
                <form method="POST" action="{{ route('employer.supportticket.update', $supportticket->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                       
                       <div class="col-sm-6">
                               <div class="form-group">
                                   <label class="control-label">Subject <span class="text-danger">*</span></label>
                                   <input type="text"
                                       class="form-control @if ($errors->has('subject')) is-invalid @endif"
                                       name="subject" value="{{ old('subject', $supportticket->subject) }}"
                                       placeholder="Enter Subject" required>
                                   <div class="invalid-feedback">{{ $errors->first('subject') }}</div>
                               </div>
                           </div><!-- Col -->
                   </div><!-- Row -->
                   <div class="row">
                   <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Message<span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control @if ($errors->has('message')) is-invalid @endif" cols="30"
                                        rows="5" required>{{ old('message', $supportticket->message) }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                                
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

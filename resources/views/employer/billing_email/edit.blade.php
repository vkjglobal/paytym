@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Edit Billing Email</h6>
                    <form method="POST" action="{{ route('employer.billing_emails.update',$billing_email->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name="name" value="{{ old('name',$billing_email->name) }}" placeholder="Enter Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                            </div><!-- Col -->

                           
                            
                            
                        </div><!-- Row -->

                        <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Email<span class="text-danger">*</span></label>
                                <!-- <select class="form-control" id="file_type" name="file_type">
                                    <option value="0">--SELECT--</option>

                                </select> -->
                                <input type="text"
                                        class="form-control @if ($errors->has('email')) is-invalid @endif"
                                        name="email" value="{{ old('email',$billing_email->email) }}" placeholder="Enter Email" required>
                                    
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
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

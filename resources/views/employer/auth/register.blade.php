@extends('employer.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>{{ __('Register') }}</b></div>
                @if (session('success'))
    <div class="alert alert-light">
        {{ session('success') }}
    </div>
@endif

                <div class="card-body">
                <form method="POST" action="{{ route('employer.register') }}" enctype="multipart/form-data" id="register-form">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('name')) is-invalid @endif"
                                            name="name" value="{{ old('name') }}" placeholder="Enter your name"
                                            required>
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Company Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('company_name')) is-invalid @endif"
                                            name="company_name" value="{{ old('company_name') }}"
                                            placeholder="Enter company name" required>
                                        <div class="invalid-feedback">{{ $errors->first('company_name') }}</div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Email <span class="text-danger">*</span></label>
                                        <input type="email"
                                            class="form-control @if ($errors->has('email')) is-invalid @endif"
                                            name="email" value="{{ old('email') }}" placeholder="Enter Email" required>
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Phone <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                            name="phone" value="{{ old('phone') }}" placeholder="Enter phone" required>
                                        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Company Phone <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('company_phone')) is-invalid @endif"
                                            name="company_phone" value="{{ old('company_phone') }}"
                                            placeholder="Enter company phone" required>
                                        <div class="invalid-feedback">{{ $errors->first('company_phone') }}</div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                   
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Street <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('street')) is-invalid @endif"
                                            name="street" value="{{ old('street') }}" placeholder="Enter Street" required>
                                        <div class="invalid-feedback">{{ $errors->first('street') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">City <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('city')) is-invalid @endif"
                                            name="city" value="{{ old('city') }}" placeholder="Enter City" required>
                                        <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Country <span class="text-danger">*</span></label>
                                        <!-- <input type="text"
                                            class="form-control @if ($errors->has('country')) is-invalid @endif"
                                            name="country" value="{{ old('country') }}" placeholder="Enter Country"
                                            required>
                                        <div class="invalid-feedback">{{ $errors->first('country') }}</div> -->
                                        <select class="form-control"  class="form-control @if ($errors->has('country')) is-invalid @endif" name="country" value="{{ old('country') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($country as $key => $value)
                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Tax Identification Number (TIN) <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @if ($errors->has('tin')) is-invalid @endif"
                                            name="tin" value="{{ old('tin') }}" placeholder="Enter TIN" required>
                                        <div class="invalid-feedback">{{ $errors->first('tin') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Website</label>
                                        <input type="url"
                                            class="form-control @if ($errors->has('website')) is-invalid @endif"
                                            name="website" value="{{ old('website') }}" placeholder="Enter Website">
                                        <div class="invalid-feedback">{{ $errors->first('website') }}</div>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                        
                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Registration Certificate</label>
                                        <input type="file"
                                            class="form-control @if ($errors->has('registration_certificate')) is-invalid @endif"
                                            name="registration_certificate" value="{{ old('registration_certificate') }}" placeholder="Enter Image">
                                        <div class="invalid-feedback">{{ $errors->first('registration_certificate') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">TIN Letter</label>
                                        <input type="file"
                                        class="form-control @if ($errors->has('tin_letter')) is-invalid @endif"
                                        name="tin_letter" value="{{ old('tin_letter') }}"
                                        placeholder="Enter tin letter">
                                    <div class="invalid-feedback">{{ $errors->first('tin_letter') }}</div>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">logo</label>
                                        <input type="file"
                                            class="form-control @if ($errors->has('image')) is-invalid @endif"
                                            name="image" value="{{ old('logo') }}" placeholder="Enter Image">
                                        <div class="invalid-feedback">{{ $errors->first('logo') }}</div>
                                    </div>
                                </div>
                            </div><!-- Row -->

                          
                            
                            <button type="submit" class="btn btn-primary submit">Register</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- The Bootstrap Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            Welcome.... <br>We have sent an email to your registered email address for account verification together with your login credentials. Please check and verify to start using our superior Paytym HR and Payroll Automation Platform.
            Thank you!.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalButton">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- The Bootstrap Modal for Validation Errors -->
<div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="validationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validationModalLabel">Validation Errors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="validation-errors"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom_js')
 <!-- <script>
$(document).ready(function() {
    $('#register-form').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Show the Bootstrap modal on success
                $('#successModal').modal('show');
            },
            error: function(xhr) {
                // Handle registration errors here
            }
        });
    });
});
</script> 
<script>
    $(document).ready(function() {
        // Add a click event handler to the Close button
        $('#closeModalButton').click(function() {
            // Reload the page when the Close button is clicked
            location.reload();
        });
    });
</script> -->
<!-- <script>
$(document).ready(function() {
    $('#register-form').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {alert(1);
                if (response.success) {
                    // Show the Bootstrap modal on success
                    $('#successModal').modal('show');
                } else {
                    // Handle validation errors here
                    var errorsHtml = '<ul>';
                    $.each(response.errors, function(key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    errorsHtml += '</ul>';
                    $('#validation-errors').html(errorsHtml);
                    $('#validationModal').modal('show');
                }
            },
            error: function(xhr) {
                // Handle registration errors here
            }
        });
    });
});
</script> -->
@endpush


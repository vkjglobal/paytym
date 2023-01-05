@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Create User</h6>
                    <form method="POST" onsubmit = "return validateForm()" action="{{ route('employer.user.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('email')) is-invalid @endif"
                                        name="first_name" value="{{ old('first_name') }}" placeholder="Enter Branch Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                        name="last_name" value="{{ old('last_name') }}" placeholder="Enter City" required>
                                    <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Email <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('company_phone')) is-invalid @endif"
                                        name="email" value="{{ old('email') }}"
                                        placeholder="Enter Email" required>
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Phone Number <span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('street')) is-invalid @endif"
                                        name="phone" value="{{ old('phone') }}" placeholder="Enter Phone No">
                                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Date Of Birth<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                        name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Enter Country">
                                    <div class="invalid-feedback">{{ $errors->first('date_of_birth') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Street <span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('postcode')) is-invalid @endif"
                                        name="street" value="{{ old('street') }}" placeholder="Enter Bank Name">
                                    <div class="invalid-feedback">{{ $errors->first('street') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">City <span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('street')) is-invalid @endif"
                                        name="city" value="{{ old('postcode') }}" placeholder="Enter Post Code">
                                    <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Town<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                        name="country" value="{{ old('town') }}" placeholder="Enter Country">
                                    <div class="invalid-feedback">{{ $errors->first('town') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Post Code <span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('postcode')) is-invalid @endif"
                                        name="bank" value="{{ old('postcode') }}" placeholder="Enter Post Code">
                                    <div class="invalid-feedback">{{ $errors->first('bank') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Country <span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('street')) is-invalid @endif"
                                        name="country" value="{{ old('country') }}" placeholder="Enter Country">
                                    <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Tin<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                        name="tin" value="{{ old('tin') }}" placeholder="Enter Tin">
                                    <div class="invalid-feedback">{{ $errors->first('country') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">FNPF<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('postcode')) is-invalid @endif"
                                        name="fnpf" value="{{ old('fnpf') }}" placeholder="Enter Bank Name">
                                    <div class="invalid-feedback">{{ $errors->first('fnpf') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Bank<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('street')) is-invalid @endif"
                                        name="bank" value="{{ old('bank') }}" placeholder="Enter Post Code">
                                    <div class="invalid-feedback">{{ $errors->first('bank') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Account Number<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                        name="account_number" value="{{ old('account_number') }}" placeholder="Enter Country">
                                    <div class="invalid-feedback">{{ $errors->first('account_number') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Position<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('position')) is-invalid @endif"
                                        name="position" value="{{ old('position') }}" placeholder="Enter Country">
                                    <div class="invalid-feedback">{{ $errors->first('account_number') }}</div>
                                </div>
                            </div><!-- Col -->
                           
                        </div><!-- Row -->

                        <div class="row">
                        <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Image <span class="text-danger"> *</span></label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('image')) is-invalid @endif"
                                        name="image" value="{{ old('image') }}" placeholder="Enter logo" required>
                                    <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                </div>
                            </div><!-- Col -->
                       
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Password<span class="text-danger"> *</span></label>
                                    <input type="password"
                                        class="form-control @if ($errors->has('street')) is-invalid @endif" id="pswd1"
                                        name="password" value="{{ old('password') }}" placeholder="Ente Password">
                                    <div class="invalid-feedback">{{ $errors->first('postcode') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password<span class="text-danger"> *</span></label>
                                    <input type="password"
                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                        id="pswd2" name="" value="{{ old('country') }}" placeholder="Confirm Password">
                                   <span id = "message1" style="color:red"> </span> <br><br>
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
<script>
    function validateForm(){
            var psw1 = document.getElementById("pswd1").value;
            var psw2 = document.getElementById("pswd2").value;
            if(psw1 != psw2){
                document.getElementById("message1").innerHTML ="** Passwords are not same";
                return false;
            }
    }
</script>
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
@endpush

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
                                        name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('last_name')) is-invalid @endif"
                                        name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required>
                                    <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Email <span class="text-danger">*</span></label>
                                    <input type="email"
                                        class="form-control @if ($errors->has('email')) is-invalid @endif"
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
                                    <input type="date"
                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                        name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Enter Country">
                                    <div class="invalid-feedback">{{ $errors->first('date_of_birth') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Street <span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('street')) is-invalid @endif"
                                        name="street" value="{{ old('street') }}" placeholder="Enter Street Name">
                                    <div class="invalid-feedback">{{ $errors->first('street') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">City <span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                        name="city" value="{{ old('city') }}" placeholder="Enter City">
                                    <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Town<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('town')) is-invalid @endif"
                                        name="town" value="{{ old('town') }}" placeholder="Enter Town">
                                    <div class="invalid-feedback">{{ $errors->first('town') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Post Code <span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('postcode')) is-invalid @endif"
                                        name="postcode" value="{{ old('postcode') }}" placeholder="Enter Post Code">
                                    <div class="invalid-feedback">{{ $errors->first('postcode') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Country<span class="text-danger">*</span></label>
                                    <select class="form-control" name="country" value="{{ old('country') }}">
                                        <option value="">--SELECT--</option>
                                        @foreach ($countries as $country)
                                        <option value="{{$country['id']}}" {{ old('country')==$country['id'] ? 'selected':'' }}>{{$country['name']}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div><!-- Col --> 
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Tin<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('tin')) is-invalid @endif"
                                        name="tin" value="{{ old('tin') }}" placeholder="Enter Tin">
                                    <div class="invalid-feedback">{{ $errors->first('tin') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">FNPF<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('fnpf')) is-invalid @endif"
                                        name="fnpf" value="{{ old('fnpf') }}" placeholder="Enter FNPF">
                                    <div class="invalid-feedback">{{ $errors->first('fnpf') }}</div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Business<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('business')) is-invalid @endif" name="business" value="{{ old('business') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($businesses as $business)
                                    <option value="{{$business['id']}} " {{ old('business')==$business['id'] ? 'selected':'' }}>{{$business['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                            </div>
                        </div><!-- Col -->
                            <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Branch<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('branch')) is-invalid @endif" name="branch" value="{{ old('branch') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($branches as $key => $value)
                                    <option value="{{$value['id']}}" {{ old('branch')==$value['id'] ? 'selected':'' }}>{{$value['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('branch') }}</div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Department<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('department')) is-invalid @endif" name="department" value="{{ old('department') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($departments as $department)
                                    <option value="{{$department['id']}}" {{ old('department')==$department['id'] ? 'selected':'' }}>{{$department['dep_name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                            </div>
                        </div><!-- Col -->


                        
                       
                         
                        </div><!-- Row -->


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Bank<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('bank')) is-invalid @endif"
                                        name="bank" value="{{ old('bank') }}" placeholder="Enter Bank">
                                    <div class="invalid-feedback">{{ $errors->first('bank') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Bank Branch<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('bank_branch')) is-invalid @endif"
                                        name="bank_branch" value="{{ old('bank_branch') }}" placeholder="Enter Bank Branch">
                                    <div class="invalid-feedback">{{ $errors->first('bank_branch') }}</div>
                                </div>
                            </div><!-- Col -->

                        


                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Account Number<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('account_number')) is-invalid @endif"
                                        name="account_number" value="{{ old('account_number') }}" placeholder="Enter Account Number">
                                    <div class="invalid-feedback">{{ $errors->first('account_number') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Role<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('position')) is-invalid @endif" name="position" value="{{ old('position') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($roles as $key => $value)
                                    <option value="{{$value['id']}}" {{ old('position')==$value['id'] ? 'selected':'' }} >{{$value['role_name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('position') }}</div>
                            </div>
                        </div><!-- Col -->

                        


                        </div><!-- Row -->



                       


                        <div class="row">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Start date of employment <span class="text-danger"> *</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('start_date')) is-invalid @endif"
                                        name="start_date" value="{{ old('start_date') }}" placeholder="Enter Image" required>
                                    <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">End date of employment  <span class="text-danger"> *</span></label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('end_date')) is-invalid @endif"
                                        name="end_date" value="{{ old('end_date') }}" placeholder="Enter Image" required>
                                    <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                                </div>
                            </div><!-- Col -->
                       
                         
                        </div><!-- Row -->



                        <div class="row">
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Image <span class="text-danger"> *</span></label>
                                    <input type="file"
                                        class="form-control @if ($errors->has('image')) is-invalid @endif"
                                        name="image"  placeholder="Enter Image" required>
                                    <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employee type<span class="text-danger">*</span></label>
                                <select class="form-control"  class="form-control @if ($errors->has('branch')) is-invalid @endif" name="employeetype" value="{{ old('employeetype') }}">
                                    <option value="">--SELECT--</option>
                                    @foreach ($employeetypes as $employeetype )
                                    <option value="{{$employeetype['code']}}" {{ old('employeetype')==$employeetype['code'] ? 'selected':'' }}>{{$employeetype['employee_type']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('employeetype') }}</div>
                            </div>
                        </div><!-- Col -->
                        </div><!-- Row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="fixed-tab" data-toggle="tab" href="#fixed" role="tab" aria-controls="fixed" aria-selected="true" onclick="setSalaryType(0)">Fixed</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="hourly-tab" data-toggle="tab" href="#hourly" role="tab" aria-controls="hourly" aria-selected="false" onclick="setSalaryType(1)">Hourly</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-wrp" id="myTabContent">
                                        <div class="tab-pane fade show active" id="fixed" role="tabpanel" aria-labelledby="fixed-tab">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Pay Period<span class="text-danger">*</span></label>
                                                        <select class="form-control" name="payperiod" value="{{ old('payperiod') }}">
                                                            <option value="">--SELECT--</option>
                                                            @foreach ($payperiods as $payperiod)
                                                            <option value="{{$payperiod['code']}}">{{$payperiod['pay_period']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                </div><!-- Col -->    
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Rate <span class="text-danger"> *</span></label>
                                                        <input type="number" class="form-control " name="fixed-rate" value="{{ old('fixed-rate') }}" placeholder="Enter Rate">
                                                        <div class="invalid-feedback">{{ $errors->first('fixed-rate') }}</div>
                                                    </div>
                                                </div><!-- Col -->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="hourly" role="tabpanel" aria-labelledby="hourly-tab">
                                            <div class="row">
                                            <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="control-label">work days per Week <span class="text-danger"> *</span></label>
                                                        <input type="number" class="form-control" name="work_days_per_week" value="{{ old('work_days_per_week') }}" placeholder="work days per Week">
                                                        <div class="invalid-feedback">{{ $errors->first('work_days_per_week') }}</div>
                                                    </div>
                                                </div><!-- Col -->
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Total hours per week <span class="text-danger"> *</span></label>
                                                        <input type="number" class="form-control " name="Total_hours_per_week" value="" value="{{ old('Total_hours_per_week') }}" placeholder="Total hours per week">
                                                        <div class="invalid-feedback">{{ $errors->first('Total_hours_per_week') }}</div>
                                                    </div>
                                                </div><!-- Col -->
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Extra hours at base rate <span class="text-danger"> *</span></label>
                                                        <input type="number" class="form-control " name="Extra_hours_at_base_rate" value="{{ old('Extra_hours_at_base_rate') }}" placeholder="Extra hours at base rate">
                                                        <div class="invalid-feedback">{{ $errors->first('Extra_hours_at_base_rate') }}</div>
                                                    </div>
                                                </div><!-- Col -->
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Rate <span class="text-danger"> *</span></label>
                                                        <input type="number" class="form-control " name="hourly-rate" value="{{ old('hourly-rate') }}" placeholder="Enter Rate">
                                                        <div class="invalid-feedback">{{ $errors->first('hourly-rate') }}</div>
                                                    </div>
                                                </div><!-- Col -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->
                        <input type="hidden" name="salary_type" id="salary_type" value="0">
                        
                        <div class="row">
                        
                       
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Password<span class="text-danger"> *</span></label>
                                    <input type="password"
                                        class="form-control @if ($errors->has('street')) is-invalid @endif" id="pswd1"
                                        name="password" value="{{ old('password') }}" placeholder="Ente Password">
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                </div>
                               
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password<span class="text-danger"> *</span></label>
                                    <input type="password"
                                        class="form-control @if ($errors->has('password')) is-invalid @endif"
                                        id="pswd2" name="" value="{{ old('password') }}" placeholder="Confirm Password">
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
    //Password Validation
    function validateForm(){
            var psw1 = document.getElementById("pswd1").value;
            var psw2 = document.getElementById("pswd2").value;
            if(psw1 != psw2){
                document.getElementById("message1").innerHTML ="** Passwords are not same";
                return false;
            }
    } // Password Validation End
</script>
<script>
    var salary_type;
     function setSalaryType(num) {
        salary_type = num; 
        document.getElementById("salary_type").value = salary_type;
        console.log(document.getElementById("salary_type").value);
    }
</script>
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
@endpush

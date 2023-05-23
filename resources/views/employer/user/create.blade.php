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
                            </div>
                            <!-- Col -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Job Title <span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control @if ($errors->has('job_title')) is-invalid @endif"
                                        name="job_title" value="{{ old('job_title') }}"
                                        placeholder="Enter Job Title" required>
                                    <div class="invalid-feedback">{{ $errors->first('job_title') }}</div>
                                </div>
                            </div>
                            <!-- Col -->
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">City / Town <span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('city')) is-invalid @endif"
                                        name="city" value="{{ old('city') }}" placeholder="Enter City">
                                    <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Tax Identification Number<span class="text-danger"> *</span></label>
                                    <input type="text"
                                        class="form-control @if ($errors->has('tin')) is-invalid @endif"
                                        name="tin" value="{{ old('tin') }}" placeholder="Enter Tin">
                                    <div class="invalid-feedback">{{ $errors->first('tin') }}</div>
                                </div>
                            </div><!-- Col -->
                         
                        </div><!-- Row -->

                        <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Business<span class="text-danger">*</span></label>
                                <select id="business_user" class="form-control"  class="form-control @if ($errors->has('business')) is-invalid @endif" name="business" value="{{ old('business') }}">
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
                                <select id="branch_user" class="form-control"  class="form-control @if ($errors->has('branch')) is-invalid @endif" name="branch" value="{{ old('branch') }}">
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
                                <select id="department_user" class="form-control"  class="form-control @if ($errors->has('department')) is-invalid @endif" name="department" value="{{ old('department') }}">
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
                                    <label class="control-label">Bank Name*<span class="text-danger"> *</span></label>
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
                                    <label class="control-label">End date of employment</label>
                                    <input type="date"
                                        class="form-control @if ($errors->has('end_date')) is-invalid @endif"
                                        name="end_date" value="{{ old('end_date') }}" placeholder="Enter Image">
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
                                <select class="form-control"  class="form-control @if ($errors->has('employeetype')) is-invalid @endif" name="employeetype" value="{{ old('employeetype') }}">
                                    <option value="">--SELECT--</option>
                                    <option value="0" {{ old('employeetype')=='0' ? 'selected':'' }}>Attachee</option>
                                    <option value="1" {{ old('employeetype')=='1' ? 'selected':'' }}>Apprenticeship</option>
                                    <option value="2" {{ old('employeetype')=='2' ? 'selected':'' }}>Probationary</option>
                                    <option value="3" {{ old('employeetype')=='3' ? 'selected':'' }}>Permanent</option>
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('employeetype') }}</div>
                            </div>
                        </div><!-- Col -->
                        </div><!-- Row -->

                            <div class="form-group">
                            <label for="salary-type">Salary Type</label>
                            <select name="salary_type" id="salary-type">
                                <option value="">--SELECT--</option>
                                <option value="1" {{ old('salary_type')=='1' ? 'selected':'' }}>Hourly</option>
                                <option value="0" {{ old('salary_type')=='0' ? 'selected':'' }}>Fixed</option>
                            </select>
                        </div>
                        <div class="hourly-section row">
                        <div class="col-md-6">
                            <label for="hourly-salary">Hourly Salary</label>
                            <input type="number" step=any name="hourly_rate" id="hourly-salary" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="total-hours-per-week">Total Hours per period</label>
                            <input type="number" step=any name="total_hours_per_week" id="total-hours-per-week" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="total-workdays-per-week">Total Workdays per period</label>
                            <input type="number" step=any name="work_days_per_week" id="total-workdays-per-week" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="extra-hours-at-base-rate">Extra Hours at Base Rate</label>
                            <input type="number" step=any name="extra_hours_at_base_rate" id="extra-hours-at-base-rate" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="pay-period">Pay Period</label>
                            <select name="hourly_pay_period" id="pay-period" class="form-control">
                                <option value="0">Weekly</option>
                                <option value="1">Fortnightly</option>
                            </select>
                        </div>
                    </div>



                        <div class="row fixed-section">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="salary-amount">Salary Amount</label>
                                    <input type="number" step=any id="salary-amount" name="fixed-rate" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pay-period">Pay Period</label>
                                    <select id="pay-period" name="payperiod" class="form-control">
                                        <option value="0">Weekly</option>
                                        <option value="1">Fortnightly</option>
                                        <option value="2">Monthly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
<br>
                        <!-- <div class="row">
                        
                       
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Password<span class="text-danger"> *</span></label>
                                    <input type="password"
                                        class="form-control @if ($errors->has('street')) is-invalid @endif" id="pswd1"
                                        name="password" value="{{ old('password') }}" placeholder="Ente Password">
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                </div> -->
                               
                            <!-- </div> -->
                            <!-- Col -->
                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password<span class="text-danger"> *</span></label>
                                    <input type="password"
                                        class="form-control @if ($errors->has('password')) is-invalid @endif"
                                        id="pswd2" name="" value="{{ old('password') }}" placeholder="Confirm Password">
                                   <span id = "message1" style="color:red"> </span> <br><br>
                                </div>
                            </div> -->
                            <!-- Col -->
                         
                        <!-- </div> -->
                        <!-- Row -->

                        

                        
                    
                        <button type="submit" class="btn btn-primary submit">Register and Send</button>
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
    $(function() {
        $('.hourly-section, .fixed-section').hide();
        $('#salary-type').on('change', function () {
            var selectedValue = $(this).val();
            
            if (selectedValue === '1') {
                $('.hourly-section').show();
                $('.fixed-section').hide();
                $('.fixed-section :input').attr('disabled', true);
                $('.hourly-section :input').attr('disabled', false);
            } else if (selectedValue === '0') {
                $('.fixed-section').show();
                $('.hourly-section').hide();
                $('.hourly-section :input').attr('disabled', true);
                $('.hourly-section :input').attr('disabled', true);
                $('.fixed-section :input').attr('disabled', false);
            } else {
                // Handle other cases here
            }
        });
    });
</script>

<script type="text/javascript">
    let token = "{{csrf_token()}}";
    (function($) {
        $('#business_user').change(function(e){
            var id = $(this).val();
            $('#branch_user').find('option').not(':first').remove();

            $.ajax({
                type: 'get',
                url: '/employer/report/employment_period/get_branch/'+id,
                dataType: 'json',
                success: function(response){
                    var len = 0;
                    if(response != null){
                        len = response['data'].length;
                    }
                    if(len>0){
                        for(var i=0;i<len;i++){
                            var id = response['data'][i].id;
                            var name = response['data'][i].name;
                            var option = "<option value='"+id+"'>"+name+"</option>";
                            $('#branch_user').append(option);
                        }
                    }
                }
            });
        });
        $('#branch_user').change(function(e){
            var id = $(this).val();
            $('#department_user').find('option').not(':first').remove();

            $.ajax({
                type: 'get',
                url: '/employer/report/employment_period/get_department/'+id,
                dataType: 'json',
                success: function(response){
                    var len = 0;
                    if(response != null){
                        len = response['data'].length;
                    }
                    if(len>0){
                        for(var i=0;i<len;i++){
                            var id = response['data'][i].id;
                            var name = response['data'][i].dep_name;
                            var option = "<option value='"+id+"'>"+name+"</option>";
                            $('#department_user').append(option);
                        }
                    }
                }
            });
        });
    })(jQuery);
</script>


    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
@endpush

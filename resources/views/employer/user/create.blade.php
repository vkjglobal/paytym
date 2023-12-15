@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"> Create User</h6>
                <form method="POST" onsubmit="return validateForm()" action="{{ route('employer.user.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{--<div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                            <input type="radio" name="employee_type" value="new" id="new_employee" checked>
                            <label for="new_employee">New Employee</label>
                            <br>
                            <input type="radio" name="employee_type" value="existing" id="existing_employee">
                            <label for="existing_employee">Existing Employee</label>
                        
                        </div>
                        </div>
                        </div>--}}


                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" required>
                                <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('last_name')) is-invalid @endif" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required>
                                <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email') }}" placeholder="Enter Email" required>
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            </div>
                        </div>
                        <!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Job Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('job_title')) is-invalid @endif" name="job_title" value="{{ old('job_title') }}" placeholder="Enter Job Title" required>
                                <div class="invalid-feedback">{{ $errors->first('job_title') }}</div>
                            </div>
                        </div>
                        <!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Tax Code <span class="text-danger">*</span></label>
                                <select class="form-control" class="form-control @if ($errors->has('tax_code')) is-invalid @endif" name="tax_code" value="{{ old('tax_code') }}">
                                    <option value="">--SELECT--</option>
                                    <option value="P" {{ old('tax_code')=='0' ? 'selected':'' }}>P - Primary</option>
                                    <option value="S" {{ old('tax_code')=='1' ? 'selected':'' }}>S - Secondary</option>
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('tax_code') }}</div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Provident Fund ID<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('provident_fund_id')) is-invalid @endif" name="provident_fund_id" value="{{ old('provident_fund_id') }}" placeholder="Enter Provident Fund" required>
                                <div class="invalid-feedback">{{ $errors->first('provident_fund_id') }}</div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Employee ID<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('employee_id')) is-invalid @endif" name="employee_id" value="{{ old('employee_id') }}" placeholder="Enter Employee ID" required>
                                <div class="invalid-feedback">{{ $errors->first('employee_id') }}</div>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <label>&nbsp;</label>
                            <div class="form-check form-check-flat form-check-primary chk-bx-typ2">
                                <input class="form-check-input @if ($errors->has('check_out_reqd')) is-invalid @endif" type="checkbox" name="check_out_reqd" id="check_out_reqd">
                                <label class="form-check-label" for="check_out_reqd">Tick if check-out is required for this employee <span></span></label>
                            </div>
                        </div>

                        <!-- <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Checkout Required? <span class="text-danger">*</span></label>
                                <input type="checkbox" class="form-control @if ($errors->has('check_out_reqd')) is-invalid @endif" name="check_out_reqd" value="{{ old('check_out_reqd') }}">
                                <div class="invalid-feedback">{{ $errors->first('check_out_reqd') }}</div>
                            </div>
                        </div> -->


                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Phone Number <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control @if ($errors->has('street')) is-invalid @endif" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone No" required>
                                <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Date Of Birth<span class="text-danger"> *</span></label>
                                <input type="date" class="form-control @if ($errors->has('city')) is-invalid @endif" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Enter DOB" required>
                                <div class="invalid-feedback">{{ $errors->first('date_of_birth') }}</div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Street <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control @if ($errors->has('street')) is-invalid @endif" name="street" value="{{ old('street') }}" placeholder="Enter Street Name" required>
                                <div class="invalid-feedback">{{ $errors->first('street') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">City / Town <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control @if ($errors->has('city')) is-invalid @endif" name="city" value="{{ old('city') }}" placeholder="Enter City" required>
                                <div class="invalid-feedback">{{ $errors->first('city') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Post Code <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control @if ($errors->has('postcode')) is-invalid @endif" name="postcode" value="{{ old('postcode') }}" placeholder="Enter Post Code" required>
                                <div class="invalid-feedback">{{ $errors->first('postcode') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Country<span class="text-danger">*</span></label>
                                <select class="form-control" name="country" id="country" value="{{ old('country') }}" required>
                                    <option value="">--SELECT--</option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country['id']}}" {{ old('country')==$country['id'] ? 'selected':'' }}>{{$country['name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4" style="display: none;" id="bank_div">
                            <div class="form-group">
                                <label class="control-label">bank <span class="text-danger">*</span></label>
                                <select class="form-control" name="bank" id="bank" value="{{ old('bank') }}">
                                </select>

                                <div class="invalid-feedback">{{ $errors->first('bank') }}</div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Tax Identification Number<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control @if ($errors->has('tin')) is-invalid @endif" name="tin" value="{{ old('tin') }}" placeholder="Enter Tin" required>
                                <div class="invalid-feedback">{{ $errors->first('tin') }}</div>
                            </div>
                        </div><!-- Col -->

                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Business<span class="text-danger">*</span></label>
                                <select id="business_user" class="form-control" class="form-control @if ($errors->has('business')) is-invalid @endif" name="business" value="{{ old('business') }}" required>
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
                                <select id="branch_user" class="form-control" class="form-control @if ($errors->has('branch')) is-invalid @endif" name="branch" value="{{ old('branch') }}" required>
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
                                <select id="department_user" class="form-control" class="form-control @if ($errors->has('department')) is-invalid @endif" name="department" value="{{ old('department') }}" required>
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
                                <label class="control-label">Bank Branch<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control @if ($errors->has('bank_branch')) is-invalid @endif" name="bank_branch" value="{{ old('bank_branch') }}" placeholder="Enter Bank Branch" required>
                                <div class="invalid-feedback">{{ $errors->first('bank_branch') }}</div>
                            </div>
                        </div><!-- Col -->

                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Account Number<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control @if ($errors->has('account_number')) is-invalid @endif" name="account_number" value="{{ old('account_number') }}" placeholder="Enter Account Number" required>
                                <div class="invalid-feedback">{{ $errors->first('account_number') }}</div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Role<span class="text-danger">*</span></label>
                                <select class="form-control" class="form-control @if ($errors->has('position')) is-invalid @endif" name="position" value="{{ old('position') }}" required>
                                    <option value="">--SELECT--</option>
                                    @foreach ($roles as $key => $value)
                                    <option value="{{$value['id']}}" {{ old('position')==$value['id'] ? 'selected':'' }}>{{$value['role_name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('position') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>



                    <!-- Row  Licence-->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Licence No </label>
                                <input type="text" class="form-control @if ($errors->has('licence_no')) is-invalid @endif" name="licence_no" value="{{ old('licence_no') }}" placeholder="Enter Licence No">
                                <div class="invalid-feedback">{{ $errors->first('licence_no') }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Licence Expiry Date</label>
                                <input type="date" class="form-control @if ($errors->has('licence_expiry_date')) is-invalid @endif" name="licence_expiry_date" value="{{ old('licence_expiry_date') }}" placeholder="Enter Licence Expiry Date">
                                <div class="invalid-feedback">{{ $errors->first('licence_expiry_date') }}</div>
                            </div>
                        </div>

                    </div>

                    <!-- Row -->

                    <!-- Row  Passport-->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Passport No </label>
                                <input type="text" class="form-control @if ($errors->has('passport_no')) is-invalid @endif" name="passport_no" value="{{ old('passport_no') }}" placeholder="Enter Passport No">
                                <div class="invalid-feedback">{{ $errors->first('passport_no') }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Passport Expiry Date</label>
                                <input type="date" class="form-control @if ($errors->has('passport_expiry_date')) is-invalid @endif" name="passport_expiry_date" value="{{ old('passport_expiry_date') }}" placeholder="Enter Passport Expiry Date">
                                <div class="invalid-feedback">{{ $errors->first('passport_expiry_date') }}</div>
                            </div>
                        </div>

                    </div>

                    <!-- Row -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Start date of employment <span class="text-danger"> *</span></label>
                                <input type="date" class="form-control @if ($errors->has('start_date')) is-invalid @endif" name="start_date" value="{{ old('start_date') }}" placeholder="Enter Image" required>
                                <div class="invalid-feedback">{{ $errors->first('start_date') }}</div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">End date of employment</label>
                                <input type="date" class="form-control @if ($errors->has('end_date')) is-invalid @endif" name="end_date" value="{{ old('end_date') }}" placeholder="Enter Image">
                                <div class="invalid-feedback">{{ $errors->first('end_date') }}</div>
                            </div>
                        </div><!-- Col -->


                    </div><!-- Row -->



                    <div class="row" id="time-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Check-In Time(Default) </label>
                                <input type="time" class="form-control @if ($errors->has('start_time')) is-invalid @endif" name="start_time" value="{{ old('start_time') }}">
                                <div class="invalid-feedback">{{ $errors->first('start_time') }}</div>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Check-Out Time(Default) </label>
                                <input type="time" class="form-control @if ($errors->has('end_time')) is-invalid @endif" name="end_time" value="{{ old('end_time') }}">
                                <div class="invalid-feedback">{{ $errors->first('end_time') }}</div>
                            </div>
                        </div><!-- Col -->

                    </div><!-- Row -->



                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Image <span class="text-danger"> *</span></label>
                                <input type="file" class="form-control @if ($errors->has('image')) is-invalid @endif" name="image" placeholder="Enter Image" value="{{ old('image') }}" required>
                                <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Employee type<span class="text-danger">*</span></label>
                                <select class="form-control" class="form-control @if ($errors->has('employeetype')) is-invalid @endif" name="employeetype" value="{{ old('employeetype') }}" required>
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
                    <!-- Add extra fields for existing employees (initially hidden) -->
                    {{--<div class="extra-fields row"  >
                      <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Annual Leaves Taken<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @if ($errors->has('annual_leaves_taken')) is-invalid @endif" name="annual_leaves_taken" value="{{ old('annual_leaves_taken') }}" placeholder="Annual leaves taken" >
                    <div class="invalid-feedback">{{ $errors->first('annual_leaves_taken') }}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Sick Leaves Taken <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if ($errors->has('sick_leaves_taken')) is-invalid @endif" name="sick_leaves_taken" value="{{ old('sick_leaves_taken') }}" placeholder="Sick leaves taken">
                <div class="invalid-feedback">{{ $errors->first('sick_leaves_taken') }}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Bereavement Leaves Taken <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if ($errors->has('bereavement_leaves_taken')) is-invalid @endif" name="bereavement_leaves_taken" value="{{ old('bereavement_leaves_taken') }}" placeholder="Bereavement leaves taken">
                <div class="invalid-feedback">{{ $errors->first('bereavement_leaves_taken') }}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Maternity Leaves Taken <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if ($errors->has('maternity_leaves_taken')) is-invalid @endif" name="maternity_leaves_taken" value="{{ old('maternity_leaves_taken') }}" placeholder="Maternity leaves taken">
                <div class="invalid-feedback">{{ $errors->first('maternity_leaves_taken') }}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Leave Without Pay <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if ($errors->has('leave_without_pay')) is-invalid @endif" name="leave_without_pay" value="{{ old('leave_without_pay') }}" placeholder="Leave without pay">
                <div class="invalid-feedback">{{ $errors->first('leave_without_pay') }}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Special Leaves Taken <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if ($errors->has('special_leave')) is-invalid @endif" name="special_leave" value="{{ old('special_leave') }}" placeholder="Special leaves taken">
                <div class="invalid-feedback">{{ $errors->first('special_leave') }}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Attendance To Date <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if ($errors->has('attendance_to_date')) is-invalid @endif" name="attendance_to_date" value="{{ old('attendance_to_date') }}" placeholder="Attendance to date">
                <div class="invalid-feedback">{{ $errors->first('attendance_to_date') }}</div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label">Days Absent <span class="text-danger">*</span></label>
                <input type="text" class="form-control @if ($errors->has('days_absent')) is-invalid @endif" name="days_absent" value="{{ old('days_absent') }}" placeholder="Enter days absent">
                <div class="invalid-feedback">{{ $errors->first('days_absent') }}</div>
            </div>
        </div>

    </div>--}}
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
    function validateForm() {
        var psw1 = document.getElementById("pswd1").value;
        var psw2 = document.getElementById("pswd2").value;
        if (psw1 != psw2) {
            document.getElementById("message1").innerHTML = "** Passwords are not same";
            return false;
        }
    } // Password Validation End
</script>
<script>
    $(function() {
        $('.hourly-section, .fixed-section').hide();
        $('#salary-type').on('change', function() {
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

        $('#country').change(function(e) {
            var id = $(this).val();
            $("#wbc_details").hide();

            $('#bank').find('option').remove();
            $.ajax({
                type: 'get',
                url: '/employer/report/employment_period/get_bank/' + id,
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response != null) {
                        len = response['data'].length;
                    }
                    if (len > 0) {
                        $("#bank_div").show();
                        var option1 = "<option value=''>--Choose Bank--</option>";
                        $('#bank').append(option1);
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].bank_name;
                            var option = "<option value='" + id + "'>" + name + "</option>";
                            $('#bank').append(option);
                        }
                    }
                }
            });
        });


        $('#bank').change(function(e) {
            var id = $(this).val();
            var selectedOption = $("#bank option:selected");
            var selectedText = selectedOption.text();
            if (selectedText == 'WBC' || selectedText == 'Westpac') {
                $("#wbc_details").show();
            } else {
                $("#wbc_details").hide();
                $("#company_name").val("");
                $("#account_number").val("");
                $("#batch_no").val("");
            }

        });




        $('#business_user').change(function(e) {
            var id = $(this).val();
            $('#branch_user').find('option').not(':first').remove();

            $.ajax({
                type: 'get',
                url: '/employer/report/employment_period/get_branch/' + id,
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response != null) {
                        len = response['data'].length;
                    }
                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].name;
                            var option = "<option value='" + id + "'>" + name + "</option>";
                            $('#branch_user').append(option);
                        }
                    }
                }
            });
        });

        $('#branch_user').change(function(e) {
            var id = $(this).val();
            $('#department_user').find('option').not(':first').remove();

            $.ajax({
                type: 'get',
                url: '/employer/report/employment_period/get_department/' + id,
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response != null) {
                        len = response['data'].length;
                    }
                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].dep_name;
                            var option = "<option value='" + id + "'>" + name + "</option>";
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
@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Create User Capabilities </h6>
                <form method="POST" action="{{ route('employer.usercapabilities.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">User Role<span class="text-danger">*</span></label>
                                <select class="form-control" class="form-control @if ($errors->has('role_name')) is-invalid @endif" name="role_name" value="{{ old('role_name') }}" required>
                                    <option value="">--SELECT--</option>
                                    @foreach ($roles as $key => $value)
                                    <option value="{{$value['id']}}">{{$value['role_name']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('role_name') }}</div>
                            </div>
                        </div><!-- Col -->

                    </div><!-- Row -->


                    <!-- <select class="form-control"  class="form-control @if ($errors->has('wages')) is-invalid @endif" name="wages" value="{{ old('wages') }}" required>
                                     <option value="0">No</option>                              
                                    <option value="1">Yes</option>
                                                                  
                                </select> -->



                    <!--Design-->

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Billing</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_card" name="manage_card" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit/Delete card</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="invoice_payments" name="invoice_payments" value="0">
                                <label for="" class="control-label mb-0 ml-2">Invoice Payments</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="billing_email_edit" name="billing_email_edit" value="0">
                                <label for="" class="control-label mb-0 ml-2">Billing Emails Edit</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_invoices" name="view_invoices" value="0">
                                <label for="" class="control-label mb-0 ml-2">View invoices</label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Business Settings</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_business" name="manage_business" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Business</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_branches" name="manage_branches" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Branches</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_departments" name="manage_departments" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Departments</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_business" name="view_business" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Business</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_branch" name="view_branch" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Branch</label>
                            </div>
                        </div>



                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_department" name="view_department" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Department</label>
                            </div>
                        </div>

                    </div>
                    <hr>


                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Budget Settings</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_payroll_budget" name="manage_payroll_budget" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Payroll Budget</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_payroll_budget" name="view_payroll_budget" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Payroll Budget</label>
                            </div>
                        </div>


                    </div>
                    <hr>




                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Manage Employees</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="add_employee" name="add_employee" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create Employee</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="edit_employee" name="edit_employee" value="0">
                                <label for="" class="control-label mb-0 ml-2">Edit Employee details</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="activate_inactivate" name="activate_inactivate" value="0">
                                <label for="" class="control-label mb-0 ml-2">Activate/Inactivate</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="upload_doc" name="upload_doc" value="0">
                                <label for="" class="control-label mb-0 ml-2">Upload documents</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="assign_projects" name="assign_projects" value="0">
                                <label for="" class="control-label mb-0 ml-2">Assign Projects</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_medical_details" name="view_medical_details" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Medical details</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="medical" name="medical" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Medical details</label>
                            </div>
                        </div>

                    </div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Provident Fund Details</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_contributions" name="manage_contributions" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Contributions </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_contributions" name="view_contributions" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Contribution List</label>
                            </div>
                        </div>
                    </div>
                    <hr>


                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">User Capabilities</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_roles" name="manage_roles" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Roles </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_roles" name="view_roles" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Roles</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_user_capabilities" name="manage_user_capabilities" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit User Capabilities</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_user_capabilities" name="view_user_capabilities" value="0">
                                <label for="" class="control-label mb-0 ml-2">View User Capabilities</label>
                            </div>
                        </div>
                    </div>
                    <hr>


                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Roster Settings</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_roster" name="manage_roster" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Roster</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_roster" name="view_roster" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Roster</label>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Project Settings</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="projects" name="projects" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Projects</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="assign_projects" name="assign_projects" value="0">
                                <label for="" class="control-label mb-0 ml-2">Assign Projects</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_projects" name="view_projects" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Projects</label>
                            </div>
                        </div>


                    </div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Attendance</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="attendance" name="attendance" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Attendance</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="approve_attendance" name="approve_attendance" value="0">
                                <label for="" class="control-label mb-0 ml-2">Approve/Decline Attendance</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_attendance" name="view_attendance" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Attendance</label>
                            </div>
                        </div>


                    </div>
                    <hr>


                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Leave settings</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_leavetypes" name="manage_leavetypes" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Leave types</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="approve_decline_leaverequest" name="approve_decline_leaverequest" value="0">
                                <label for="" class="control-label mb-0 ml-2">Approve/Decline Leave requests</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_status" name="view_status" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Status</label>
                            </div>
                        </div>


                    </div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Payroll Settings</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_payroll" name="view_payroll" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Payroll</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="calculate_payroll" name="calculate_payroll" value="0">
                                <label for="" class="control-label mb-0 ml-2">Process Payroll</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_split_payments" name="view_split_payments" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Split Payments</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_overtime_status" name="view_overtime_status" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Overtime Status</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_overtime" name="manage_overtime" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Overtime</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="approve_decline_overtime" name="approve_decline_overtime" value="0">
                                <label for="" class="control-label mb-0 ml-2">Approve/Decline Overtime</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="payslip_settings" name="payslip_settings" value="0">
                                <label for="" class="control-label mb-0 ml-2">Payslip Settings</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="receive_payroll_email" name="receive_payroll_email" value="0">
                                <label for="" class="control-label mb-0 ml-2">Receive Payroll Email</label>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Employee Adjustment Settings</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_allowance" name="manage_allowance" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Allowances</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_allowance" name="view_allowance" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Allowances</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_advance_loan__paid" name="view_advance_loan__paid" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Advance Pay/Loan paid</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_advance_pay_loan" name="manage_advance_pay_loan" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Advance Pay/Loan</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="approve_decline_advance_pay_loan" name="approve_decline_advance_pay_loan" value="0">
                                <label for="" class="control-label mb-0 ml-2">Approve/Decline Advance Pay/Loan requests</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_bonus" name="manage_bonus" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Bonus</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_bonus" name="view_bonus" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Bonus</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="deductions" name="deductions" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Deductions</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="create_manual_payment_record" name="create_manual_payment_record" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create Manual Payment Record</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_deduction" name="view_deduction" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Deduction</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_commission" name="manage_commission" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Commission</label>
                            </div>
                        </div>


                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_commission" name="view_commission" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Commission</label>
                            </div>
                        </div>

                    </div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Uploads/Downloads</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_uploads" name="manage_uploads" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Uploads</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_download_uploads" name="view_download_uploads" value="0">
                                <label for="" class="control-label mb-0 ml-2">View/Download</label>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Manage Calendar</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_events" name="manage_events" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Events</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="create_meetings" name="create_meetings" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Meetings</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_holidays" name="manage_holidays" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Holidays</label>
                            </div>
                        </div>

                    </div>
                    <hr>


                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Reports</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_attendance" name="view_attendance" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Attendance</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_allowance" name="view_allowance" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Allowance</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_allowance" name="download_allowance" value="0">
                                <label for="" class="control-label mb-0 ml-2">Download Allowance</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_employemnt_periods" name="view_employemnt_periods" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Employment Periods</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_deductions" name="view_deductions" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Deductions</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_pf_tax" name="view_pf_tax" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Provident Fund and Tax</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_status_active_inactive" name="view_status_active_inactive" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Status (active/inactive)</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_projects" name="view_projects" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Projects</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_attendance" name="download_attendance" value="0">
                                <label for="" class="control-label mb-0 ml-2">Download Attendance</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_deductions" name="download_deductions" value="0">
                                <label for="" class="control-label mb-0 ml-2">Download Deductions</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_pf_tax" name="download_pf_tax" value="0">
                                <label for="" class="control-label mb-0 ml-2">Download Provident Fund and Tax</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_status" name="download_status" value="0">
                                <label for="" class="control-label mb-0 ml-2">Download Status</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_projects" name="download_projects" value="0">
                                <label for="" class="control-label mb-0 ml-2">Download Projects</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_commissions" name="view_commissions" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Commissions</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_commission" name="download_commission" value="0">
                                <label for="" class="control-label mb-0 ml-2">Download Commission</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_payroll" name="view_payroll" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Payroll</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_payroll" name="download_payroll" value="0">
                                <label for="" class="control-label mb-0 ml-2">Download Payroll</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_advance_loan_pay" name="view_advance_loan_pay" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Advance Pay/Loan</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_advance_loan_pay" name="download_advance_loan_pay" value="0">
                                <label for="" class="control-label mb-0 ml-2">Download Advance Pay / Loan</label>
                            </div>
                        </div>

                    </div>
                    <hr>


                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Chat</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="create_chat_groups" name="create_chat_groups" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Chat groups</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="create_remove_chat_members" name="create_remove_chat_members" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create/Remove Members</label>
                            </div>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Support Ticket</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="add_support_ticket" name="add_support_ticket" value="0">
                                <label for="" class="control-label mb-0 ml-2">Create Support Ticket</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_support_ticket" name="view_support_ticket" value="0">
                                <label for="" class="control-label mb-0 ml-2">View Support Ticket</label>
                            </div>
                        </div>
                    </div>
                    <!--End Design-->






                    <div>
                    </div>


                    <input type="submit" class="btn btn-primary submit" value="Submit">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection



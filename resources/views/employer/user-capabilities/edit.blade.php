@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Edit User Capabilities </h6>
                <form method="POST" action="{{ route('employer.usercapabilities.update',$usercapability) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">User Role<span class="text-danger">*</span></label>
                                <select class="form-control" class="form-control @if ($errors->has('role_name')) is-invalid @endif" name="role_name" value="{{ old('role_name', $usercapability->role_name) }}" required>
                                    <option disabled="disabled">--SELECT--</option>
                                    @foreach ($roles as $key => $value)
                                    <option value="{{$value['id']}}" @if ($value['id']==$usercapability->role_id)
                                        selected
                                        @endif disabled="disabled">{{$value['role_name']}}</option>
                                    @endforeach
                                    <input type="hidden" name="role_name" value="{{$usercapability->role_id}}">
                                </select>

                                <div class="invalid-feedback">{{ $errors->first('role_name') }}</div>
                            </div>
                        </div><!-- Col -->

                    </div><!-- Row -->

                    <!-- Design--->
                    <!--Design-->

                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Billing</h6>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_card" name="manage_card"  value="{{ $usercapability->manage_card }}" {{ ($usercapability->manage_card == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit/Delete card</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="invoice_payments" name="invoice_payments" value="{{ $usercapability->invoice_payments }}" {{ ($usercapability->invoice_payments == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Invoice Payments</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="billing_email_edit" name="billing_email_edit" value="{{ $usercapability->billing_email_edit}}" {{ ($usercapability->billing_email_edit == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Billing Emails Edit</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_invoices" name="view_invoices" value="{{ $usercapability->view_invoices}}" {{ ($usercapability->view_invoices == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="manage_business" name="manage_business" value="{{ $usercapability->manage_business}}" {{ ($usercapability->manage_business == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Business</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_branches" name="manage_branches" value="{{ $usercapability->manage_branches}}" {{ ($usercapability->manage_branches == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Branches</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_departments" name="manage_departments" value="{{ $usercapability->manage_departments}}" {{ ($usercapability->manage_departments == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Departments</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_business" name="view_business" value="{{ $usercapability->view_business}}" {{ ($usercapability->view_business == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Business</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_branch" name="view_branch" value="{{ $usercapability->view_branch}}" {{ ($usercapability->view_branch == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Branch</label>
                            </div>
                        </div>



                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_department" name="view_department" value="{{ $usercapability->view_department}}" {{ ($usercapability->view_department == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="manage_payroll_budget" name="manage_payroll_budget" value="{{ $usercapability->manage_payroll_budget}}" {{ ($usercapability->manage_payroll_budget == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Payroll Budget</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_payroll_budget" name="view_payroll_budget" value="{{ $usercapability->view_payroll_budget}}" {{ ($usercapability->view_payroll_budget == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="add_employee" name="add_employee" value="{{ $usercapability->add_employee}}" {{ ($usercapability->add_employee == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create Employee</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="edit_employee" name="edit_employee" value="{{ $usercapability->edit_employee}}" {{ ($usercapability->edit_employee == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Edit Employee details</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="activate_inactivate" name="activate_inactivate" value="{{ $usercapability->activate_inactivate}}" {{ ($usercapability->activate_inactivate == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Activate/Inactivate</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="upload_doc" name="upload_doc" value="{{ $usercapability->upload_doc}}" {{ ($usercapability->upload_doc == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Upload documents</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="assign_projects" name="assign_projects" value="{{ $usercapability->assign_projects}}" {{ ($usercapability->assign_projects == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Assign Projects</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_medical_details" name="view_medical_details" value="{{ $usercapability->view_medical_details}}" {{ ($usercapability->view_medical_details == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Medical details</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="medical" name="medical" value="{{ $usercapability->medical}}" {{ ($usercapability->medical == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="manage_contributions" name="manage_contributions" value="{{ $usercapability->manage_contributions}}" {{ ($usercapability->manage_contributions == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Contributions </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_contributions" name="view_contributions" value="{{ $usercapability->view_contributions}}" {{ ($usercapability->view_contributions == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="manage_roles" name="manage_roles" value="{{ $usercapability->manage_roles}}" {{ ($usercapability->manage_roles == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Roles </label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_roles" name="view_roles" value="{{ $usercapability->view_roles}}" {{ ($usercapability->view_roles == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Roles</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_user_capabilities" name="manage_user_capabilities" value="{{ $usercapability->manage_user_capabilities}}" {{ ($usercapability->manage_user_capabilities == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit User Capabilities</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_user_capabilities" name="view_user_capabilities" value="{{ $usercapability->view_user_capabilities}}" {{ ($usercapability->view_user_capabilities == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="manage_roster" name="manage_roster" value="{{ $usercapability->manage_roster}}" {{ ($usercapability->manage_roster == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Roster</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_roster" name="view_roster" value="{{ $usercapability->view_roster}}" {{ ($usercapability->view_roster == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="projects" name="projects" value="{{ $usercapability->projects}}" {{ ($usercapability->projects == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Projects</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="assign_projects" name="assign_projects" value="{{ $usercapability->assign_projects}}" {{ ($usercapability->assign_projects == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Assign Projects</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_projects" name="view_projects" value="{{ $usercapability->view_projects}}" {{ ($usercapability->view_projects == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="attendance" name="attendance" value="{{ $usercapability->attendance}}" {{ ($usercapability->attendance == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Attendance</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="approve_attendance" name="approve_attendance" value="{{ $usercapability->approve_attendance}}" {{ ($usercapability->approve_attendance == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Approve/Decline Attendance</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_attendance" name="view_attendance" value="{{ $usercapability->view_attendance}}" {{ ($usercapability->view_attendance == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="manage_leavetypes" name="manage_leavetypes" value="{{ $usercapability->manage_leavetypes}}" {{ ($usercapability->manage_leavetypes == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Leave types</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="approve_decline_leaverequest" name="approve_decline_leaverequest" value="{{ $usercapability->approve_decline_leaverequest}}" {{ ($usercapability->approve_decline_leaverequest == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Approve/Decline Leave requests</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_status" name="view_status" value="{{ $usercapability->view_status}}" {{ ($usercapability->view_status == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="view_payroll" name="view_payroll" value="{{ $usercapability->view_payroll}}" {{ ($usercapability->view_payroll == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Payroll</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="calculate_payroll" name="calculate_payroll" value="{{ $usercapability->calculate_payroll}}" {{ ($usercapability->calculate_payroll == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Process Payroll</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_split_payments" name="view_split_payments" value="{{ $usercapability->view_split_payments}}" {{ ($usercapability->view_split_payments == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Split Payments</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_overtime_status" name="view_overtime_status" value="{{ $usercapability->view_overtime_status}}" {{ ($usercapability->view_overtime_status == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Overtime Status</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_overtime" name="manage_overtime" value="{{ $usercapability->manage_overtime}}" {{ ($usercapability->manage_overtime == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Overtime</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="approve_decline_overtime" name="approve_decline_overtime" value="{{ $usercapability->approve_decline_overtime}}" {{ ($usercapability->approve_decline_overtime == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Approve/Decline Overtime</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="payslip_settings" name="payslip_settings" value="{{ $usercapability->payslip_settings}}" {{ ($usercapability->payslip_settings == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Payslip Settings</label>
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
                                <input type="checkbox" class="" id="manage_allowance" name="manage_allowance" value="{{ $usercapability->manage_allowance}}" {{ ($usercapability->manage_allowance == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Allowances</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_allowance" name="view_allowance" value="{{ $usercapability->view_allowance}}" {{ ($usercapability->view_allowance == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Allowances</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_advance_loan__paid" name="view_advance_loan__paid" value="{{ $usercapability->view_advance_loan__paid}}" {{ ($usercapability->view_advance_loan__paid == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Advance Pay/Loan paid</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_advance_pay_loan" name="manage_advance_pay_loan" value="{{ $usercapability->manage_advance_pay_loan}}" {{ ($usercapability->manage_advance_pay_loan == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Advance Pay/Loan</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="approve_decline_advance_pay_loan" name="approve_decline_advance_pay_loan" value="{{ $usercapability->approve_decline_advance_pay_loan}}" {{ ($usercapability->approve_decline_advance_pay_loan == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Approve/Decline Advance Pay/Loan requests</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_bonus" name="manage_bonus" value="{{ $usercapability->manage_bonus}}" {{ ($usercapability->manage_bonus == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Bonus</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_bonus" name="view_bonus" value="{{ $usercapability->view_bonus}}" {{ ($usercapability->view_bonus == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Bonus</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="deductions" name="deductions" value="{{ $usercapability->deductions}}" {{ ($usercapability->deductions == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Deductions</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="create_manual_payment_record" name="create_manual_payment_record" value="{{ $usercapability->create_manual_payment_record}}" {{ ($usercapability->create_manual_payment_record == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create Manual Payment Record</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_deduction" name="view_deduction" value="{{ $usercapability->view_deduction}}" {{ ($usercapability->view_deduction == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Deduction</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_commission" name="manage_commission" value="{{ $usercapability->manage_commission}}" {{ ($usercapability->manage_commission == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Commission</label>
                            </div>
                        </div>


                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_commission" name="view_commission" value="{{ $usercapability->view_commission}}" {{ ($usercapability->view_commission == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="manage_uploads" name="manage_uploads" value="{{ $usercapability->manage_uploads}}" {{ ($usercapability->manage_uploads == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Uploads</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_download_uploads" name="view_download_uploads" value="{{ $usercapability->view_download_uploads}}" {{ ($usercapability->view_download_uploads == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="manage_events" name="manage_events" value="{{ $usercapability->manage_events}}" {{ ($usercapability->manage_events == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Events</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="create_meetings" name="create_meetings" value="{{ $usercapability->create_meetings}}" {{ ($usercapability->create_meetings == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Meetings</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="manage_holidays" name="manage_holidays" value="{{ $usercapability->manage_holidays}}" {{ ($usercapability->manage_holidays == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="view_attendance" name="view_attendance" value="{{ $usercapability->view_attendance}}" {{ ($usercapability->view_attendance == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Attendance</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_allowance" name="view_allowance" value="{{ $usercapability->view_allowance}}" {{ ($usercapability->view_allowance == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Allowance</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_allowance" name="download_allowance" value="{{ $usercapability->download_allowance}}" {{ ($usercapability->download_allowance == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Download Allowance</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_employemnt_periods" name="view_employemnt_periods" value="{{ $usercapability->view_employemnt_periods}}" {{ ($usercapability->view_employemnt_periods == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Employment Periods</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_deductions" name="view_deductions" value="{{ $usercapability->view_deductions}}" {{ ($usercapability->view_deductions == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Deductions</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_pf_tax" name="view_pf_tax" value="{{ $usercapability->view_pf_tax}}" {{ ($usercapability->view_pf_tax == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Provident Fund and Tax</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_status_active_inactive" name="view_status_active_inactive" value="{{ $usercapability->view_status_active_inactive}}" {{ ($usercapability->view_status_active_inactive == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Status (active/inactive)</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_projects" name="view_projects" value="{{ $usercapability->view_projects}}" {{ ($usercapability->view_projects == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Projects</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_attendance" name="download_attendance" value="{{ $usercapability->download_attendance}}" {{ ($usercapability->download_attendance == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Download Attendance</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_deductions" name="download_deductions" value="{{ $usercapability->download_deductions}}" {{ ($usercapability->download_deductions == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Download Deductions</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_pf_tax" name="download_pf_tax" value="{{ $usercapability->download_pf_tax}}" {{ ($usercapability->download_pf_tax_pf_tax == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Download Provident Fund and Tax</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_status" name="download_status" value="{{ $usercapability->download_status}}" {{ ($usercapability->download_status == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Download Status</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_projects" name="download_projects" value="{{ $usercapability->download_projects}}" {{ ($usercapability->download_projects == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Download Projects</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_commissions" name="view_commissions" value="{{ $usercapability->view_commissions}}" {{ ($usercapability->view_commissions == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Commissions</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_commission" name="download_commission" value="{{ $usercapability->download_commission}}" {{ ($usercapability->download_commission == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Download Commission</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_payroll" name="view_payroll" value="{{ $usercapability->view_payroll}}" {{ ($usercapability->view_payroll == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Payroll</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_payroll" name="download_payroll" value="{{ $usercapability->download_payroll}}" {{ ($usercapability->download_payroll == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Download Payroll</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_advance_loan_pay" name="view_advance_loan_pay" value="{{ $usercapability->view_advance_loan_pay}}" {{ ($usercapability->view_advance_loan_pay == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Advance Pay/Loan</label>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="download_advance_loan_pay" name="download_advance_loan_pay" value="{{ $usercapability->download_advance_loan_pay}}" {{ ($usercapability->download_advance_loan_pay == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="create_chat_groups" name="create_chat_groups" value="{{ $usercapability->create_chat_groups}}" {{ ($usercapability->create_chat_groups == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create/Edit Chat groups</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="create_remove_chat_members" name="create_remove_chat_members" value="{{ $usercapability->create_remove_chat_members}}" {{ ($usercapability->create_remove_chat_members == 1 ? 'checked' : '')}}>
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
                                <input type="checkbox" class="" id="add_support_ticket" name="add_support_ticket" value="{{ $usercapability->add_support_ticket}}" {{ ($usercapability->add_support_ticket == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">Create Support Ticket</label>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="" id="view_support_ticket" name="view_support_ticket" value="{{ $usercapability->view_support_ticket}}" {{ ($usercapability->view_support_ticket == 1 ? 'checked' : '')}}>
                                <label for="" class="control-label mb-0 ml-2">View Support Ticket</label>
                            </div>
                        </div>
                    </div>
                    <!--End Design-->

                    <input type="submit" class="btn btn-primary submit" value="Submit">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
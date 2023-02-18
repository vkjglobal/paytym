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
                                <select class="form-control"  class="form-control @if ($errors->has('role_name')) is-invalid @endif" name="role_name" value="{{ old('role_name', $usercapability->role_name) }}" required>
                                    <option value="">--SELECT--</option>
                                    @foreach ($roles as $key => $value)
                                    <option value="{{$value['id']}}" @if ($value['id']==$usercapability->role_id)
                                        selected
                                    @endif>{{$value['role_name']}}</option>
                                    @endforeach
                                </select>
                                
                                <div class="invalid-feedback">{{ $errors->first('role_name') }}</div>
                            </div>
                        </div><!-- Col -->

                    </div><!-- Row -->

                    <div>
                        <table width="100%">
                            <tr>
                                <td>
                                <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Wages<span class="text-danger"></span></label>
                                <input type="hidden" name="wages" value="0">
                                <input type="checkbox" id="wages" name="wages"  value="{{ ($usercapability->wages) }}"{{ ($usercapability->wages == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('wages') }}</div>

                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Projects<span class="text-danger"></span></label>
                                <input type="hidden" name="projects" value="0">
                                <input type="checkbox" id="projects" name="projects" value="{{ ($usercapability->projects) }}"{{ ($usercapability->projects == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('projects') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Attendance<span class="text-danger"></span></label>
                                <input type="hidden" name="attendance" value="0">
                                <input type="checkbox" id="attendance" name="attendance" value="{{ ($usercapability->attendance) }}"{{ ($usercapability->attendance == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('attendance') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Approve Attendance<span class="text-danger"></span></label>
                                <input type="hidden" name="approve_attendance" value="0">
                                <input type="checkbox" id="approve_attendance" name="approve_attendance" value="{{ ($usercapability->approve_attendance) }}"{{ ($usercapability->approve_attendance == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('approve_attendance') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Medical<span class="text-danger"></span></label>
                                <input type="hidden" name="medical" value="0">
                                <input type="checkbox" id="medical" name="medical" value="{{ ($usercapability->medical) }}"{{ ($usercapability->medical == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('medical') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Contract Period<span class="text-danger"></span></label>
                                <input type="hidden" name="contract_period" value="0">
                                <input type="checkbox" id="contract_period" name="contract_period" value="{{ ($usercapability->contract_period) }}"{{ ($usercapability->contract_period == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('contract_period') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Deductions<span class="text-danger"></span></label>
                                <input type="hidden" name="deductions" value="0">
                                <input type="checkbox" id="deductions" name="deductions" value="{{ ($usercapability->deductions) }}"{{ ($usercapability->deductions == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('deductions') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>

                                </td>


                        <td>

                        <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Create Chat Groups<span class="text-danger"></span></label>
                                <input type="hidden" name="create_chat_groups" value="0">
                                <input type="checkbox" id="create_chat_groups" name="create_chat_groups" value="{{ ($usercapability->create_chat_groups) }}"{{ ($usercapability->create_chat_groups == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('create_chat_groups') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Create Meetings<span class="text-danger"></span></label>
                                <input type="hidden" name="create_meetings" value="0">
                                <input type="checkbox" id="create_meetings" name="create_meetings" value="{{ ($usercapability->create_meetings) }}"{{ ($usercapability->create_meetings == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('create_meetings') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Approve Leaves<span class="text-danger"></span></label>
                                <input type="hidden" name="approve_leaves" value="0">
                                <input type="checkbox" id="approve_leaves" name="approve_leaves" value="{{ ($usercapability->approve_leaves) }}"{{ ($usercapability->approve_leaves == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('approve_leaves') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">View Payroll<span class="text-danger"></span></label>
                                <input type="hidden" name="view_payroll" value="0">
                                <input type="checkbox" id="view_payroll" name="view_payroll" value="{{ ($usercapability->view_payroll) }}"{{ ($usercapability->view_payroll == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('view_payroll') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Approve Payroll<span class="text-danger"></span></label>
                                <input type="hidden" name="approve_payroll" value="0">
                                <input type="checkbox" id="approve_payroll"  name="approve_payroll" value="{{ ($usercapability->approve_payroll) }}"{{ ($usercapability->approve_payroll == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('approve_payroll') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Calculate Payroll<span class="text-danger"></span></label>
                                <input type="hidden" name="calculate_payroll" value="0">
                                <input type="checkbox" id="calculate_payroll"  name="calculate_payroll" value="{{ ($usercapability->calculate_payroll) }}"{{ ($usercapability->calculate_payroll == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('calculate_payroll') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Edit Deductions<span class="text-danger"></span></label>
                                <input type="hidden" name="edit_deduction" value="0">
                                <input type="checkbox" id="edit_deduction" name="edit_deduction" value="{{ ($usercapability->edit_deduction) }}"{{ ($usercapability->edit_deduction == 1 ? 'checked' : '')}} >
                                <div class="invalid-feedback">{{ $errors->first('edit_deduction') }}</div>
                            </div>
                        </div><!-- Col -->
                    </div>

                        </td>
                        
                            </tr></table></div>
                    

                <input type="submit" class="btn btn-primary submit" value="Submit">
                </form>

            </div>
        </div>
    </div>
</div>
@endsection



@push('custom_js')
<script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
<script>
     
  const wages = document.getElementById("wages"); 
  const projects = document.getElementById("projects");
  const attendance = document.getElementById("attendance");
  const approve_attendance = document.getElementById("approve_attendance");
  const medical = document.getElementById("medical");
  const contract_period = document.getElementById("contract_period");
  const deductions = document.getElementById("deductions");
  const create_chat_groups = document.getElementById("create_chat_groups");
  const create_meetings = document.getElementById("create_meetings");
  const approve_leaves = document.getElementById("approve_leaves");
  const view_payroll = document.getElementById("view_payroll");
  const approve_payroll = document.getElementById("approve_payroll");
  const calculate_payroll = document.getElementById("calculate_payroll");
  const edit_deduction = document.getElementById("edit_deduction");
 

  wages.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
   
  });
  projects.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
    
  });
  attendance.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
    alert(this.value);
  });
  approve_attendance.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
  });
  medical.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
    
  });
  contract_period.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
  });
  deductions.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
  });
  create_chat_groups.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
  });
  create_meetings.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
  });
  approve_leaves.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
  });
  view_payroll.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
  });
  approve_payroll.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
  });
  calculate_payroll.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
  });
  edit_deduction.addEventListener("change", function() {
    this.value = this.checked ? 1 : 0;
  });

</script>
@endpush

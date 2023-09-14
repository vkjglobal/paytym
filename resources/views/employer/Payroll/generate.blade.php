@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs')
@endcomponent
<div class="container mt-4">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#hourlyPay">All Employees</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#fixedPay">Choose Employee</a>
    </li>
  </ul>
  <div class="tab-content">
    <div id="hourlyPay" class="tab-pane active">
      <div class="card mt-3">
        <div class="card-header bg-primary text-white">
          <h4>All Employees</h4>
        </div>
        <div class="card-body">
          <form action="{{route('employer.payroll.generate.web')}}" method="get">
            @csrf
            <input type="hidden" id="payroll_type" name="payroll_type" value="1" />
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm">Generate Payroll</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="fixedPay" class="tab-pane">
      <div class="card mt-3">
        <div class="card-header bg-primary text-white">
          <h4>Choose Employee</h4>
        </div>
        <div class="card-body">
          <form action="{{route('employer.payroll.generate.web')}}" method="get">
            @csrf
            <input type="hidden" id="payroll_type" name="payroll_type" value="0" />
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">Business<span class="text-danger"></span></label>
                  <select name="business" id="business1" class="@if ($errors->has('business')) is-invalid @endif">
                    <option selected="true" value=" ">Choose Business</option>
                    @foreach($businesses as $business)
                    <option value="{{$business->id}}">{{$business->name}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">{{ $errors->first('business') }}</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">Branch<span class="text-danger"></span></label>
                  <select name="branch" id="branch1" class="@if ($errors->has('branch')) is-invalid @endif">
                    <option selected="true" value=" ">Choose Branch</option>
                    @foreach($branches as $branch)
                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">{{ $errors->first('branch') }}</div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">Department<span class="text-danger"></span></label>
                  <select name="department" id="department" class="@if ($errors->has('department')) is-invalid @endif">
                    <option selected="true" value=" ">Choose Department</option>
                    @foreach($departments as $department)
                    <option value="{{$department->id}}">{{$department->dep_name}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Select Employees</label>
                  <select id="employees" class="form-control @if ($errors->has('user')) is-invalid @endif" name="users[]" value="{{ old('user') }}" multiple="multiple">
                    @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->id}} - {{$user->first_name}}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">{{ $errors->first('user') }}</div>
                </div>
              </div><!-- Col -->
            </div>

            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm">Generate Payroll</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
@push('custom_js')
<script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
  $(document).ready(function() {
    $('#employees').select2({
      placeholder: "--Select--",
      allowClear: true
    });

  });
</script>

<script type="text/javascript">
  let token = "{{csrf_token()}}";
  (function($) {
    $('#business1').change(function(e) {
      var id = $(this).val();
      $('#branch1').find('option').not(':first').remove();

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
              $('#branch1').append(option);
            }
          }
        }
      });
    });
    $('#branch1').change(function(e) {
      var id = $(this).val();
      $('#department').find('option').not(':first').remove();

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
              $('#department').append(option);
            }
          }
        }
      });
    });
    $('#department').change(function(e) {
      var id = $(this).val();
      $('#user').find('option').not(':first').remove();

      $.ajax({
        type: 'get',
        url: '/employer/report/employment_period/get_user/' + id,
        dataType: 'json',
        success: function(response) {
          var len = 0;
          if (response != null) {
            len = response['data'].length;
          }
          if (len > 0) {
            for (var i = 0; i < len; i++) {
              var id = response['data'][i].id;
              var name = response['data'][i].first_name;
              var option = "<option value='" + id + "'>" + name + "</option>";
              $('#user').append(option);
            }
          }
        }
      });
    });
  })(jQuery);
</script>

@endpush
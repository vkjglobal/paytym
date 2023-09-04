@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs')
    @endcomponent
    <div class="container mt-4">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#hourlyPay">Hourly Pay</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#fixedPay">Fixed Pay</a>
    </li>
  </ul>
  <div class="tab-content">
    <div id="hourlyPay" class="tab-pane active">
      <div class="card mt-3">
        <div class="card-header bg-primary text-white">
          <h4>Hourly Payroll</h4>
        </div>
        <div class="card-body">
          <form action="{{route('employer.payroll.generate.hourly')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="payDate">Pay Date:</label>
              <input type="date" name="paydate" class="form-control" id="payDate">
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
    <div id="fixedPay" class="tab-pane">
      <div class="card mt-3">
        <div class="card-header bg-primary text-white">
          <h4>Fixed Payroll</h4>
        </div>
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="payType">Pay Type:</label>
              <select class="form-control" id="payType">
                <option value="weekly">Weekly</option>
                <option value="fortnightly">Fortnightly</option>
                <option value="monthly">Monthly</option>
              </select>
            </div>
            <div class="form-group">
              <label for="calculationType">Calculate By:</label>
              <select class="form-control" id="calculationType">
                <option value="department">Department</option>
                <option value="branch">Branch</option>
                <option value="business">Business</option>
              </select>
            </div>
            <div class="form-group">
              <label for="payDate">Pay Date:</label>
              <input type="date" class="form-control" id="payDate">
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
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>
@endpush

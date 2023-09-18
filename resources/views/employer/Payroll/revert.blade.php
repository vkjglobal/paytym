@extends('employer.layouts.app')
@section('content')
@component('employer.layouts.partials.breadcrumbs')
@endcomponent
<div class="container mt-4">
<div class="card mt-3">
        <div class="card-header bg-primary text-white">
          <h6>Revert Last Payroll</h6>
        </div>
        <div class="card-body">
          <form action="{{route('employer.payroll.revert.web')}}" method="get">
            @csrf
            <input type="hidden" id="payroll_type" name="payroll_type" value="1" />
            <div class="row">
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm">Revert Payroll</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      @include('employer.Payroll.list')

</div>
@endsection

@push('custom_js')
<script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

@endpush
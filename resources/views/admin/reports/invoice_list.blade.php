@extends('admin.layouts.app')
@section('content')
    @component('admin.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Invoices</h6>

                    <div class="float-right mb-3">
                        <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("admin.report.invoice.download")}}'">
                          <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                          Download Report
                        </button> 
                  
                  </div>
                    
                    <form method="POST" action="{{ route('admin.report.invoice.filter') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mt-4 mb-4" id="" >
                            
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label class="control-label">Payment Status<span class="text-danger"></span></label>
                                    <select name="status" id="status1" class="@if ($errors->has('status')) is-invalid @endif" >
                                        <option selected="true" value="" disabled>All</option>
                                        <option value="0" {{ old('status') === 0 ? 'selected' : '' }}>Pending</option>
                                        <option value="1" {{ old('status') === 1 ? 'selected' : '' }}>Paid</option>
                                        <option value="2" {{ old('status') === 2 ? 'selected' : '' }}>Overdue</option>
                                    </select>                                
                                    <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                                </div>
                            </div><!-- Col -->
                            
                            <div class="col-sm-2"> 
                                <button class="btn btn-info mt-4 p-2" id="filter_employee">Filter</button>
                            </div>
                        </div><!-- Row -->
                    </form>

                    
                    <div class="table-responsive">
                        @include('admin.reports.table.invoice_list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
@endpush

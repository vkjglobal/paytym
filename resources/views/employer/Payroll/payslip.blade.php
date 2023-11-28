@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Payroll</h6>
                    <div class="table-responsive">
                        @if($res->pay_slip)
                      
    <iframe src="{{ asset('storage/pdfs/'.$res->pay_slip) }}" width="100%" height="600px" class="mt-2"></iframe>
                        <!-- <img src="{{ asset('storage/pdfs/'.$res->pay_slip) }}" class="img-thumbnail mt-2" width="" alt=""> -->
                        @else
                        <span>No Payslip Found</span>
                        @endif
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

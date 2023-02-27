@extends('employer.layouts.app')
@section('content')
    {{-- @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent --}}

<div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div class="container-fluid d-flex justify-content-between">
            <div class="col-lg-3 ps-0">
              <a href="#" class="noble-ui-logo d-block mt-3">Noble<span>UI</span></a>                 
              <p class="mt-1 mb-1"><b>NobleUI Themes</b></p>
              <p>108,<br> Great Russell St,<br>London, WC1B 3NA.</p>
              <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
              <p>Joseph&nbsp;E&nbsp;Carr,<br> 102, 102  Crown Street,<br> London, W3 3PR.</p>
            </div>
            <div class="col-lg-3 pe-0">
              <h4 class="fw-bold text-uppercase text-end mt-4 mb-2">invoice</h4>
              <h6 class="text-end mb-5 pb-4"># INV-002308</h6>
              <p class="text-end mb-1">Balance Due</p>
              <h4 class="text-end fw-normal">$ 72,420.00</h4>
              <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Invoice Date :</span> 25rd Jan 2023</h6>
              <h6 class="text-end fw-normal"><span class="text-muted">Due Date :</span> 12th Jul 2023</h6>
            </div>
          </div>
          <div class="container-fluid mt-5 d-flex justify-content-center w-100">
            <div class="table-responsive w-100">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th class="text-end">Quantity</th>
                        <th class="text-end">Unit cost</th>
                        <th class="text-end">Total</th>
                      </tr>
                  </thead>
                  <tbody>
                    <tr class="text-end">
                      <td class="text-start">1</td>
                      <td class="text-start">PSD to html conversion</td>
                      <td>02</td>
                      <td>$55</td>
                      <td>$110</td>
                    </tr>
                    <tr class="text-end">
                      <td class="text-start">2</td>
                      <td class="text-start">Package design</td>
                      <td>08</td>
                      <td>$34</td>
                      <td>$272</td>
                    </tr>
                    <tr class="text-end">
                      <td class="text-start">3</td>
                      <td class="text-start">Html template development</td>
                      <td>03</td>
                      <td>$500</td>
                      <td>$1500</td>
                    </tr>
                    <tr class="text-end">
                      <td class="text-start">4</td>
                      <td class="text-start">Redesign</td>
                      <td>01</td>
                      <td>$30</td>
                      <td>$30</td>
                    </tr>
                  </tbody>
                </table>
              </div>
          </div>
          <div class="container-fluid mt-5 w-100">
            <div class="row">
              <div class="col-md-6 ms-auto">
                  <div class="table-responsive">
                    <table class="table">
                        <tbody>
                          <tr>
                            <td>Sub Total</td>
                            <td class="text-end">$ 14,900.00</td>
                          </tr>
                          <tr>
                            <td>TAX (12%)</td>
                            <td class="text-end">$ 1,788.00</td>
                          </tr>
                          <tr>
                            <td class="text-bold-800">Total</td>
                            <td class="text-bold-800 text-end"> $ 16,688.00</td>
                          </tr>
                          <tr>
                            <td>Payment Made</td>
                            <td class="text-danger text-end">(-) $ 4,688.00</td>
                          </tr>
                          <tr class="bg-light">
                            <td class="text-bold-800">Balance Due</td>
                            <td class="text-bold-800 text-end">$ 12,000.00</td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
          <div class="container-fluid w-100">
            <a href="javascript:;" class="btn btn-primary float-end mt-4 ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send me-3 icon-md"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>Send Invoice</a>
            <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-2 icon-md"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>Print</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endsection
{{-- @push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush --}}
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

@endpush
@extends('employer.layouts.app')
@section('content')
    @component('employer.layouts.partials.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
    @php
        use Carbon\Carbon;
    @endphp
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Employee FRCS Data Report</h6>
                    {{-- <div class="float-right mb-3">
                          <button type="button" class="btn btn-primary btn-icon-text" onclick="window.location='{{route("employer.report.attendance.export", $request)}}'">
                            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                            Download Report
                          </button> 
                    </div>--}}

                    <div class="float-right mb-3">
                        <form action="{{route("employer.report.frcsreport.export")}}" method="get">
                        <input type="hidden" name="business" value="{{$request->business}}">
                            <input type="hidden" name="pay_period" value="{{$request->pay_period}}">
                           
                            <input type="hidden" name="start_date" value="{{$request->start_date}}">
                            <input type="hidden" name="end_date" value="{{$request->end_date}}">
                            <input type="hidden" name="employer_id" value="{{$employer_id}}">
                            <button type="submit" class="btn btn-primary btn-icon-text">
                                <i class="btn-icon-prepend" data-feather="download-cloud"></i>
                                Download Report
                              </button> 
                        </form>
                    </div>
<div class="table-responsive">
    <table id="dataTableExample" class="table">
        <thead>
        <tr>
                <th>Sl #</th>
                <th>Employee </th>
                <th>TIN</th>
                <th>Date of Birth</th>
                <th>Residence</th>
                <th>Tax Code</th>
                <th>Employment Start Date</th>
                <th>Employment End Date</th>
                <th>YTD Normal Pay</th>
                <th>YTD dir.rem and bonus/overtime</th>
                <th>ytd redundancy payments</th>
                <th>ytd lumpsum payments</th>
                <th>ytd other one-offpayments</th>
                <th>ytd income tax</th>
                <th>ytd srt</th>
                <th>ytd ecal</th>

                <th>normal pay</th>
                <th>dir. remuneration</th>
                <th>bonus/overtime</th>
                <th>redundancy payment approval no</th>
                <th>redundancy payments</th>
                <th>lumpsum payment approval no</th>
                <th>lumpsum payment</th>
                <th>other one-off_payment approval no</th>
                <th>other one-offpayment</th>
                <th>fnpf deduction</th>
                <th>gross-up employee</th>
                <th>income tax</th>
                <th>srt</th>
                <th>ecal</th>

</tr>
        </thead>
        <tbody>
            @foreach ($frcs as $frcs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    {{--<td>
                        {{ optional($frcs->user)->first_name ?? 'No data' }}  {{ optional($frcs->user)->last_name ?? 'No data' }}
                    </td>--}}
                    <td>
                        {{ optional($frcs)->first_name ?? 'No data' }}  {{ optional($frcs)->last_name ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->tin ?? 'No data' }}
                    </td>
                   
                    <td> {{ optional($frcs)->date_of_birth ? \Carbon\Carbon::parse(optional($frcs)->date_of_birth)->format('d/m/Y') : 'no data' }}</td>

                    <td>
                        {{ optional($frcs->frcs)->residence ?? 'No data' }}
                    </td>
                    <td>
                        @if($frcs->tax_code == 'P')
                        Primary
                        @else
                        Secondary
                        @endif
                        {{--{{ optional($frcs)->tax_code ?? 'No data' }}--}}
                    </td>
                    <td> {{ optional($frcs)->employment_start_date ? \Carbon\Carbon::parse(optional($frcs)->employment_start_date)->format('d/m/Y') : 'no data' }}</td>
                    <td> {{ optional($frcs)->employment_end_date ? \Carbon\Carbon::parse(optional($frcs)->employment_end_date)->format('d/m/Y') : 'no data' }}</td>
                    <td>
                        {{ optional($frcs->frcs)->yeartodate_normal_pay ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->yeartodate_dir_rem_and_bonus_overtime ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->yeartodate_redundancy_payments ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->yeartodate_lumpsum_payments ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->yeartodate_other_one_off_payments ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->yeartodate_income_tax ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->yeartodate_srt ?? 'No data' }}
                    </td> <td>
                        {{ optional($frcs->frcs)->yeartodate_ecal ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->normal_pay ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->director_remuneration ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->bonus_overtime ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->redundancy_payment_approval_no ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->redundancy_payments ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->lumpsum_payment_approval_no ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->lumpsum_payment ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->other_oneoff_payment_approval_no ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->other_oneoff_payment ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->fnpf_deduction ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->gross_up_employee ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->income_tax ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->srt ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs->frcs)->ecal ?? 'No data' }}
                    </td>
             </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
            </div>
        </div>
    </div>

    @endsection
    @push('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endpush
@push('custom_js')
    <script src="{{ asset('admin_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin_assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin_assets/js/data-table.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

@endpush
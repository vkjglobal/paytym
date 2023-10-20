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

               

               

        </thead>
        <tbody>
            @foreach ($frcs as $frcs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ optional($frcs->user)->first_name ?? 'No data' }}  {{ optional($frcs->user)->last_name ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->tin ?? 'No data' }}
                    </td>
                   
                    <td> {{ optional($frcs)->date_of_birth ? \Carbon\Carbon::parse(optional($frcs)->date_of_birth)->format('d/m/Y') : 'no data' }}</td>

                    <td>
                        {{ optional($frcs)->residence ?? 'No data' }}
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
                        {{ optional($frcs)->yeartodate_normal_pay ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->yeartodate_dir_rem_and_bonus_overtime ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->yeartodate_redundancy_payments ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->yeartodate_lumpsum_payments ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->yeartodate_other_one_off_payments ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->yeartodate_income_tax ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->yeartodate_srt ?? 'No data' }}
                    </td> <td>
                        {{ optional($frcs)->yeartodate_ecal ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->normal_pay ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->director_remuneration ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->bonus_overtime ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->redundancy_payment_approval_no ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->redundancy_payments ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->lumpsum_payment_approval_no ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->lumpsum_payment ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->other_oneoff_payment_approval_no ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->other_oneoff_payment ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->fnpf_deduction ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->gross_up_employee ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->income_tax ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->srt ?? 'No data' }}
                    </td>
                    <td>
                        {{ optional($frcs)->ecal ?? 'No data' }}
                    </td>
             </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
</head>
<body>
    <table style="width: 100%; text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 1.2;">
        <tr>
            <td>
                <table style="width: 100%; margin: 0 auto; border: 1px solid #000000; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="font-size: 25px; line-height: 1.2; padding: 20px; border-bottom: 1px solid #000000;">{{$employee->employer->company}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td valign="top">
                                            <table style="text-align: left;">
                                                <tr>
                                                    <td>Name: <strong>{{$employee->first_name." ".$employee->last_name}}</strong></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Employee Code: <strong>123456</strong></td>
                                                </tr> -->
                                            </table>
                                        </td>
                                        <td valign="top">
                                            <table style="text-align: left;">
                                                <tr>
                                                    <td>Bank Name: <strong>{{$employee->bank}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Bank Branch: <strong>{{$employee->bank_branch_name}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Bank A/C No: <strong>{{$employee->account_number}}</strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td valign="top">
                                            <table style="text-align: left;">
                                                <tr>
                                                    <td>Payslip No: <strong>{{$paySlipNumber}}</strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 100%; text-align: left;">
                                    <tr>
                                        <td style="border-right: 1px solid #000000; width: 50%;">
                                            <table style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 60%; text-align:left;">Allowance</th>
                                                        <th style="width: 40%; text-align: right;">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($allowances as $allowance)
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">{{ $allowance->allowance->type}} </td>
                                                        <td style="width: 40%; text-align: right;">{{ $allowance->rate}} </td>
                                                    </tr>
                                                    @endforeach
                                                    <!-- <tr>
                                                        <td style="width: 60%; text-align:left;">Allowance 2</td>
                                                        <td style="width: 40%; text-align: right;">1500</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">Allowance 3</td>
                                                        <td style="width: 40%; text-align: right;">3000</td>
                                                    </tr> -->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%;">Total</td>
                                                        <td style="width: 40%; text-align: right;"><strong>{{$totalAllowance}}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td style="width: 50%;">
                                            <table style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 60%; text-align:left;">Deduction</th>
                                                        <th style="width: 40%; text-align: right;">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>    
                                                    @foreach($deductions as $deduction)
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">{{$deduction->deduction->name}}</td>
                                                        <td style="width: 40%; text-align: right;">{{$employee->rate * ($deduction->rate/100) }}</td>
                                                    </tr>
                                                    @endforeach
                                                    <!-- <tr>
                                                        <td style="width: 60%; text-align:left;">Deduction 2</td>
                                                        <td style="width: 40%; text-align: right;">100</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">Deduction 3</td>
                                                        <td style="width: 40%; text-align: right;">1000</td>
                                                    </tr> -->
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%;">Total</td>
                                                        <td style="width: 40%; text-align: right;"><strong>{{$totalDeduction}}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 100%; text-align: left;">
                                    <tr>
                                        <td style="border-right: 1px solid #000000; width: 50%;">
                                            <table style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 60%; text-align:left;">Tax:</th>
                                                        <th style="width: 40%; text-align: right;">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">Income Tax:</td>
                                                        <td style="width: 40%; text-align: right;">{{ $income_tax }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">FNPF</td>
                                                        <td style="width: 40%; text-align: right;">{{$fnpf}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">SRT</td>
                                                        <td style="width: 40%; text-align: right;">{{$srt}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">Total</td>
                                                        <td style="width: 40%; text-align: right;"><strong>{{ $income_tax + $fnpf + $srt }}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td style="width: 50%;">
                                            <table style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 60%; text-align:left;">&nbsp;</th>
                                                        <th style="width: 40%; text-align: right;">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">From date: </td>
                                                        <td style="width: 40%; text-align: right;">{{$fromDate->format('Y-m-d')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">End date: </td>
                                                        <td style="width: 40%; text-align: right;">{{$endDate->format('Y-m-d')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">Commission:</td>
                                                        <td style="width: 40%; text-align: right;">{{$commission_amount}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">Bonus:</td>
                                                        <td style="width: 40%; text-align: right;">{{$total_bonus}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">Gross Salary:</td>
                                                        <td style="width: 40%; text-align: right;">{{$grossSalary}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">Net Salary:</td>
                                                        <td style="width: 40%; text-align: right;">{{$netSalary}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 60%; text-align:left;">Total Salary</td>
                                                        <td style="width: 40%; text-align: right;"><strong>{{$totalSalary}}</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%; border-collapse: collapse; text-align: center;">
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid #000000;">Working Days</th>
                                            <th style="border: 1px solid #000000;">LWOP</th>
                                            <th style="border: 1px solid #000000;">Salary type</th>
                                            <th style="border: 1px solid #000000;">Commissions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border: 1px solid #000000;">{{$nonHolidayDates}}</td>
                                            <td style="border: 1px solid #000000;">{{$lwop}}</td>
                                            <td style="border: 1px solid #000000;">@if($employee->salary_type == "0") Fixed @elseif ($employee->salary_type == "0") Hourly @endif</td>
                                            <td style="border: 1px solid #000000;">4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
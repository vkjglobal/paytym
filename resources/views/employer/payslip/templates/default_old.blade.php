<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
</head>

<?php
$invoice_no=$payroll->id;
$pay_date=$payroll->pay_date;
$name = $employee->first_name . " " . $employee->last_name;
$employee_id = $employee->id;
$designation = $employee->job_title;
$doj = $employee->employment_start_date;
$paid_days = 0;
$paid_hours = 0;
$salary_type = $employee->salary_type;
$pay_period = $employee->pay_period; // 0=Weekly,1=>fortnightly,2=monthly
$taxId = "##00001";
$provident_fund = "0";
$base_rate = $base_pay;
$double_time = $doubleTimeRate;
$allowance = $totalAllowance;
$bonus = $total_bonus;  // Add the Total Bonus 
$commission = $commission_amount;
$gross_earnings = $grossSalary;  ////gross pay =  Base Pay + Overtime Pay + Double Pay + Bonus + Commission 
$netSalary=$netSalary;  //net salary= Gross Pay – (Superannuation + All Taxes);
$pf = $fnpf;
$srtax=$srt;
$tax = $income_tax + $srtax;
$loan = "0";
$union = "0";
$surcharge = "0";
$total_deduction = $totalDeduction;
$nonHolidayDates=$nonHolidayDates;
// Total Net Paid
$bank_account_no = $employee->account_number;
$mpaisa = "0";
$mycash = "0";
$total_amount = "0";

?>

<body>
    <table style="width: 100%; text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.2;">
        <tr>
            <td>
                <table style="width: 600px; margin: 0 auto; border: 1px solid #000000; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border-bottom: 1px solid #000000; padding-top: 20px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="border-bottom: 5px solid #000000;">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td>
                                                        <table style="width: 100%;">
                                                            <tr>
                                                                <td style="text-align: left; font-size: 35px; font-weight: 700;">
                                                                    <img src="https://paytym.net/home_assets/images/logo.png" style="display: block; width: 150px;" alt="">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: left; vertical-align: bottom; font-weight: normal; width: 20%;">
                                                                    <strong>Invoice No.:</strong>{{$invoice_no}}  <br>
                                                                    <strong>Pay Date:</strong> {{$pay_date}}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="width: 47%;"></td>
                                                    <td style="text-align: right; font-weight: normal; font-size: 14px; width: 33%;">
                                                        <strong style="display: block;">{{$business_name}}</strong>
                                                      {{ $street }}<br>
                                                      {{$city}}
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size: 20px; font-weight: 600; padding: 10px 5px; border-bottom: 1px solid #000000;">
                                Employee Payslip
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <tr>
                                        <td>
                                            <table style="width: 100%; border-collapse: collapse;">
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px; width: 33%;"><strong>Employee ID</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px; width: 33%;">{{$employee_id}}</td>
                                                    <td style="text-align: left; padding: 5px; width: 34%;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Employee Name</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">{{$name}}</td>
                                                    <td style="text-align: left; padding: 5px;" rowspan="3"><strong>Paid Days: {{$paid_days}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Designation</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">{{$designation}}</td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Date of Joining</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">{{$doj}}</td>
                                                </tr>


                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Salary Type</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">{{$salary_type == 0 ? 'Fixed' : 'Hourly' }}</td>
                                                    <td style="text-align: left; padding: 5px;" rowspan="3"><strong>Paid Hours: {{$paid_hours}}</strong></td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Pay Period</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">{{ $pay_period == 0 ? 'Weekly' : ($pay_period == 1 ? 'Fortnightly' : 'Monthly') }}</td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Tax ID</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">{{$taxId}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Provident Fund</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">{{$provident_fund}}</td>
                                                    <td style="text-align: left; padding: 5px;"></td>
                                                </tr>
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="width: 100%; border-top: 1px solid #000000; border-collapse: collapse;">
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #000000; padding: 10px 5px; width: 33%; font-size: 17px;"><strong>Earnings</strong></td>
                                                    <td style="text-align: left; border: 1px solid #000000; padding: 10px 5px; width: 33%; font-size: 17px;"><strong>Rate/Hours worked</strong></td>
                                                    <td style="text-align: right; border: 1px solid #000000; padding: 10px 5px; width: 34%; font-size: 17px;"><strong>Amount</strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Base</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"></td>
                                                    <td style="text-align: right; padding: 5px;">{{$base_rate}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Time and Half</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"></td>
                                                    <td style="text-align: right; padding: 5px;">{{$double_time}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Double Time</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"></td>
                                                    <td style="text-align: right; padding: 5px;">{{$double_time}}</td>
                                                </tr>
                                                @foreach($allowances as $allowance)
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Allowances</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"></td>
                                                    <td style="text-align: right; padding: 5px;">{{$allowance->rate}}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Bonuses</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"></td>
                                                    <td style="text-align: right; padding: 5px;">{{$bonus}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Commission</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"></td>
                                                    <td style="text-align: right; padding: 5px;">{{$commission}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; border-top: 1px solid #000000; padding: 5px;"><strong>Gross Earnings</strong></td>
                                                    <td style="text-align: left; border-right: 1px solid #000000; border-top: 1px solid #000000; padding: 5px;"></td>
                                                    <td style="text-align: right; padding: 5px; border-top: 1px solid #000000;">{{$gross_earnings}}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="width: 66%; border-collapse: collapse;">
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #000000; padding: 10px 5px; width: 50%; font-size: 17px;"><strong>Deductions</strong></td>
                                                    <td style="text-align: right; border: 1px solid #000000; padding: 10px 5px; width: 50%; font-size: 17px;"><strong>Amount</strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Provident Fund</strong></td>
                                                    <td style="text-align: right; border-right: 1px solid #000000; padding: 5px;">{{$pf}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Tax</strong></td>
                                                    <td style="text-align: right; border-right: 1px solid #000000; padding: 5px;">{{$tax}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Loan</strong></td>
                                                    <td style="text-align: right; border-right: 1px solid #000000; padding: 5px;">{{$loan}}</td>
                                                </tr>
                                                <!-- <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Union</strong></td>
                                                    <td style="text-align: right; border-right: 1px solid #000000; padding: 5px;">{{$union}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;"><strong>Surcharge</strong></td>
                                                    <td style="text-align: right; border-right: 1px solid #000000; padding: 5px;">{{$surcharge}}</td>
                                                </tr> -->
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; border-top: 1px solid #000000; padding: 5px;"><strong>Total Deductions</strong></td>
                                                    <td style="text-align: right; border-top: 1px solid #000000; padding: 5px;">{{$total_deduction}}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table style="width: 100%; border-collapse: collapse;">
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #000000; padding: 10px 5px; width: 33%; font-size: 17px;"><strong>Total Net Paid</strong></td>
                                                    <td style="text-align: left; padding: 10px 5px; width: 33%; font-size: 17px;"><strong></strong></td>
                                                    <td style="text-align: left; padding: 10px 5px; width: 34%; font-size: 17px;"><strong></strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; padding: 5px;"><strong>Bank Account No.</strong></td>
                                                    <td style="text-align: left; padding: 5px;"></td>
                                                    <td style="text-align: right; padding: 5px;">{{$bank_account_no}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; padding: 5px;"><strong>Mpaisa</strong></td>
                                                    <td style="text-align: left; padding: 5px;"></td>
                                                    <td style="text-align: right; padding: 5px;">{{$mpaisa}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; padding: 5px;"><strong>MyCash</strong></td>
                                                    <td style="text-align: left; padding: 5px;"></td>
                                                    <td style="text-align: right; padding: 5px;">{{$mycash}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-top: 1px solid #000000; padding: 5px;"><strong>&nbsp;</strong></td>
                                                    <td style="text-align: left; border-top: 1px solid #000000; padding: 5px;">&nbsp;</td>
                                                    <td style="text-align: right; border-top: 1px solid #000000; border-bottom: 2px solid #000000; font-size: 16px; padding: 5px;"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</body>
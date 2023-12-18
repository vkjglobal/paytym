<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>

<?php
$invoice_no=$payroll->id;
$pay_date=$payroll->pay_date;
$name = $employee->first_name . " " . $employee->last_name;
$employee_id = $employee->id;
$designation = $employee->job_title;
$doj = $employee->employment_start_date;
$paid_days = $attendance_count;
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
$payslip_number=$paySlipNumber;
?>



<body>
    <table style="width: 100%; text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.2; border-collapse: collapse;">
        <tr>
            <td style="padding:5px;">
                <table style="width: 100%; margin: 0 auto; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border-bottom: 1px solid #000000; padding-top: 20px; padding: 0;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <tr>
                                        <td style="border-bottom: 2px solid #000000; padding: 0;">
                                            <table style="width: 100%; border-collapse: collapse;">
                                                <tr>
                                                    <td style="padding:0;">
                                                        <table style="width: 100%; border-collapse: collapse;">
                                                            <tr>
                                                                <td style="text-align: left; font-size: 35px; font-weight: 700;">
                                                                    <img src="https://paytym.net/home_assets/images/logo.png" style="display: block; width: 150px;" alt="">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: left; vertical-align: bottom; font-weight: normal; width: 20%;">
                                                                    <strong>{{$payslip_number}}</strong><br>
                                                                    <strong>Pay Date:</strong> {{$pay_date}}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="width: 47%;"></td>
                                                    <td style="text-align: right; font-weight: normal; font-size: 14px; width: 33%;">
                                                        <strong style="display: block;">{{$business_name}}</strong>
                                                        {{ $street }} <br>
                                                        {{$city}}<br>
                                                    </td>
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
                            <td style="font-size: 20px; font-weight: 600; padding: 10px 5px; border-bottom: 5px solid #000000;">
                                Employee Payslip
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <tr>
                                        <td style="padding:0;">
                                            <table style="width: 100%; border-collapse: collapse;">
                                                <!-- <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf;  padding: 10px 5px; width: 33%; font-size: 17px;"><strong>Description</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf;  padding: 10px 5px; width: 33%; font-size: 17px;"><strong></strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf;  padding: 10px 5px; width: 34%; font-size: 17px;"><strong></strong></td>                                                    
                                                </tr> -->
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px; width: 33.33%;"><strong>Employee ID</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px; width: 33.33%;">{{$employee_id}}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px; width: 33.33%;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Employee Name</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;">{{$name}}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Designation</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;">{{$designation}}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Paid Days: </strong>{{$paid_days}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Date of Joining</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;">{{$doj}}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Salary Type</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;">{{$salary_type == 0 ? 'Fixed' : 'Hourly' }}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Paid Hours: {{$paid_hours}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Pay Period</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;">{{ $pay_period == 0 ? 'Weekly' : ($pay_period == 1 ? 'Fortnightly' : 'Monthly') }}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Tax ID</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;">{{$taxId}}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-bottom: 2px solid #000000; padding: 5px;"><strong>Provident Fund</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-bottom: 2px solid #000000; padding: 5px;">{{$provident_fund}}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-bottom: 2px solid #000000; padding: 5px;"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0;">
                                            <table style="width: 100%; border-collapse: collapse;">
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-top: none; padding: 10px 5px; width: 33.33%; font-size: 17px;"><strong>Earnings</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-top: none; padding: 10px 5px; width: 33.33%; font-size: 17px;"><strong>Rate/Hours worked</strong></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; border-top: none; padding: 10px 5px; width: 33.33%; font-size: 17px;"><strong>Amount</strong></td>                                                    
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Base</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$base_rate}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Time and Half</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$double_time}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Double Time</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$double_time}}</td>
                                                </tr>
                                                @foreach($allowances as $allowance)
                                                <tr>                                               
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Allowances</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$allowance->rate}}</td>
                                                </tr>
                                                @endforeach

                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Bonuses</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$bonus}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Commission</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$commission}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-bottom: none; padding: 5px; font-size: 17px;"><strong>Gross Earnings</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-bottom: none; padding: 5px;"></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; border-bottom: none; border-top: 2px solid #000000; padding: 5px;">&dollar;{{$gross_earnings}}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0;">
                                            <table style="width: 100%; border-collapse: collapse;">
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-top: 2px solid #000000; padding: 10px 5px; width: 33.33%; font-size: 17px;"><strong>Deductions</strong></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; border-top: 2px solid #000000; padding: 10px 5px; width: 33.33%; font-size: 17px;"><strong>Amount</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px; width: 33.33%;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Provident Fund</strong></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$pf}}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Tax</strong></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$tax}}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Loan</strong></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$loan}}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Union</strong></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Surcharge</strong></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-top: 1px solid #000000; border-bottom: none; padding: 5px;"><strong>Total Deductions</strong></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; border-top: 2px solid #000000; border-bottom: none; padding: 5px;">&dollar;{{$total_deduction}}</td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-bottom: none; padding: 5px;"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0;">
                                            <table style="width: 100%; border-collapse: collapse;">
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-bottom: 2px solid #000000;  padding: 10px 5px; width: 33.33%; font-size: 17px;"><strong>Total Net Paid</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 10px 5px; width: 33.33%; font-size: 17px;"><strong></strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 10px 5px; width: 33.33%; font-size: 17px;"><strong></strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px; font-size: 17px;"><strong>Bank Account No.</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;">{{$bank_account_no}}</td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>Mpaisa</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$mpaisa}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"><strong>MyCash</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; padding: 5px;"></td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; padding: 5px;">&dollar;{{$mycash}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-top: 1px solid #000000; padding: 5px;"><strong>&nbsp;</strong></td>
                                                    <td style="text-align: left; border: 1px solid #dfdfdf; border-top: 1px solid #000000; padding: 5px;">&nbsp;</td>
                                                    <td style="text-align: right; border: 1px solid #dfdfdf; border-top: 1px solid #000000; border-top: 2px solid #000000; border-bottom: 2px solid #000000; font-size: 16px; padding: 5px;">&dollar;</td>
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
</html>
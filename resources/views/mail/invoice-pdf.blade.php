<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Invoice</title>
    <script src="{{ asset('admin_assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/tinymce.js') }}"></script>

</head>

<body>
    <table style="width: 100%; text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.2;">
    <tr>
                                        <td style="text-align: left;">
                                            
                                            
                                        </td>
                                    </tr>   
                                    <tr>{{--<a href="https://paytym.net/employer/invoice" style="font-size: 16px; font-weight: 600; padding: 10px 5px; border: 2px solid #0818a8; background-color: #0818a8;color:white; text-decoration: none;">Pay Now</a>--}}</tr><br><br>
                                  
    <tr>
            <td>
                <table style="width: 700px; margin: 0 auto; border: 1px solid #000000; border-collapse: collapse;">
                    <thead>
                    
                        <tr>
                            <th style="border-bottom: 1px solid #000000; padding-top: 20px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="text-align: left; font-size: 35px; font-weight: 700;">
                                       <img src="https://paytym.net/home_assets/images/logo.png" style="display: block; width: 150px;" alt=""> {{----}}
                                        </td>
                                    </tr>
                                 
                                    <tr>
                                        <td style="border-bottom: 5px solid #000000;">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="text-align: left; font-weight: normal; font-size: 14px; width: 33%;">
                                                        1 Regal Lane, <br>
                                                        Level 2 De Vos on the Park Building, <br>
                                                        Suva, Fiji <br>
                                                        contact@paytym.net
                                                    </td>
                                                    <td style="width: 47%;"></td>
                                                    <td style="text-align: left; vertical-align: bottom; font-weight: normal; width: 20%;">
                                                        <strong>Invoice No.:</strong> {{$invoiceNumber}} <br>
                                                        <strong>Date:</strong> {{ $invoice->date->format('d/m/Y') }}
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
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 50%;">
                                    <tr>
                                        <td style="vertical-align: top; text-align: left; font-weight: bold;">Bill To:</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">
                                            {{ $employer->company }} <br>
                                            {{ $employer->street }}, <br>
                                            {{ $employer->city }}  - {{ $employer->postcode }},
                                            {{ optional($employer->country)->name ?? "" }} <br>
                                           
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 50%;">
                                    <tr>
                                        <td style="vertical-align: top; text-align: left; font-weight: bold;">Plan Details:</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">
                                            Plan : <strong>{{$plan->plan}} </strong> <br>
                                            Employee - Range : <strong>{{$plan->range_from}} - {{$plan->range_to}} </strong> <br>
                                            Rate per Employee : <strong>${{$plan->rate_per_employee}}</strong>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td>
                                            <table style="width: 100%; border: 1px solid #000000; border-collapse: collapse;">
                                                <tr>
                                                    <td style="text-align: left; border: 1px solid #000000; padding: 10px 5px; width: 50%;"><strong>Description</strong></td>
                                                    <td style="text-align: right; border: 1px solid #000000; padding: 10px 5px; width: 50%;"><strong>Amount</strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">Service Period: 
                                                    <?php
                                                     $previousMonth = date('F Y', strtotime('-1 month'));?>
                                                     {{ $previousMonth }}</td>
                                                    <td style="text-align: right; padding: 5px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">Monthly Subscription as per Plan:</td>
                                                    <td style="text-align: right; padding: 5px;">${{$plan->rate_per_month}} </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">
                                                  
                                                    Rate per Employee: ${{$plan->rate_per_employee}} <br>
                                                        Active No. of Employees: {{$invoice->active_employees}} <br>
                                                        Total Employees Rate: ${{$plan->rate_per_employee}} * {{$invoice->active_employees}}
                                                    </td>
                                                    <td style="text-align: right; padding: 5px; vertical-align: bottom;">${{ number_format($total_employee_rate, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 16px; text-align: left; padding: 10px 5px; width: 50%; border-bottom: 1px solid #000000; border-top: 2px solid #000000;
                                                    "><strong>Total Tax Inclusive Amount Due</strong></td>
                                                    <td style="font-size: 16px; text-align: right; padding: 10px 5px; width: 50%; border-bottom: 1px solid #000000; border-top: 2px solid #000000;"><strong>${{ number_format($invoice->amount, 2) }}</strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr><br>
                                    <tr>
                                        <td style="font-size: 18px; font-weight: 600; padding: 10px 5px;">
                                       

                                        </td>
                                    </tr>
                                    
                                        
                                   <tr><td style="font-size: 16px; padding: 10px 5px 20px">
                                  
                                       <td></td> </tr>
                                </table>
                            </td>
                        </tr><tr></tr>
                    </tbody>
                </table>
            </td>
        </tr><br><br>
        <tr>
                        <td style="text-align: left;vertical-align: top; text-align: left; font-weight: bold;font-size: 17px;">
                        </td>
                        <tr>
                        <td style="text-align: left;vertical-align: top; text-align: left; font-weight: bold;">
                        </td>
                    </tr>
                    </tr>
    </table>
</body>
</html>




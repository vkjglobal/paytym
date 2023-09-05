<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Invoice</title>
</head>

<body>
    <table style="width: 100%; text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.2;">
    <tr>
                                        <td style="text-align: left;">
                                            <h4>Dear {{ $employer->name }},</h4>

                                            <br>
                                            Please find your invoice details below: <br>
                                            <br>
                                          
                                        </td>
                                    </tr>   
    <tr>
            <td>
                <table style="width: 1000px; margin: 0 auto; border: 1px solid #000000; border-collapse: collapse;">
                    <thead>
                    
                        <tr>
                            <th style="border-bottom: 1px solid #000000; padding-top: 20px;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="text-align: left; font-size: 35px; font-weight: 700;">
                                            <img src="https://paytym.net/home_assets/images/logo.png" style="display: block; width: 150px;" alt="">
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
                                            {{ $employer->name }} <br>
                                            {{ $employer->street }}, <br>
                                            {{ $employer->city }}  - {{ $employer->postcode }},
                                            {{ $employer->country->name }} <br>
                                           
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #000000;">
                                <table style="width: 50%;">
                                    <tr>
                                        <td style="vertical-align: top; text-align: left; font-weight: bold;">Packages Details:</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;">
                                            Plan : <strong>{{$plan->plan}}: </strong> <br>
                                            Employee - Range : <strong>{{$plan->range_from}} - {{$plan->range_to}} </strong> <br>
                                            Rate per Employee : <strong>${{$plan->rate_per_employee}} </strong>
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
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">Package Amount per Month</td>
                                                    <td style="text-align: right; padding: 5px;">${{$plan->rate_per_month}} </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; border-right: 1px solid #000000; padding: 5px;">
                                                  
                                                    Rate per Employee: ${{$plan->rate_per_employee}} <br>
                                                        Total No. of Employees: {{$invoice->active_employees}} <br>
                                                        Total Employees Rate: ${{$plan->rate_per_employee}} * {{$invoice->active_employees}}
                                                    </td>
                                                    <td style="text-align: right; padding: 5px; vertical-align: bottom;">${{$total_employee_rate}}</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 16px; text-align: left; padding: 10px 5px; width: 50%; border-bottom: 1px solid #000000; border-top: 2px solid #000000;
                                                    "><strong>Total</strong></td>
                                                    <td style="font-size: 16px; text-align: right; padding: 10px 5px; width: 50%; border-bottom: 1px solid #000000; border-top: 2px solid #000000;"><strong>${{$invoice->amount}}</strong></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 18px; font-weight: 600; padding: 10px 5px;">
                                            Payable
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 16px; padding: 10px 5px 20px; ">
                                            <a href="https://paytym.net/employer/invoice" style="font-size: 16px; font-weight: 600; padding: 10px 5px; border: 2px solid #0818a8; color: #000000; text-decoration: none;">To Pay</a>
                                            Click on this button, it will be redirected to the payment section.
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




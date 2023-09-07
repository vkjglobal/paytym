<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Deactivation</title>
</head>

<body>
    <table style="width: 100%; text-align: center; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 18px;">
        <tr>
            <td>
                <table style="width: 500px; margin: 0 auto; border-collapse: collapse;">
                    <tr>
                        <th>
                            <img src="https://paytym.net/home_assets/images/logo.png" style="display: block; width: 100px;" alt="">
                        </th>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <h4>Dear {{ $employer->company }},</h4>

                            <br>
                            "URGENT" <br><br/>

Due to the unpaid invoice for Paytym HR and Payroll services for the month of <?php
                                                     $previousMonth = date('F Y', strtotime('-1 month'));?>
                                                     {{ $previousMonth }}, your account with Paytym has been deactivated.

This means your access to the superior benefits of the Paytym HR and Payroll web services is now restricted.  <br><br><br/>
Furthermore, your employees and staff no longer have access to the Paytym mobile application services, as they have been fully restricted.

<br><br><br/>To swiftly reactivate your account and regain access to these essential services, you can still pay the due invoice by clicking on the following link:<br><br/>

    <a href="https://paytym.net/employer/invoice" style="font-size: 16px; font-weight: 600; padding: 10px 5px; color:#0818a8; text-decoration: none;">Click Here To Pay</a><br><br/>

Once your payment is processed successfully, please allow up to one business day for your Paytym account to be reactivated.

<br><br/>
If you have any questions or require any assistance, please let us know.
<br><br></br>
Thank you.
               
<br><br><br/>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                    <br/>  <br/>
                    </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                    <td style="text-align: left;vertical-align: top; text-align: left; font-weight: bold;">
                            The Paytym Team
                        </td>
                        <tr>
                        <td style="text-align: left;vertical-align: top; text-align: left; font-weight: bold;"">
                            <a href="mailto:contact@paytym.net" style="">contact@paytym.net</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>



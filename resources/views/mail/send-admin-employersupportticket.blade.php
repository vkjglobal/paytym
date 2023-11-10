<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Deactivation Notification</title>
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
                            <h4>Dear Admin,</h4>

                            <br>
                            A new support ticket is created by {{$employer->company}}. Please find the details below.
                            <br><br>
                            <strong>Subject</strong> : {{$supportTicket->subject}} <br>
                            <strong>Message</strong> : {{$supportTicket->message}}

<br><br>
<br><br>

                        </td>
                    </tr>
                    <tr>
                    <br/>  <br/>
                    </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                    <td style="text-align: left;vertical-align: top; text-align: left; font-weight: bold;font-size: 17px;">
                            The Paytym Team
                        </td>
                        <tr>
                        <td style="text-align: left;vertical-align: top; text-align: left; font-weight: bold;">
                            <a href="mailto:contact@paytym.net" style="font-size: 14px;">contact@paytym.net</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>



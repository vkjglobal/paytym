<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Login Credentials</title>
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
                            <h4>Dear {{ $employer->name }},</h4>

                            <br>
                            Welcome!! You are now a registered employer and can start using our superior Paytym HR and Payroll Automation Platform.
                            <br><br>
                            Your login credentials for the Paytym Employer portal is as follows: <br>
                            <br>
                            email : {{$employer->email}}<br>
                            password: {{$password}}<br><br>
                        </td>
                    </tr><br>
                    <tr>
                        <td style="text-align: left;">To login, please complete the verification by clicking on the below verify button.
                        </td>
                    </tr>
                    
                    <tr><br><br></br><br></br>
                        <td style="height: 15px;"><a href="{{ route('employer.verification.verify', ['id' => $employer->id, 'hash' => sha1($employer->email_verified_token)]) }}" style="font-size: 16px; font-weight: 600; padding: 10px 5px; border: 2px solid #0818a8; background-color: #0818a8;color:white; text-decoration: none;">Verify</a>
                    <br/>  <br/>
                    </td>
                    </tr>
                    {{--<tr>
                        <td style="height: 15px;"><p><a href="{{ route('employer.verification.verify', ['id' => $employer->id, 'hash' => sha1($employer->email_verified_token)]) }}">Verify Email</a></p>
                            <hr>
                        </td>
                    </tr>--}}
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


<!-- <!DOCTYPE html>
<html>
<head>
 <title>Employer Login Credentials</title>
</head>
<body>

<h4>Dear {{ $employer->name }},</h4>

<br>
Yours login credentials for the Paytym Employer portal is as follows: <br>

email : {{$employer->email}}<br>
password: {{$password}}<br>

</body>
</html>  -->

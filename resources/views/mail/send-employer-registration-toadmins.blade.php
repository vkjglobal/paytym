<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Employer Registration</title>
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
                            <h4>Dear Admin {{--{{ $employer->name }}--}},</h4>

                            <br>
                            A new employer has registered through the portal with details is as follows: <br>
                            <br>
                            Name : {{$employer->name}}<br>
                            Company : {{$employer->company}}<br>
                            Email : {{$employer->email}}<br>
                            Address : {{$employer->company}}<br>
                            {{ $employer->street }}, <br>
                                            {{ $employer->city }}  - {{ $employer->postcode }},
                                            {{ $employer->country->name }} <br>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 15px;">
                            <hr>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            Email: <a href="mailto:contact@paytym.net" style="">contact@paytym.net</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>




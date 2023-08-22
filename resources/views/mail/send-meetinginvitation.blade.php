<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Invitation</title>
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
                            <h4>Hi,</h4>

                            You have been invited to attend a meeting on {{optional(\Carbon\Carbon::createFromFormat('Y-m-d', $date))->format('d-m-Y') ?? 'No data'}} between {{ optional( \Carbon\Carbon::createFromFormat('H:i', $start_time))->format('h:i A') ?? 'No data' }} and {{ optional( \Carbon\Carbon::createFromFormat('H:i', $end_time))->format('h:i A') ?? 'No data' }}<br><br>

                            Meeting details: <br><br>

                            Title: {{ $title }}<br>
                            Location: {{ $location }}<br>
                            Agenda: {{ $agenda }}<br>
                            Guests: <br>
                            @foreach($guests as $guest)
                            {{$guest}}<br>
                            @endforeach
                            <br><br>
                            Thanks,<br>
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


<!-- <!DOCTYPE html>
<html>

<head>
    <title>Meeting Invitation</title>
</head>

<body>
    <h2>Hey !</h2> <br><br>

    You have been invited to attend a meeting on {{optional(\Carbon\Carbon::createFromFormat('Y-m-d', $date))->format('d-m-Y') ?? 'No data'}} between {{ optional( \Carbon\Carbon::createFromFormat('H:i', $start_time))->format('h:i A') ?? 'No data' }} and {{ optional( \Carbon\Carbon::createFromFormat('H:i', $end_time))->format('h:i A') ?? 'No data' }}<br><br>

    Meeting details: <br><br>

    Title: {{ $title }}<br>
    Location: {{ $location }}<br>
    Agenda: {{ $agenda }}<br>
    Guests: </br>
    @foreach($guests as $guest)
    {{$guest}}</br>
    @endforeach
    </br>

    Thanks,</br>
    {{ config('app.name') }}
</body>

</html> -->
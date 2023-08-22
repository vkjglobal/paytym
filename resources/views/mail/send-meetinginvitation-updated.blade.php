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
                            There is a change in the scheduled meeting. Please find the updated details below:
                            <br>
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






<!-- 
<!DOCTYPE html>
<html>

<head>
    <title>Meeting Invitation</title>
</head>

<body>
    <h2>Hey !</h2> <br><br>

    There is a change in the scheduled meeting. Please find the updated details below:
    <br><br>

    Meeting details: <br><br>

    Title: {{ $title }}<br>
    Location: {{ $location }}<br>
    Date: {{optional(\Carbon\Carbon::createFromFormat('Y-m-d', $date))->format('d-m-Y') ?? 'No data'}} <br>
    Start Time: {{ optional( \Carbon\Carbon::createFromFormat('H:i', $start_time))->format('h:i A') ?? 'No data' }}<br>
    End Time: {{ optional( \Carbon\Carbon::createFromFormat('H:i', $end_time))->format('h:i A') ?? 'No data' }}<br>
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
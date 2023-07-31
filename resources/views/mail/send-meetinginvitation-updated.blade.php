
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

Title:  {{ $title }}<br>
Location:  {{ $location }}<br>
Date:   {{optional(\Carbon\Carbon::createFromFormat('Y-m-d', $date))->format('d-m-Y') ?? 'No data'}} <br>
Start Time:  {{ optional( \Carbon\Carbon::createFromFormat('H:i', $start_time))->format('h:i A') ?? 'No data' }}<br>
End Time: {{ optional( \Carbon\Carbon::createFromFormat('H:i', $end_time))->format('h:i A') ?? 'No data' }}<br>
Agenda:  {{ $agenda }}<br><br>

Thanks,</br>
{{ config('app.name') }}
</body>
</html> 
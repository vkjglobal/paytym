
<!DOCTYPE html>
<html>
<head>
 <title>Meeting Invitation</title>
</head>
<body>
<h2>Hey !</h2> <br><br>

You have been invited to attend a meeting on {{optional(\Carbon\Carbon::createFromFormat('Y-m-d', $date))->format('d-m-Y') ?? 'No data'}} between {{ optional( \Carbon\Carbon::createFromFormat('H:i', $start_time))->format('h:i A') ?? 'No data' }} and {{ optional( \Carbon\Carbon::createFromFormat('H:i', $end_time))->format('h:i A') ?? 'No data' }}<br><br>

Meeting details: <br><br>

Title:  {{ $title }}<br>
Location:  {{ $location }}<br>
Agenda:  {{ $agenda }}<br>
Guests: </br>
@foreach($guests as $guest)
{{$guest}}</br>
@endforeach
</br>

Thanks,</br>
{{ config('app.name') }}
</body>
</html> 
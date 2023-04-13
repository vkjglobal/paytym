<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
  table {
    border-collapse: collapse;
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    font-family: Arial, sans-serif;
    font-size: 14px;
    line-height: 1.5;
  }
  
  th, td {
    padding: 10px;
    text-align: left;
    vertical-align: top;
  }
  
  th {
    background-color: #f2f2f2;
  }
  
  tr:nth-child(even) {
    background-color: #f9f9f9;
  }
</head>
<body>
        <h1>{{$user->employer->company}}</h1>
        <table border="1">
        <tr>
            <th colspan="2">Employee Information</th>
        </tr>
        <tr>
            <td>First Name:</td>
            <td>{{ $user->first_name }}</td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td>{{ $user->last_name }}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td>{{ $user->phone }}</td>
        </tr>
        <tr>
            <td>Date Of Birth:</td>
            <td>{{ $user->date_of_birth }}</td>
        </tr>
        <tr>
            <td>Address:</td>
            <td>{{ $user->street }}, {{ $user->town }}, {{ $user->city }}, Pincode: {{ $user->postcode }}</td>
        </tr>
        <tr>
            <td>Country:</td>
            <td>{{ optional($user->country)->name ?? 'no data' }}</td>
        </tr>
        <tr>
            <td>Tin:</td>
            <td>{{ $user->tin }}</td>
        </tr>
        <tr>
            <td>FNPF:</td>
            <td>{{ $user->fnpf }}</td>
        </tr>
        <tr>
            <td>Position:</td>
            <td>{{ $rolename }}</td>
        </tr>
        <tr>
            <td>Employment start date:</td>
            <td>{{ $user->employment_start_date }}</td>
        </tr>
        </table>

</body>
</html>
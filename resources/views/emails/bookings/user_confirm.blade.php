<html>
<head>
    <style>
        #bookings {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #bookings td, #bookings th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #bookings tr:nth-child(even){background-color: #f2f2f2;}

        #bookings tr:hover {background-color: #ddd;}

        #bookings th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4e73df;
            color: white;
        }
    </style>
</head>
<body>

<p><strong>{{$name}}</strong></p>
<p>Konfirmoni Rezervimin duke klikuar linkun e meposhtem.</p>

<a href="{{URL::to('/')}}/user/email/{{$id}}/{{$confirmation}}">Konfirmoni Rezervimin Tuaj duke klikuar ketu!</a>

<p><strong>Detajet:</strong></p>
<table id="bookings">
    <thead>
    <tr>
        <th scope="col">Nisja</th>
        <th scope="col">Destinacioni</th>
        <th scope="col">Data</th>
        <th scope="col">Orari</th>
        <th scope="col">Cmimi</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$st_location}}</td>
        <td>{{$end_location}}</td>
        <td>{{$st_date}}</td>
        <td>{{$st_time}}</td>
        <td>{{$price}}</td>
    </tr>
    </tbody>
</table>

@if(!empty($members))
    <p><strong>Antaret:</strong></p>
    <table id="bookings">
        <thead>
        <tr>
            <th scope="col">Emri</th>
            <th scope="col">Mbiemri</th>
            <th scope="col">Grup Mosha</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{$member->name}}</td>
                <td>{{$member->surname}}</td>
                <td>{{$member->age_group}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

</body>
</html>

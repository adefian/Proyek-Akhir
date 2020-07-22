<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sensor</title>
</head>

<body>
    <table>
        <thead>
            <tr align="center" height="25">
                <th>No</th>
                <th>Code_Reward</th>
            </tr>
        </thead>
        <tbody>
            @if($data)
            @php $i=1 @endphp
            @foreach($data as $datas)
            <tr align="center">
                <!-- Nomor -->
                <td width="8%">{{$i++}}</td>
                <td width="13%">{{$datas->code_reward}}</td>
            
            </tr>
            @endforeach
            @endif
        </tbody>

    </table>
</body>

</html>
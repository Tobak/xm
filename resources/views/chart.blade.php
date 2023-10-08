<!DOCTYPE html>
<html>
<head>
    <title>Historical Values</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: beige;">
<a href="{{ url('/') }}" class="btn btn-primary"  style="background-color: beige; color:black;">Go to Home</a>
<div class="container mt-5">
    <h2>Historical Values for {{ request()->symbol }}</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Date</th>
            <th>Open</th>
            <th>High</th>
            <th>Low</th>
            <th>Close</th>
            <th>Volume</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prices as $price)
            <tr>
                <td>{{ date('Y-m-d H:i:s',$price->getDate()) }}</td>
                <td>{{ $price->getOpen() }}</td>
                <td>{{ $price->getHigh() }}</td>
                <td>{{ $price->getLow() }}</td>
                <td>{{ $price->getClose() }}</td>
                <td>{{ $price->getVolume() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
</html>

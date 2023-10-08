<!DOCTYPE html>
<html>
<head>
    <title>Historical Values</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.1.2"></script>

</head>
<body style="background-color: beige;">

<a href="{{ url('/') }}" class="btn btn-primary"  style="background-color: beige; color:black; top: 0;">Go to Home</a>
<canvas id="priceChart" width="400" height="200"></canvas>
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
                <td>{{ date('Y-m-d',$price->getDate()) }}</td>
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

<script>
    // Convert PHP data to JavaScript
    var data = @json($chartData);

    // Extract dates, open prices, and close prices
    var dates = data.map(d => d.date);
    var openPrices = data.map(d => d.open);
    var closePrices = data.map(d => d.close);

    const ctx = document.querySelector("#priceChart").getContext("2d");
    const chart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: dates,
            datasets: [
                {
                    label: "Open",
                    data: openPrices,
                },
                {
                    label: "Close",
                    data: closePrices,
                },
            ],
        },
    });
</script>
</body>
</html>

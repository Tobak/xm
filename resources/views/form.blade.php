<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form</title>
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Normalize.css for consistent cross browser styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <!-- Your additional CSS files should come here -->
    <!-- <link rel="stylesheet" href="css/main.css"> -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <link href="{{ vite_asset('assets/app.css') }}" rel="stylesheet">
</head>
<body>

<form action="{{ route('form.process') }}" method="post">
    @csrf
    <select name="company_symbol" class="required">
        <option value="">Select Company</option>
        @foreach ($symbols as $symbol)
            <option value="{{ $symbol }}">{{ $symbol }}</option>
        @endforeach
    </select>
    <br>

    <label for="start_date">Start Date:</label>
    <input type="text" name="start_date" value="{{ old('start_date') }} " class="required">
    <br>

    <label for="end_date">End Date:</label>
    <input type="text" name="end_date" value="{{ old('end_date') }}" class="required">
    <br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ old('email') }}">
    <br>

    <input type="submit" value="Submit">
</form>


    <!-- Display error messages here -->
    @if ($errors->any())
        <div style="color: red; margin: 10px auto; text-align: center;">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <!-- Display success messages here -->
    @if (session('success'))
        <div style="color: green; margin: 10px auto; text-align: center;">
            {{ session('success') }}
        </div>
    @endif
<!-- Vite JS -->
<script type="module" src="{{ vite_asset('assets/app.js') }}"></script>

</body>
</html>

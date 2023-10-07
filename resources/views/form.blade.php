<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script type="module" src="{{ vite_asset('js/app.js') }}"></script>
</head>
<body>
@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif

<form action="{{ route('form.process') }}" method="post">
    @csrf
    <select name="company_symbol">
        <option value="">Select Company</option>
        @foreach ($symbols as $symbol)
            <option value="{{ $symbol }}">{{ $symbol }}</option>
        @endforeach
    </select>
    <br>

    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" value="{{ old('start_date') }}">
    <br>

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" value="{{ old('end_date') }}">
    <br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ old('email') }}">
    <br>

    <input type="submit" value="Submit">
</form>
</body>
</html>

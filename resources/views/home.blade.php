<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <a href="{{ route('page1') }}">Next Page</a>
    <form method="POST" action="{{ route('check.marks') }}">
        @csrf {{-- CSRF token is required for POST in Laravel --}}
        
        <label for="marks">Enter Your Marks</label>
        <input type="number" name="marks" id="marks" value="{{ old('marks') }}">
        
        <button type="submit" name="check">Check</button>
    </form>

    @if(isset($result))
        <p>{{ $result }}</p>
    @endif
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import Excel</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
    <form action="{{ route('excel.import.file') }}" method="post" enctype="multipart/form-data">
        @csrf

        @error('file')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if (session('success'))
            {{ session('success') }}
        @endif

        {{-- @foreach ($sheetNames as $sheetName)
            {{ $sheetName }} <br><br>
        @endforeach --}}

        <br><br>

        Select excel file to upload
        <br><br>

        <input type="file" name="file" id="file" class="@error('file') is-invalid @enderror">

        {{-- @error('file')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}

        <br><br>

        <button type="submit">Upload File</button>

        @if (session('success'))
        {{-- {{ session('success') }} --}}
            <br><br>
            @foreach ($sheetNames as $sheetName)
                {{ $sheetName }} <br>
            @endforeach
        @endif
    </form>

</body>
</html>
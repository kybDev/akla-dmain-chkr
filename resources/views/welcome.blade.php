<!DOCTYPE html>
<html>
<head>
    <title>Domain Validator</title>
</head>
<body>
    <form action="{{ route('validate') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file">
        <button type="submit">Upload CSV</button>
    </form>
</body>
</html>
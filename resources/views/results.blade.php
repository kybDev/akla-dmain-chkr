<!DOCTYPE html>
<html>
<head>
    <title>Domain Validation Results</title>
</head>
<body>
    <h1>Domain Validation Results</h1>
    <table>
        <tr>
            <th>Domain</th>
            <th>Is Abusive</th>
            <th>Abuse Confidence Score</th>
        </tr>
        @foreach ($results as $result)
            <tr>
                <td>{{ $result['domain'] }}</td>
                <td>{{ $result['is_abusive'] ? 'Yes' : 'No' }}</td>
                <td>{{ $result['abuse_confidence_score'] }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekening</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            width: 8.5cm;
            margin-left: -45px;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            white-space: nowrap;
        }
        .header img {
            height: 50px;
            display: inline-block;
            vertical-align: middle;
            filter: grayscale(1);
        }
        .header h1 {
            display: inline-block;
            vertical-align: middle;
            margin: 0 10px;
            font-size: 18px;
        }
        .table {
            width: 100%;
        }
        .table th, .table td {
            padding: 1px;
            border: none !important;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
        h1, p {
            margin: 0;
            padding: 0;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ $logoLeft }}" alt="Golden Dragon">
        <h1>{{ $restaurantName }}</h1>
        <img src="{{ $logoRight }}" alt="Golden Dragon">
        <p>Onderwijsboulevard 215, kamer OG112<br>5223 DE 's-Hertogenbosch</p>
        <p>Bestelling nummer: {{ $order->id }}<br>Tafel nummer: {{ $order->tafel_nummer }}</p>

        <p>Datum: {{ \Carbon\Carbon::parse($order->datum)->format('d-m-Y') }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Aantal</th>
                <th>Gerecht</th>
                <th>Prijs</th>
                <th>Subtotaal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gerechten as $gerecht)
                <tr>
                    <td style="text-align: center;">{{ $gerecht['aantal'] }}</td>
                    <td>{{ $gerecht['naam'] }}</td>
                    <td>&euro;{{ number_format($gerecht['prijs'], 2, ',', '.') }}</td>
                    <td style="text-align: right;">&euro;{{ number_format($gerecht['totaal'], 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Total price section -->
    <div class="text-right mt-4">
        <h3><strong>Totaal:</strong> &euro;{{ number_format($totalPrice, 2, ',', '.') }}</h3>
    </div>
    <p>{{ now()->format('d-m-Y H:i') }}</p>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fefebe;
            border-style: solid;
            border-width: 2px;
            border-color: green;
        }
        .title {
            text-align: center;
        }
        .menu {
            margin: 10px;
        }
        .soort {
            margin-top: 15px;
        }
        .gerecht {
            margin-top: -15px;
        }
        .aanbiedingen {
            margin-top: 50px;
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="title">
        <h1>{{ __('website.golden_dragon') }}</h1>
        <h2>{{ __('website.chineese_specialties') }}</h2>
        <h2>{{ __('website.menu') }}</h2>
    </div>
    <div class="menu">
        @foreach($gerechtSoorten as $soort)
            <div class="soort">
                <h3>{{ $soort->naam }}</h3>
                @foreach($soort->gerechten as $gerecht)
                    <div class="gerecht">
                        <p><strong>{{ $gerecht->nummer }}. {{ $gerecht->naam }}</strong> @if($gerecht->beschrijving != null)({{ $gerecht->beschrijving }})@endif - &euro;{{ $gerecht->prijs }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    @if($geldigeAanbiedingen->isNotEmpty())
        <div class="aanbiedingen">
            <h2>{{ __('website.special_offers') }}</h2>
            @foreach($geldigeAanbiedingen as $aanbieding)
                <div class="aanbieding">
                    <h3>{{ __('Aanbieding van') }} {{ $aanbieding->begin_datum->format('d-m-Y') }} {{ __('tot') }} {{ $aanbieding->eind_datum->format('d-m-Y') }}</h3>
                    <ul>
                        @foreach($aanbieding->gerechten as $gerecht)
                            <li>{{ $gerecht->naam }} - &euro;{{ $gerecht->prijs }} ({{ $aanbieding->korting_percentage }}% korting)</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    @endif
</body>
</html>

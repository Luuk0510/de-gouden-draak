<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bestelling;
use App\Models\GerechtHeeftBestelling;
use App\Models\Gerecht;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function getSalesData(Request $request)
    {
        $startDate = $request->input('startDate') . ' 00:00:00';
        $endDate = $request->input('endDate') . ' 23:59:59';

        $bestellingen = Bestelling::whereBetween('datum', [$startDate, $endDate])->get();

        $salesData = $bestellingen->map(function ($bestelling) {
            $gerechtenHeeftBestelling = GerechtHeeftBestelling::where('bestelling', $bestelling->id)->get();
            $gerechten = $gerechtenHeeftBestelling->map(function ($item) {
                $gerecht = Gerecht::find($item->gerecht);
                if ($gerecht) {
                    return [
                        'naam' => $gerecht->naam,
                        'prijs' => $gerecht->prijs,
                        'aantal' => $item->deel,
                        'subtotaal' => $gerecht->prijs * $item->deel,
                    ];
                }
            });

            $totaal = $gerechten->sum('subtotaal');
            $formattedDate = Carbon::parse($bestelling->datum)->format('d-m-Y');
            return [
                'datum' => $formattedDate,
                'tafel_nummer' => $bestelling->tafel_nummer,
                'gerechten' => $gerechten,
                'totaal' => $totaal,
            ];
        });

        return response()->json($salesData);
    }
}

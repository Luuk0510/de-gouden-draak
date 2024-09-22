<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GerechtSoort;
use App\Models\Bestelling;
use App\Models\GerechtHeeftBestelling;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        $dishes = GerechtSoort::with(['gerechten' => function($query) {
            $query->with(['opmerkingen' => function($query) {
                $query->select('id', 'gerecht', 'opmerkingen')->distinct();
            }]);
        }])->get();
        return view('register.index', compact('dishes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orderItems' => 'required|array',
            'orderItems.*.id' => 'required|integer',
            'orderItems.*.nummer' => 'required|integer',
            'orderItems.*.naam' => 'required|string',
            'orderItems.*.prijs' => 'required|numeric',
            'orderItems.*.quantity' => 'required|integer|min:1',
            'orderItems.*.rijst_soort' => 'nullable|string',
            'orderItems.*.opmerkingen' => 'nullable', 
            'orderItems.*.newOpmerking' => 'nullable',
            'orderItems.*.selectedOpmerking' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $bestelling = Bestelling::create([
            'status' => 1,
            'ronde' => 1,
            'tafel_nummer' => null,
            'datum' => now(),
            'aangemaakt_op' => now(),
            'gewijzigd_op' => now(),
        ]);
    
        $orderItems = $request->input('orderItems');
    
        foreach ($orderItems as $item) {
            $rijstSoort = null;
            $opmerkingen = $item['newOpmerking'] ?? $item['selectedOpmerking'] ?? $item['opmerkingen'] ?? null;
            $opmerkingen = ($opmerkingen == "Geen opmerking") ? null : $opmerkingen;

            GerechtHeeftBestelling::create([
                'bestelling' => $bestelling->id,
                'gerecht' => $item['id'],
                'rijst_soort' => null,
                'deel' => $item['deel'] ?? 1,
                'opmerkingen' => $opmerkingen,
            ]);
        }
    
        return response()->json(['success' => 'Bestelling succesvol opgeslagen'], 200);
    }
    

    public function dishes()
    {
        return view('register.dishes');
    }

    public function sales()
    {
        return view('register.sales');
    }
}

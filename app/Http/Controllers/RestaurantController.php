<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Bestelling;
use App\Models\GerechtHeeftBestelling;
use App\Models\GerechtSoort;
use App\Models\Gerecht;
use App\Models\Klant;
use App\Models\Tafel;
use Carbon\Carbon;
use PDF;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('restaurant.index');
    }

    public function registerCustomer()
    {
        $tafels = Tafel::orderBy('id')->get();

        return view('restaurant.registerCustomer', compact('tafels'));
    }

    public function storeCustomer(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'infix' => 'nullable|string|max:255',
            'surname' => 'required|string|max:255',
            'extra_menu' => 'nullable',
            'table' => 'required|exists:tafels,id',
            'birthday' => 'required|array|min:1',
            'birthday.*' => 'required|date',
        ]);

        $numPersons = count($request->input('birthday'));

        $bestelling = Bestelling::create([
            'status' => 1, 
            'tafel_nummer' => $validated['table'],
            'ronde' => 1,
            'datum' => Carbon::now(),
            'aangemaakt_op' => Carbon::now(),
            'gewijzigd_op' => Carbon::now(),
        ]);

        Klant::create([
            'bestelling' => $bestelling->id,
            'voornaam' => $validated['firstname'],
            'tussenvoegsel' => $validated['infix'] ?? null,
            'achternaam' => $validated['surname'],
            'geboortedatum' => $validated['birthday'][0],
            'aangemaakt_op' => Carbon::now(),
            'gewijzigd_op' => Carbon::now(),
        ]);

        for ($i = 1; $i < $numPersons; $i++) {
            Klant::create([
                'bestelling' => $bestelling->id,
                'voornaam' => null,
                'tussenvoegsel' => null,
                'achternaam' => null, 
                'geboortedatum' => $request->input('birthday')[$i],
                'aangemaakt_op' => Carbon::now(),
                'gewijzigd_op' => Carbon::now(),
            ]);
        }

        return redirect()->route('restaurant.table', ['bestelling' => $bestelling->id, 'tafel' => $validated['table']]);
    }

    public function table(Request $request)
    {
        $validated = $request->validate([
            'bestelling' => 'required|integer',
            'tafel' => 'required|integer',
        ]);

        $bestelling = Bestelling::find($request->input('bestelling'));
        $tafel = Tafel::find($request->input('tafel'));

        return view('restaurant.table', compact('bestelling', 'tafel'));
    }

    public function order()
    {
        $orders = Bestelling::whereDate('datum', Carbon::today())
        ->with(['klanten' => function($query) {
            $query->whereNotNull('voornaam')->whereNotNull('achternaam');
        }])
        ->orderBy('datum', 'desc')
        ->get();

        return view('restaurant.orderDaily', compact('orders'));
    }

    public function orderCustomer(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer',
        ]);
    
        $order = Bestelling::with('klanten')->findOrFail($validated['id']);
        $numPersons = $order->klanten->count();
    
        $gerechtenHeeftBestelling = GerechtHeeftBestelling::where('bestelling', $validated['id'])->get();

        $gerechten = $gerechtenHeeftBestelling->map(function ($item) {
            $gerecht = Gerecht::find($item->gerecht);
            if ($gerecht) {
                return [
                    'naam' => $gerecht->naam,
                    'prijs' => $gerecht->prijs,
                ];
            }
        });
    
    return view('restaurant.orderCustomer', ['gerechten' => $gerechten, 'order' => $order, 'numPersons' => $numPersons]);
    
    
        return view('restaurant.orderCustomer', [
            'order' => $order,
            'numPersons' => $numPersons,
            'gerechten' => $gerechten
        ]);
    }

    public function pdf($id)
    {
        $order = Bestelling::with(['klanten', 'gerechtenHeeftBestelling.gerecht'])->findOrFail($id);
    
        $gerechtenHeeftBestelling = GerechtHeeftBestelling::where('bestelling', $id)->get();
    
        $gerechtenGrouped = [];
        $totalPrice = 0; 
    
        foreach ($gerechtenHeeftBestelling as $item) {
            $gerecht = Gerecht::find($item->gerecht);
            if ($gerecht) {
                if (!isset($gerechtenGrouped[$gerecht->naam])) {
                    $gerechtenGrouped[$gerecht->naam] = [
                        'naam' => $gerecht->naam,
                        'prijs' => $gerecht->prijs,
                        'aantal' => $item->deel,
                        'totaal' => $item->deel * $gerecht->prijs,
                    ];
                } else {
                    $gerechtenGrouped[$gerecht->naam]['aantal'] += $item->deel;
                    $gerechtenGrouped[$gerecht->naam]['totaal'] += $item->deel * $gerecht->prijs;
                }

                $totalPrice += $item->deel * $gerecht->prijs;
            }
        }
    
        $data = [
            'order' => $order,
            'gerechten' => $gerechtenGrouped, 
            'numPersons' => $order->klanten->count(),
            'logoLeft' => public_path('images/dragon-small.png'), 
            'logoRight' => public_path('images/dragon-small-flipped.png'),
            'restaurantName' => __('website.golden_dragon'),
            'totalPrice' => $totalPrice
        ];        
    
        $pdf = PDF::loadView('restaurant.orderPdf', $data);
    
        return $pdf->setPaper([0, 0, 241, 283], 'portrait')
                   ->stream('rekening.orderPdf');
    }    

    public function allOrders()
    {
        $orders = Bestelling::with(['klanten' => function($query) {
            $query->whereNotNull('voornaam')->whereNotNull('achternaam');
        }])
        ->orderBy('datum', 'desc')
        ->get();

        return view('restaurant.allOrders', compact('orders'));
    }

    public function startOrder()
    {
        return view('restaurant.startOrder');
    }

    public function processStartOrder(Request $request)
    {
        $validated = $request->validate([
            'current_date' => 'required|date',
            'order' => 'required|integer',
            'table' => 'required|integer',
        ]);

        $bestelling = Bestelling::where('id', $validated['order'])
                        ->where('tafel_nummer', $validated['table'])
                        ->whereDate('datum', $validated['current_date'])
                        ->first();

        if (!$bestelling) {
            return redirect()->back()->withErrors(['error' => 'De bestelling bestaat niet met deze gegevens.']);
        }

        $heeftGerechten = GerechtHeeftBestelling::where('bestelling', $bestelling->id)->exists();

        if ($heeftGerechten) {
            return redirect()->back()->withErrors(['error' => 'Deze bestelling is al begonnen.']);
        }

        session([
            'order_id' => $bestelling->id,
            'table' => $validated['table'],
            'current_round' => 1,
            'round_start_time' => now(),
        ]);
    
        return redirect()->route('restaurant.orderOverview');
    }
    

    public function orderOverview()
    {
        $dishes = GerechtSoort::with('gerechten')->get();
        $table = session('table');
        $currentRound = session('current_round');
        $roundStartTime = session('round_start_time');

        return view('restaurant.orderFood', compact('dishes', 'table', 'currentRound', 'roundStartTime'));
    }

    public function registerRound(Request $request)
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
    
        $orderId = session('order_id');
        $currentRound = session('current_round');
        $roundStartTime = session('round_start_time');
    
        if (now()->diffInMinutes($roundStartTime) > 10 && $currentRound != 1) {
            return response()->json(['error' => 'Je moet 10 minuten wachten voor de volgende ronde.'], 400);
        }

        $bestelling = Bestelling::find($orderId);

        $orderItems = $request->input('orderItems');
        foreach ($orderItems as $item) {
            $rijstSoort = $item['rijst_soort'] ?? null;
            $opmerkingen = $item['newOpmerking'] ?? $item['selectedOpmerking'] ?? $item['opmerkingen'] ?? null;
            if ($opmerkingen == "Geen opmerking") $opmerkingen = null;
    
            GerechtHeeftBestelling::create([
                'bestelling' => $bestelling->id,
                'gerecht' => $item['id'],
                'rijst_soort' => $rijstSoort,
                'deel' => $item['deel'] ?? 1,
                'opmerkingen' => $opmerkingen,
            ]);
        }

        $newRound = $currentRound + 1;
        if ($newRound >= 6) {
            return redirect()->route('restaurant.orderFinished', ['id' => $bestelling->id]);
        }        

        if ($newRound <= 5){
            $bestelling->ronde = $newRound;
            $bestelling->save(); 
        }
        
        $newRoundStartTime = now();
        session([
            'current_round' => $newRound,
            'round_start_time' => $newRoundStartTime, 
        ]);

        return response()->json([
            'success' => 'Ronde geregistreerd!',
            'current_round' => $newRound,
            'round_start_time' => $newRoundStartTime->toDateTimeString(),
        ]);
    }

    public function orderFinished($id)
    {
        $bestelling = Bestelling::where('id', $id)
                                ->whereDate('datum', Carbon::today())
                                ->where('ronde', 5)
                                ->first();

        if (!$bestelling) {
            return redirect()->back()->withErrors(['error' => 'Bestelling niet gevonden.']);
        }

        session()->flush();

        return view('restaurant.orderFinished', compact('bestelling'));
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tafel;
use App\Models\Medewerker;
use App\Models\TafelHeeftMedewerker;
use Carbon\Carbon;

class PlanningController extends Controller
{
    public function index(Request $request)
    {
        // Bepaal de week: Als een week is geselecteerd, gebruik die, anders gebruik de huidige week
        $week = $request->input('week') ? Carbon::parse($request->input('week')) : now();
        $dagen = collect();

        // Loop door de dagen van de week (maandag t/m zondag)
        foreach (range(0, 6) as $dagOffset) {
            $dag = $week->copy()->startOfWeek()->addDays($dagOffset);
            // Haal alle tafels op met de medewerkers die voor die dag ingepland zijn
            $tafels = Tafel::with(['medewerkers' => function ($query) use ($dag) {
                $query->where('datum', $dag->toDateString());
            }])->get();

            // Voeg de tafels toe aan de juiste dag
            $dagen->put($dag->format('l'), $tafels);
        }

        // Haal alle medewerkers op om ze te kunnen selecteren in het formulier
        $medewerkers = Medewerker::all();

        // Stuur de data door naar de view
        return view('admin.planning', compact('dagen', 'medewerkers', 'week'));
    }

    public function store(Request $request)
    {
        // Valideer de invoer
        $data = $request->validate([
            'tafel' => 'required|exists:tafels,id',
            'medewerker' => 'required|exists:medewerkers,id',
            'dag' => 'required|date',
        ]);

        // Controleer of de medewerker al is ingepland voor de geselecteerde dag
        $exists = TafelHeeftMedewerker::where('medewerker', $data['medewerker'])
                                        ->where('datum', $data['dag'])
                                        ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['medewerker' => 'Medewerker is al ingepland op deze dag.']);
        }

        // Maak een nieuwe inplanning aan
        TafelHeeftMedewerker::create([
            'tafel' => $data['tafel'],
            'medewerker' => $data['medewerker'],
            'datum' => $data['dag'],
        ]);

        // Redirect terug met een success bericht
        return redirect()->back()->with('success', 'Planning is succesvol opgeslagen');
    }
}

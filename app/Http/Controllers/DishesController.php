<?php

namespace App\Http\Controllers;

use App\Models\Gerecht;
use App\Models\GerechtSoort;
use Illuminate\Http\Request;

class DishesController extends Controller
{
    public function index()
    {
        $dishes = Gerecht::with('soort')->get();

        return view('admin.dishes.index', compact('dishes'));
    }

    public function create()
    {
        $categories = GerechtSoort::all();
        $newNumber = Gerecht::whereRaw('`nummer` REGEXP "^[0-9]+$"')
            ->orderByRaw('CAST(`nummer` AS UNSIGNED) DESC')->value('nummer')+1;
 

       
        return view('admin.dishes.create', compact('categories', 'newNumber'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nummer' => 'required|string|unique:gerechten,nummer',
            'naam' => 'required|string',
            'prijs' => 'required|numeric',
            'soort' => 'required|exists:gerecht_soort,id',
        ]);

        $data = $request->all();

        Gerecht::create($data);
        return redirect()->route('admin.dishes.index')->with('success', 'Gerecht toegevoegd.');
    }

    public function edit($id)
    {
        $dish = Gerecht::findOrFail($id);
        $categories = GerechtSoort::all();
        return view('admin.dishes.edit', compact('dish', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nummer' => 'required|string|unique:gerechten,nummer',
            'naam' => 'required|string',
            'prijs' => 'required|numeric',
            'soort' => 'required|exists:gerecht_soort,id',
        ]);

        $dish = Gerecht::findOrFail($id);
        $dish->update($request->all());
        $dish->gewijzigd_op = now();
        $dish->save();

        return redirect()->route('admin.dishes.index')->with('success', 'Gerecht bijgewerkt.');
    }

    public function destroy($id)
    {
        $dish = Gerecht::findOrFail($id);
        $dish->delete();
        return redirect()->route('admin.dishes.index')->with('success', 'Gerecht verwijderd.');
    }

    public function copy($id)
    {
        $dish = Gerecht::findOrFail($id);
        $categories = GerechtSoort::all();

        // Generate a new unique number
        $newNumber = $this->generateUniqueNumber($dish->nummer);

        return view('admin.dishes.copy', compact('dish', 'categories', 'newNumber'));
    }

    private function generateUniqueNumber($baseNumber)
    {

        if (preg_match('/[a-z]$/i', $baseNumber)) {
            $suffix = substr($baseNumber, -1); // Get the last character
            $baseNumber = substr($baseNumber, 0, -1); // Remove the last character
        } else {
            $suffix = 'a';
        }
        $newNumber = $baseNumber . $suffix;

        while (Gerecht::where('nummer', $newNumber)->exists()) {
            $suffix++;
            if ($suffix > 'z') {
                throw new \Exception('Unable to generate unique number. Maximum suffix reached.');
            }
            $newNumber = $baseNumber . $suffix;
        }

        return $newNumber;
    }
}

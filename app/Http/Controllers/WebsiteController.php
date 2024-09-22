<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Gerecht;
use App\Models\GerechtSoort;
use App\Models\Aanbieding;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function menu()
    {
        return view('menu');
    }

    public function news()
    {
        return view('news');
    }

    public function contact()
    {
        return view('contact');
    }

    public function downloadMenu()
    {
        $gerechtSoorten = GerechtSoort::with('gerechten')->get();

        $vandaag = now();
        $geldigeAanbiedingen = Aanbieding::where('begin_datum', '<=', $vandaag)
                                          ->where('eind_datum', '>=', $vandaag)
                                          ->with('gerechten')
                                          ->get();
    
        $pdf = PDF::loadView('menu_pdf', compact('gerechtSoorten', 'geldigeAanbiedingen'));
    
        return $pdf->download('menu.pdf');
    }
}


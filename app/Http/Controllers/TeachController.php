<?php

namespace App\Http\Controllers;

use App\Orario;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;

class TeachController extends Controller
{
    public function get_teach(Request $request)
    {
        $data = $request->get('data');
        $dataString = Carbon::parse($data)->format('d-m-Y');
        $giorni = ['dom', 'lun', 'mar', 'mer', 'gio', 'ven', 'sab'];
        $giornoString = $giorni[Carbon::parse($data)->dayOfWeek];


        $orari = DB::table('orarios')->where('giorno', $giornoString)->get();
        return response()->json(['response' => $orari]);
    }
}


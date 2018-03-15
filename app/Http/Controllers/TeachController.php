<?php

namespace App\Http\Controllers;

use App\Orario;
use Illuminate\Http\Request;
use DB;

class TeachController extends Controller
{
    public function get_teach(Request $request)
    {
        $data = $request->get('data');
        $orari = DB::table('orarios')->get();
        return response()->json(['response' => $orari]);
    }
}


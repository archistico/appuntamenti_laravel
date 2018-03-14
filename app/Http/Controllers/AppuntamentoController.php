<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appuntamento;
use Illuminate\Support\Carbon;
use DB;

class AppuntamentoController extends Controller
{
    public function show($id) {

        $appuntamenti = DB::table('appuntamentos')
            ->join('orarios', 'orarios.id', '=', 'appuntamentos.orario_id')
            ->select('appuntamentos.*', 'orarios.ora as ora', 'orarios.giorno as giorno')
            ->where('appuntamentos.id', $id)
            ->get();

        return view('show', ['appuntamenti' => $appuntamenti]);
    }
}

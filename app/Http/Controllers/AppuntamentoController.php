<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appuntamento;
use Illuminate\Support\Carbon;
use DB;
use Illuminate\Support\Facades\Redirect;

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

    public function add(Request $request) {
        $data = $request->input('data');
        $nome = $request->input('nome');
        $note = $request->input('note');
        $orario_id = $request->input('orario');

        $app = new Appuntamento();
        $app->data = Carbon::parse($data)->format('Y-m-d');
        $app->nome = $nome;
        $app->note = $note;
        $app->orario_id = $orario_id;
        $app->save();

        return Redirect::route('lista');
    }

    public function delete($id) {

        $app = Appuntamento::find($id);
        $app->delete();

        return Redirect::route('lista');
    }
}

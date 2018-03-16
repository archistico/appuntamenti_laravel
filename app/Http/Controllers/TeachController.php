<?php

namespace App\Http\Controllers;

use App\Orario;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;

class Temp {
    public $id;
    public $ora;
    public $attivo;
    public $disponibile;
}

class TeachController extends Controller
{
    public function get_teach(Request $request)
    {

        $data = $request->get('data');

        //$data  = '01-03-2018';

        $dataString = Carbon::parse($data)->format('d-m-Y');
        $giorni = ['dom', 'lun', 'mar', 'mer', 'gio', 'ven', 'sab'];
        $giornoString = $giorni[Carbon::parse($data)->dayOfWeek];

        $orari = DB::table('orarios')->where('giorno', $giornoString)->get();

        // cerca tutti gli appuntamenti di quel giorno già fissati
        $appuntamenti = DB::table('appuntamentos')->where('data', Carbon::parse($data)->format('Y-m-d'))->get();

        // fondo assieme i due array
        $res = array();
        foreach ($orari as $orario) {
            $nome = '';
            $temp = new Temp();
            $temp->id = $orario->id;
            // cerca nel $app se ci sono con questo orario_id
            foreach ($appuntamenti as $app) {
                if($app->orario_id == $temp->id) {
                    $nome = $app->nome;
                }
            }
            if($nome) {
                $temp->ora = $orario->ora . ' - ' . $nome;
                $temp->disponibile = 0;
            } else {
                $temp->ora = $orario->ora;
                $temp->disponibile = 1;
            }
            $temp->attivo = $orario->attivo;
            $res[] = $temp;
        }

        return response()->json(['response' => $res]);
    }
}


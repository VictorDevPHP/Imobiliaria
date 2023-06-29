<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class masterController extends Controller
{
    public function index(){

        $catalogo = DB::table('catalogos')
                    ->join('produtos','produtos.id','=','catalogos.id_tp_produto')
                    ->select('catalogos.id','catalogos.titulo','catalogos.localidade','catalogos.area','catalogos.valor','produtos.descricao')
                    ->limit(3)
                    ->get();

        $imagem = DB::table('imagens')
                    ->select('chave','path')
                    ->get();

        // dd($catalogo, $imagem);

        return view('index',['itens' => $catalogo, 'imagens' => $imagem]);
    }
}

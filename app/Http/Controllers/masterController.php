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

        $opcoes = [
            (object) ['id' => 1, 'name' => 'Home','path' => '/admin'],
            (object) ['id' => 2, 'name' => 'Editar Perfil', 'path' => '/admin/editUsuario'],
            (object) ['id' => 3, 'name' => 'Sair','path' => '/logout'],
        ];

        return view('index',['itens' => $catalogo, 'imagens' => $imagem, 'opcoes' => $opcoes]);
    }

    public function store(Request $request){

        $tipo = strlen($request->infoPesquisa);

        if($tipo == 1 or $tipo == 2 or $tipo == 3 ){

            $imoveis = DB::table('catalogos')
                        ->join('produtos','produtos.id','=','catalogos.id_tp_produto')
                        ->select('catalogos.id','catalogos.titulo','catalogos.localidade','catalogos.area','catalogos.valor','produtos.descricao')
                        ->where('produtos.id','=',$request->infoPesquisa)
                        ->get();

            $imagem = DB::table('imagens')
                        ->select('chave','path')
                        ->get();

        }else{

            $imoveis = DB::table('catalogos')
                        ->join('produtos','produtos.id','=','catalogos.id_tp_produto')
                        ->select('catalogos.id','catalogos.titulo','catalogos.localidade','catalogos.area','catalogos.valor','produtos.descricao')
                        ->where('catalogos.titulo','like',$request->infoPesquisa)
                        ->get();

            $imagem = DB::table('imagens')
                        ->select('chave','path')
                        ->get();
        }


        return view('imoveis.home',['imoveis' => $imoveis, 'imagens' => $imagem]);
    }

    public function sobre(){
        return view('sobre');
    }

    public function contato(){
        return view('contato');
    }
}

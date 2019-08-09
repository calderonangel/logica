<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatricesController extends Controller
{
    /**
     * Store Controla la matriz.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {            
            if(!$this->validar($request))
                return response()->json("Datos incorrectos en la matriz.",500);
            $arrMatriz = $this->girarAntiHorario($request);
            return response()->json($arrMatriz,200);
        } catch (\Exception $e) {            
            return response()->json($e->getMessage(),500);
        }       
    }

    /**
     * Metodo privado GirarAntiHorario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return $arrMatriz
     */
    private function girarAntiHorario(Request $request)
    {        
        $nContGen = count($request->all());            
            $arrMatriz = array();
            for($i = 0; $i < $nContGen; $i++){
                for($w = 0; $w < $nContGen; $w++){                
                    $arrMatriz[$i][$w] = $request[$w][$nContGen - 1 - $i];                
                }
            }
            return $arrMatriz;
    }

    /**
     * Metodo privado Validar la matriz NxN.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function validar(Request $request)
    {
        $nContGen = count($request->all());
        if($nContGen === 0)
            return false;
        for($i = 0; $i < $nContGen; $i++){                        
            if($nContGen != count($request[ $i ]))            
                return false;           
        }
        return true;
    }
}

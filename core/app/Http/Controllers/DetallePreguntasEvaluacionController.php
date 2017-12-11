<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Detalle_Preguntas_Evaluacion;

use App\Util;



class DetallePreguntasEvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dpe=Detalle_Preguntas_Evaluacion::all();
        return response()->json(["datos"=>$dpe,"mensaje"=>"Detalle peguntas evaluacion encontradas"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $datos=Util::decodificar_json($request->get("datos"));
        
        $dpe=Detalle_Preguntas_Evaluacion::firstOrCreate([
                                    "fk_id_pregunta"=>$datos["datos"]->fk_id_pregunta,
                                    "fk_id_evaluacion"=>$datos["datos"]->fk_id_evaluacion,
                                                                    
                                ]);
        return response()->json(["mensaje"=>"OK","id"=>$dep->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         $dtp=Detalle_Preguntas_Evaluacion::where("id","=",$id)->get();
        
        return response()->json(["datos"=>$dtp,"mensaje"=>"Detalle preguntas encontrado"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datos=Util::decodificar_json($request->get("datos"));
        Detalle_Preguntas_Evaluacion::where("id",$id)
                            ->update([
                                   "fk_id_pregunta"=>$datos["datos"]->fk_id_pregunta,
                                    "fk_id_evaluacion"=>$datos["datos"]->fk_id_evaluacion,

                                ]);
        return response()->json(["mensaje"=>"Recurso actualizado"]);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $dta=Detalle_Preguntas_Evaluacion::destroy($id);
        return response()->json(["mensaje"=>"Recurso eliminado"]);    
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Respuestas;

use App\Util;

class RespuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $r=Respuestas::all();
        return response()->json(["datos"=>$r,"mensaje"=>"Respuesta encontradas"]); 
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
        
        $p=Respuestas::firstOrCreate([

                                   "argumento_respuesta"=>$datos["datos"]->argumento_respuesta,
                                    "es_correcta"=>$datos["datos"]->es_correcta,
                                    "fk_id_pregunta"=>$datos["datos"]->fk_id_pregunta,
                                    
                                    
                                                                    
                                ]);
        return response()->json(["mensaje"=>"OK","id"=>$p->id]);
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
         $r=Respuestas::where("id","=",$id)->get();
        
        return response()->json(["datos"=>$r,"mensaje"=>"Recurso encontrado"]);
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
        Respuestas::where("id",$id)
                            ->update([
                               
                                   "argumento_respuesta"=>$datos["datos"]->argumento_respuesta,
                                    "es_correcta"=>$datos["datos"]->es_correcta,
                                    "fk_id_pregunta"=>$datos["datos"]->fk_id_pregunta,
                                    
                                 
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
        $dta=Respuestas::destroy($id);
        return response()->json(["mensaje"=>"Recurso eliminado"]);    
    }
}

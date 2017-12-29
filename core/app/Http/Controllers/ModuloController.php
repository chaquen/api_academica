<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Modulo;

use App\Models\Preguntas;

use App\Functions\Util;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $m=Modulo::all();
        return response()->json(["datos"=>$m,"mensaje"=>"modulos encontrados"]);
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
        
        $m=Modulo::firstOrCreate(["nombre_modulo"=>$datos["datos"]->nombre_modulo,"descripcion_modulo"=>$datos["datos"]->nombre_modulo,"fk_id_curso"=>$datos["datos"]->fk_id_curso,"fecha_inicio_modulo"=>$datos["datos"]->fecha_inicio_modulo,"fecha_fin_modulo"=>$datos["datos"]->fecha_fin_modulo]);
     
        return response()->json(["respuesta"=>TRUE,"mensaje"=>"modulo registrado","datos"=>$m->id]);
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
        $m=Modulo::where("nombre_modulo","=",$id)->get();
        
        return response()->json(["datos"=>$m,"mensaje"=>"modulos encontrados"]);
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
        Modulo::where()
                    ->update([]);
        return response()->json(["repsuesta"=>TRUE,"mensaje"=>"modulo registrado"]);
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
       
 
            Modulo::where("id",$id)
                           
                            ->delete();       
            return response()->json(["mensaje"=>"Recurso eliminado","respuesta"=>TRUE]);                                        
        
    }

    public function modulos_de_curso($id){
         $m=Modulo::where("fk_id_curso","=",$id)->get();
        return response()->json(["datos"=>$m,"mensaje"=>"modulos encontrados","respuesta"=>true]);
    }
}

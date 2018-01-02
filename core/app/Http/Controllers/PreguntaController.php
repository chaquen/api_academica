<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Preguntas;

use App\Models\Respuestas;

use App\Functions\Util;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
         $pre=Preguntas::all();
          $arr=[];   
          $i=0;       
         foreach ($pre as $key => $value) {
                $arr[$i]=$value;
                $arr[$i]["respuestas"]=Respuestas::where("fk_id_pregunta","=",$value->id)->get();
                $i++;
        }           
        //var_dump($arr);
        if(count($arr)>0){
            return response()->json(["mensaje"=>"Preguntas encontradas ","respuesta"=>true,"datos"=>$arr]);    
        }else{
            return response()->json(["mensaje"=>"Preguntas NO encontradas ","respuesta"=>false]);    
        }
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
        
        $p=Preguntas::firstOrCreate([

                                    "argumento_pregunta"=>$datos["datos"]->argumento_pregunta,
                                    "tipo_pregunta"=>$datos["datos"]->tipo_pregunta,
                                    "estado_pregunta"=>"1",
                                    
                                                                    
                                ]);
        if($p->id > 0){
            if(count($datos["datos"]->respuestas)==0){
                Respuestas::firstOrCreate([
                        "argumento_respuesta"=>"Respuesta:",
                        "es_correcta"=>true,
                        "fk_id_pregunta"=>$p->id,            

                    ]);    
            }
            foreach ($datos["datos"]->respuestas as $key => $value) {

                    Respuestas::firstOrCreate([
                        "argumento_respuesta"=>$value->respuesta,
                        "es_correcta"=>$value->es_correcta,
                        "fk_id_pregunta"=>$p->id,            

                    ]);    
            }
            
        }

        return response()->json(["mensaje"=>"Pregunta creada","id"=>$p->id]);
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
        
        $pre=Preguntas::where("id","=",$id)->get();
          $arr=[];   
          $i=0;       
         foreach ($pre as $key => $value) {
                $arr[$i]=$value;
                $arr[$i]["respuestas"]=Respuestas::where("fk_id_pregunta","=",$value->id)->get();
                $i++;
        }           
        //var_dump($arr);
        if(count($arr)>0){
            return response()->json(["mensaje"=>"Preguntas encontradas ","respuesta"=>true,"datos"=>$arr]);    
        }else{
            return response()->json(["mensaje"=>"Preguntas NO encontradas ","respuesta"=>false]);    
        }
        
        return response()->json(["datos"=>$e,"mensaje"=>"Detalle preguntas encontrado"]);
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
        Preguntas::where("id",$id)
                            ->update([
                                   "argumento_pregunta"=>$datos["datos"]->argumento_pregunta,
                                    "tipo_pregunta"=>$datos["datos"]->tipo_pregunta,
                                    
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
         $datos=Util::decodificar_json($request->get("datos"));
        $e=Preguntas::where("id",$id);
        if($e->estado_pregunta==1){
            Preguntas::where("id",$id)
                            ->where("estado_pregunta","=",1)
                            ->update(["estado_pregunta"=>0]);       
                return response()->json(["mensaje"=>"Recurso eliminado"]);                                        
        }else{
            Preguntas::where("id",$id)
                            ->where("estado_pregunta","=",0)
                            ->update(["estado_pregunta"=>1]);  
                return response()->json(["mensaje"=>"Recurso habilitado"]);                                             

        }
    }

    public function preguntas_tipo($tipo){
        $pre=Preguntas::where("preguntas.tipo_pregunta","=",$tipo)
                    ->get();
          $arr=[];   
          $i=0;       
         foreach ($pre as $key => $value) {
                $arr[$i]=$value;
                $arr[$i]["respuestas"]=Respuestas::where("fk_id_pregunta","=",$value->id)->get();
                $i++;
        }           
        //var_dump($arr);
        if(count($arr)>0){
            return response()->json(["mensaje"=>"Preguntas encontradas ","respuesta"=>true,"datos"=>$arr]);    
        }else{
            return response()->json(["mensaje"=>"Preguntas NO encontradas ","respuesta"=>false]);    
        }
                                                     
    }
}

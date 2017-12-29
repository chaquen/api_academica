<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Actividades;

use App\Functions\Util;

use DB;


class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
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
         Actividades::create(['nombre_actividad'=>$datos["datos"]->nombre_actividad,
                            'tipo_actividad'=>$datos["datos"]->tipo_evento,
                            'activo_desde'=>$datos["datos"]->fecha_inicio_evento." ".$datos["datos"]->hora_inicio_evento,
                            'activo_hasta'=>$datos["datos"]->fecha_fin_evento." ".$datos["datos"]->hora_fin_evento,
                            'estado_actividad'=>"1",
                            'actividad_recurso'=>$datos["datos"]->url_evento,
                            'fk_id_modulo_curso'=>$datos["datos"]->id_modulo]);
         return response()->json(["mensaje"=>"Evento registrado","respuesta"=>true]);
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
        $val=explode("&",$id);
       
        $arr=[];
        $arr_final=[];
        $i=0;
        $e=0;
        foreach ($val as $key => $value) {
            $arr[$i]=$value;
            if($i==2){
               
                 
            $arr_final[$e]=$arr;
               $e++;
               $arr=[];    
               $i=0;
            }else{
                 $i++;
            }
           
        }
      
        $act=Actividades::where($arr_final)->get();
        
        return response()->json(["mensaje"=>"Eventos encontrados","respuesta"=>true,"datos"=>$act]);
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
        
         DB::table("actividades")                    
                    ->where("actividades.id","=",$id)
                    ->delete(); 
        return response()->json(["respuesta"=>true,"mensaje"=>"actividad eliminada"]);         

    }

    public function subir_archivo(Request $request){

            $file=$request->file('miArchivo');
            
            $datos=Util::decodificar_json($request->get("datos"));
            
            $filename=$datos["datos"]->nombre_archivo;

            $datos=Util::decodificar_json($request->get("datos"));
            
            $des="recursos/documento";
            
            if($file->move($des,$datos["datos"]->nombre_archivo)){
                echo json_encode(["respuesta"=>true,"mensaje"=>"archivo guardado"]);
            }else{
                echo json_encode(["respuesta"=>false,"mensaje"=>"NO se ha podido guardar"]);
            }
    }

    public function eventos($id_curso){
        
           $re=DB::table("actividades")
                    ->join("modulos","modulos.id","=","actividades.fk_id_modulo_curso")
                    ->join("cursos","cursos.id","=","modulos.fk_id_curso")
                    ->where([
                                                    ["modulos.fk_id_curso","=", $id_curso],
                                                    ["actividades.tipo_actividad","=", "evento"],
                                                    ["actividades.estado_actividad","=","1"]
                                                ])
                    ->orwhere([
                                                    ["modulos.fk_id_curso","=", $id_curso],
                                                    ["actividades.tipo_actividad","=", "evaluacion"],
                                                    ["actividades.estado_actividad","=","1"]
                                                ])
                    ->select("actividades.id","actividades.nombre_actividad","cursos.nombre_curso","actividades.activo_desde","actividades.activo_hasta","actividades.tipo_actividad")
                    ->get();            
                        
             return response()->json(["mensaje"=>"Eventos encontrados","respuesta"=>true,"datos"=>$re]);
                        
                 
    }
}

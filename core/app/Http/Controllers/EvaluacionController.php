<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Evaluaciones;

use App\Models\PreguntasEvaluacion;

use App\Models\Respuestas;

use App\Functions\Util;

use DB;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $e=Detalle_Preguntas_Evaluaciones::all();
        return response()->json(["datos"=>$e,"mensaje"=>"Evaluacion encontradas"]);

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
         //var_dump($datos["datos"]);
         //var_dump($datos["datos"]->fk_id_actividad);
        $e=Evaluaciones::firstOrCreate([

                                    "tipo_evaluacion"=>$datos["datos"]->tipo_evaluacion,
                                    "fk_id_actividad"=>$datos["datos"]->fk_id_actividad,
                                    "fecha_evaluacion_inicio"=>$datos["datos"]->fecha_evaluacion_inicio,
                                    "fecha_evaluacion_fin"=>$datos["datos"]->fecha_evaluacion_fin
                                                                    
                                ]);
        //registrar las preguntas
        
        foreach ($datos["datos"]->preguntas as $key => $value) {
            # code...
               
                PreguntasEvaluacion::create([
                    "fk_id_pregunta"=>$value[0]->id,
                    "fk_id_evaluacion"=>$e->id,
                ]);
        }
       

        return response()->json(["mensaje"=>"OK","id"=>$e->id]);
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
        $e=Evaluaciones::where("fk_id_actividad","=",$id)->get();
        //var_dump($e);
          $arr=[];   
          $i=0;       
         foreach ($e as $key => $value) {
                //var_dump($value);
                $arr[$i]=$value;
                $arr[$i]["preguntas"]=PreguntasEvaluacion::join("preguntas","preguntas.id","=","preguntas_evaluacions.fk_id_pregunta")
                                        ->where("fk_id_evaluacion","=",$value->id)
                                        ->select("preguntas_evaluacions.id as id_pregunta","preguntas.id","preguntas.argumento_pregunta","tipo_pregunta","preguntas_evaluacions.fk_id_pregunta")
                                        ->get();
                 //var_dump(count($arr[$i]["preguntas"]));
                 //echo "====";                       
                $i++;
         }

        //var_dump($arr);
         foreach ($arr[0]["preguntas"] as $key => $value) {
            //var_dump($value->fk_id_pregunta);
            //echo "=========";
             $arr[0]["preguntas"][$key]["respuestas"]=Respuestas::where("fk_id_pregunta","=",$value->fk_id_pregunta)
                                                                    ->select("respuestas.id","respuestas.argumento_respuesta","es_correcta") 
                                                                    ->get();
         }           
        if(count($arr)>0){
            return response()->json(["datos"=>$arr,"mensaje"=>"Evaluacion encontrada","respuesta"=>true]);    
        }else{
            return response()->json(["datos"=>$arr,"mensaje"=>"Evaluacion NO  encontrada","respuesta"=>false]);    
        }

        
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
        Evaluaciones::where("id",$id)
                            ->update([
                                    
                                    "tipo_evaluacion"=>$datos["datos"]->tipo_evaluacion,
                                    "fk_id_curso"=>$datos["datos"]->fk_id_curso,
                                    "fecha_evaluacion_inicio"=>$datos["datos"]->fecha_evaluacion_inicio,
                                    "fecha_evaluacion_fin"=>$datos["datos"]->fecha_evaluacion_fin,

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
        $datos=Util::decodificar_json($request->get("datos"));
        $e=Evaluaciones::where("id",$id);
        if($e->estado_evaluacion==1){
            Categorias_Cursos::where("id",$id)
                            ->where("estado_evaluacion","=",1)
                            ->update(["estado_evaluacion"=>0]);       
                return response()->json(["mensaje"=>"Recurso eliminado"]);                                        
        }else{
            Categorias_Cursos::where("id",$id)
                            ->where("estado_evaluacion","=",0)
                            ->update(["estado_evaluacion"=>1]);  
                return response()->json(["mensaje"=>"Recurso habilitado"]);                                             

        }
    }

    public function evaluaciones_por_curso($id_curso){
        $eval=DB::table("actividades")
            ->join("modulos","modulos.id","=","actividades.fk_id_modulo_curso")
            ->join("evaluaciones","evaluaciones.fk_id_actividad","=","actividades.id")
            ->where("modulos.fk_id_curso","=",$id_curso)
            ->get();
         return response()->json(["mensaje"=>"Evaluacion encontrada","respuesta"=>true,"datos"=>$eval]);                                                
    }
    public function resultado_evaluacion($id_evaluacion,$id_alumno){
        $eva=DB::table("evaluaciones")
                ->join("preguntas_evaluacions","preguntas_evaluacions.fk_id_evaluacion","=","evaluaciones.id")
                ->join("preguntas","preguntas.id","=","preguntas_evaluacions.fk_id_pregunta")
                ->where("evaluaciones.id","=",$id_evaluacion)
                ->select("preguntas.id","preguntas.argumento_pregunta","preguntas_evaluacions.id as id_pregunta","preguntas.tipo_pregunta")
                ->get();                
        $arr=[];
        $i=0;
        foreach ($eva as $key => $value) {
              //var_dump($value);
              //echo "============";
              $arr[$i]=(array)$value;
              $arr[$i]["respuestas"]=DB::table("respuestas_del_usuarios ")
                                      ->join("respuestas","respuestas_del_usuarios.fk_id_respuestas","=","respuestas.id")
                                      ->where([
                                                ["respuestas_del_usuarios.fk_id_det_pre_evaluacion","=",$value->id_pregunta],
                                                ["respuestas_del_usuarios.fk_id_usuario","=",$id_alumno]
                                              ])
                                      ->get();
              $i++;

        }
         return response()->json(["mensaje"=>"resultado evaluacion encontrada","respuesta"=>true,"datos"=>$arr]);

    }

    public function evaluacion_de_alumno($id_evaluacion,$id_usuario){
          

         
            //var_dump($e);
         $rr=DB::table("respuestas_del_usuarios")
            ->join("evaluaciones","evaluaciones.id","=","respuestas_del_usuarios.fk_id_evaluaciones")
            ->where([["respuestas_del_usuarios.fk_id_usuario","=",$id_usuario],["evaluaciones.fk_id_actividad","=",$id_evaluacion]])
            ->get();
          //var_dump($rr);  
         if(count($rr)==0){
                 $e=Evaluaciones::where("actividades.id","=",$id_evaluacion)
                            ->join("actividades","actividades.id","=","evaluaciones.fk_id_actividad")   
                            ->select("evaluaciones.id","evaluaciones.tipo_evaluacion","evaluaciones.fk_id_actividad","evaluaciones.fecha_evaluacion_inicio","evaluaciones.fecha_evaluacion_fin","evaluaciones.estado_evaluacion")
                            ->get();   
                 $arr=[];   
                 $i=0;       
                 foreach ($e as $key => $value) {
                        //echo "==";
                        //var_dump($value->id);
                        $arr[$i]=$value;
                        $arr[$i]["preguntas"]=PreguntasEvaluacion::join("preguntas","preguntas.id","=","preguntas_evaluacions.fk_id_pregunta")
                                                ->where("fk_id_evaluacion","=",$value->id)
                                                ->select("preguntas_evaluacions.id as id_pregunta","preguntas.id","preguntas.argumento_pregunta","tipo_pregunta","preguntas_evaluacions.fk_id_pregunta")
                                                ->get();
                         //var_dump(count($arr[$i]["preguntas"]));
                         //echo "====";                       
                        $i++;
                 }

                //var_dump($arr);
                 
                          
                if(count($arr)>0){
                     foreach ($arr[0]["preguntas"] as $key => $value) {
                        //var_dump($value->fk_id_pregunta);
                        //echo "=========";
                         $arr[0]["preguntas"][$key]["respuestas"]=Respuestas::where("fk_id_pregunta","=",$value->fk_id_pregunta)
                                                                                ->select("respuestas.id","respuestas.argumento_respuesta","es_correcta") 
                                                                                ->get();
                     }   
                    return response()->json(["datos"=>$arr,"mensaje"=>"Evaluacion encontrada","respuesta"=>true]);    
                }else{
                    return response()->json(["mensaje"=>"No hay preguntas para esta evaluacion","respuesta"=>false]);    
                } 
         }else{
            return response()->json(["mensaje"=>"Ya finalizaste la evaluacion","respuesta"=>false]);    
         }
          
 
    }
}

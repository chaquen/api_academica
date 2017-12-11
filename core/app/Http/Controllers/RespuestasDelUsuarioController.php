<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\RespuestasDelUsuario;

use App\Util;

use DB;
class RespuestasDelUsuarioController extends Controller
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
        //var_dump($datos);
        $i=0;
        
        foreach ($datos["datos"]->preguntas as $key => $value) {
            //var_dump($value);
           $arr=[];    
           
          
           //var_dump($v);
           // var_dump($v->tipo_pregunta);
            $i=0;
            switch ($value->tipo_pregunta) {
                case 'abierta':
                       // var_dump($v->respuestas->seleccionada);
                        foreach ($value->respuestas as $y => $r) {
                            if($r->seleccionada){
                                 //var_dump($v->respuestas[0]->id);
                                 //var_dump($v->respuestas[0]);
                                    $arr[$i]=["comentario_respuesta"=>$r->texto_respuesta,"fk_id_respuestas"=>$r->id,"fk_id_det_pre_evaluacion"=>$value->id_pregunta,"fk_id_usuario"=>$datos["datos"]->usuario,"fk_id_evaluaciones"=>$datos["datos"]->evaluacion];
                                  
                            }
                        }
                       

                    break;
                
                case "cerrada":
                        //var_dump($v->respuestas);
                        foreach ($value->respuestas as $y => $r) {
                            if($r->seleccionada){
                                  $arr[$i]=["comentario_respuesta"=>"","fk_id_respuestas"=>$r->id,"fk_id_det_pre_evaluacion"=>$value->id_pregunta,"fk_id_usuario"=>$datos["datos"]->usuario,"fk_id_evaluaciones"=>$datos["datos"]->evaluacion];
                              
                            }
                        }
                    break;
                case "cerrada_comentario":
                        foreach ($v->respuestas as $y => $r) {
                            if($r->seleccionada){
                                 //var_dump($v->respuestas[0]->id);
                                  $arr[$i]=["comentario_respuesta"=>$value->respuestas[0]->texto_respuesta,"fk_id_respuestas"=>$r->id,"fk_id_det_pre_evaluacion"=>$value->id_pregunta,"fk_id_usuario"=>$datos["datos"]->usuario,"fk_id_evaluaciones"=>$datos["datos"]->evaluacion];
                                  
                            }
                        }
                          
                    break;    
                case "cerrada_multiple":
                        foreach ($value->respuestas as $y => $r) {
                            if($r->seleccionada){
                                 $arr[$i]=["comentario_respuesta"=>"","fk_id_respuestas"=>$r->id,"fk_id_det_pre_evaluacion"=>$value->id_pregunta,"fk_id_usuario"=>$datos["datos"]->usuario,"fk_id_evaluaciones"=>$datos["datos"]->evaluacion];
                                 
                            }
                        }
                break;    
            }
            //var_dump($arr);
            DB::table("respuestas_del_usuarios")
                ->insert($arr);
            //var_dump($v->seleccionada);
            //var_dump($v->texto_respuesta);

          
         
        }

        return response()->json(["mensaje"=>"Haz finalizado, gracias por participar","respuesta"=>true]);

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
    }

    public function ver_resultados_de_alumno($id_evaluacion,$id_alumno){}
}

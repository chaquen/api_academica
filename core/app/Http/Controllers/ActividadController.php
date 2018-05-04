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
                            'activo_desde'=>$datos["datos"]->activo_desde." ".$datos["datos"]->hora_inicio_evento,
                            'activo_hasta'=>$datos["datos"]->activo_hasta." ".$datos["datos"]->hora_fin_evento,
                            'estado_actividad'=>"1",
                            'actividad_recurso'=>$datos["datos"]->url_evento,
                            'fk_id_modulo_curso'=>$datos["datos"]->fk_id_modulo_curso]);
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
        
       
      

      
        $act=Actividades::join("modulos","modulos.id","=","actividades.fk_id_modulo_curso")
                            ->where([["modulos.fk_id_curso","=",$id],["tipo_actividad","=","evento"]])
                            ->orwhere([["modulos.fk_id_curso","=",$id],["tipo_actividad","=","evaluacion"]])
                            ->select("actividades.activo_desde","actividades.activo_hasta","actividades.nombre_actividad","actividades.id","actividades.fk_id_modulo_curso","modulos.nombre_modulo","actividades.tipo_actividad")
                            ->get();
        if(count($act)>0){
            return response()->json(["mensaje"=>"Eventos encontrados","respuesta"=>true,"datos"=>$act]);    
        }else{
            return response()->json(["mensaje"=>"Eventos NO encontrados","respuesta"=>false]);
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
        
        Actividades::where("id","=",$id)
                       ->update(["nombre_actividad"=>$datos["datos"]->nombre_actividad,"tipo_actividad"=>$datos["datos"]->tipo_evento,"activo_desde"=>$datos["datos"]->fecha_inicio_evento." ".$datos["datos"]->hora_inicio_evento.":00","activo_hasta"=>$datos["datos"]->fecha_fin_evento." ".$datos["datos"]->hora_fin_evento.":00","fk_id_modulo_curso"=>$datos["datos"]->id_modulo]); 

        return response()->json(["mensaje"=>"Agenda actualizada","respuesta"=>true]);    
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
            
            //$datos=Util::decodificar_json($request->get("datos"));
            //var_dump($request->get("datos"));
            $datos=json_decode($request->get("datos"));
            //var_dump($datos->datos);
            $filename=$datos->datos->nombre_archivo;

            $datos=Util::decodificar_json($request->get("datos"));
            
            $des="recursos/documento";
            
            if($file->move($des,$filename)){
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

    public function agenda_por_id($id_agenda){
         $act=Actividades::join("modulos","modulos.id","=","actividades.fk_id_modulo_curso")
                            ->where("actividades.id","=",$id_agenda) ->select("actividades.id","actividades.nombre_actividad","actividades.tipo_actividad",
                                "actividades.estado_actividad",
                                "actividades.actividad_recurso",
                                "actividades.activo_desde", 
                                "actividades.activo_hasta", 
                                "actividades.fk_id_modulo_curso",       
                                "modulos.numero_de_modulo",
                                "modulos.nombre_modulo",
                                "modulos.fk_id_curso",
                                "modulos.fecha_fin_modulo",
                                "modulos.fecha_inicio_modulo")                           
                            ->get();
        if(count($act)>0){
            return response()->json(["mensaje"=>"Eventos encontrados","respuesta"=>true,"datos"=>$act]);    
        }else{
            return response()->json(["mensaje"=>"Eventos NO encontrados","respuesta"=>false]);
        }
    }

    public function evaluaciones($uno,$dos,$tres,$cuatro){
         $act=Actividades::join("modulos","modulos.id","=","actividades.fk_id_modulo_curso")
                            ->where([[$uno,"=",$dos],[$tres,"=",$cuatro]])
                          
                            ->select("actividades.id","actividades.nombre_actividad","actividades.activo_desde","actividades.activo_hasta","actividades.fk_id_modulo_curso","modulos.nombre_modulo","actividades.tipo_actividad")
                            ->get();
        if(count($act)>0){
            return response()->json(["mensaje"=>"Eventos encontrados","respuesta"=>true,"datos"=>$act]);    
        }else{
            return response()->json(["mensaje"=>"Eventos NO encontrados","respuesta"=>false]);
        }
    }


    public function buscar_actividades_por_curso($id_curso){
        $act=DB::table("cursos")
            ->join("modulos","modulos.fk_id_curso","=","cursos.id")
            ->join("actividades","actividades.fk_id_modulo_curso","=","modulos.id")
            ->where("cursos.id",$id_curso)
            ->select("actividades.id","actividades.nombre_actividad","actividades.activo_desde","actividades.activo_hasta","actividades.fk_id_modulo_curso","modulos.nombre_modulo","actividades.tipo_actividad")
            ->get();
        if(count($act)>0){
            return response()->json(["mensaje"=>"Actividades encontrados","respuesta"=>true,"datos"=>$act]);    
        }else{
            return response()->json(["mensaje"=>"Actividades NO encontrados","respuesta"=>false]);
        }    
    }
    public function subir_archivo_actividad (Request $request){
       $datos=json_decode($request->get("datos"));
        //var_dump($datos->datos->usuario);
        //var_dump($datos->datos->actividad);
       DB::table("detalle_evaluacion_usuario")
                ->where([
                        ["fk_id_usuario",$datos->datos->usuario],
                        ["fk_id_evaluacion",$datos->datos->actividad]
                    ])
                ->update(["fk_id_usuario"=>$datos->datos->usuario,"fk_id_evaluacion"=>$datos->datos->actividad,"nota_evaluacion"=>"0","estado"=>"pendiente_califar"]);
                
        $des=substr(base_path(),0,-5)."/actividades/".$datos->datos->usuario."/".$datos->datos->curso."/".$datos->datos->actividad;        
        $file=$request->file('miArchivo');
        //var_dump($des); 
        if($file->move($des,$datos->datos->nombre_archivo)){
            return response()->json(["mensaje"=>"ARCHIVO GUARDADO","respuesta"=>true,"ruta"=>trim("actividades/ ").$datos->datos->nombre_archivo]);
        }else{
            return response()->json(["mensaje"=>"No se a podido subir el archivo","respuesta"=>true]);
        }
   }

    public function registrar_nota(Request $request){
        $datos=Util::decodificar_json($request->get("datos"));
        DB::table("detalle_evaluacion_usuario")
                ->where([["fk_id_usuario",$datos["datos"]->usuario],["fk_id_evaluacion",$datos["datos"]->actividad]])
                ->update(["fk_id_usuario"=>$datos["datos"]->usuario,"fk_id_evaluacion"=>$datos["datos"]->actividad,"num_intentos"=>"1","nota_evaluacion"=>$datos["datos"]->nota,"estado"=>"calificada"]);
                
        return response()->json(["mensaje"=>"Actividad calificada","respuesta"=>true]);                
    }

    public function ver_notas_actividades($id_usuario){
         $nota=DB::table("detalle_evaluacion_usuario")
            ->join("usuarios","usuarios.id","=","detalle_evaluacion_usuario.fk_id_usuario")
            ->join("actividades","actividades.id","=","detalle_evaluacion_usuario.fk_id_evaluacion")
            ->select("actividades.id","actividades.nombre_actividad","detalle_evaluacion_usuario.nota_evaluacion")
            ->where("usuarios.id",$id_usuario)
            ->get();
        if(count($nota)>0){
            return response()->json(["mensaje"=>"Notas encontradas","respuesta"=>true,"datos"=>$nota]);    
        }else{
            return response()->json(["mensaje"=>"Notas NO encontradas","respuesta"=>false]);
        }    
    }

    


   public function actividades_del_usuario($usuario,$curso,$actividad){
        $ruta=$des=substr(base_path(),0,-5)."/actividades/".$usuario."/".$curso."/".$actividad;  
        //var_dump($ruta);     

        $nota=DB::table("detalle_evaluacion_usuario")
            ->where([["fk_id_usuario",$usuario],["fk_id_evaluacion",$actividad]])
            ->get();
        //var_dump($nota);    
        //var_dump($usuario);    
        //var_dump($actividad);    
        $arr=array();
        //Abrir directorio y listarlo
        if(is_dir($ruta)){
            if($dh=  opendir($ruta)){
                $i=0;                
               // $arr=  scandir($ruta);
                while(($archivo=  readdir($dh))!== false){
                    //var_dump($dh);
                    //var_dump($archivo);
                    if($archivo!="." && $archivo!=".."){
                        $arr[$i]=$archivo;
                        $i++;
                    }
                    
                }
                return response()->json(["respuesta"=>true,"mensaje"=>"ok","datos"=>$arr,"nota"=>$nota[0]]);
            }
            closedir($dh);
            
        }else{
            return response()->json(["respuesta"=>false,"mensaje"=>"ruta no existe","nota"=>$nota[0]]);
        }
   }

   public function  validar_actividad_anterior($curso,$actividad,$usuario){
     //aqui debe validar la actividad anteriora laque se quiere hacer y validar que este o pendiente por calificar o calificada
    //var_dump($curso);
    //var_dump($actividad);

     $ac=DB::table("actividades")
        ->join("modulos","modulos.id","=","actividades.fk_id_modulo_curso")
        ->join("cursos","cursos.id","=","modulos.fk_id_curso")
        ->join("detalle_evaluacion_usuario","detalle_evaluacion_usuario.fk_id_evaluacion","=","actividades.id")
        ->where([["cursos.id",$curso],["actividades.id",$actividad],["detalle_evaluacion_usuario.fk_id_usuario",$usuario]])
        ->select("actividades.numero_actividad","detalle_evaluacion_usuario.estado")
        ->get();


     //var_dump((int)$ac[0]->numero_actividad);
     $an=((int)$ac[0]->numero_actividad) - 1;
     if($an==0){
            //es la primera actividad puede verla
        return response()->json(["respuesta"=>true,"mensaje"=>"puedes continuar"]);
     }else{
        $ac2=DB::table("actividades")
        ->join("modulos","modulos.id","=","actividades.fk_id_modulo_curso")
        ->join("cursos","cursos.id","=","modulos.fk_id_curso")
        ->join("detalle_evaluacion_usuario","detalle_evaluacion_usuario.fk_id_evaluacion","=","actividades.id")
        ->where([
                    ["cursos.id",$curso],
                    ["actividades.numero_actividad",$an],
                    ["detalle_evaluacion_usuario.fk_id_usuario",$usuario]
                ])
        ->select("actividades.numero_actividad","detalle_evaluacion_usuario.estado")
        ->get();
        
        if($ac2[0]->estado=="calificada" ||  $ac2[0]->estado=="pendiente_calificar"){
            //  var_dump($ac2);        
                //puedes continuar 
            return response()->json(["respuesta"=>true,"mensaje"=>"puedes continuar"]);
        }else if($ac2[0]->estado=="pendiente" || $ac2[0]->estado=="vencida"){
            //No puedes continuar
            return response()->json(["respuesta"=>false,"mensaje"=>"debes terminar la actividad anterior"]);        
        }
        
     }  
   }
}

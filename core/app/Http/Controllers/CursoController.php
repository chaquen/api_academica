<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use App\Models\Curso;

use App\Models\Actividades;

use App\Models\Modulo;

use App\Models\Evaluacion;

use App\Functions\Util;

use Carbon\Carbon;

use App\Functions\Random;

use Maatwebsite\Excel\Facades\Excel;

use App\views;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cur=Curso::all();
        return response()->json(["datos"=>$cur,"mensaje"=>"Curso encontradas","respuesta"=>TRUE]);
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
            $cur=Curso::where("nombre_curso","=",$datos["datos"]->nombre_curso)->get();
            //var_dump($cur[0]->id);
            if(count($cur)==0){
                $cur=Curso::firstOrCreate([
                                            "nombre_curso"=>$datos["datos"]->nombre_curso,
                                            "descripcion_curso"=>$datos["datos"]->descripcion_curso,
                                            "valor_curso"=>$datos["datos"]->valor_curso,
                                            "fecha_inicio_curso"=>$datos["datos"]->fecha_inicio_curso,
                                            "fecha_fin_curso"=>$datos["datos"]->fecha_fin_curso,
                                            "fk_id_categoria_curso"=>$datos["datos"]->id_categoria,
                                            "tipo_curso"=>$datos["datos"]->tipo_curso

                                        ]);
                //CREAR CARPETA PARA LOS CURSOS
                //var_dump($cur);
                /*$nom__alt=explode(" ",$datos["datos"]->nombre_curso);
                $nom_carpeta="";
                foreach ($nom__alt as $key => $value) {
                     $nom_carpeta.=$value; 
                }*/
                if(!is_dir("recursos/cursos/".$cur->id)){
                  
                  

                    if(mkdir("recursos/cursos/".$cur->id, 0777)){
                        $i=1;
                        $j=1;
                        foreach ($datos["datos"]->modulos as $key => $value) {
                            //AQUI REGISTRAR MODULOS
                            //AQUI REGISTRAR RECURSOS DEL MODULO
                            //var_dump($value->nombre_modulo);
                            $mod=Modulo::create(["nombre_modulo"=>$value->nombre_modulo,
                                                            "descripcion_modulo"=>"",
                                                            "fk_id_curso"=>$cur->id,
                                                            "fecha_inicio_modulo"=>$value->fecha_inicio_modulo,
                                                            "fecha_fin_modulo"=>$value->fecha_fin_modulo,
                                                            "numero_de_modulo"=>$i++]);

                                foreach ($value->contenidos as $k => $v) {
                                    if($v->tipo_recurso!="evaluacion"){

                                        if($v->tipo_recurso=="documento"){
                                             copy("recursos/documento/".$v->recurso,"recursos/cursos/".$cur->id."/".$v->recurso);                            
                                        }

                                        Actividades::create(["nombre_actividad"=>$v->contenido,
                                                    "tipo_actividad"=>$v->tipo_recurso,
                                                    "activo_desde"=>$v->activo_desde,
                                                    "activo_hasta"=>$v->activo_hasta,
                                                    "actividad_recurso"=>$v->recurso,
                                                    "fk_id_modulo_curso"=>$mod->id,
                                                    "numero_actividad"=> $j++]);    
                                    }else{
                                      Actividades::create(["nombre_actividad"=>$v->contenido,
                                                    "tipo_actividad"=>$v->tipo_recurso,
                                                    "activo_desde"=>$v->activo_desde,
                                                    "activo_hasta"=>$v->activo_hasta,
                                                    "actividad_recurso"=>$v->recurso,
                                                    "fk_id_modulo_curso"=>$mod->id,
                                                    "numero_actividad"=> $j++]);  

                                        
                                    }
                                    
                                }
                        }
                        
                       

                        return response()->json(["mensaje"=>"Curso creado","id"=>$cur->id,"respuesta"=>TRUE]);    
                    }else{
                        return response()->json(["mensaje"=>"fallo al crear curso en carpetas","id"=>$cur->id,"respuesta"=>TRUE]);
                    }    
                }else{

                     $i=1;
                      $j=1;
                        foreach ($datos["datos"]->modulos as $key => $value) {
                            //AQUI REGISTRAR MODULOS
                            //AQUI REGISTRAR RECURSOS DEL MODULO
                            //var_dump($value->nombre_modulo);
                            $mod=Modulo::create(["nombre_modulo"=>$value->nombre_modulo,
                                                            "descripcion_modulo"=>"",
                                                            "fk_id_curso"=>$cur->id,
                                                            "fecha_inicio_modulo"=>$value->fecha_inicio_modulo,
                                                            "fecha_fin_modulo"=>$value->fecha_fin_modulo,
                                                            "numero_de_modulo"=>$i++]);

                                foreach ($value->contenidos as $k => $v) {
                                    if($v->tipo_recurso!="evaluacion"){

                                        if($v->tipo_recurso=="documento"){
                                             copy("recursos/documento/".$v->recurso,"recursos/cursos/".$cur->id."/".$v->recurso);                            
                                        }

                                        Actividades::create(["nombre_actividad"=>$v->contenido,
                                                    "tipo_actividad"=>$v->tipo_recurso,
                                                    "activo_desde"=>$v->activo_desde,
                                                    "activo_hasta"=>$v->activo_hasta,
                                                    "actividad_recurso"=>$v->recurso,
                                                    "fk_id_modulo_curso"=>$mod->id,
                                                    "numero_actividad"=> $j++]);    
                                    }else{

                                        Actividades::create(["nombre_actividad"=>$v->contenido,
                                                    "tipo_actividad"=>$v->tipo_recurso,
                                                    "activo_desde"=>$v->activo_desde,
                                                    "activo_hasta"=>$v->activo_hasta,
                                                    "actividad_recurso"=>$v->recurso,
                                                    "fk_id_modulo_curso"=>$mod->id,
                                                    "numero_actividad"=> $j++]);    

                                        
                                    }
                                    
                                }
                        }
                        
                    return response()->json(["mensaje"=>"Curso creado exitosamente","id"=>$cur->id,"respuesta"=>TRUE]);    
                }
            }else{
                return response()->json(["mensaje"=>"Curso ya existe","id"=>$cur[0]->id,"respuesta"=>TRUE]);
            }
            
            
            

        
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
        //var_dump(json_decode($_GET["datos"]));

        
     
        if(Util::validar_token()){
          return response()->json(["mensaje"=>"Ya haz iniciado sesión en otro dispositivo o navegador, en ese caso tu otra sesión ha caducado","expulsar"=>TRUE]);  
        }

        //$cur=Curso::where("id","=",$id)->get();
        $val=explode("&",$id);
        $arr=[];
        $arr_final=[];
        $i=0;
        $e=0;

        foreach ($val as $key => $value) {
            //var_dump($value);

            $arr[$i]=$value;
           // var_dump($arr);
            if($i==2){
             
                $arr[2].="%";
              //var_dump($arr[$i]);
                 
              $arr_final[$e]=$arr;
                 $e++;
                 $arr=[];    
                 $i=0;
            }else{
                 $i++;
            }
           
        }
       // var_dump($arr_final);
        $cur=DB::table("cursos")
                //->join("modulos","modulos.fk_id_curso","=","cursos.id")
                //->join("","","=","") 
                ->where($arr_final)
               
                ->get();
            $arr_cur=array();    
            $array_cursos=array();
            $i=0;
            foreach ($cur as $key => $value) {
                $arr_cur[$i]=(array)$value;
                $arr_cur[$i]["modulos"]=(array)DB::table("modulos")
                //->join("modulos","modulos.fk_id_curso","=","cursos.id")
                //->join("","","=","") 
                ->where("modulos.fk_id_curso","=",$value->id)
                ->get();   
                 

                //var_dump($arr_cur[$i]["modulos"]);
                $i++;

            }

            foreach ($arr_cur as $key => $value) {
              $arr=array();
              $l=0;
              foreach ($value["modulos"] as $k => $v) {
                
                //var_dump($v);
                $arr_cur[$key]["modulos"][$l]=(array)$v;
                //var_dump($arr_cur[$key]["modulos"]);
                //var_dump($arr_cur[$key]["modulos"]);
                //echo "<br>";
                $l++;
              }
            }
            //var_dump($arr_cur);

            foreach ($arr_cur as $key => $value) {
              $j=0;
              //var_dump($value);
              foreach ($value["modulos"] as $k => $va) {
                  //var_dump($k);
                  //var_dump($va["id"]);

                 
                    $arr_cur[$key]["modulos"][$j]["actividades"]=(array)DB::table('actividades')
                            ->where("fk_id_modulo_curso","=",$va["id"])
                            ->orderBy('numero_actividad')  
                            ->get();
                        $j++;
                  
                      

              }

            }


            //var_dump($arr_cur);
            //echo "--";
            $array_cursos=$arr_cur;
            //var_dump($array_cursos);
        if(count($array_cursos)>0){
          return response()->json(["datos"=>$array_cursos,"mensaje"=>"Curso encontradas","respuesta"=>TRUE]);  
        }else{
          return response()->json(["mensaje"=>"Curso no encontradas","respuesta"=>FALSE]);  
        }    
        
    }
    public function cursos_redimir_pin($id)
    {
        //
        //var_dump(json_decode($_GET["datos"]));

        
     
        

        //$cur=Curso::where("id","=",$id)->get();
        $val=explode("&",$id);
        $arr=[];
        $arr_final=[];
        $i=0;
        $e=0;

        foreach ($val as $key => $value) {
            //var_dump($value);

            $arr[$i]=$value;
           // var_dump($arr);
            if($i==2){
             
                $arr[2].="%";
              //var_dump($arr[$i]);
                 
              $arr_final[$e]=$arr;
                 $e++;
                 $arr=[];    
                 $i=0;
            }else{
                 $i++;
            }
           
        }
       // var_dump($arr_final);
        $cur=DB::table("cursos")
                //->join("modulos","modulos.fk_id_curso","=","cursos.id")
                //->join("","","=","") 
                ->where($arr_final)
               
                ->get();
            $arr_cur=array();    
            $array_cursos=array();
            $i=0;
            foreach ($cur as $key => $value) {
                $arr_cur[$i]=(array)$value;
                $arr_cur[$i]["modulos"]=(array)DB::table("modulos")
                //->join("modulos","modulos.fk_id_curso","=","cursos.id")
                //->join("","","=","") 
                ->where("modulos.fk_id_curso","=",$value->id)
                ->get();   
                 

                //var_dump($arr_cur[$i]["modulos"]);
                $i++;

            }

            foreach ($arr_cur as $key => $value) {
              $arr=array();
              $l=0;
              foreach ($value["modulos"] as $k => $v) {
                
                //var_dump($v);
                $arr_cur[$key]["modulos"][$l]=(array)$v;
                //var_dump($arr_cur[$key]["modulos"]);
                //var_dump($arr_cur[$key]["modulos"]);
                //echo "<br>";
                $l++;
              }
            }
            //var_dump($arr_cur);

            foreach ($arr_cur as $key => $value) {
              $j=0;
              //var_dump($value);
              foreach ($value["modulos"] as $k => $va) {
                  //var_dump($k);
                  //var_dump($va["id"]);

                 
                    $arr_cur[$key]["modulos"][$j]["actividades"]=(array)DB::table('actividades')
                            ->where("fk_id_modulo_curso","=",$va["id"])
                            ->get();
                        $j++;
                  
                      

              }

            }


            //var_dump($arr_cur);
            //echo "--";
            $array_cursos=$arr_cur;
            //var_dump($array_cursos);
        if(count($array_cursos)>0){
          return response()->json(["datos"=>$array_cursos,"mensaje"=>"Curso encontradas","respuesta"=>TRUE]);  
        }else{
          return response()->json(["mensaje"=>"Curso no encontradas","respuesta"=>FALSE]);  
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
        $n_c=Curso::where("id",$id)->get();
        
        Curso::where("id",$id)
                            ->update([
                                            "nombre_curso"=>$datos["datos"]->nombre_curso,
                                            "descripcion_curso"=>$datos["datos"]->descripcion_curso,
                                            "valor_curso"=>$datos["datos"]->valor_curso,
                                            "fecha_inicio_curso"=>$datos["datos"]->fecha_inicio_curso,
                                            "fecha_fin_curso"=>$datos["datos"]->fecha_fin_curso,
                                            "fk_id_categoria_curso"=>$datos["datos"]->fk_id_categoria_curso,
                                            "tipo_curso"=>$datos["datos"]->tipo_curso

                                        ]);
        foreach ($datos["datos"]->modulos as $key => $value) {
          if(property_exists ( $value, "id" )){
            //var_dump($value->id);                    
          
          }else{
            //var_dump($value);                    
          }
        }

        return response()->json(["mensaje"=>"Recurso actualizado","respuesta"=>TRUE]);                            
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
        $cat=Curso::where("id",$id);
        if($cat->estado_curso==1){
            Curso::where("id",$id)
                            ->where("estado_curso","=",1)
                            ->update(["estado_curso"=>0]);       
                return response()->json(["mensaje"=>"Recurso eliminado","respuesta"=>TRUE]);                                        
        }else{
            Curso::where("id",$id)
                            ->where("estado_curso","=",0)
                            ->update(["estado_curso"=>1]);  
                return response()->json(["mensaje"=>"Recurso habilitado","respuesta"=>TRUE]);                                             

        }
        
    }

    public function mostrar_arbol_modulos($id_curso){

          //var_dump(explode("=", $id_curso)[1]);
          $id_curso=explode("=", $id_curso)[1];
          $cur=DB::table("cursos")->where("id","=",$id_curso)->get();
          //var_dump($cur);
          $arr_arbol=[
                    ["title"=>strtoupper($cur[0]->nombre_curso),"key"=>1],

          ];

          $mod=Modulo::where("fk_id_curso","=",$id_curso)->get();
          //var_dump($mod);
          $act=array();
          $a=1;
          foreach ($mod as $key => $value) {

              $act=Actividades::where("fk_id_modulo_curso","=",$value->id)->get();
              $child=array();
              $i=0;
              foreach ($act as $key => $v) {
                  //var_dump($v->nombre_actividad);
                  if($v->tipo_actividad == "evento"){
                   $v->nombre_actividad.=" (EVENTO) ";
  
                  }

                  if($v->tipo_actividad == "evaluacion"){
                   $v->nombre_actividad.=" (EVALUACION) ";
  
                  }
                  
                   $child[$i]=["title"=>$v->nombre_actividad,"key"=>$a,"valor"=>$v->id,"tipo"=>$v->tipo_actividad,"recurso"=>$v->actividad_recurso,"nombre_curso"=>$cur[0]->nombre_curso,"id_curso"=>$cur[0]->id  ];

                  //array_push($child,["title"=>"nombre_actividad","key"=>"a","valor"=>"","tipo"=>"tipo_actividad","recurso"=>"actividad_recurso"]);
                  $i++;
                  $a++;
              }
              
              array_push($arr_arbol, ["title"=>$value->nombre_modulo,
                                      "key"=>$a,
                                      "folder"=>true,
                                      "children"=>$child

                                    ]);

              $a++;
          } 

          //var_dump($cur[0]->nombre_curso);
          
          //var_dump($arr_arbol);


       
           


           return response()->json($arr_arbol);


                                      /*[
                                        ["title"=>"CURSO 1","key"=>"1"],
                                        ["title"=>"Modulo 1","key"=>"2","folder"=>true,
                                            "children"=>[
                                                ["title"=>"Contenido 1","key"=>"3","valor"=>"","tipo"=>"documento","recurso"=>"prueba1.docx"],
                                                ["title"=>"Contenido 2","key"=>"4","valor"=>"","tipo"=>"video","recurso"=>"YgQRRI9goFg"],

                                            ]
                                        ],
                                        ["title"=>"Modulo 2","key"=>"2","folder"=>true,
                                            "children"=>[
                                                    ["title"=>"Contenido 1","key"=>"5","valor"=>"","tipo"=>"documento","recurso"=>"prueba.pdf"],
                                                    ["title"=>"Contenido 2","key"=>"6","valor"=>"","tipo"=>"video","recurso"=>"YgQRRI9goFg"],
                                        
                                            ]
                                        ]   
                                        
                                    ]*/
 
    }
    public function crear_pines($curso,$numero_pines,$prefijo){
        
        $arr=[];



        for($i=0;$i<=$numero_pines-1;$i++){

              $pin=Random::AlphaNumeric(6);
              $arr[$i]=["fk_id_curso"=>$curso,
                        "pin"=>$prefijo."-".$pin,
                        "estado"=>"activo",
                        "updated_at"=>Carbon::now("America/Bogota"),
                        "created_at"=>Carbon::now("America/Bogota")];
        }
        $C=DB::table("cursos")->where("id",$curso)->get();
        DB::table("pines")
            ->insert(
              $arr
            );
        $arr_2=array();
        $i=0;    
        foreach ($arr as $key => $value) {
              $arr_2[$i]=$value;
              $arr_2[$i]["nombre_curso"]=$C[0]->nombre_curso;
              $i++;
        }    
        return response()->json(["mensaje"=>"Pines generados","respuesta"=>true,"datos"=>$arr_2]);    
    }

    public function consultar_pin($pin){
      $dd=DB::table("pines")
        ->where([["pin","=",$pin],["estado","=","activo"]])
        ->get();
       if(count($dd)>0){
          return response()->json(["mensaje"=>"Pin aprovado","respuesta"=>true,"curso"=>$dd[0]->fk_id_curso,"datos"=>$dd[0]]);   
       }else{
        return response()->json(["mensaje"=>"Pin NO  es valido","respuesta"=>false]);
       } 
      
    }
    public function consultar_pin_admin($curso,$pin){

      if($pin=="*"){
              if($curso==0){
                $dd=DB::table("pines")
                  ->join("cursos","cursos.id","=","pines.fk_id_curso")
                  ->select("cursos.nombre_curso",
                            "pines.fk_id_curso",
                            "pines.id",
                            "pines.pin",
                            "pines.estado")
                  ->get();
                
              }else{
                $dd=DB::table("pines")
                 ->join("cursos","cursos.id","=","pines.fk_id_curso")
                  ->where("fk_id_curso","=",$curso)
                  ->select("cursos.nombre_curso",
                            "pines.fk_id_curso",
                            "pines.id",
                            "pines.pin",
                            "pines.estado")
                  ->get();
               
              }


               if(count($dd)>0){
                  return response()->json(["mensaje"=>"Pin encontrado","respuesta"=>true,"datos"=>$dd]);   
               }else{
                  return response()->json(["mensaje"=>"Pines NO encontrados","respuesta"=>false]);
               } 
              
            
      }else{
             
              if($curso==0){
                $dd=DB::table("pines")
               ->join("cursos","cursos.id","=","pines.fk_id_curso")
                ->where([["pin","=",$pin]])
                ->get();
 
              }else{
                $dd=DB::table("pines")
                ->join("cursos","cursos.id","=","pines.fk_id_curso")
                ->where([["pin","=",$pin],["fk_id_curso","=",$curso]])
                ->get();

              }
               

               if(count($dd)>0){
                  return response()->json(["mensaje"=>"Pin encontrado","respuesta"=>true,"curso"=>$dd[0]->fk_id_curso,"datos"=>$dd]);   
               }else{
                  return response()->json(["mensaje"=>"Pin NO  es valido","respuesta"=>false]);
               } 
              
            
      }
    }  
      
    public function eliminar_pin($id){
       $dd=DB::table("pines")
                  ->where("id","=",$id)
                  ->delete();
      return response()->json(["mensaje"=>"Pin elimiando","respuesta"=>true]);   
    }  

   public function exportar_pines($curso,$pin){

    if($pin=="*"){
              if($curso==0){
                $dd=DB::table("pines")
                  ->join("cursos","cursos.id","=","pines.fk_id_curso")
                  ->select("cursos.nombre_curso as NOMBRE CURSO",
                            "pines.pin as PIN",
                            "pines.estado as ESTADO PIN")
                  ->get();
                
              }else{
                $dd=DB::table("pines")
                 ->join("cursos","cursos.id","=","pines.fk_id_curso")
                  ->where("fk_id_curso","=",$curso)
                  ->select("cursos.nombre_curso as NOMBRE CURSO",
                            "pines.pin as PIN",
                            "pines.estado as ESTADO PIN")
                  ->get();
               
              }


              
            
      }else{
             
              if($curso==0){
                $dd=DB::table("pines")
               ->join("cursos","cursos.id","=","pines.fk_id_curso")
                ->where([["pin","=",$pin]])
                ->select("cursos.nombre_curso as NOMBRE CURSO",
                            "pines.pin as PIN",
                            "pines.estado as ESTADO PIN")
                ->get();
 
              }else{
                $dd=DB::table("pines")
                ->join("cursos","cursos.id","=","pines.fk_id_curso")
                ->where([["pin","=",$pin],["fk_id_curso","=",$curso]])
                ->select("cursos.nombre_curso as NOMBRE CURSO",
                            "pines.pin as PIN",
                            "pines.estado as ESTADO PIN")
                ->get();

              }
               

               
            
      }
 
        $arr=[];
      
        foreach ($dd as $key => $value) {
          $arr[$key]=(array)$value;
          

        }
      
    if(count($dd)>0){
                Excel::create("pines_".$curso, function($excel) use($arr){
                         // use($datos->datos->nombre_reporte)   
                        $excel->sheet('pines',function($sheet) use($arr){
                                //var_dump($arr);
                           
                                $sheet->fromArray($arr);
                        });
                    })->store('xls', trim(substr(base_path(),0,-4)."recursos_para_exportar"));

         return response()->json(["archivo"=>"pines_".$curso.".xls","mensaje"=>"Pin encontrado ","respuesta"=>true,"curso"=>$curso,"datos"=>$dd]);   
    }else{
         return response()->json(["mensaje"=>"Pin NO  es valido","respuesta"=>false]);
    } 
              
   }


   public function activar_curso_pin($id_usuario,$id_curso){  

          //
            $uu=DB::table("usuarios")
                ->where("id",$id_usuario)
                ->get();  
            $cc=DB::table("cursos")
                ->join("modulos","modulos.fk_id_curso","=","cursos.id")
                ->join("actividades","actividades.fk_id_modulo_curso","=","modulos.id")
                ->where("cursos.id",$id_curso)
                ->select("actividades.id","cursos.nombre_curso")
                ->get();
            
            //var_dump($id_usuario);
                
            foreach ($cc as $key => $value) {

              //var_dump($value->id);
                $d=DB::table("detalle_evaluacion_usuario")
                    ->where(["fk_id_usuario"=>$id_usuario,"fk_id_evaluacion"=>$value->id])
                    ->get();
                if(count($d)==0){
                    DB::table("detalle_evaluacion_usuario")
                      ->insert(["fk_id_usuario"=>$id_usuario,"fk_id_evaluacion"=>$value->id]);    
                }
                
            }
            


            return \View::make('vistas.agradecimiento_activa_pin', array('nombre_usuario' => $uu[0]->nombre_usuario." ".$uu[0]->apellido_usuario,"nombre_curso"=>$cc[0]->nombre_curso));

   }

   

}

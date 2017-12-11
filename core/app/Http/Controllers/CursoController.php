<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use App\Curso;

use App\Actividades;

use App\Modulo;

use App\Evaluacion;

use App\Util;




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
                if(!is_dir("recursos/cursos/".$datos["datos"]->nombre_curso)){
                  
                  

                    if(mkdir("recursos/cursos/".$datos["datos"]->nombre_curso, 0777)){
                        $i=1;
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
                                             copy("recursos/documento/".$v->recurso,"recursos/cursos/".$datos["datos"]->nombre_curso."/".$v->recurso);                            
                                        }

                                        Actividades::create(["nombre_actividad"=>$v->contenido,
                                                    "tipo_actividad"=>$v->tipo_recurso,
                                                    "activo_desde"=>$v->activo_desde,
                                                    "activo_hasta"=>$v->activo_hasta,
                                                    "actividad_recurso"=>$v->recurso,
                                                    "fk_id_modulo_curso"=>$mod->id]);    
                                    }else{
                                        Evaluaciones::create(["tipo_evaluacion"=>"examen",
                                                              "fk_id_actividad"=>$cur->id,
                                                              "fecha_evaluacion_inicio"=>$v->activo_desde,
                                                              "fecha_evaluacion_fin"=>$v->activo_hasta]);
                                    }
                                    
                                }
                        }
                        
                       

                        return response()->json(["mensaje"=>"Curso creado","id"=>$cur->id,"respuesta"=>TRUE]);    
                    }else{
                        return response()->json(["mensaje"=>"fallo al crear curso en carpetas","id"=>$cur->id,"respuesta"=>TRUE]);
                    }    
                }else{
                    return response()->json(["mensaje"=>"OK, ya existe carpeta","id"=>$cur->id,"respuesta"=>TRUE]);    
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
        //$cur=Curso::where("id","=",$id)->get();
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

        return response()->json(["datos"=>$array_cursos,"mensaje"=>"Curso encontradas","respuesta"=>TRUE]);
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


          $cur=Curso::where("id","=",$id_curso)->get();
          $arr_arbol=[
                    ["title"=>strtoupper($cur[0]->nombre_curso),"key"=>1],

          ];

          $mod=Modulo::where("fk_id_curso","=","$id_curso")->get();

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
                  
                   $child[$i]=["title"=>$v->nombre_actividad,"key"=>$a,"valor"=>$v->id,"tipo"=>$v->tipo_actividad,"recurso"=>$v->actividad_recurso];

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

}

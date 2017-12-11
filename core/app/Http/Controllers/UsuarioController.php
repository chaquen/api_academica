<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use App\Usuario;

use App\Detalle_Usuario_Curso;

use App\Util;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $al=Usuario::all();

        return response()->json(["datos"=>$al,"mensaje"=>"Usuario encontrados","respuesta"=>TRUE]);
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
        
        $al=Usuario::firstOrCreate(["nombre_usuario"=>$datos["datos"]->nombre_usuario,
                                    "apellido_usuario"=>$datos["datos"]->apellido_usuario,
                                    "fecha_nacimiento"=>$datos["datos"]->fecha_nacimiento,
                                    "correo_usuario"=>$datos["datos"]->correo_usuario[0],
                                    "documento_usuario"=>$datos["datos"]->documento_usuario,
                                    "telefono_usuario"=>$datos["datos"]->telefono_usuario,
                                    "direccion_usuario"=>$datos["datos"]->direccion_usuario,
                                    "fk_id_rol"=>$datos["datos"]->rol,
                                    "red"=>"",
                                    "password"=>$datos["datos"]->clave[0],
                                    
                                    "id_red"=>""]);

        if($datos["datos"]->curso!="0"){
           Detalle_Usuario_Curso::create(["fk_id_curso"=>$datos["datos"]->curso,"fk_id_usuario"=>$al->id,"nota_esperada"=>"100","nota_final"=>"0"]);
        }

         


        return response()->json(["mensaje"=>"OK","id"=>$al->id,"respuesta"=>TRUE]);
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
         $al=DB::table("usuarios")
                        ->where("id","=",$id)
                        ->orwhere("usuarios.nombre_usuario","LIKE",$id."%")
                        ->get();

        //consultar cursos
        
          $arr=array();
          $i=0;
          foreach ($al as $key => $value) {
                    //var_dump($value);
                    $arr[$i]=(array)$value;
                    $arr[$i]["cursos"]=(array)DB::table("cursos")
                                                ->join("detalle__usuario__cursos","detalle__usuario__cursos.fk_id_curso","=","cursos.id")
                                                ->where('detalle__usuario__cursos.fk_id_usuario',"=",$id)
                                                ->get();
                }      
        
        return response()->json(["datos"=>$arr,"mensaje"=>"Usuario encontrado","respuesta"=>TRUE]);
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
        Usuario::where("id",$id)
                            ->update(["nombre_usuario"=>$datos["datos"]->nombre_usuario,
                                      "apellido_usuario"=>$datos["datos"]->apellido_usuario,
                                      "correo_usuario"=>$datos["datos"]->correo_usuario,
                                      "telefono_usuario"=>$datos["datos"]->telefono_usuario,
                                      "direccion_usuario"=>$datos["datos"]->direccion_usuario,
                                      "documento_usuario"=>$datos["datos"]->documento_usuario,
                                      ]);

                            if(property_exists($datos["datos"], "password")){

                                Usuario::where("id",$id)
                                    ->update([
                                                "password"=>$datos["datos"]->password                                             
                                              ]);
                            }


        return response()->json(["mensaje"=>"Recurso actualizado","respuesta"=>TRUE,"datos"=>Usuario::where("id",$id)->get()]);  
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
        $us=Usuario::find($id);
        $us->delete();
        return response()->json(["mensaje"=>"Recurso eliminado","respuesta"=>TRUE]);
    }

    public function loginFacebook(Request $request){
        
            $datos=Util::decodificar_json($request->get("datos"));
        

            $al=Usuario::where("correo_usuario","=",$datos["datos"]->email)->get();

             
            
            if(count($al)==0){
                $al=Usuario::create(["nombre_usuario"=>$datos["datos"]->first_name,"apellido_usuario"=>$datos["datos"]->last_name,"correo_usuario"=>$datos["datos"]->email,"fecha_nacimiento"=>$datos["datos"]->birthday,'id_red'=>$datos["datos"]->id,'fk_id_rol'=>$rol[0]->id,
                                      "password"=>"12345"]);

                
                
                
                Util::enviar_email("email.bienvenido",["nombre"=>$datos["datos"]->first_name],"academia@oelsas.com","Essau Valentino","Bienvenido",$datos["datos"]->email,$datos["datos"]->first_name);
                
                return response()->json(["mensaje"=>$datos["datos"]->first_name.", gracias por registrarte con nosotros","datos"=>$al[0],"respuesta"=>TRUE]);

            }else{
                Alumnos::where("id","=",$al[0]->id)->update(["updated_at"=>$datos["hora_cliente"]]);
                
                return response()->json(["mensaje"=>"Bienvenido,".$datos["datos"]->first_name.", ya te habias registrado con anterioridad","respuesta"=>TRUE,"datos"=>$al[0]]);    
            }            
    }
    public function loginGoogle(Request $request){
            //var_dump($request->get("datos"));
            $datos=Util::decodificar_json($request->get("datos"));
            $al=Usuario::join("roles","usuarios.fk_id_rol","=","roles.id")
                              ->where("correo_usuario","LIKE",$datos["datos"]->email)                              
                              ->get();
            
           

            if(count($al)==0){
                $rol=$rol=DB::table('roles')->where("nombre_rol","LIKE","usuario")->select('id')->get();

                Usuario::create(["nombre_usuario"=>$datos["datos"]->nombre,
                                      "apellido_usuario"=>$datos["datos"]->apellido,
                                      "correo_usuario"=>$datos["datos"]->email ,
                                      
                                      "fecha_nacimiento"=>$datos["datos"]->birthday,
                                      'id_red'=>$datos["datos"]->id,
                                      'fk_id_rol'=>$rol[0]->id,
                                      "password"=>"12345"]);
                 $al=Usuario::join("roles","usuarios.fk_id_rol","=","roles.id")
                              ->where("correo_usuario","LIKE",$al[0]->correo_usuario)                              
                              ->get();
                Util::enviar_email("email.bienvenido",["nombre"=>$datos["datos"]->nombre],"academia@oelsas.com","Essau Valentino","Bienvenido",$datos["datos"]->email,$datos["datos"]->nombre);
                

                return response()->json(["mensaje"=>$datos["datos"]->nombre.", gracias por registrarte con nosotros","datos"=>$al,"respuesta"=>TRUE]);    
            }else{
                
               
                return response()->json(["mensaje"=>"Bienvenido,".$datos["datos"]->nombre.", ya te habias registrado con anterioridad","respuesta"=>TRUE,"datos"=>$al[0]]);    
            }
    }

    public function login(Request $request){
            $datos=Util::decodificar_json($request->get("datos"));
            //var_dump($datos["datos"]);
            $al=DB::table('usuarios')
                                ->join("roles","roles.id","=","usuarios.fk_id_rol")
                                ->where([
                                    ["correo_usuario","=",$datos["datos"]->usuario],
                                    ["password","=",$datos["datos"]->clave]
                                ])
                                ->select("usuarios.nombre_usuario",
                                    "usuarios.apellido_usuario",
                                    "usuarios.correo_usuario",
                                    "usuarios.direccion_usuario",
                                    "usuarios.documento_usuario",
                                    "usuarios.telefono_usuario",
                                    "usuarios.fecha_nacimiento",
                                    "usuarios.fk_id_rol",
                                    "roles.nombre_rol",
                                    "usuarios.id")
                                ->get();
            
            if(count($al)==0){ 
                return response()->json(["mensaje"=>"No estas registrado","respuesta"=>FALSE]);    
            }else{
                
                Usuario::where("id","=",$al[0]->id)->update(["updated_at"=>$datos["hora_cliente"]]);

                return response()->json(["mensaje"=>"Bienvenido,".$al[0]->nombre_usuario.", ","respuesta"=>TRUE,"datos"=>$al[0]]);    
            }   
    }


    public function alumnos_del_curso($id_curso){
        $us=Usuario::join("detalle__usuario__cursos","detalle__usuario__cursos.fk_id_usuario","=","usuarios.id")
                ->where("detalle__usuario__cursos.fk_id_curso","=",$id_curso)
                ->get();
                
        return response()->json(["mensaje"=>"Alumnos encontrados","respuesta"=>TRUE,"datos"=>$us]);    
    } 

}
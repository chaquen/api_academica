<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use App\Models\Usuario;

use App\Models\Detalle_Usuario_Curso;

use App\Functions\Util;

use App\Functions\Random;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_alumno()
    {
        //
        $al=DB::table("usuarios")
                        ->where("fk_id_rol","=","1")
                        
                        ->get();

        //consultar cursos
        
          $arr=array();
          $i=0;
          foreach ($al as $key => $value) {
                    //var_dump($value);
                    $arr[$i]=(array)$value;
                    $arr[$i]["cursos"]=(array)DB::table("cursos")
                                                ->join("detalle__usuario__cursos","detalle__usuario__cursos.fk_id_curso","=","cursos.id")
                                                ->where('detalle__usuario__cursos.fk_id_usuario',"=",$value->id)
                                                ->get();
                    $i++;
                }      
        
        return response()->json(["datos"=>$arr,"mensaje"=>"Usuario encontrado","respuesta"=>TRUE]);
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
        $uss=Usuario::where("correo_usuario","=",$datos["datos"]->correo_usuario)->orwhere("documento_usuario","=",$datos["datos"]->documento_usuario)->get();
        if(count($uss)==0){
            $al=Usuario::firstOrCreate(["nombre_usuario"=>$datos["datos"]->nombre_usuario,
                                    "apellido_usuario"=>$datos["datos"]->apellido_usuario,
                                    "fecha_nacimiento"=>$datos["datos"]->fecha_nacimiento,
                                    "correo_usuario"=>$datos["datos"]->correo_usuario,
                                    "documento_usuario"=>$datos["datos"]->documento_usuario,
                                    "telefono_usuario"=>$datos["datos"]->telefono_usuario,
                                    "direccion_usuario"=>$datos["datos"]->direccion_usuario,
                                    "fk_id_rol"=>$datos["datos"]->rol,
                                    
                                    "password"=>$datos["datos"]->clave,
                                    
                                    ]);

          if($datos["datos"]->curso!="0"){
            //Aqui inscribo al estudiante al curso
             Detalle_Usuario_Curso::create(["fk_id_curso"=>$datos["datos"]->curso,"fk_id_usuario"=>$al->id,"nota_esperada"=>"100","nota_final"=>"0"]);

             //aqui redimo el pin
             DB::table("pines")
              ->where([["fk_id_curso","=",$datos["datos"]->curso],["pin","=",$datos["datos"]->pin]])
              ->update(["estado"=>"redimido"]);
              //Aquí envo email de bienvenida
              Util::enviar_email("email.bienvenido_pin",["nombre"=>$datos["datos"]->nombre_usuario." ".$datos["datos"]->apellido_usuario,"pin"=>$datos["datos"]->pin],"academia@oelsas.com","Academia OEL","Gracias por redimir tu pin",$datos["datos"]->correo_usuario,$datos["datos"]->nombre_usuario);
             
          }else{
            //Aquí envio email d bienvenida
              Util::enviar_email("email.bienvenido",["nombre"=>$datos["datos"]->nombre_usuario." ".$datos["datos"]->apellido_usuario],"academia@oelsas.com","Academia OEL","Bienvenido a esta gran familia",$datos["datos"]->correo_usuario,$datos["datos"]->nombre_usuario);

          }

          $u=DB::table("usuarios")
                  ->where("usuarios.id","=",$al->id)
                  ->join("roles","roles.id","=","usuarios.fk_id_rol")
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
                  
           


          return response()->json(["mensaje"=>"Bienvenido ".$datos["datos"]->nombre_usuario,"id"=>$al->id,"respuesta"=>TRUE,"datos"=>$u[0]]);  
        }else{
          return response()->json(["mensaje"=>"Por favor verifique su correo electronico y documento parece que los datos que esta suministrando ya se encuentran registrados ","respuesta"=>FALSE]);  
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
                                                $i++;
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
        //var_dump($datos);
        Usuario::where("id",$id)
                            ->update(["nombre_usuario"=>$datos["datos"]->nombre_usuario,
                                      "apellido_usuario"=>$datos["datos"]->apellido_usuario,
                                       "fecha_nacimiento"=>$datos["datos"]->fecha_cumple,
                                      "correo_usuario"=>$datos["datos"]->correo_usuario,
                                      "telefono_usuario"=>$datos["datos"]->telefono_usuario,
                                      "direccion_usuario"=>$datos["datos"]->direccion_usuario,
                                      "documento_usuario"=>$datos["datos"]->documento_usuario
                                      ]);
         //var_dump(property_exists($datos["datos"], "password"));                   
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
            //echo "ip del cliente ";
            //var_dump($request->ip());

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
                                    "usuarios.id",
                                    "usuarios.password")
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

    public function recuperar_pass(Request $request){

         $datos=Util::decodificar_json($request->get("datos"));

         $al=DB::table('usuarios')
                                ->join("roles","roles.id","=","usuarios.fk_id_rol")
                                ->where(
                                    "correo_usuario","=",$datos["datos"]->email                                    
                                )
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
                return response()->json(["mensaje"=>"Lo sentimos pero el correo <b>".$datos["datos"]->email."</b> NO esta registrado","respuesta"=>FALSE]);    
            }else{
                $pin_clave=Random::AlphaNumeric(6);
                Usuario::where("id","=",$al[0]->id)->update(["updated_at"=>$datos["hora_cliente"],"password"=>$pin_clave,"cambio_pass"=>$pin_clave]);
                Util::enviar_email("email.olvido_clave",["nombre"=>$al[0]->nombre_usuario,"url"=>$datos["datos"]->url."recuperar_clave.html?us=".$al[0]->id."&pc=".$pin_clave],"academia@oelsas.com","Centro de ayuda OEL","Olvidaste tu contraseña",$datos["datos"]->email,$al[0]->nombre_usuario." ".$al[0]->apellido_usuario);

                return response()->json(["mensaje"=>"Hemos enviado un correo electronico a esta cuenta de correo, <b>".$datos["datos"]->email."</b>,".$al[0]->nombre_usuario." por favor sigue las instrucciones para actualizar tu clave ","respuesta"=>TRUE,"datos"=>$al[0]]);    
            }   
    }

    public function validar_cambio_pass($id_usuario,$pin_clave){
        $us=Usuario::where([["id","=",$id_usuario],["cambio_pass","LIKE",$pin_clave]])->get();
        if(count($us)==0){
            return response()->json(["mensaje"=>"Este no es un pin valido para la recuperacion intentalo nuevamnete o escribe al area de soporte para recibir ayuda","respuesta"=>FALSE]);   
        }else{

            return response()->json(["mensaje"=>"PIN VALIDO","respuesta"=>TRUE,"datos"=>$us[0]]);   
        }
    }

    public function cambiar_pass_recuparada(Request $request){
            $datos=Util::decodificar_json($request->get("datos"));
         
            Usuario::where([["id","=",$datos["datos"]->id],["cambio_pass","LIKE",$datos["datos"]->pin_clave]])
                        ->update(["updated_at"=>$datos["hora_cliente"],"password"=>$datos["datos"]->clave,"cambio_pass"=>""]);
            $us=Usuario::join("roles","roles.id","=","usuarios.fk_id_rol")
                             ->where("usuarios.id","=",$datos["datos"]->id)
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
                        
            return response()->json(["mensaje"=>"Bienvenido","respuesta"=>TRUE,"datos"=>$us[0]]);                    

    }

    

}

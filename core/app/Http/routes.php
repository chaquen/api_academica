<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
header( 'Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS' );

Route::get('/', function () {
    return view('welcome');
});

/*AQUI VAN LAS RUTAS DE LA APLICACION*/
Route::get("consulta_inicial/{id}",function($id){

	$datos=[];
	$datos["categorias"]=DB::table("categorias_cursos")->where("estado_categoria","=",1)->get();
	$datos["cursos_alumno"]=DB::table("cursos")
					->join("detalle__usuario__cursos","detalle__usuario__cursos.fk_id_curso","=",'cursos.id')
					->join("usuarios","usuarios.id","=","detalle__usuario__cursos.fk_id_usuario")
					->where([["estado_curso","=",1],["fk_id_usuario","=",$id]])
					->select("cursos.id","cursos.nombre_curso")
					->get();
	$datos["cursos"]=DB::table("cursos")
					->where("estado_curso","=",1)
					->select("cursos.id","cursos.nombre_curso")
					->get();
	
	echo json_encode(["mensaje"=>"","respuesta"=>true,"datos"=>$datos]);
});
Route::get("consulta_inicial_alumno/{usuario}",function($usuario){

				$datos=[];
				$datos["cursos"]=DB::table("cursos")
								->join("detalle__usuario__cursos","detalle__usuario__cursos.fk_id_curso","=",'cursos.id')
								->join("usuarios","usuarios.id","=","detalle__usuario__cursos.fk_id_usuario")
								->where([["estado_curso","=",1],["fk_id_usuario","=",$usuario]])
								->select("cursos.id",
											"cursos.nombre_curso",
											"cursos.descripcion_curso",
											"cursos.valor_curso",
											"cursos.fecha_inicio_curso",
											"cursos.fecha_fin_curso",
											"cursos.fk_id_categoria_curso",
											"cursos.tipo_curso",
											"cursos.estado_curso")
								->get();
				//$datos["eventos"]=array();
				$i=0;
				
				$re=array();

				 foreach ($datos["cursos"] as $key => $value) {
			 	       
				 		$re[$i]=DB::table("actividades")
				 						->join("modulos","modulos.id","=","actividades.fk_id_modulo_curso")
				 						->join("cursos","cursos.id","=","modulos.fk_id_curso")
										->where([
													["modulos.fk_id_curso","=", $value->id],
													["actividades.tipo_actividad","=", "evento"],
													["actividades.estado_actividad","=","1"]
												])
										->orwhere([
													["modulos.fk_id_curso","=", $value->id],
													["actividades.tipo_actividad","=", "evaluacion"],
													["actividades.estado_actividad","=","1"]
												])
										->select("actividades.id","actividades.nombre_actividad","cursos.nombre_curso","actividades.activo_desde","actividades.activo_hasta","actividades.tipo_actividad")
										->get();
					
				 		$i++;
				 }
				 if(count($re)>0){
					$datos["eventos"]=$re; 	
					echo json_encode(["mensaje"=>"Tienes cursos activos o pendientes","respuesta"=>true,"datos"=>$datos]);
				 }else{
				 	echo json_encode(["mensaje"=>"No tienes cursos pendientes o activos","respuesta"=>false]);
				 	
				 }
		 	
			
				//$datos["eventos"];
				/*
				[
				 ["title"=>"Prueba 1","start"=>date("D M j G:i:s T Y"),"end"=>date("D M j G:i:s T Y"),"description"=>"prueba desde el servidor 1","allDay"=>"false"],
												["title"=>"Prueba 1.2","start"=>'2017-09-09 00:00:00',"end"=>"2017-09-09 00:00:00","description"=>"prueba desde el servidor 1","allDay"=>"false"],
			                                    ["title"=>"Prueba 2","start"=>"","end"=>"","description"=>"prueba desde el servidor 1","allDay"=>true]

			                                ];
			                                */
							
			
});
Route::resource("usuarios","UsuarioController");
Route::resource("agenda","ActividadController");
Route::resource("preguntas","PreguntaController");
Route::get("preguntas_tipo/{tipo}","PreguntaController@preguntas_tipo");
Route::resource("respuestas","RespuestaController");
Route::resource("respuestas_de_usuario","RespuestasDelUsuarioController");
Route::resource("evaluacion","EvaluacionController");
Route::resource("modulo_curso","ModuloController@modulos_de_curso");
Route::resource("modulos","ModuloController");
Route::get("usuarios_por_curso/{curso}","UsuarioController@alumnos_del_curso");
Route::get("evaluaciones_por_curso/{id_curso}","EvaluacionController@evaluaciones_por_curso");

Route::get("resultado_evaluacion/{id_evaluacion}/{id_alumno}","EvaluacionController@resultado_evaluacion");

Route::post("usuariosFB","UsuarioController@loginFacebook");
Route::post("usuariosGO","UsuarioController@loginGoogle");
Route::post("login","UsuarioController@login");
Route::post("recuperar_pass","UsuarioController@recuperar_pass");
Route::post("cambiar_pass_recuparada","UsuarioController@cambiar_pass_recuparada");
Route::get("validar_cambio_pass/{id_usuario}/{pin_clave}","UsuarioController@validar_cambio_pass");
Route::resource("categorias","CategoriasCursosController");
Route::resource("cursos","CursoController");
Route::resource("actividades","ActividadController");
Route::get("modulos_del_cursos/{id_curso}","CursoController@mostrar_arbol_modulos");
Route::post("subir_archivos","ActividadController@subir_archivo");
Route::get("eventos/{id_curso}","ActividadController@eventos");
Route::get("evaluacion_de_alumno/{id_evaluacion}/{id_usuario}","EvaluacionController@evaluacion_de_alumno");

Route::get("crear_pines/{curso}/{numero_pines}/","CursoController@crear_pines");
Route::get("consultar_pin/{pin}","CursoController@consultar_pin");
Route::get("consultar_pin_admin/{curso}/{pin}","CursoController@consultar_pin_admin");
Route::get("exportar_pines/{curso}/{pin}","CursoController@exportar_pines");
Route::delete("eliminar_pin/{id}","CursoController@eliminar_pin");
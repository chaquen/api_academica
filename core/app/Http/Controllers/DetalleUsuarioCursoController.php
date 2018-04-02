<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Detalle_Usuario_Curso;

use App\Functions\Util;

use DB;

class DetalleUsuarioCursoController extends Controller
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
        $Dt=Detalle_Usuario_Curso::where(["fk_id_curso"=>$datos["datos"]->curso,"fk_id_usuario"=>$datos["datos"]->id_usuario,"rol"=>$datos["datos"]->rol])->get();

        if(count($Dt)==0){
                Detalle_Usuario_Curso::create(["fk_id_curso"=>$datos["datos"]->curso,"fk_id_usuario"=>$datos["datos"]->id_usuario,"rol"=>$datos["datos"]->rol]);
                $cc=DB::table("cursos")
                    ->join("modulos","modulos.fk_id_curso","=","cursos.id")
                    ->join("actividades","actividades.fk_id_modulo_curso","=","modulos.id")
                    ->where("cursos.id",$datos["datos"]->curso)
                    ->select("actividades.id")
                    ->get();
                

                foreach ($cc as $key => $value) {
                    DB::table("detalle_evaluacion_usuario")
                        ->insert(["fk_id_usuario"=>$datos["datos"]->id_usuario,"fk_id_evaluacion"=>$value->id]);    
                }        



            return response()->json(["mensaje"=>"ALUMNO ASOCIADO SATISFACTORIAMENTE","respuesta"=>TRUE]);    
        }else{
            return response()->json(["mensaje"=>"ALUMNO YA ESTA ASOCIADO ","respuesta"=>FALSE]);    
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
        Detalle_Usuario_Curso::where("id","=",$id)->delete();
        return response()->json(["mensaje"=>"ALUMNO ELIMINADO SATISFACTORIAMENTE","respuesta"=>TRUE]);    
    }
}

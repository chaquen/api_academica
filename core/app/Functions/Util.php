<?php

namespace App\Functions;

use Mail;


class Util 
{
    /*
      funcion para decodificar una peticion HTTP POST,PUT
      {$datos_string = datos de la peticion}
    */
    public static function decodificar_json($datos_string){
    	$datos=json_decode($datos_string);
    	//var_dump(json_decode($datos_string));
        //$form=json_decode($datos->datos);
        //echo "--";
        //var_dump($datos->peticion);
        
        return ["hora_cliente"=>$datos->hora_cliente,"peticion"=>$datos->peticion,"datos"=>$datos->datos];
    }
    
    
    /*
        {ruta}=>tuta de la vista para el email
    	{array_datos}=> array de datos a enviar ['user' => $user]
        {de}=>correo que envia
        {de_nombre}=> nombre de quien envia
        {asunto} => asunto de correo
        {destino} => destino del correo
        {$nombre_destino} => nombre del destinatario
    */
    public static function enviar_email($ruta,$array_datos,$de,$de_nombre,$asunto,$destino,$nombre_destino){

    	  Mail::send($ruta,$array_datos , function ($m) use ($destino,$nombre_destino,$de,$de_nombre,$asunto) {
		            $m->from($de, $de_nombre);

		            $m->to($destino, $nombre_destino)->subject($asunto);
		        });
          
    }
    	
    
     
}

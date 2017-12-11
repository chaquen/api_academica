<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Util;
use Jenssegers\Date\Date;
use App\Uusario;
use DateTimeZone; 
use DB;



class VuelveAClaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vuelve_a_clase:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando se ejecuta para verificar los estudiantes que no han ingresado en un periodo superior a 72 horas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //consultar estudianets activos que no tengan registro de la plataforma durante menos de 72 horas y que tengan un curso pendiente
        //enviar correo recordando que el curso esta pendiente
        $hace_dos_dias=Date::now(new DateTimeZone("America/Bogota"))->sub('2 day');
        //var_dump($hace_dos_dias->day);

        $us=DB::table("users")
            ->where("updated_at","<",$hace_dos_dias)
            ->get();

         //var_dump($us);   
         foreach ($us as $key => $value) {
            $al=Usuario::where("correo_usuario","=",$value->email)->get();
           
            var_dump($value->email);
            Util::enviar_email("email.vuelve_a_clase",["nombre"=>$al[0]->nombre_alumno],"academia@oelsas.com","El equipo OEL","Te estamos esperando, vuelve pronto",$value->email,$al[0]->nombre_alumno);    
         }
         
    }
}

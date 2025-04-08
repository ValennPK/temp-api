<?php

namespace App\Console\Commands;

use App\Models\ThermometerToTestigo;
use App\Services\WhatAppService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AlertasCoammand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'controles:alertas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se realizan diferentes controles sobre la transmición de los termostatos y termómetros testigos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $heladeras = ThermometerToTestigo::all();
        foreach ($heladeras as $key => $heladera) {
            echo $heladera->thermometer;
            echo " ";
            echo $heladera->testigo;
            echo "\n\r";

            $termostato = DB::table($heladera->thermometer)->orderByDesc('created_at')->limit(30)->get()->avg('port1');
            $testigo = DB::table($heladera->testigo)->orderByDesc('created_at')->limit(30)->get()->avg('port1');

            dump($termostato, $testigo);

            $from ="116206874689502";

            if (true)//($termostato === -127) {
                {echo "Tiro alerta termostato";
                $data=[
                    "name" => "lectura_termostato_detenida",
                    "code" => "es",
                    "heladera" => "",
                    "equipo" => "termostato ",
                    "termometro" => $heladera->thermometer,
                    "fechayhora" => Carbon::now()->format("d-m-Y h:i")
                ];

                $resultado = (new WhatAppService($from,"template"))->enviar_plantilla($data);
                dump($resultado->json());

            //dump( $resultado->status(), $resultado->json() );
                if ($testigo === -127) {
                    echo "Tiro alerta testigo";
                }
            }
            # code...
        }
    }
}

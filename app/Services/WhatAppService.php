<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

final class WhatAppService
{

    protected $token, $ws_ver;
    public $from;
    public $type;

    public function __construct( string $ws_from, string $ws_type)
    {
        $this->token = env('WS_TOKEN');
        $this->ws_ver = env('WS_VERSION');
        $this->from = $ws_from;
        $this->type = $ws_type;

    }

    public function enviar_plantilla(string $plantilla, string $recipient_type = 'individual', string $to = '5493364614924')
    {
        $enviado =  Http::withHeaders([
                        'Authorization' => "Bearer " . $this->token,
                        'Content-Type' => 'application/json',
                    ])
                    ->post("https://graph.facebook.com/". $this->ws_ver."/". $this->from."/messages",
                            [
                                "messaging_product"=> "whatsapp",
                                "recipient_type"=> "$recipient_type",
                                "to"=> "$to",
                                "type"=> "template",
                                "template"=> $this->template($plantilla)
                            ]);
        return $enviado;
    }

    public function template(string $plantilla)
    {
        switch ($plantilla) {
            case 'lectura_termostato_detenida':
                return $this->lectura_termostato_detenida($plantilla['heladera'], $plantilla['equipo'], $plantilla['termometro']);
                break;

            default:
                # code...
                break;
        }


    }

    public function lectura_termostato_detenida(string $heladera, string $tipo_equipo, string $nombre_equipo)
    {
        return '{"name": "lectura_termostato_detenida","language": {"code": "es"},"components":[{"type": "body","parameters":'.
        '[{"type": "text","paramter_name": "heladera","text":"'.$heladera.'"},{"type": "text","paramter_name": "equipo",'.
        '"text":"'.$tipo_equipo.'"},{"type": "text","paramter_name": "termometro",'.'"text": "'.$nombre_equipo.'"}]}]}';

    }

}

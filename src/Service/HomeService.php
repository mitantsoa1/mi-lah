<?php

namespace App\Service;

class HomeService
{

    public function setNumeroticket()
    {
        $heure = date("H");
        $minute = date("i");
        $seconde = date("s");

        // $nombre = sprintf("%02d%02d%02d", $heure, $minute, $seconde);
        $nombre = ($heure * 3600 + $minute * 60 + $seconde) % 1000;
        // $nombre = $heure . $minute . $seconde;

        return $nombre;
    }
}

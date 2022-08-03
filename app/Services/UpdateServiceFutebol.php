<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;

class UpdateServiceFutebol {
    public function getDataFutebolBrasileiroMasculino($campeonato)
    {
        if ($campeonato->status == 1) {
            return $this->getDataFutebolBrasileiroAtual($campeonato->url);
        } else {
            return $this->getDataFutebolBrasileiroAnteriores($campeonato->url);
        }
    }

    private function getDataFutebolBrasileiroAtual($url)
    {
        try {
            $site = file_get_contents($url);
            $site = str_replace('"', "'", $site);

            $dt01 = explode("Jogos realizados</b></p>", $site);
            $dt02 = explode("<br><br>", $dt01[1]);

            $dt03 = explode("<tr>", $dt02[0]);

            $x = 0;
            $jogos = [];
            foreach ($dt03 as $linha) {
                if ($x > 1) {
                    $colunas = explode("<td", $linha);

                    $data = Carbon::createFromFormat('d/m/Y', trim(str_replace("</font></td>\n", "", str_replace("align='center' bgcolor='#FFFFFF'><font size='2'>", "", $colunas[1]))))->format('Y-m-d H:i:s');
                    $mandante = utf8_encode(trim(str_replace("</font></td>\n", "", str_replace("bgcolor='#FFFFFF'> <font size='2'>", "", $colunas[2]))));
                    $placar = explode('x', trim(str_replace("</font></td>\n", "", str_replace("bgcolor='#FFFFFF'> <font size='2'>", "", $colunas[3]))));
                    $visitante = utf8_encode(trim(str_replace("</font></td>\n", "", str_replace("bgcolor='#FFFFFF'> <font size='2'>", "", $colunas[4]))));

                    $jogos[] = ['data' => $data, 'mandante' => $mandante, 'placar' => $placar, 'visitante' => $visitante];
                }
            
                $x++;
            }

            return $jogos;
        } catch (Exception $ex) {
            
        }
    }

    private function getDataFutebolBrasileiroAnteriores($url)
    {
        $site = utf8_encode(file_get_contents($url));
        $site = str_replace('"', "'", $site);
        $site = str_ireplace(array("\r"), "", $site);

        // $site = utf8_decode($site);2
        return mb_detect_encoding($site);

        $dt01 = explode("<table", $site);

        $dt03 = explode("<tr>", $dt01[1]);

        $x = 0;
        $jogos = [];
        foreach ($dt03 as $linha) {
            if ($x > 1) {
                $colunas = explode("<td", $linha);

                $data = Carbon::createFromFormat('d/m/Y', trim(str_replace("</font></td>\n", "", str_replace("align='center' bgcolor='#FFFFFF'><font size='2'>", "", $colunas[1]))))->format('Y-m-d H:i:s');
                $mandante = utf8_encode(trim(str_replace("</font></td>\n", "", str_replace("bgcolor='#FFFFFF'> <font size='2'>", "", $colunas[2]))));
                $placar = explode('x', trim(str_replace("</font></td>\n", "", str_replace("bgcolor='#FFFFFF'> <font size='2'>", "", $colunas[3]))));
                $visitante = utf8_encode(trim(str_replace("</font></td>\n", "", str_replace("bgcolor='#FFFFFF'> <font size='2'>", "", $colunas[4]))));

                $jogos[] = ['data' => $data, 'mandante' => $mandante, 'placar' => $placar, 'visitante' => $visitante];
            }
        
            $x++;
        }

        return $jogos;
    }
}
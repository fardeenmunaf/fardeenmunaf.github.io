<?php

    function textoHome() {

        date_default_timezone_set('Europe/Lisbon');
        $diaSemana = date("w");
        $dia = date("d");
        $mes = date("m");
        $ano = date("Y");
        $hora = date("H:i");

        if ($diaSemana == "1") {
            $diaSemana = "Segunda-Feira";
        } else if ($diaSemana == "2") {
            $diaSemana = "Terça-Feira";
        } else if ($diaSemana == "3") {
            $diaSemana = "Quarta-Feira";
        } else if ($diaSemana == "4") {
            $diaSemana = "Quinta-Feira";
        } else if ($diaSemana == "5") {
            $diaSemana = "Sexta-Feira";
        } else if ($diaSemana == "6") {
            $diaSemana = "Sábado";
        } else if ($diaSemana == "0") {
            $diaSemana = "Domingo";
        }
         


        if($mes == "01") {

            $mes = "Janeiro";
        } else if($mes == "02") {

            $mes = "Fevereiro";
        } else if($mes == "03") {

            $mes = "Março";
        } else if($mes == "04") {

            $mes = "Abril";
        } else if($mes == "05") {

            $mes = "Maio";
        } else if($mes == "06") {

            $mes = "Junho";
        } else if($mes == "07") {

            $mes = "Julho";
        } else if($mes == "08") {

            $mes = "Agosto";
        } else if($mes == "09") {

            $mes = "Setembro";
        } else if($mes == "10") {

            $mes = "Outubro";
        } else if($mes == "11") {

            $mes = "Novembro";
        } else if($mes == "12") {

            $mes = "Dezembro";
        }

        echo "Hoje é " . $diaSemana . ", " . $dia . " de " . $mes . " de " . $ano . " - " . $hora;
    }

?>
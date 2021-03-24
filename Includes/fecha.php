<?php
    function fecha($fecha) {
        $fecha = substr($fecha, 0, 10);//recortaremos la fecha para obtener los diez primeros caracteres 

        
        //obtener el número de día, el día (nombre del día), el mes y el año con la función strtotime().
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));

        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");//lo que ya muestra
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");//lo que se mostrara

        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");//lo que ya muestra
        $meses_ES = array("ene", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sept", "oct", "nov", "dic");//lo que se mostrara
        
        //Por defecto el día y el mes ($dia, $mes) se obtienen en inglés, por ende hay que convertirlo a castellano usando str_replace().
        $diaencastellano = str_replace($dias_EN, $dias_ES, $dia);
        $mesencastellano = str_replace($meses_EN, $meses_ES, $mes);


        return $numeroDia." ".$mesencastellano.". ";
      }
?>
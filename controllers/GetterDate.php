<?php

class GetDate
{

/**
 * Función para saber las semanas de vida del niño en la edad que tiene (Ejemplo: 15 Semanas de vida)
 *
 * @param mixed $year - Año de nacimiento
 * @param mixed $birthDay - fecha de nacimiento
 *
 * @return array $semana - las semanas de vida
 *
 */
    public function getWeek($year, $birthDay)
    {
        $fechaCalculo = new DateTime();
        $fechaCalculo->setDate($year, 01, 01);
        $diff = $fechaCalculo->diff($birthDay);

        $dias = $diff->days;
        $semana = $dias / 7;
        $semana = round($semana);

        return $semana;
    }

/**
 * Función para conocer datos de las fechas como la edad del niño, las semanas de vida
 * (Ejemplo: 4 Años y 3 semanas de vida)
 *
 * @param mixed $birthDay - fecha de nacimiento
 *
 * @return array $fechas - Datos de las fechas
 */
    public function getDates($birthDay)
    {
        $fechas = [];
        list($year, $mes, $dia) = explode("-", $birthDay);
        $year_diferencia = date("Y") - $year;
        $mes_diferencia = date("m") - $mes;
        $dia_diferencia = date("d") - $dia;
        
        $year_diferencia--;
        array_push($fechas, $year_diferencia);
        array_push($fechas, $year);
        return $fechas;

    }

}

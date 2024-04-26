<?php

function mes() {

  $mes_actual = date('m');

  $mes_numero = intval($mes_actual);

  $meses = array(
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre',
  );

  if ($mes_numero >= 1 && $mes_numero <= 12) {
    return $meses[$mes_numero - 1];
  }

  return '';
}
?>

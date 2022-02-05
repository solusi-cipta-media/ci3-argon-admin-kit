<?php


function rupiah_bulat($jml) {
    $int = number_format(ceil($jml), 0, '', '.');
    return $int;
}

function currency($jml) {
    $int = number_format(ceil($jml), 0, '', '.');
    if (($jml === NULL) or ($jml === 0) or ($jml === '0') or ($jml === '')) {
        return '-';
    } else {
        return $int;
    }
}

function currencyToNumber($a) {
    $var        = str_replace(".", "", $a);
    $real_var   = str_replace(",", ".", $var);
    return $real_var;
}



?>
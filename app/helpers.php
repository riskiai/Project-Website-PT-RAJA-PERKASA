<?php

if (! function_exists('format_indo_currency')) {
    function format_indo_currency($number) {
        if ($number >= 1000000000) {
            return number_format($number, 0, ',', '.') . ' Miliar';
        } elseif ($number >= 1000000) {
            return number_format($number, 0, ',', '.') . ' Juta';
        } else {
            return number_format($number, 0, ',', '.');
        }
    }
}

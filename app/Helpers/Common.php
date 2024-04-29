<?php 

if (! function_exists('show_route')) {
    function sum_by_column( $array, string $column)
    {
        $sum = 0;
        foreach ($array as $key) {
           $sum += $key[$column];
        }

        return $sum;
    }
}

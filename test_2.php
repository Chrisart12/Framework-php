<?php

$first_array = [1, 2, 3, 4];

function add($elt){
    return $elt + 5;
}

var_dump($first_array);

$second_array = array_map('add', $first_array);

var_dump($second_array);

?>
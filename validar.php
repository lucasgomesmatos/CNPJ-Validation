<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Validation\CNPJ;

$resultado = CNPJ::validar('27397579000124');

var_dump($resultado);
<?php
require 'vendor/autoload.php';
require "Query.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$url = $_ENV['APP_URL'];

function getCompras(){
    $query = new Query();
    $sql = "SELECT * FROM `compras` ORDER BY `fecha` DESC;";
    $rows = $query->getAll($sql);
    return $rows;
}

function getFirst($table, $id){
    $query = new Query();
    $sql = "select * from `{$table}` where `id` = '{$id}'";
    $rows = $query->getFirst($sql);
    return $rows;
}

// Create new Plates instance
$templates = new League\Plates\Engine('layout');

// Register a one-off function
$templates->registerFunction('nivel', function ($id) {
    $nivel = getFirst('niveles', $id);
    if ($nivel){
        return $nivel['nombre'];
    }else{
        return $id;
    }
});

$templates->registerFunction('plan', function ($id) {
    $plan = getFirst('planes', $id);
    if ($plan){
        return $plan['tipo'];
    }else{
        return $id;
    }
});

$templates->registerFunction('vendedor', function ($id) {
    $vendedor = getFirst('vendedores', $id);
    if ($vendedor){
        return $vendedor['nombre'];
    }else{
        return "NO APLICA";
    }
});

$templates->registerFunction('fecha', function ($fecha) {
    $newDate = date("d-m-Y", strtotime($fecha));
    return $newDate;
});

$compras = array();

// Render a template
    $compras = getCompras();
    echo $templates->render(
        'listarcompras',
        [
            'compras' => $compras,
            'url' => $url
        ]);



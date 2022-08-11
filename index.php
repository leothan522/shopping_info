<?php
require 'vendor/autoload.php';
require "Query.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$url = $_ENV['APP_URL'];

function getVendedores(){
    $query = new Query();
    $sql = "SELECT * FROM `vendedores`;";
    $rows = $query->getAll($sql);
    return $rows;
}

function getPrecios($plan){
    $query = new Query();
    $sql = "SELECT * FROM `precios` WHERE `planes_id` = $plan;";
    $rows = $query->getAll($sql);
    return $rows;
}

// Create new Plates instance
$templates = new League\Plates\Engine('layout');

$nivel = null;
$plan = null;
$vendedores = array();

if (isset($_GET['nivel'])){ $nivel = $_GET['nivel']; }
if (isset($_GET['plan'])){ $plan = $_GET['plan']; }

// Render a template
if (is_null($nivel) && is_null($plan)){
    echo $templates->render('error_no_get');
}else{
    $vendedores = getVendedores();
    $precios = getPrecios($plan);
    echo $templates->render(
        'formulario',
            [
                'nivel' => $nivel,
                'plan' => $plan,
                'vendedores' => $vendedores,
                'precios' => $precios,
                'url' => $url
            ]);

}



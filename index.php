<?php
require 'vendor/autoload.php';
require "Query.php";

function getVendedores(){
    $query = new Query();
    $sql = "SELECT * FROM `vendedores`;";
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
    echo $templates->render('formulario', ['nivel' => $nivel, 'plan' => $plan, 'vendedores' => $vendedores]);

}



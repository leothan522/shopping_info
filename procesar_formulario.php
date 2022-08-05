<?php
require 'vendor/autoload.php';
require "Query.php";
require "Mailer.php";

function procesar($planPago, $nombre, $email, $telefono, $vendedor, $nivel, $plan){
    $query = new Query();
    $row = null;
    $date = date("Y-m-d H:i:s");

    //consultamos si ya existe el email
    $existe = "select * from `compras` where `email` = '{$email}'";
    if ($query->getFirst($existe)){
        return false;
    }

    $sql = "INSERT INTO `compras` (`nombre`, `email`, `telefono`, `plan_pago`, `niveles_id`, `planes_id`, `vendedores_id`, `fecha`) 
            VALUES ('{$nombre}', '{$email}', '{$telefono}', '{$planPago}', '{$nivel}', '{$plan}', '{$vendedor}', '{$date}');";
    $query->save($sql);
    $row = $query->getFirst($existe);
    return $row;

}


$json = array();

if (isset($_POST['planPlago'])){ $planPago = $_POST['planPlago']; }else{ $planPago = null; }
if (isset($_POST['nombre'])){ $nombre = $_POST['nombre']; }else{ $nombre = null; }
if (isset($_POST['email'])){ $email = $_POST['email']; }else{ $email = null; }
if (isset($_POST['telefono'])){ $telefono = $_POST['telefono']; }else{ $telefono = null; }
if (isset($_POST['vendedor'])){ $vendedor = intval($_POST['vendedor']); }else{ $vendedor = null; }
if (isset($_POST['nivel'])){ $nivel = intval($_POST['nivel']); }else{ $nivel = null; }
if (isset($_POST['plan'])){ $plan = intval($_POST['plan']); }else{ $plan = null; }

$compra = procesar($planPago, ucwords($nombre), strtolower($email), $telefono, $vendedor, $nivel, $plan);
if ($compra){
    $json['success'] = true;
    $json['type'] = "success";
    $json['message'] = "Solicitud Procesada Correctamente";
    echo json_encode($json, JSON_UNESCAPED_UNICODE);

    //ENVIO CORREO
    $mailer = new Mailer();
    $subject = 'Solicitud de compra procesada';
    $body = 'Hola, este es un correo de prueba';
    $mailer->enviarEmail($email, $subject);

}else{
    $json['success'] = false;
    $json['type'] = "error";
    $json['message'] = "El correo electronico que suministro ya tiene una solicitud de compra en proceso. ".$email;
    echo json_encode($json, JSON_UNESCAPED_UNICODE);
}

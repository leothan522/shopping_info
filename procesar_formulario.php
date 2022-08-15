<?php
require 'vendor/autoload.php';
require "Query.php";
require "Mailer.php";

function procesar($planPago, $cedula, $nombre, $email, $telefono, $vendedor, $nivel, $plan, $representante, $registro, $numero, $tomo, $year){
    $query = new Query();
    $row = null;
    $date = date("Y-m-d");

    //consultamos si ya existe el email
    $existe = "select * from `compras` where `email` = '{$email}'";
    if ($query->getFirst($existe)){
        return false;
    }

    $sql = "INSERT INTO `compras` (`cedula`, `nombre`, `email`, `telefono`, `plan_pago`, `niveles_id`, `planes_id`, `vendedores_id`, `fecha`, `representante`, `registro`, `numero`, `tomo`, `year`) 
            VALUES ('{$cedula}', '{$nombre}', '{$email}', '{$telefono}', '{$planPago}', '{$nivel}', '{$plan}', '{$vendedor}', '$date', '{$representante}', '{$registro}', '{$numero}', '{$tomo}', '{$year}');";
    $query->save($sql);
    $row = $query->getFirst($existe);
    return $row;

}


$json = array();

if (isset($_POST['planPlago'])){ $planPago = $_POST['planPlago']; }else{ $planPago = null; }
if (isset($_POST['cedula'])){ $cedula = $_POST['cedula']; }else{ $cedula = null; }
if (isset($_POST['nombre'])){ $nombre = $_POST['nombre']; }else{ $nombre = null; }
if (isset($_POST['email'])){ $email = $_POST['email']; }else{ $email = null; }
if (isset($_POST['telefono'])){ $telefono = $_POST['telefono']; }else{ $telefono = null; }
if (isset($_POST['vendedor'])){ $vendedor = $_POST['vendedor']; }else{ $vendedor = null; }
if (isset($_POST['nivel'])){ $nivel = $_POST['nivel']; }else{ $nivel = null; }
if (isset($_POST['plan'])){ $plan = $_POST['plan']; }else{ $plan = null; }
if (isset($_POST['representante'])){ $representante = $_POST['representante']; }else{ $representante = null; }
if (isset($_POST['registro'])){ $registro = $_POST['registro']; }else{ $registro = null; }
if (isset($_POST['numero'])){ $numero = $_POST['numero']; }else{ $numero = null; }
if (isset($_POST['tomo'])){ $tomo = $_POST['tomo']; }else{ $tomo = null; }
if (isset($_POST['year'])){ $year = $_POST['year']; }else{ $year = null; }

$compra = procesar($planPago, strtoupper($cedula), ucwords($nombre), strtolower($email), $telefono, $vendedor, $nivel, $plan, $representante, $registro, $numero, $tomo, $year);
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

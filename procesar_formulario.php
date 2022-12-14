<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require "Query.php";
require "Mailer.php";

function procesar($planPago, $cedula, $nombre, $email, $telefono, $vendedor, $nivel, $plan, $representante, $registro, $numero, $tomo, $year, $persona = "Persona Natural"){
    $query = new Query();
    $row = null;
    $date = date("Y-m-d");

    //consultamos si ya existe el email
    $existe = "select * from `compras` where `email` = '{$email}'";
    if ($query->getFirst($existe)){
        return false;
    }

    $sql = "INSERT INTO `compras` (`cedula`, `nombre`, `email`, `telefono`, `plan_pago`, `niveles_id`, `planes_id`, `vendedores_id`, `fecha`, `representante`, `registro`, `numero`, `tomo`, `year`, `persona`) 
            VALUES ('{$cedula}', '{$nombre}', '{$email}', '{$telefono}', '{$planPago}', '{$nivel}', '{$plan}', '{$vendedor}', '$date', '{$representante}', '{$registro}', '{$numero}', '{$tomo}', '{$year}', '{$persona}');";
    $query->save($sql);
    $row = $query->getFirst($existe);
    return $row;

}

function getFirst($table, $id){
    $query = new Query();
    $sql = "select * from `{$table}` where `id` = '{$id}'";
    $rows = $query->getFirst($sql);
    return $rows;
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
if (isset($_POST['persona'])){ $persona = $_POST['persona']; }else{ $persona = null; }

$compra = procesar($planPago, strtoupper($cedula), ucwords($nombre), strtolower($email), $telefono, $vendedor, $nivel, $plan, $representante, $registro, $numero, $tomo, $year, $persona);
if ($compra){
    $json['success'] = true;
    $json['type'] = "success";
    $json['message'] = "Solicitud Procesada Correctamente";
    echo json_encode($json, JSON_UNESCAPED_UNICODE);

    //ENVIO CORREO
    $mailer = new Mailer();
    $subject = 'Solicitud de compra procesada';
    $body = '
  <!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn\'t be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn\'t work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you\'d like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        .primary{
            background: #30e3ca;
        }
        .bg_white{
            background: #ffffff;
        }
        .bg_light{
            background: #fafafa;
        }
        .bg_black{
            background: #000000;
        }
        .bg_dark{
            background: rgba(0,0,0,.8);
        }
        .email-section{
            padding:2.5em;
        }

        /*BUTTON*/
        .btn{
            padding: 10px 15px;
            display: inline-block;
        }
        .btn.btn-primary{
            border-radius: 5px;
            background: #30e3ca;
            color: #ffffff;
        }
        .btn.btn-white{
            border-radius: 5px;
            background: #ffffff;
            color: #000000;
        }
        .btn.btn-white-outline{
            border-radius: 5px;
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
        }
        .btn.btn-black-outline{
            border-radius: 0px;
            background: transparent;
            border: 2px solid #000;
            color: #000;
            font-weight: 700;
        }

        h1,h2,h3,h4,h5,h6{
            font-family: \'Lato\', sans-serif;
            color: #000000;
            margin-top: 0;
            font-weight: 400;
        }

        body{
            font-family: \'Lato\', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0,0,0,.4);
        }

        a{
            color: #30e3ca;
        }

        table{
        }
        /*LOGO*/

        .logo h1{
            margin: 0;
        }
        .logo h1 a{
            color: #30e3ca;
            font-size: 24px;
            font-weight: 700;
            font-family: \'Lato\', sans-serif;
        }

        /*HERO*/
        .hero{
            position: relative;
            z-index: 0;
        }

        .hero .text{
            color: rgba(0,0,0,.3);
        }
        .hero .text h2{
            color: #000;
            font-size: 40px;
            margin-bottom: 0;
            font-weight: 400;
            line-height: 1.4;
        }
        .hero .text h3{
            font-size: 24px;
            font-weight: 300;
        }
        .hero .text h2 span{
            font-weight: 600;
            color: #30e3ca;
        }


        /*HEADING SECTION*/
        .heading-section{
        }
        .heading-section h2{
            color: #000000;
            font-size: 28px;
            margin-top: 0;
            line-height: 1.4;
            font-weight: 400;
        }
        .heading-section .subheading{
            margin-bottom: 20px !important;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(0,0,0,.4);
            position: relative;
        }
        .heading-section .subheading::after{
            position: absolute;
            left: 0;
            right: 0;
            bottom: -10px;
            content: \'\';
            width: 100%;
            height: 2px;
            background: #30e3ca;
            margin: 0 auto;
        }

        .heading-section-white{
            color: rgba(255,255,255,.8);
        }
        .heading-section-white h2{
            font-family:
            line-height: 1;
            padding-bottom: 0;
        }
        .heading-section-white h2{
            color: #ffffff;
        }
        .heading-section-white .subheading{
            margin-bottom: 0;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255,255,255,.4);
        }


        ul.social{
            padding: 0;
        }
        ul.social li{
            display: inline-block;
            margin-right: 10px;
        }

        /*FOOTER*/

        .footer{
            border-top: 1px solid rgba(0,0,0,.05);
            color: rgba(0,0,0,.5);
        }
        .footer .heading{
            color: #000;
            font-size: 20px;
        }
        .footer ul{
            margin: 0;
            padding: 0;
        }
        .footer ul li{
            list-style: none;
            margin-bottom: 10px;
        }
        .footer ul li a{
            color: rgba(0,0,0,1);
        }


        @media screen and (max-width: 500px) {


        }


    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
<center style="width: 100%; background-color: #f1f1f1;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="logo" style="text-align: center;">
                                <h1 style="color: #6f42c1 !important;">'.strtoupper($nombre).'</h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                    <table>
                        <tr>
                            <td>
                                <div class="text" style="padding: 0 2.5em; text-align: center;">
                                    <h2>Bienvenido al futuro de la B2C</h2>
                                    <h3>Usted ya forma parte de nuestra comunidad <em style="color: #6f42c1 !important;">caracashoppingcenter</em>
                                        En los pr??ximos minutos ser?? atendido por nuestro equipo
                                        Gerencia de Ventas</h3>
                                    <!--<p><a href="#" class="btn btn-primary">Yes! Subscribe Me</a></p>-->
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <!-- 1 Column Text + Button : END -->
        </table>

    </div>
</center>
</body>
</html>
    ';

    $mailer->enviarEmail($email, $subject, $body);


    $DB_nivel = getFirst('niveles', $nivel);
    if ($DB_nivel){
        $verNivel = $DB_nivel['nombre'];
    }else{
        $verNivel = $nivel;
    }

    $DB_plan = getFirst('planes', $plan);
    if ($DB_plan){
        $verPlan = $DB_plan['tipo'];
    }else{
        $verPlan = $plan;
    }

    $DB_vendedor = getFirst('vendedores', $vendedor);
    if ($DB_vendedor){
        $verVendedor = $DB_vendedor['nombre'];
    }else{
        $verVendedor = "NO APLICA";
    }

    
    $email_admin = $_ENV['MAIL_USERNAME'];
    $subject_admin = "Solicitud de compra cliente ".strtoupper($nombre);
    $body_admin = '
  <!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn\'t be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn\'t work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you\'d like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        .primary{
            background: #30e3ca;
        }
        .bg_white{
            background: #ffffff;
        }
        .bg_light{
            background: #fafafa;
        }
        .bg_black{
            background: #000000;
        }
        .bg_dark{
            background: rgba(0,0,0,.8);
        }
        .email-section{
            padding:2.5em;
        }

        /*BUTTON*/
        .btn{
            padding: 10px 15px;
            display: inline-block;
        }
        .btn.btn-primary{
            border-radius: 5px;
            background: #30e3ca;
            color: #ffffff;
        }
        .btn.btn-white{
            border-radius: 5px;
            background: #ffffff;
            color: #000000;
        }
        .btn.btn-white-outline{
            border-radius: 5px;
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
        }
        .btn.btn-black-outline{
            border-radius: 0px;
            background: transparent;
            border: 2px solid #000;
            color: #000;
            font-weight: 700;
        }

        h1,h2,h3,h4,h5,h6{
            font-family: \'Lato\', sans-serif;
            color: #000000;
            margin-top: 0;
            font-weight: 400;
        }

        body{
            font-family: \'Lato\', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0,0,0,.4);
        }

        a{
            color: #30e3ca;
        }

        table{
        }
        /*LOGO*/

        .logo h1{
            margin: 0;
        }
        .logo h1 a{
            color: #30e3ca;
            font-size: 24px;
            font-weight: 700;
            font-family: \'Lato\', sans-serif;
        }

        /*HERO*/
        .hero{
            position: relative;
            z-index: 0;
        }

        .hero .text{
            color: rgba(0,0,0,.3);
        }
        .hero .text h2{
            color: #000;
            font-size: 40px;
            margin-bottom: 0;
            font-weight: 400;
            line-height: 1.4;
        }
        .hero .text h3{
            font-size: 24px;
            font-weight: 300;
        }
        .hero .text h2 span{
            font-weight: 600;
            color: #30e3ca;
        }


        /*HEADING SECTION*/
        .heading-section{
        }
        .heading-section h2{
            color: #000000;
            font-size: 28px;
            margin-top: 0;
            line-height: 1.4;
            font-weight: 400;
        }
        .heading-section .subheading{
            margin-bottom: 20px !important;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(0,0,0,.4);
            position: relative;
        }
        .heading-section .subheading::after{
            position: absolute;
            left: 0;
            right: 0;
            bottom: -10px;
            content: \'\';
            width: 100%;
            height: 2px;
            background: #30e3ca;
            margin: 0 auto;
        }

        .heading-section-white{
            color: rgba(255,255,255,.8);
        }
        .heading-section-white h2{
            font-family:
            line-height: 1;
            padding-bottom: 0;
        }
        .heading-section-white h2{
            color: #ffffff;
        }
        .heading-section-white .subheading{
            margin-bottom: 0;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255,255,255,.4);
        }


        ul.social{
            padding: 0;
        }
        ul.social li{
            display: inline-block;
            margin-right: 10px;
        }

        /*FOOTER*/

        .footer{
            border-top: 1px solid rgba(0,0,0,.05);
            color: rgba(0,0,0,.5);
        }
        .footer .heading{
            color: #000;
            font-size: 20px;
        }
        .footer ul{
            margin: 0;
            padding: 0;
        }
        .footer ul li{
            list-style: none;
            margin-bottom: 10px;
        }
        .footer ul li a{
            color: rgba(0,0,0,1);
        }


        @media screen and (max-width: 500px) {


        }


    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
<center style="width: 100%; background-color: #f1f1f1;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td colspan="2" style="text-align: center;">
                    <h1 style="color: #6f42c1 !important;">'.strtoupper($nombre).'</h1>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td colspan="2">
                    <div class="text" style="padding: 0 2.5em; text-align: center;">
                        <h2>Detalles de la solicitud de compra</h2>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Nivel: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($verNivel).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Plan: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($verPlan).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Plan de pago: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($planPago).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Cedula o RIF: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($cedula).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Nombre o Raz&oacute;n social: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($nombre).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Email: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($email).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Tel&eacute;fono: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($telefono).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Tipo: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($persona).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Representante legal: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($representante).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Registro: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($registro).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Numero: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($numero).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Tomo: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($tomo).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">A&ntilde;o: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($year).'</h3>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3><em style="color: #6f42c1 !important;">Vendedor: </em></h3>
                    </div>
                </td>
                <td>
                    <div class="text" style="padding: 0 2.5em; text-align: left;">
                        <h3>'.strtoupper($verVendedor).'</h3>
                    </div>
                </td>
            </tr>
        </table>

    </div>
</center>
</body>
</html>
    ';

    $mailer->enviarEmail($email_admin, $subject_admin, $body_admin);




}else{
    $json['success'] = false;
    $json['type'] = "error";
    $json['message'] = "El correo electronico que suministro ya tiene una solicitud de compra en proceso. ".$email;
    echo json_encode($json, JSON_UNESCAPED_UNICODE);
}

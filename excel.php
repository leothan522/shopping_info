<?php
header("Content-Type: text/html;charset=utf-8");
header("Pragma: public");
header("Expires: 0");
$hoy = date("d-m-Y");
$hora = date("h-i-A");
$filename = "compras_{$hoy}_{$hora}.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

require "Query.php";
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
$compras = getCompras();
?>
<table border="1">
    <thead>
    <tr>
        <th scope="col" style="background-color: #0c84ff">ID</th>
        <th scope="col" style="background-color: #0c84ff">Cedula o RIF</th>
        <th scope="col" style="background-color: #0c84ff">Nombre o Raz&oacute;n social</th>
        <th scope="col" style="background-color: #0c84ff">Email</th>
        <th scope="col" style="background-color: #0c84ff">Tel&eacute;fono</th>
        <th scope="col" style="background-color: #0c84ff">Plan de Pago</th>
        <th scope="col" style="background-color: #0c84ff">Nivel</th>
        <th scope="col" style="background-color: #0c84ff">Plan</th>
        <th scope="col" style="background-color: #0c84ff">Vendedor</th>
        <th scope="col" style="background-color: #0c84ff">Fecha</th>
        <th scope="col" style="background-color: #0c84ff">Tipo</th>
        <th scope="col" style="background-color: #0c84ff">Representante legal</th>
        <th scope="col" style="background-color: #0c84ff">Registro</th>
        <th scope="col" style="background-color: #0c84ff">Numero</th>
        <th scope="col" style="background-color: #0c84ff">Tomo</th>
        <th scope="col" style="background-color: #0c84ff">A&ntilde;o</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($compras){ ?>
        <?php
            foreach ($compras as $compra):
            $nivel = getFirst('niveles', $compra['niveles_id']);
            if ($nivel){ $nivel = $nivel['nombre']; }else{ $nivel = $compra['niveles_id']; }
            $plan = getFirst('planes', $compra['planes_id']);
            if ($plan){ $plan = $plan['tipo']; }else{ $plan = $compra['planes_id']; }
            $vendedor = getFirst('vendedores', $compra['vendedores_id']);
            if ($vendedor){ $vendedor = $vendedor['nombre']; }else{ $vendedor = "NO APLICA"; }
        ?>
            <tr>
                <td><?= $compra['id'] ?></td>
                <td><?= $compra['cedula'] ?></td>
                <td><?= $compra['nombre'] ?></td>
                <td><?= $compra['email'] ?></td>
                <td><?= $compra['telefono'] ?></td>
                <td><?= $compra['plan_pago'] ?></td>
                <td><?= utf8_encode($nivel) ?></td>
                <td><?= utf8_encode($plan) ?></td>
                <td><?= utf8_encode($plan) ?></td>
                <td><?= date("d-m-Y", strtotime($compra['fecha'])) ?></td>
                <td><?= $compra['persona'] ?></td>
                <td><?= $compra['representante'] ?></td>
                <td><?= $compra['registro'] ?></td>
                <td><?= $compra['numero'] ?></td>
                <td><?= $compra['tomo'] ?></td>
                <td><?= $compra['year'] ?></td>
            </tr>
        <?php endforeach; ?>
    <?php } ?>
    </tbody>
</table>

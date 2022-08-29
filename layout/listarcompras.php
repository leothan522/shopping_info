<?php
$this->layout('master', ['title' => 'Fomulario']) ?>

<div class="col-md-11">
    <div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
        <div class="card-header">
            <h3 class="card-title text-purple text-bold">Compras Registradas</h3>

            <div class="card-tools">
                <a href="excel.php" class="btn btn-tool text-success swalDefaultInfo">
                    <i class="fas fa-file-excel"></i> <i class="fas fa-download"></i>
                </a>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cedula o RIF</th>
                    <th scope="col">Nombre o Razón social</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Plan de Pago</th>
                    <th scope="col">Nivel</th>
                    <th scope="col">Plan</th>
                    <th scope="col">Vendedor</th>
                    <th scope="col">Fecha</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($compras){ ?>
                    <?php foreach ($compras as $compra): ?>
                        <tr>
                            <th scope="row" class="text-center"><?= $compra['id'] ?></th>
                            <td><?= $compra['cedula'] ?></td>
                            <td><?= $compra['nombre'] ?></td>
                            <td><?= $compra['email'] ?></td>
                            <td><?= $compra['telefono'] ?></td>
                            <td><?= $compra['plan_pago'] ?></td>
                            <td><?= utf8_encode($this->nivel($compra['niveles_id'])) ?></td>
                            <td><?= utf8_encode($this->plan($compra['planes_id'])) ?></td>
                            <td><?= utf8_encode($this->vendedor($compra['vendedores_id'])) ?></td>
                            <td><?= $this->fecha($compra['fecha']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php }else{ ?>
                        <tr>
                            <td colspan="10">Sin Registros</td>
                        </tr>
                <?php } ?>
                </tbody>
            </table>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<?php
$this->layout('master', ['title' => 'Fomulario']) ?>

<div class="col-md-8" id="div_formulario">
    <div class="card card-outline card-purple" style="height: inherit; width: inherit; transition: all 0.15s ease 0s;">
        <div class="card-header">
            <h3 class="card-title text-purple text-bold">¡Ya casi lo logras! Completa tu pedido</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <form action="#">

                <div class="row">

                    <div class="col-md-12">
                        <label>1. Plan de pago</label>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box border border-info">
                            <span class="info-box-icon">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary1" name="plan_pago" value="1 mes">
                                    <label for="radioPrimary1"></label>
                                </div>
                            </span>
                            <div class="info-box-content">
                               <!-- <span class="info-box-text">1 mes</span>-->
                                <span class="info-box-number">1 mes</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box border border-success">
                            <span class="info-box-icon">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary2" name="plan_pago" value="4 mes">
                                    <label for="radioPrimary2"></label>
                                </div>
                            </span>
                            <div class="info-box-content">
                                <!-- <span class="info-box-text">1 mes</span>-->
                                <span class="info-box-number">4 mes</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box border border-warning">
                            <span class="info-box-icon">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary3" name="plan_pago" value="6 mes">
                                    <label for="radioPrimary3"></label>
                                </div>
                            </span>
                            <div class="info-box-content">
                                <!-- <span class="info-box-text">1 mes</span>-->
                                <span class="info-box-number">6 mes</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box border border-danger">
                            <span class="info-box-icon">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary4" name="plan_pago" value="12 mes">
                                    <label for="radioPrimary4"></label>
                                </div>
                            </span>
                            <div class="info-box-content">
                                <!-- <span class="info-box-text">1 mes</span>-->
                                <span class="info-box-number">
                                    12 mes
                                    <span class="float-right badge bg-danger navbar-badge text-bold">Ahorra 45%</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- ./row -->
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <label>2. Datos para la cuenta</label>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nombre" id="nombre">
                            <span class="col-sm-12 text-sm text-danger d-none" id="error_nombre">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <span id="span_nombre"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" placeholder="Email" id="email">
                            <span class="col-sm-12 text-sm text-danger d-none" id="error_email">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <span id="span_email"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-phone-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Teléfono" id="telefono">
                            <span class="col-sm-12 text-sm text-danger d-none" id="error_telefono">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <span id="span_telefono"></span>
                            </span>
                        </div>
                    </div>


                    <!-- ./row -->
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <label>3. Selecciona un vendedor</label>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user-tie"></i>
                                </span>
                            </div>
                            <select name="vendedor" id="vendedor" class="custom-select">
                                <?php if ($vendedores){ ?>
                                    <?php foreach ($vendedores as $vendedor): ?>
                                        <option value="<?=$vendedor['id'] ?>"><?=$vendedor['nombre'] ?></option>
                                    <?php endforeach ?>
                                <?php }else{ ?>
                                    <option value="">NO APLICA</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <!-- ./row -->
                </div>

                <div class="row justify-content-end">

                    <div class="col-md-12">
                        <label>4. ¡Ya estás listo para comprar!</label>
                        <input type="hidden" value="<?= $nivel ?>" id="nivel">
                        <input type="hidden" value="<?= $plan ?>" id="plan">
                    </div>

                    <div class="col-md-4">
                        <input type="hidden" id="url_ajax" value="<?= $url ?>">
                        <button type="button" class="btn btn-block bg-gradient-purple" id="btn_formulario">Comprar</button>
                    </div>
                    <!-- ./row -->
                </div>

            </form>


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<div class="col-md-3 d-none" id="div_procesado">
    <div class="info-box mb-3 bg-success">
        <span class="info-box-icon">
            <i class="far fa-thumbs-up"></i>
        </span>

        <div class="info-box-content">
            <span class="info-box-text">Solicitud de Compra Enviada</span>
            <span class="info-box-text">Revisa tu correo electronico</span>
            <span class="info-box-number">Te contactaremos en breve.</span>
        </div>
        <!-- /.info-box-content -->
    </div>
</div>
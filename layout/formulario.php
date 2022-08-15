<?php
$this->layout('master', ['title' => 'Fomulario']) ?>

<div class="col-md-11" id="div_formulario">
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

                    <?php if ($precios){ ?>
                        <?php
                        $i = 0;
                        $border = null;
                        $bg = null;
                        ?>
                        <?php foreach ($precios as $precio): ?>
                            <?php
                            $i++;
                            if ($i == 1){
                                $border = "border-info";
                                $bg = "bg-info";
                            }
                            if ($i == 2){
                                $border = "border-success";
                                $bg = "bg-success";
                            }
                            if ($i == 3){
                                $border = "border-warning";
                                $bg = "bg-warning";
                            }
                            if ($i == 4){
                                $border = "border-danger";
                                $bg = "bg-danger";
                            }
                            ?>

                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box border <?php echo $border; ?>">
                            <span class="info-box-icon">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary<?php echo $i;?>" name="plan_pago" value="<?php echo $precio['mes'];?>">
                                    <label for="radioPrimary<?php echo $i;?>"></label>
                                </div>
                            </span>
                                    <div class="info-box-content">
                                        <span class="info-box-number"><?php echo $precio['mes'];?></span>
                                        <?php if ($precio['ahorro']){ ?>
                                            <!--<del class="info-box-text"><?php /*echo $precio['precio'];*/?></del>-->
                                            <span class="info-box-text text-bold text-primary text-lg"><?php echo $precio['pago_mes'];?></span>
                                            <small class="info-box-text text-xs">mes</small>
                                            <span class="float-right badge <?php echo $bg; ?> navbar-badge text-bold text-lg">Ahorra <?php echo $precio['ahorro']?></span>
                                        <?php }else{ ?>
                                            <span class="info-box-text text-bold text-primary text-lg"><?php echo $precio['precio'];?></span>
                                            <small class="info-box-text text-xs">&nbsp;</small>
                                        <?php } ?>
                                        <small class="info-box-text text-xs">+ <?php echo $preventa; ?> por firma (pago único)</small>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach ?>
                    <?php } ?>

                    <!--<div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box border border-info">
                            <span class="info-box-icon">
                                <div class="icheck-primary">
                                    <input type="radio" id="radioPrimary1" name="plan_pago" value="1 mes">
                                    <label for="radioPrimary1"></label>
                                </div>
                            </span>
                            <div class="info-box-content">
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
                                <span class="info-box-number">
                                    12 mes
                                    <span class="float-right badge bg-danger navbar-badge text-bold">Ahorra 45%</span>
                                </span>
                            </div>
                        </div>
                    </div>-->

                    <!-- ./row -->
                </div>

                <div class="row">

                    <div class="col-md-12">
                        <label>2. Datos para la cuenta</label>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-id-card"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Cedula o RIF" id="cedula">
                            <span class="col-sm-12 text-sm text-danger d-none" id="error_cedula">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <span id="span_cedula"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nombre o Razón social" id="nombre">
                            <span class="col-sm-12 text-sm text-danger d-none" id="error_nombre">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <span id="span_nombre"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
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

                    <div class="col-md-3">
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

                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-id-card-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Representante legal (opcional)" id="representante">
                            <span class="col-sm-12 text-sm text-danger d-none" id="error_representante">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <span id="span_representante"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-passport"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Registro (opcional)" id="registro">
                            <span class="col-sm-12 text-sm text-danger d-none" id="error_registro">
                                <i class="icon fas fa-exclamation-triangle"></i>
                                <span id="span_registro"></span>
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 row">

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-hashtag"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Numero" id="numero">
                                <span class="col-sm-12 text-sm text-danger d-none" id="error_numero">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    <span id="span_numero"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-hashtag"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Tomo" id="tomo">
                                <span class="col-sm-12 text-sm text-danger d-none" id="error_tomo">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    <span id="span_tomo"></span>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-hashtag"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Año" id="year">
                                <span class="col-sm-12 text-sm text-danger d-none" id="error_year">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    <span id="span_year"></span>
                                </span>
                            </div>
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
                        <div class="col-md-12 form-group mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                <label class="col-md-12 custom-control-label" for="exampleCheck1">
                                    Estoy de acuerdo con los<a href="#" target="_blank"> términos de servicio.</a>
                                </label>
                                <span class="col-sm-12 text-sm text-danger d-none" id="error_terminos">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    <span>Debes aceptar los terminos del servicio.</span>
                                </span>
                            </div>
                        </div>
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
<?php
$this->layout('master', ['title' => 'Fomulario']) ?>

<div class="col-md-9" id="div_formulario">
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
                                            <span class="info-box-text text-bold text-primary">mes <?php echo $precio['pago_mes'];?></span>
                                            <span class="float-right badge <?php echo $bg; ?> navbar-badge text-bold">Ahorra <?php echo $precio['ahorro']?></span>
                                        <?php }else{ ?>
                                            <span class="info-box-text text-bold text-primary"><?php echo $precio['precio'];?></span>
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
                        <div class="col-md-12 form-group mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                <label class="col-md-12 custom-control-label" for="exampleCheck1">
                                    Estoy de acuerdo con los<button type="button" class="btn btn-sm btn-link text-bold" data-toggle="modal" data-target="#exampleModal">términos de servicio.</button>
                                </label>
                                <span class="col-sm-12 text-sm text-danger d-none" id="error_terminos">
                                    <i class="icon fas fa-exclamation-triangle"></i>
                                    <span>Debes Aceptar los terminos del servicio.</span>
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

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg"">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Términos de servicio.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">



                            <p class="text-justify text-sm">
                                Entre INTERNACIONAL DESARROLLOS SHOPPINGCENTER 0311. C.A, Sociedad Mercantil debidamente registrada por ante el Registro Mercantil Quinto del Distrito capital y estado Bolivariano de Miranda bajo el N° 4, Tomo 231-A, correspondiente al año 2022, registro de Información Fiscal  N° J-50233570-6, representada para el siguiente acto por Libardo Antonio Laurens Méndez, mayor de edad, civilmente hábil, portador de la cédula  de identidad N° V-10.199.465 que en adelante y para efecto del presente contrato se denominara LA DESARROLLADORA Y por la otra parte: ________________________________ Sociedad Mercantil debidamente registrada por ante el Registro Mercantil :_________________________________bajo el N° ____, Tomo _____, correspondiente al año ______, registro de Información Fiscal  N° __________, representada para el siguiente acto por:  ________________________, , mayor de edad, civilmente hábil, portador de la cédula  de identidad N° ___________, Registro de Información Fiscal:___________,  que en adelante y para efecto del presente contrato se denominará   EL LOCATARIO,  que en adelante declara que la información proporcionada, es de carácter confidencial y por la misma autoriza suficientemente a LA DESARROLLADORA para que verifique cualquier información que considere relevante para adquirir los derechos y responsabilidades inherente a las tiendas propuestas por el presente contrato , y actuando de manera voluntaria y haciendo uso de mi derecho de mi representada al libre ejercicio de los  derechos mercantiles, acepto el presente CONTRATO DE ADHESIÓN PARA LA ADQUISICIÓN DE UNA TIENDA ONLINE. Y contratando los servicios conexos detallados en las siguientes cláusulas:
                                CLÁUSULA PRIMERA:   LA DESARROLLADORA, oferta una tienda online en el portal  caracashoppingcenter.com cuyas dimensiones y condiciones  se detallan a continuación: NIVEL: ____________ Tipo de tienda:__________.  Entendiendo las partes que la referida tienda online, está ofertada según la tarifa, contemplando  unas series de servicios y responsabilidades que se describe en la propuesta comercial que  EL LOCATARIO, declara conocer y aceptar. CLÁUSULA SEGUNDA: EL LOCATARIO, se obliga a pagar una suma mensual por concepto de SERVICIOS ESPECÍFICOS y promociones. El monto se señala  en la propuesta comercial de acuerdo al nivel y el tipo de tienda  que   EL LOCATARIO declara conocer y aceptar, se entiende que referido pago será facturado a nombre de EL LOCATARIO y su pago se considera obligatorio y en consecuencia se realizará mediante descuentos directo al pago correspondiente a EL LOCATARIO.  CLÁUSULA TERCERA: Las partes declaran por la presente, que la firma del presente contrato y el cumplimento del pago correspondiente  otorga propiedad a EL LOCATARIO sobre la tienda adquirida, la misma está sujeta al uso, disfrute y usufructo, pero la misma está integrada a la comunidad tecnológica y de servicio de caracashoppingcenter.com y no puede funcionar fuera de esta comunidad  y la llave es el usuario y la clave son parte fundamental de la propiedad. La referida tienda podrá ser transmitida por sucesión, donación, venta, cesión, y la relación no se extingue por muerte de EL LOCATARIO,  pero está condicionada a las siguientes obligaciones: 1. Pagar las sumas convenidas y señalada en la cláusula segunda. 2. Mantener la tienda abierta de manera permanente. 3. Evitar las ventas engañosas y las estafas. 4.  Utilizar solo los canales de venta, cobro y envió de  LA DESARROLLADORA.  5. Está prohibido Comercializar productos procedentes del robo, contrabando, fabricación pirata y productos expresamente prohibidos por el estado venezolano, cualquier violación de estas normas se registrará en un archivo interno de LA DESARROLLADORA y se enviara notificación a EL LOCATARIO,  al recibir  la misma EL LOCATARIO dispone de cinco (05) días hábiles para presentar sus alegatos o solventar la situación. En caso de no solventar y no presentar sus alegatos, se abrirá un archivo interno que se denominará  EXPEDIENTE NEGATIVO, y al acumular 03 expedientes negativos, EL LOCATARIO o a su representante, será notificado del inicio de un proceso  de rescisoria del contrato, de ser aprobado  este proceso se ofertara la tienda en una subasta y del monto pagado menos un veinte por ciento (20%) para gastos administrativo que cobrara  LA DESARROLLADORA, el saldo restante se transferirá  a EL LOCATARIO.  CLAUSULA CUARTA: EL LOCATARIO se obliga a mantener un stock de inventario permanente y en caso de tener problema de suministro, notificará de manera expresa a la gerencia de almacén y entrega con por lo menos 15 días calendario de antelación, igual debe notificar cualquier cambio de ramo o marca de mercancía. CLÁUSULA QUINTA: LA DESARROLLADORA, prestará servicios de procesos de la plataforma y para este  fin dispone de los servicios de un equipo profesional de desarrollo web y contratará servicios de servidores blindados, pero no puede garantizar la seguridad ante un ataque cibernético a los servidores, por la misma las partes acuerdan  que en caso de un ataque cibernético que ocasiones la caída de los servicios en línea no habrá demandas judiciales  cuando el ataque no responda a falla de los desarrolladores del sistema contratado.  CLÁUSULA SEXTA: Para prevenir la perdida de la información generada por  LOS LOCATARIOS,  se desarrollará una plataforma espejo que recibirá toda la información y en caso de un ataque, LA DESARROLLADORA, activará a través de otros  servidores y de segundas y terceras direcciones generando un daño mínimo de la operatividad de las plataformas  caracashoppingcenter, este servicios de respaldo está dirigido a todos los locatarios. CLÁUSULA SEPTIMA: por la presente EL LOCATARIO, solicita a  LA DESARROLLADORA a prestar los siguientes servicios: 1. Promocionar su marca comercial y productos. 2. Realizar los cobros a través de su pasarela de pagos, incluidos los pagos en efectivos y uso de bóveda. 3. Servicio de Delivery para beneficio de los consumidores. 4. Arriendo de espacios en almacenes de diferentes zonas del área metropolitana de Caracas. 5. Pago de seguro a los consumidores por productos dañados y ofertas engañosas. 6. Sistema administrativo y control de inventario en tiempo real. 7. Promociones en corredores de alto consumo comercial con promotoras. EL LOCATARIO, asume el pago estos servicios por descuento de un porcentaje de cinco (5 %)  sobre sus ventas. CLÁUSULA OCTAVA: LA DESARROLLADORA, prestará el servicio de nuestra Plataforma web y los servicios de ventas, cobranzas y Delivery  en el marco de las normas jurídica que rigen el ordenamiento jurídico de la República Bolivariana de Venezuela, por lo mismo está sujeta a las normativas y el poder del príncipe del Estado Venezolano, por lo que si por una decisión legislativa o ejecutiva nos vemos obligados a dejar de funcionar o dejar de prestar uno o varios servicios EL LOCATARIO no podrá demandar ni exigir se cumpla los referidos servicios, pero podrá pedir trasladar su tienda a otra ciudad donde esté funcionando una plataforma shoppingcenter donde seguirá disfrutando de nuestros servicios y cumpliendo sus obligaciones contractuales. CLÁUSULA NOVENA: Las partes acuerdan que caracashoppingcenter.com es un sistema cerrado de comercialización y por efecto toda transacción comercial se efectuara a través de los diferentes tipos de canales de comercialización que pone a la orden de los consumidores y que las tiendas online, están sujeta a las políticas comerciales de  LA DESARROLLADORA. CLÁUSULA DECIMA: LA DESARROLLADORA, contratará servicio especializado de Marketing, de servicio de Delivery, servicio de promotoras  y firmará convenio con la Banca nacional e internacional, para optimizar y aumentar las ventas de EL LOCATARIO, por lo que este se obliga a estar al día en materia de inventario y a mantener la calidad de los productos y servicios ofertados. CLÁUSULA DECIMA PRIMERA: por los servicios que se prestarán de acuerdo a la cláusula séptima EL LOCATARIO autoriza a  LA DESARROLLADORA para que descuente un CINCO POR CIENTO (5%) de total de los ingresos menos impuestos, en cada desembolso que realice. CLÁUSULA DECIMA SEGUNDA: LA DESARROLLADORA generará una  factura  por concepto de pago se servicios que enviará de manera periódica a EL LOCATARIO, y un reporte mensual  de ingresos, egresos y control de inventario. Pero pondrá a la orden de EL LOCATARIO, un servicio gratuito de control de inventario, control de venta y estado de cuenta  en tiempo real. DECIMA TERCERA: LA DESARROLLADORA,  creará un departamento para procesar y monitorear fallas en el sistema de inventarios, ventas y pagos. Este departamento recibirá quejas, consultas y sugerencias de LOS LOCATARIOS, y le brindaran oportuna respuestas. DECIMA CUARTA: LA DESARROLLADORA, dispondrá de un departamento de control de calidad de productos y servicios, el señalado departamento, procesará las devoluciones de garantías y desembolsos a los consumidores, evaluará los reclamos y llevara un control  de reclamos, será la responsable de generar los expedientes negativos señalados en la cláusula  tercera  y notificará al GENERAL MANAGER, para que active el procedimiento de proceso de rescisoria del contrato y notifique  a EL LOCATARIO. DECIMA QUINTA: Las partes acuerdan y es política de confidencialidad de la data, Toda la información generada por los consumidores se considera material clasificado y no estará disponible para terceros, esta data estará encriptada y será para uso interno de  LA DESARROLLADORA. DECIMA SEXTA: LA DESARROLLADORA, generara y enviará un corte de caja y el respectivo desembolso en la cuenta del banco designado para esta transacción en la moneda que haya utilizado el consumidor para pagar el producto o servicio. EL LOCATARIO  toma el  tiempo determinado para cada desembolso  72 ___, 144___ horas para la consignación de los pagos, en la cuenta de EL LOCATARIO:__________________________ del  Banco:_____________________ se entiende que para las transferencias de la Banca internacional este proceso se realizar una vez por semana.  DECIMA SEPTIMA: Las partes acuerdan que el único canal de comunicación para el tema de los pagos y solvencias es cajainterna@caracashoppingcenter.com  este canal de comunicación es exclusivo para atender: 1.consultas de pagos. 2. Solicitar reportes de pagos ya realizados. 3. Solicitar solvencias. 4. Reportar incidencias sobre pagos. 5. Queda entendido que no se aceptará otro canal para las referidas comunicaciones. DECIMA OCTAVA: Las partes asumen que cualquier falla del sistema se debe gestionar por el canal de comunicación soporteplataforma@caracashoppingcenter.com de igual manera el área de soporte para responder: 1. consultas relacionadas al soporte web. Preguntas relacionadas a los deferentes servicios en líneas.  3. recibir respuesta del personal de soporte web. 4. Queda entendido que no se aceptará otro canal para las referidas comunicaciones. DECIMA NOVENA: El servicio de atención de la oficina de Marketing a partir del momento de la aceptación del presente contrato y el pago de los servicios seleccionados, el departamento de Marketing  iniciará contacto de manera directa con EL LOCATARIO a través del presente canal serviciomarketing@caracashoppingcenter.com para los siguientes servicios: 1. Recibir información directa de EL LOCATARIO, relacionado a su plan de marketing y sistema de venta que viene implementado a la fecha. 2. Recibir las observaciones pertinentes y plan de Marketing  y propuesta comercial para su adaptación de su tienda.  3. Mantener feedback  EL LOCATARIO- Gerencia de ventas En todo lo relacionado a la estructuración de esa determinada área  durante el proceso de decoración de la tienda y plan de marketing. 4.  Para enviar cualquier consulta relacionada con el área de marketing y ventas. Queda entendido que no se aceptará otro canal para las referidas comunicaciones.  VIGESIMA: El departamento Diseño creativo trabajará directamente en contacto con EL LOCATARIO, a partir de la aceptación del presente contrato y el respectivo pago del paquete tomado para lo cual se debe seguir los pasos siguiente: 1. Enviar al departamento creativo el logo e imágenes  de los productos banderas o principales de su plan de comercialización. 2. El departamento creativo de acuerdo a la tienda adquirida por EL LOCATARIO, procederá a evaluar y enviar las observaciones y propuestas sobre el logo, las imágenes y los colores y otros elementos que considera pertinente. 3. Mantener feedback  EL LOCATARIO- Gerencia creativa para el diseño de la tienda durante todo el proceso de decoración y adecuación de la tienda. 4.  Para enviar cualquier consulta relacionada con el área de diseño creativo, queda entendido que no se aceptará otro canal para las referidas comunicaciones.  VIGESIMA PRIMERA: El departamento de Almacén-Despacho y Delivery, desde el momento de contratación y pago de los servicios adquiridos por EL LOCATARIO. 1. Abrirá un expediente a la referida tienda y le asignará un Código control. A través del siguiente canal de comunicación  delivery@caracashoppingcenter.com.  2. EL LOCATARIO solo podrá utilizar este código control para comunicarse con el referido departamento para establecer estrategias de almacenaje y empaques para las respectivas entregas finales a los consumidores. 3. Para enviar cualquier consulta relacionada con el área de Almacén-Despacho y Delivery, queda entendido que no se aceptará otro canal para las referidas comunicaciones. VIGESIMA SEGUNDA: La Unidad de servicios Interno, prestará un servicio de atención de los diferentes servicios y promociones que de manera interna se ofertarán a EL LOCATARIO para  lo cual utilizará el siguiente canal de comunicación serviciosinterno@caracashoppingcenter.com canal que utilizara para: 1. Realizar contactos directo con EL LOCATARIO por visita personal  y por los canales regulares. 2.  Enviará las diferentes direcciones  de los departamentos a EL LOCATARIO. 3. Evaluará el grado de satisfacción de  EL LOCATARIO. 4. Gestionará y atenderá los reclamos que por estos servicios reciba de EL LOCATARIO, para lo cual tendrá comunicación directa y prioritaria con cada departamento. VIGESIMA SEGUNDA: Los  servicios contemplados para el servicio de EL LOCATARIO son los siguientes y varios están sujetos a condiciones especiales y otros están contemplados en los pagos ya señalados en las Cláusulas segunda y decima primera: 1. Servicio de evaluación de sus productos y propuesta comerciales por un equipo de especialistas en márketing y las respectivas recomendaciones. 2. Servicio de verificación de imagen y diseño de logos por un equipo de diseñadores. 3. Asistencia para el servicio de creación de personalidad jurídica, (consulta y redacción de documento.  4. Asistencia para registros sanitarios en alimentos y productos naturales. 5. Servicio de  adecuación bancaria para acceder a las diferentes modalidades de pago.  6. Promoción de sus marcas.  7. Talonarios de cupones electrónicos de promociones de productos. 8. Servicios aduanero integral para aquellos Locatarios o  fabricantes que requieran importar materia prima o productos terminados.  9. Pasarela de pago con seguro de compra (gratuito para el usuario o clientes)  10. Sistema administrativo integrado  de la plataforma.  11.  Servicio de Delivery propio de la plataforma.  12.  Servicio de promoción con promotoras en los corredores de consumo más destacados de la ciudad de Caracas. 13. Servicio de  centro de entrega depósito-custodia.  14. Prioridad de las preventas  de aperturas de tiendas en los Shoppingcenter hermanos distribuidos en América y Europa. EL LOCATARIO declara conocer que cada servicio está sujeto a diferentes costos y están sujetas a condiciones espaciales. VIGESIMA TERCERA: Las partes acuerdan sobre lo no previsto en el presente  CONTRATO DE ADHESIÓN PARA ADQUISICION DE TIENDAS ONLINE.CARACASHOPPINGCENTER.COM., se resolverá como lo decidan las leyes vigentes sobre la materia, escogiendo como domicilio único con exclusión de cualquiera otro a la ciudad de Caracas, a cuyos Tribunales declaran someterse en caso de controversia. Así lo declaramos a la fecha de su conformidad. Con la aceptación de todas cláusulas y condiciones. En la ciudad de Caracas a la fecha de su adhesión.
                            </p>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

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
const Cargando = Swal.mixin({
    allowOutsideClick: false,
    didOpen: () => {
        Swal.showLoading()
    },
    showConfirmButton: false,
    width: '100',
});

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

const Alerta = Swal.mixin({
    toast: false,
    //position: 'top-end',
    showConfirmButton: true,
    //timer: 3000,
    //timerProgressBar: true,
    /*didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }*/
});

function validarEmail(valor) {
    re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
    if(!re.exec(valor)){
        return false
    } else{
        return true
    }

}

function setClass(id, option = "add", clase = "d-none"){
    let elemento = document.getElementById(id);
    if (option === "add"){
        elemento.classList.add(clase);
    }else {
        elemento.classList.remove(clase);
    }
}


$("#btn_formulario").click(function (e) {
    e.preventDefault();
    //Cargando.fire();
    var valNombre;
    var valEmail;
    var valTelefono;
    let planPago;
    let radio = document.querySelector('input[name=plan_pago]:checked');
    let nivel = document.getElementById('nivel').value;
    let plan = document.getElementById('plan').value;
    let nombre = document.getElementById('nombre').value;
    let email = document.getElementById('email').value;
    let telefono = document.getElementById('telefono').value;
    let vendedor = document.getElementById('vendedor').value;
    if (radio){
        planPago = radio.value
    }else {
        planPago = "null"
    }

    if (planPago === "null"){
        Alerta.fire({
            icon: "warning",
            title: "Elige Plan de Pago",
            text: "Debes elegir alguno de nuestros planes de pago",
        });
    }else if (nombre === "" || email === "" || telefono === "") {
        Toast.fire({
            icon: "error",
            title: "Todos los campos son requeridos.",
        });
    }

    let spanNombre = document.getElementById('span_nombre');
    if (nombre === ""){
        valNombre = false;
        spanNombre.innerText = "El campo nombre es requerido";
        setClass('error_nombre', 'remove');
    } else {
        if (nombre.length >= 4){
            valNombre = true;
            setClass('error_nombre');
        }else{
            valNombre = false;
            spanNombre.innerText = "El nombre debe tener al menos 4 caracteres";
            setClass('error_nombre', 'remove');
        }

    }

    let spanTelefono = document.getElementById('span_telefono');
    if (telefono === ""){
        valTelefono = false;
        spanTelefono.innerText = "El campo teléfono es requerido";
        setClass('error_telefono', 'remove');
    } else {
        if( !(/^\d{11}$/.test(telefono)) ) {
            valTelefono = false;
            spanTelefono.innerText = "El teléfono debe tener 11 digitos";
            setClass('error_telefono', 'remove');
        }else {
            valTelefono = true;
            setClass('error_telefono');
        }

    }

    let span = document.getElementById('span_email');
    if (email === ""){
        valEmail = false;
        span.innerText = "El campo email es requerido";
        setClass('error_email', 'remove');
    } else {
        if (validarEmail(email)){
            valEmail = true;
            setClass('error_email')
        }else {
            valEmail = false;
            span.innerText = "El email no es valido";
            setClass('error_email', 'remove');
        }

    }


    if (planPago !== "null" && nivel !== "" && plan !== "" && valNombre && valEmail && valTelefono){
        Cargando.fire();
        let url_ajax = document.getElementById('url_ajax').value;
        $.ajax({
            type: 'POST',
            url: url_ajax + "procesar_formulario.php",
            data: {
                planPlago: planPago,
                nombre: nombre,
                email: email,
                telefono: telefono,
                vendedor: vendedor,
                nivel: nivel,
                plan: plan
            },
            success: function (data) {

                var jsonData = JSON.parse(data);

                if (jsonData.success){
                    setClass('div_formulario');
                    setClass('div_procesado', 'remove');
                    Toast.fire({
                        icon: jsonData.type,
                        title: jsonData.message,
                    });
                }else{
                    Alerta.fire({
                        icon: "error",
                        title: "Email ya registrado",
                        text: jsonData.message,
                    });
                }
            }
        });
    }else{
        //alert("nivel: " + nivel + " | plan: " + plan + " | nombre: " + nombre + " | email: " + email + " | telefono: " + telefono + " | vendedor: " + vendedor + " | Pago: " + planPago );
    }

});

$("#btn_prueba").click(function(e) {
    e.preventDefault();
    //Cargando.fire();
    /*Alerta.fire({
        icon: "error",
        title: "title",
        text: "mensaje",
    });*/
    Toast.fire({
        icon: "success",
        title: "Guardado.",
    });

    //let producto = this.getAttribute('content');
    /*let producto = this.dataset.idStock;
    let cantidad = this.dataset.cantidad;
    $.ajax({
        type: 'POST',
        url: "{{ route('ajax.favoritos') }}",
        data: {
            id_stock: producto
        },
        success: function (data) {
            Toast.fire({
                icon: data.type,
                title: data.message,
            });
            let div = document.getElementById('header_favoritos');
            div.innerHTML = data.cantidad;
            if (data.type === "success"){
                document.getElementById(data.id).classList.add('fondo-favoritos')
            }else{
                document.getElementById(data.id).classList.remove('fondo-favoritos')
            }
        }
    });*/
});

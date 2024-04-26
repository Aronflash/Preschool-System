const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('.form-control');
const alertSuccess = document.getElementById('alertSuccess');

const expresiones = {
    codigo_periodo: /^\d{1,5}$/,
    nombre: /^[a-zA-ZÀ-ÿ\s0-9-]{2,20}$/, // Letras y espacios, de 2 a 50 caracteres

};

const campos = {
    codigo_periodo: true,
    nombre: false,
    fecha_inicio: false,
    fecha_fin: false
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombre":

            validarCampo(expresiones[e.target.name], e.target, e.target.name);
            break;
    }
};


const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
};
document.getElementById('fecha_inicio').addEventListener('blur', function (e) {
    validarFechaF(e.target.value);
});

function validarFechaF(fechaIngresada) {
    // Convertir la fecha ingresada a un objeto Date
    var fechaIngresadaObj = new Date(fechaIngresada);
  
    // Verificar si la fecha es válida
    if (!isNaN(fechaIngresadaObj.getTime())) {
        document.getElementById(`grupo__fecha_inicio`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__fecha_inicio`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__fecha_inicio i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo__fecha_inicio i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo__fecha_inicio .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos.fecha_inicio = true;
    } else {
        document.getElementById(`grupo__fecha_inicio`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__fecha_inicio`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__fecha_inicio i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo__fecha_inicio i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo__fecha_inicio .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos.fecha_inicio = false;
    }
}

const fechaInicioInput = document.getElementById('fecha_inicio');
const fechaFinInput = document.getElementById('fecha_fin');

fechaFinInput.addEventListener('change', validarFechas);

function validarFechas() {
    const fechaInicio = new Date(fechaInicioInput.value);
    const fechaFin = new Date(fechaFinInput.value);

    if (fechaFin < fechaInicio) {
        // Fecha de fin es menor que la fecha de inicio
        document.getElementById('grupo__fecha_fin').classList.add('formulario__grupo-incorrecto');
        document.getElementById('grupo__fecha_fin').classList.remove('formulario__grupo-correcto');
        document.querySelector('#grupo__fecha_fin i').classList.add('fa-times-circle');
        document.querySelector('#grupo__fecha_fin i').classList.remove('fa-check-circle');
        document.querySelector('#grupo__fecha_fin .formulario__input-error').classList.add('formulario__input-error-activo');
        campos.fecha_fin = false;

        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
    } else {
        // Fecha de fin es válida
        document.getElementById('grupo__fecha_fin').classList.remove('formulario__grupo-incorrecto');
        document.getElementById('grupo__fecha_fin').classList.add('formulario__grupo-correcto');
        document.querySelector('#grupo__fecha_fin i').classList.remove('fa-times-circle');
        document.querySelector('#grupo__fecha_fin i').classList.add('fa-check-circle');
        document.querySelector('#grupo__fecha_fin .formulario__input-error').classList.remove('formulario__input-error-activo');
        campos.fecha_fin = true;

        document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
    }
}
inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
    
});
formulario.addEventListener('submit', (e) => {
    e.preventDefault();
    if (campos.codigo_periodo && campos.nombre && campos.fecha_fin && campos.fecha_inicio) {
        // Envía el formulario
        formulario.submit();
    } else {
        // Algunos campos no son válidos
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
    }
});



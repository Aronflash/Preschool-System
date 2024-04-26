const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('.form-control');
const alertSuccess = document.getElementById('alertSuccess');

const expresiones = {
    codigo_usuario: /^\d{1,5}$/,
    nombre_usuario: /^[a-zA-ZÀ-ÿ\s0-9]{2,20}$/, // Letras y espacios, de 2 a 50 caracteres
    contrasena: /^.{1,50}$/,
    tipodeusuario: /^[1-9]\d*$/,
};

const campos = {
    codigo_usuario: false,
    nombre_usuario: false,
    contrasena: false,
    tipodeusuario: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "codigo_usuario":
        case "nombre_usuario":
        case "contrasena":
        case "tipodeusuario":

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

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);

});


formulario.addEventListener('submit', (e) => {
    e.preventDefault();
    if (campos.codigo_usuario && campos.nombre_usuario && campos.contrasena 
        && campos.tipodeusuario) {
        formulario.submit();
    } else {
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');

    }
});

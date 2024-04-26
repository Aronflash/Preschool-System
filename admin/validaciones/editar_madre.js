const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('.form-control');
const alertSuccess = document.getElementById('alertSuccess');

const expresiones = {
    cedula_mama: /^\d{7,8}$/,
    nombres: /^[a-zA-ZÀ-ÿ\s]{2,20}$/, // Letras y espacios, de 2 a 50 caracteres
    apellidos: /^[a-zA-ZÀ-ÿ\s]{2,25}$/, // Solo números
    telefono_habitacion: /^[0-9]{11}$/,
    telefono_trabajo: /^[0-9]{11}$/,
    codigo_estadocivil: /^[1-9]\d*$/,
    codigo_nacionalidad: /^[1-9]\d*$/,
    codigo_nivelacademico: /^[1-9]\d*$/,
    codigo_estado: /^[1-9]\d*$/,
    edad: /^\d{1,3}$/,
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/,
    datos_extras: /^[a-zA-Z0-9\s,_.+-]{1,500}$/,
    ocupacion: /^[a-zA-Z0-9À-ÿ\s,_.+-]{1,500}$/,
    profesion: /^[a-zA-Z0-9À-ÿ\s,_.+-]{1,500}$/,
    direccion_trabajo: /^[a-zA-Z0-9À-ÿ\s,_.+-]{1,500}$/,
    direccion_habitacion: /^[a-zA-Z0-9À-ÿ\s,_.+-]{1,500}$/,


};

const campos = {
    cedula_mama: true,
    nombres: true,
    apellidos: true,
    telefono_habitacion: true,
    telefono_trabajo: true,
    codigo_estadocivil: true,
    codigo_nacionalidad: true,
    codigo_nivelacademico: true,
    codigo_estado: true,
    edad: true,
    correo: true,
    datos_extras: true,
    ocupacion: true,
    profesion: true,
    direccion_trabajo: true,
    direccion_habitacion: true,

};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "cedula_mama":
        case "nombres":
        case "apellidos":
        case "telefono_habitacion":
        case "telefono_trabajo":
        case "codigo_estadocivil":
        case "codigo_nacionalidad":
        case "codigo_nivelacademico":
        case "codigo_estado":
        case "edad":
        case "correo":
        case "datos_extras":
        case "ocupacion":
        case "profesion":
        case "direccion_trabajo":
        case "direccion_habitacion":



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
    if (campos.cedula_mama && campos.nombres && campos.apellidos &&
        campos.telefono_habitacion && campos.direccion_trabajo &&
        campos.codigo_estadocivil && campos.codigo_nacionalidad &&
        campos.codigo_nivelacademico && campos.edad && campos.correo &&
        campos.datos_extras && campos.ocupacion && campos.profesion &&
        campos.direccion_trabajo && campos.direccion_habitacion && campos.codigo_estado) {
        formulario.submit();
    } else {
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');

    }
});

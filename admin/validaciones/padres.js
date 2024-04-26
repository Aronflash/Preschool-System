const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('.form-control');
const alertSuccess = document.getElementById('alertSuccess');

const expresiones = {
    cedula_papa: /^\d{7,8}$/,
    nombres: /^[a-zA-ZÀ-ÿ\s]{2,20}$/, // Letras y espacios, de 2 a 50 caracteres
    apellidos: /^[a-zA-ZÀ-ÿ\s]{2,25}$/, // Solo números
    telefono_habitacion: /^[0-9]{11}$/,
    telefono_trabajo: /^[0-9]{11}$/,
    codigo_estadocivil: /^[1-9]\d*$/,
    codigo_nacionalidad: /^[1-9]\d*$/,
    codigo_nivelacademico: /^[1-9]\d*$/,
    foto_papa: /.+\.(jpg|jpeg|png)$/,
    edad: /^\d{1,3}$/,
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/,
    datos_extras: /^[a-zA-Z0-9À-ÿ\s,_.+-]{1,500}$/,
    ocupacion: /^[a-zA-Z0-9À-ÿ\s,_.+-]{1,500}$/,
    profesion: /^[a-zA-Z0-9À-ÿ\s,_.+-]{1,500}$/,
    direccion_trabajo: /^[a-zA-Z0-9À-ÿ\s,_.+-]{1,500}$/,
    direccion_habitacion: /^[a-zA-Z0-9À-ÿ\s,_.+-]{1,500}$/,


};

const campos = {
    cedula_papa: false,
    nombres: false,
    apellidos: false,
    telefono_habitacion: false,
    telefono_trabajo: false,
    codigo_estadocivil: false,
    codigo_nacionalidad: false,
    codigo_nivelacademico: false,
    foto_papa: false,
    edad: false,
    correo: false,
    datos_extras: false,
    ocupacion: false,
    profesion: false,
    direccion_trabajo: false,
    direccion_habitacion: false,

};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "cedula_papa":
        case "nombres":
        case "apellidos":
        case "telefono_habitacion":
        case "telefono_trabajo":
        case "codigo_estadocivil":
        case "codigo_nacionalidad":
        case "codigo_nivelacademico":
        case "edad":
        case "correo":
        case "datos_extras":
        case "ocupacion":
        case "profesion":
        case "direccion_trabajo":
        case "direccion_habitacion":



            validarCampo(expresiones[e.target.name], e.target, e.target.name);
            break;
        case "foto_papa":
            validarImagen(e.target, 'foto_papa');
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
    if (input.type === 'file') {
        input.addEventListener('change', () => {
            validarImagen(input, input.name);
        });
    }
});


const validarImagen = (input, campo) => {
    const file = input.files[0];
    if (file) {
        const extension = file.name.split('.').pop().toLowerCase();
        if (extension === 'jpg' || extension === 'jpeg' || extension === 'png') {
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
    }
};


formulario.addEventListener('submit', (e) => {
    e.preventDefault();
    if (campos.cedula_papa && campos.nombres && campos.apellidos &&
        campos.telefono_habitacion && campos.direccion_trabajo &&
        campos.codigo_estadocivil && campos.codigo_nacionalidad &&
        campos.codigo_nivelacademico && campos.edad && campos.correo &&
        campos.datos_extras && campos.ocupacion && campos.profesion &&
        campos.direccion_trabajo && campos.direccion_habitacion && campos.foto_papa) {
        formulario.submit();
    } else {
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');

    }
});

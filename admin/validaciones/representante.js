const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('.form-control');
const alertSuccess = document.getElementById('alertSuccess');

const expresiones = {
    cedula_representante: /^\d{7,8}$/,
    nombres: /^[a-zA-ZÀ-ÿ\s]{2,20}$/, // Letras y espacios, de 2 a 50 caracteres
    apellidos: /^[a-zA-ZÀ-ÿ\s]{2,25}$/, // Solo números
    telefono: /^[0-9]{11}$/,
    codigo_parentesco: /^[1-9]\d*$/,
    foto_representante: /.+\.(jpg|jpeg|png)$/
};

const campos = {
    cedula_representante: false,
    nombres: false,
    apellidos: false,
    codigo_parentesco: false,
    telefono: false,
    foto_representante: false,
};

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "cedula_representante":
        case "nombres":
        case "apellidos":
        case "codigo_parentesco":
        case "telefono":
            validarCampo(expresiones[e.target.name], e.target, e.target.name);
            break;
        case "foto_representante":
            validarImagen(e.target, 'foto_representante');
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
    if (campos.cedula_representante && campos.nombres && campos.apellidos &&
        campos.codigo_parentesco && campos.foto_representante && campos.telefono) {
        formulario.submit();
    } else {
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');

    }
});

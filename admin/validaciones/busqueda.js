$(document).ready(function () {
    $('#cedula_representante').on('keyup', function () {
        var cedulaRepresentante = $(this).val();

        // Realizar la petición AJAX para buscar la información del representante
        $.ajax({
            type: 'POST',
            url: '../php/busqueda.php',
            data: { cedulaRepresentante: cedulaRepresentante },
            success: function (response) {
                // Manejar la respuesta del servidor
                console.log(response);

                // Actualizar los campos con la información del representante si existe
                var representanteInfo = JSON.parse(response);
                if (representanteInfo) {
                    $('#apellidos_representante').val(representanteInfo.apellidos);
                    $('#nombres_representante').val(representanteInfo.nombres);
                    $('#telefono_representante').val(representanteInfo.telefono);
                    $('#codigo_parentesco').val(representanteInfo.codigoParentesco);

                    $('#apellidos_representante').prop('disabled', true);
                    $('#nombres_representante').prop('disabled', true);
                    $('#telefono_representante').prop('disabled', true);
                    $('#codigo_parentesco').prop('disabled', true);
                } else {

                    $('#apellidos_representante').prop('disabled', false);
                    $('#nombres_representante').prop('disabled', false);
                    $('#telefono_representante').prop('disabled', false);
                    $('#codigo_parentesco').prop('disabled', false);
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores de la petición AJAX, si es necesario
                console.error(xhr.responseText);
            }
        });
    });
    $('#cedula_mama').on('keyup', function () {
        var cedulamama = $(this).val();
        $.ajax({
            type: "POST",
            url: "../php/busqueda_madre.php", // Ajusta la URL al archivo correcto
            data: {
                cedulaMama: cedulamama
            },
            dataType: "json",
            success: function (madreInfo) {
                if (madreInfo) {
                    // Llenar los campos con la información de la madre
                    $('#apellidos_mama').val(madreInfo.apellidos);
                    $('#nombres_mama').val(madreInfo.nombres);
                    $('#codigo_civilmama').val(madreInfo.codigoCivil);
                    $('#nacionalidad_mama').val(madreInfo.nacionalidad);
                    $('#fecha_mama').val(madreInfo.fecha_mama);
                    $('#telefono_mama').val(madreInfo.telefono);
                    $('#direccionh_mama').val(madreInfo.direccionHabitacion);
                    $('#telefonoh_mama').val(madreInfo.telefonoHabitacion);
                    $('#direcciont_mama').val(madreInfo.direccionTrabajo);
                    $('#telefonot_mama').val(madreInfo.telefonoTrabajo);
                    $('#nivel_mama').val(madreInfo.nivelAcademico);
                    $('#ocupacion_mama').val(madreInfo.ocupacion);
                    $('#profesion_mama').val(madreInfo.profesion);
                    $('#correo_mama').val(madreInfo.correo);
                    $('#datos_mama').val(madreInfo.datosExtras);

                    // Deshabilitar los campos
                    $('#apellidos_mama').prop('disabled', true);
                    $('#nombres_mama').prop('disabled', true);
                    $('#codigo_civilmama').prop('disabled', true);
                    $('#nacionalidad_mama').prop('disabled', true);
                    $('#fecha_mama').prop('disabled', true);
                    $('#telefono_mama').prop('disabled', true);
                    $('#direccionh_mama').prop('disabled', true);
                    $('#telefonoh_mama').prop('disabled', true);
                    $('#direcciont_mama').prop('disabled', true);
                    $('#telefonot_mama').prop('disabled', true);
                    $('#nivel_mama').prop('disabled', true);
                    $('#ocupacion_mama').prop('disabled', true);
                    $('#profesion_mama').prop('disabled', true);
                    $('#correo_mama').prop('disabled', true);
                    $('#datos_mama').prop('disabled', true);
                } else {

                    // Quitar la propiedad 'disabled'
                    $('#apellidos_mama').prop('disabled', false);
                    $('#nombres_mama').prop('disabled', false);
                    $('#codigo_civilmama').prop('disabled', false);
                    $('#nacionalidad_mama').prop('disabled', false);
                    $('#fecha_mama').prop('disabled', false);
                    $('#telefono_mama').prop('disabled', false);
                    $('#direccionh_mama').prop('disabled', false);
                    $('#telefonoh_mama').prop('disabled', false);
                    $('#direcciont_mama').prop('disabled', false);
                    $('#telefonot_mama').prop('disabled', false);
                    $('#nivel_mama').prop('disabled', false);
                    $('#ocupacion_mama').prop('disabled', false);
                    $('#profesion_mama').prop('disabled', false);
                    $('#correo_mama').prop('disabled', false);
                    $('#datos_mama').prop('disabled', false);

                    // Mostrar un mensaje o manejar según tus necesidades
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores de la petición AJAX, si es necesario
                console.error(xhr.responseText);
            }
        });
    });

    $('#cedula_papa').on('keyup', function () {
        var cedulapapa = $(this).val();
        $.ajax({
            type: "POST",
            url: "../php/busqueda_papa.php", // Ajusta la URL al archivo correcto
            data: {
                cedulapapa: cedulapapa
            },
            dataType: "json",
            success: function (papaInfo) {
                if (papaInfo) {
                    // Llenar los campos con la información de la papa
                    $('#apellidos_papa').val(papaInfo.apellidos);
                    $('#nombres_papa').val(papaInfo.nombres);
                    $('#codigo_civilpapa').val(papaInfo.codigoCivil);
                    $('#nacionalidad_papa').val(papaInfo.nacionalidad);
                    $('#fecha_papa').val(papaInfo.fecha_papa);
                    $('#telefono_papa').val(papaInfo.telefono);
                    $('#direccionh_papa').val(papaInfo.direccionHabitacion);
                    $('#telefonoh_papa').val(papaInfo.telefonoHabitacion);
                    $('#direcciont_papa').val(papaInfo.direccionTrabajo);
                    $('#telefonot_papa').val(papaInfo.telefonoTrabajo);
                    $('#nivel_papa').val(papaInfo.nivelAcademico);
                    $('#ocupacion_papa').val(papaInfo.ocupacion);
                    $('#profesion_papa').val(papaInfo.profesion);
                    $('#correo_papa').val(papaInfo.correo);
                    $('#datos_papa').val(papaInfo.datosExtras);

                    // Deshabilitar los campos
                    $('#apellidos_papa').prop('disabled', true);
                    $('#nombres_papa').prop('disabled', true);
                    $('#codigo_civilpapa').prop('disabled', true);
                    $('#nacionalidad_papa').prop('disabled', true);
                    $('#fecha_papa').prop('disabled', true);
                    $('#telefono_papa').prop('disabled', true);
                    $('#direccionh_papa').prop('disabled', true);
                    $('#telefonoh_papa').prop('disabled', true);
                    $('#direcciont_papa').prop('disabled', true);
                    $('#telefonot_papa').prop('disabled', true);
                    $('#nivel_papa').prop('disabled', true);
                    $('#ocupacion_papa').prop('disabled', true);
                    $('#profesion_papa').prop('disabled', true);
                    $('#correo_papa').prop('disabled', true);
                    $('#datos_papa').prop('disabled', true);
                } else {

                    // Quitar la propiedad 'disabled'
                    $('#apellidos_papa').prop('disabled', false);
                    $('#nombres_papa').prop('disabled', false);
                    $('#codigo_civilpapa').prop('disabled', false);
                    $('#nacionalidad_papa').prop('disabled', false);
                    $('#fecha_papa').prop('disabled', false);
                    $('#telefono_papa').prop('disabled', false);
                    $('#direccionh_papa').prop('disabled', false);
                    $('#telefonoh_papa').prop('disabled', false);
                    $('#direcciont_papa').prop('disabled', false);
                    $('#telefonot_papa').prop('disabled', false);
                    $('#nivel_papa').prop('disabled', false);
                    $('#ocupacion_papa').prop('disabled', false);
                    $('#profesion_papa').prop('disabled', false);
                    $('#correo_papa').prop('disabled', false);
                    $('#datos_papa').prop('disabled', false);

                    // Mostrar un mensaje o manejar según tus necesidades
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores de la petición AJAX, si es necesario
                console.error(xhr.responseText);
            }
        });
    });

    $('#cedula_escolar').on('keyup', function () {
        var cedulaEscolar = $(this).val();

        // Realizar la petición AJAX para filtrar por cédula_escolar
        $.ajax({
            type: 'POST',
            url: '../php/busqueda_estudiante.php', // Ajusta la URL al archivo correcto
            data: { cedulaEscolar: cedulaEscolar },
            dataType: 'json',
            success: function (estudianteInfo) {
                if (estudianteInfo) {
                    // Llenar los campos con la información del estudiante
                    $('#apellidos_estudiante').val(estudianteInfo.apellidos);
                    $('#nombres_estudiante').val(estudianteInfo.nombres);
                    // Agregar el resto de campos según la estructura de tu base de datos

                    // Deshabilitar los campos
                    // $('#apellidos_estudiante').prop('disabled', true);
                    // $('#nombres_estudiante').prop('disabled', true);
                    // Deshabilitar el resto de campos según la estructura de tu formulario
                } else {
                    // Limpiar los campos si el estudiante no existe
                    $('#apellidos_estudiante, #nombres_estudiante, #otro_campo_estudiante').val('');

                    // Quitar la propiedad 'disabled'
                    $('#apellidos_estudiante').prop('disabled', false);
                    $('#nombres_estudiante').prop('disabled', false);
                    // Quitar el resto de campos según la estructura de tu formulario

                    // Mostrar un mensaje o manejar según tus necesidades
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores de la petición AJAX, si es necesario
                console.error(xhr.responseText);
            }
        });
    });
    $('#cedula_escolar').on('keyup', function () {
        var cedulaEscolar = $(this).val();

        // Realizar la petición AJAX para buscar la información del estudiante
        $.ajax({
            type: 'POST',
            url: '../php/busqueda_estudiante.php',
            data: { cedulaEscolar: cedulaEscolar },
            dataType: 'json',
            success: function (estudianteInfo) {
                if (estudianteInfo) {
                    // Llenar los campos con la información del estudiante
                    if(estudianteInfo.estado_estudiante == '1'){
                        $('#apellidos_estudiante').val(estudianteInfo.apellidos);
                        $('#nombres_estudiante').val(estudianteInfo.nombres);
                        $('#fecha_estudiante').val(estudianteInfo.fechaNacimiento);
                        $('#lugar_nacimiento').val(estudianteInfo.lugarNacimiento);
                        $('#estado_estudiante').val(estudianteInfo.estado);
                        $('#nacionalidad_estudiante').val(estudianteInfo.nacionalidad);
                        $('#procedencia_estudiante').val(estudianteInfo.procedencia);
                        $('#estado_hermano').val(estudianteInfo.estadoHermano);
                        $('#cantidad_hermano').val(estudianteInfo.cantidadHermano);
                        $('#sexo_hermano').val(estudianteInfo.sexoHermano);
                        $('#lugar_hermano').val(estudianteInfo.lugarHermano);
                        // Deshabilitar los campos
                        $('#apellidos_estudiante, #nombres_estudiante, #fecha_estudiante, #lugar_nacimiento, #estado_estudiante, #nacionalidad_estudiante, #procedencia_estudiante, #estado_hermano, #cantidad_hermano, #sexo_hermano, #lugar_hermano').prop('disabled', true);
                        $('#redirigirBtn').show();
                        $('#originalBtn').hide();
                    }
                    else{
                        if(estudianteInfo.estado_estudiante == '2'){
                            swal({
                                title: "Que pena!",
                                text: "No es posible inscribir este estudiante pues ya ha cursado o se encuentra cursando Grupo C",
                                type: "error"
                            },
                            function(isResult){
                                window.location.reload();
                            });
                        }
                    }
                   

                    
                } else {
                    
                    // Quitar la propiedad 'disabled'
                    $('#apellidos_estudiante, #nombres_estudiante, #fecha_estudiante, #lugar_nacimiento, #estado_estudiante, #nacionalidad_estudiante, #procedencia_estudiante, #estado_hermano, #cantidad_hermano, #sexo_hermano, #lugar_hermano').prop('disabled', false);
                    $('#redirigirBtn').hide();
                    $('#originalBtn').show();
                    // Mostrar un mensaje o manejar según tus necesidades
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores de la petición AJAX, si es necesario
                console.error(xhr.responseText);
            }
        });
    });
    $('#redirigirBtn').on('click', function () {
        var cedulaEscolar = $('#cedula_escolar').val();
        window.location.href = "inscripcion.php?cedulaEstudiante=" + cedulaEscolar;
    });
});
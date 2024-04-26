function showSection(sectionId) {
    var sections = document.getElementsByClassName('form-section');
    for (var i = 0; i < sections.length; i++) {
      sections[i].classList.remove('current-section');
    }
    document.getElementById(sectionId).classList.add('current-section');
  }

  function validateAndShowSection(nextSection, currentSection) {
    var form = document.getElementById(currentSection).querySelector('form');
    if (form.reportValidity()) {
      showSection(nextSection);
    }
  }
  function completeForm() {
    // Obtener los valores de los campos del estudiante
    var cedulaEstudiante = document.getElementById('cedula_escolar').value;
    var apellidosEstudiante = document.getElementById('apellidos_estudiante').value;
    var nombresEstudiante = document.getElementById('nombres_estudiante').value;
    var fechaEstudiante = document.getElementById('fecha_estudiante').value;
    var lugarNacimiento = document.getElementById('lugar_nacimiento').value;
    var estadoEstudiante = document.getElementById('estado_estudiante').value;
    var nacionalidadEstudiante = document.getElementById('nacionalidad_estudiante').value;
    var procedenciaEstudiante = document.getElementById('procedencia_estudiante').value;
    var estadoHermano = document.getElementById('estado_hermano').value;
    var cantidadHermano = document.getElementById('cantidad_hermano').value;
    var sexoHermano = document.getElementById('sexo_hermano').value;
    var lugarHermano = document.getElementById('lugar_hermano').value;

    // Obtener los valores de los campos de antecedentes prenatales
    var enfermedad = document.getElementById('enfermedad').value;
    var hospitalizado = document.getElementById('hospitalizado').value;
    var alergias = document.getElementById('alergias').value;
    var condicion = document.getElementById('condicion').value;
    var informe = document.getElementById('informe').value;
    var limitacion = document.getElementById('limitacion').value;
    var especialista = document.getElementById('especialista').value;
    var doctor = document.getElementById('doctor').value;
    var enfermarFacilidad = document.getElementById('enfermar_facilidad').value;

    // Obtener los valores de los campos del representante legal
    var cedulaRepresentante = document.getElementById('cedula_representante').value;
    var apellidosRepresentante = document.getElementById('apellidos_representante').value;
    var nombresRepresentante = document.getElementById('nombres_representante').value;
    var telefonoRepresentante = document.getElementById('telefono_representante').value;
    var codigoParentesco = document.getElementById('codigo_parentesco').value;
    var nacionalidadRepresentante = document.getElementById('nacionalidad_representante').value;

    // Obtener los valores de los campos de la madre
    var cedulaMama = document.getElementById('cedula_mama').value;
    var apellidosMama = document.getElementById('apellidos_mama').value;
    var nombresMama = document.getElementById('nombres_mama').value;
    var codigoCivilMama = document.getElementById('codigo_civilmama').value;
    var nacionalidadMama = document.getElementById('nacionalidad_mama').value;
    var fechaMama = document.getElementById('fecha_mama').value;
    var direccionHMama = document.getElementById('direccionh_mama').value;
    var telefonoHMama = document.getElementById('telefonoh_mama').value;
    var direccionTMama = document.getElementById('direcciont_mama').value;
    var telefonoTMama = document.getElementById('telefonot_mama').value;
    var nivelMama = document.getElementById('nivel_mama').value;
    var ocupacionMama = document.getElementById('ocupacion_mama').value;
    var profesionMama = document.getElementById('profesion_mama').value;
    var correoMama = document.getElementById('correo_mama').value;
    var datosMama = document.getElementById('datos_mama').value;

    // Obtener los valores de los campos del padre
    var cedulaPapa = document.getElementById('cedula_papa').value;
    var apellidosPapa = document.getElementById('apellidos_papa').value;
    var nombresPapa = document.getElementById('nombres_papa').value;
    var estadoPapa = document.getElementById('estado_papa').value;
    var nacionalidadPapa = document.getElementById('nacionalidad_papa').value;
    var fechaPapa = document.getElementById('fecha_papa').value;
    var direccionHPapa = document.getElementById('direccionh_papa').value;
    var telefonoHPapa = document.getElementById('telefonoh_papa').value;
    var direccionTPapa = document.getElementById('direcciont_papa').value;
    var telefonoTPapa = document.getElementById('telefonot_papa').value;
    var nivelPapa = document.getElementById('nivel_papa').value;
    var ocupacionPapa = document.getElementById('ocupacion_papa').value;
    var profesionPapa = document.getElementById('profesion_papa').value;
    var correoPapa = document.getElementById('correo_papa').value;
    var datosPapa = document.getElementById('datos_papa').value;

    // Obtener los valores de los campos de la persona autorizada en caso de emergencia
    var nombreCaso = document.getElementById('nombre_caso').value;
    // Enviar los datos a guardar_inscripcion.php
    $.ajax({
      type: "POST",
      url: "guardar_inscripcion.php",
      data: {
        // Datos del estudiante
        cedulaEstudiante: cedulaEstudiante,
        apellidosEstudiante: apellidosEstudiante,
        nombresEstudiante: nombresEstudiante,
        fechaEstudiante: fechaEstudiante,
        lugarNacimiento: lugarNacimiento,
        estadoEstudiante: estadoEstudiante,
        nacionalidadEstudiante: nacionalidadEstudiante,
        procedenciaEstudiante: procedenciaEstudiante,
        estadoHermano: estadoHermano,
        cantidadHermano: cantidadHermano,
        sexoHermano: sexoHermano,
        lugarHermano: lugarHermano,

        // Antecedentes prenatales
        enfermedad: enfermedad,
        hospitalizado: hospitalizado,
        alergias: alergias,
        condicion: condicion,
        informe: informe,
        limitacion: limitacion,
        especialista: especialista,
        doctor: doctor,
        enfermarFacilidad: enfermarFacilidad,

        // Representante legal
        cedulaRepresentante: cedulaRepresentante,
        apellidosRepresentante: apellidosRepresentante,
        nombresRepresentante: nombresRepresentante,
        telefonoRepresentante: telefonoRepresentante,
        codigoParentesco: codigoParentesco,
        nacionalidadRepresentante: nacionalidadRepresentante,

        // Datos de la madre
        cedulaMama: cedulaMama,
        apellidosMama: apellidosMama,
        nombresMama: nombresMama,
        codigoCivilMama: codigoCivilMama,
        nacionalidadMama: nacionalidadMama,
        fechaMama: fechaMama,
        direccionHMama: direccionHMama,
        telefonoHMama: telefonoHMama,
        direccionTMama: direccionTMama,
        telefonoTMama: telefonoTMama,
        nivelMama: nivelMama,
        ocupacionMama: ocupacionMama,
        profesionMama: profesionMama,
        correoMama: correoMama,
        datosMama: datosMama,

        // Datos del padre
        cedulaPapa: cedulaPapa,
        apellidosPapa: apellidosPapa,
        nombresPapa: nombresPapa,
        estadoPapa: estadoPapa,
        nacionalidadPapa: nacionalidadPapa,
        fechaPapa: fechaPapa,
        direccionHPapa: direccionHPapa,
        telefonoHPapa: telefonoHPapa,
        direccionTPapa: direccionTPapa,
        telefonoTPapa: telefonoTPapa,
        nivelPapa: nivelPapa,
        ocupacionPapa: ocupacionPapa,
        profesionPapa: profesionPapa,
        correoPapa: correoPapa,
        datosPapa: datosPapa,

        // Persona autorizada en caso de emergencia
        nombreCaso: nombreCaso
      },
      success: function (response) {
        // Manejar la respuesta del servidor, si es necesario
        console.log(response);
      },
      error: function (xhr, status, error) {
        // Manejar errores de la petición AJAX, si es necesario
        console.error(xhr.responseText);
      }
    });
  }
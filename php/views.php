<?php
    include "conexion.php";
    $sql = "DROP VIEW v_planillainscripcion;";
    $conexion->query($sql);
    $sql = '
    CREATE VIEW v_planillainscripcion AS
    (SELECT
    `a`.`codigo_inscripcion` AS `codigo_inscripcion`,
    `b`.`cedula_escolar` AS `cedula_estudiante`,
    `b`.`apellidos` AS `apellidos_b`,
    `b`.`Nacionalidad` AS `nacionalidad_b`,
    `b`.`nombres` AS `nombres_b`,
    `b`.`fecha_nacimiento` AS `fna_b`,
    b.edad AS edad_b,
    `b`.`lugar_nacimiento` AS `lna_b`,
    `b`.`estado` AS `estado_b`,
    `b`.`procedencia` AS `procedencia_b`,
    `b`.`estado_hermano` AS `estadoHermano_b`,
    `b`.`cantidad_hermano` AS `cantidadHermano_b`,
    `b`.`lugar_hermano` AS `lugarHermano_b`,
    `r`.`cedula_representante` AS `cedula_r`,
    `r`.`nacionalidad` AS `nacionalidad_r`,
    `r`.`nombres` AS `nombres_r`,
    `r`.`apellidos` AS `apellidos_r`,
    `r`.`telefono` AS `telefono_r`,
    `p`.`descripcion` AS `parentesco_r`,
    `m`.`cedula_mama` AS `cedula_m`,
    `m`.`codigo_nacionalidad` AS `nacionalidad_m`,
    `m`.`nombres` AS `nombres_m`,
    `m`.`apellidos` AS `apellidos_m`,
    `m`.`telefono` AS `telefono_m`,
    `m`.`codigo_estadocivil` AS `estadoCivil_m`,
    `m`.`fecha_nacimiento` AS `fecha_m`,
    m.edad AS edad_m,
    `m`.`direccion_habitacion` AS `dh_m`,
    `m`.`telefono_habitacion` AS `th_m`,
    `m`.`direccion_trabajo` AS `dt_m`,
    `m`.`telefono_trabajo` AS `tt_m`,
    `m`.`codigo_nivelacademico` AS `nivelAcademico_m`,
    `m`.`ocupacion` AS `ocupacion_m`,
    `m`.`profesion` AS `profesion_m`,
    `m`.`correo` AS `correo_m`,
    `m`.`datos_extras` AS `datos_extra_m`,
    `pp`.`cedula_papa` AS `cedula_pp`,
    `pp`.`codigo_nacionalidad` AS `nacionalidad_pp`,
    `pp`.`nombres` AS `nombres_pp`,
    `pp`.`apellidos` AS `apellidos_pp`,
    `pp`.`telefono` AS `telefono_pp`,
    `pp`.`codigo_estadocivil` AS `estadoCivil_pp`,
    `pp`.`fecha_nacimiento` AS `fecha_pp`,
    pp.edad AS edad_pp,
    `pp`.`direccion_habitacion` AS `dh_pp`,
    `pp`.`telefono_habitacion` AS `th_pp`,
    `pp`.`direccion_trabajo` AS `dt_pp`,
    `pp`.`telefono_trabajo` AS `tt_pp`,
    `pp`.`codigo_nivelacademico` AS `nivelAcademico_pp`,
    `pp`.`ocupacion` AS `ocupacion_pp`,
    `pp`.`profesion` AS `profesion_pp`,
    `pp`.`correo` AS `correo_pp`,
    `pp`.`datos_extras` AS `datos_extra_pp`,
    `ap`.`enfermedad` AS `enfermedad_AP`,
    `ap`.`hospitalizado` AS `hospitalizado_AP`,
    `ap`.`alergias` AS `alergias_AP`,
    `ap`.`condicion` AS `condicion_AP`,
    `ap`.`informe` AS `informe_AP`,
    `ap`.`limitacion` AS `limitacion_AP`,
    `ap`.`especialista` AS `especialista_AP`,
    `ap`.`doctor` AS `doctor_AP`,
    `ap`.`enfermar_facilidad` AS `enfermar_facilidad_AP`,
    `a`.`fecha` AS `fecha`, 
    ce.nombre AS caso_emergencia, 
    p1.descripcion AS parentesco_emergencia 
    from ((((((`comunitario_pagina`.`inscripcion` `a` join `comunitario_pagina`.`estudiante` `b` on(`a`.`cedula_escolar` = `b`.`cedula_escolar`)) join `comunitario_pagina`.`representante_legal` `r` on(`b`.`cedula_representante` = `r`.`cedula_representante`)) join `comunitario_pagina`.`parentesco` `p` on(`p`.`codigo_parentesco` = `r`.`codigo_parentesco`)) join `comunitario_pagina`.`mama` `m` on(`m`.`cedula_mama` = `b`.`cedula_mama`)) join `comunitario_pagina`.`papa` `pp` on(`pp`.`cedula_papa` = `b`.`cedula_papa`)) join `comunitario_pagina`.`antecedentes_paranatales` `ap` on(`ap`.`cedula_escolar` = `b`.`cedula_escolar`) JOIN caso_emergencia ce ON ce.codigo_emergencia = b.caso_emergencia) JOIN parentesco p1 ON ce.parentesco = p1.codigo_parentesco)';
    $result = $conexion->query($sql);
    $sql = "DROP VIEW v_estudiantesactivos;";
    $conexion->query($sql);
    $sql ='
    CREATE VIEW `v_estudiantesactivos` AS (select `a`.`cedula_escolar` AS `cedula_escolar`,`a`.`nombres` AS `nombres`,`a`.`apellidos` AS `apellidos`,`a`.`fecha_nacimiento` AS `fecha_nacimiento`, a.edad as edad, `a`.`lugar_nacimiento` AS `lugar_nacimiento`,`a`.`estado` AS `estado`,`a`.`codigo_nacionalidad` AS `codigo_nacionalidad`,`a`.`estado_hermano` AS `estado_hermano`,`a`.`cantidad_hermano` AS `cantidad_hermano`,`a`.`sexo_hermano` AS `sexo_hermano`,`a`.`lugar_hermano` AS `lugar_hermano`,`a`.`cedula_representante` AS `cedula_representante`,`a`.`cedula_papa` AS `cedula_papa`,`a`.`cedula_mama` AS `cedula_mama`,`a`.`caso_emergencia` AS `caso_emergencia`,`a`.`foto_estudiante` AS `foto_estudiante`,`a`.`procedencia` AS `procedencia`,`a`.`estado_estudiante` AS `estado_estudiante`,`b`.`cedula_escolar` AS `cedula_escolar_b` from ((`estudiante` `a` join `inscripcion` `b` on(`a`.`cedula_escolar` = `b`.`cedula_escolar`)) join `periodo_academico` `c` on(`c`.`codigo_periodo` = `b`.`codigo_periodo`)) where `c`.`actual` = 1)
    ';
    $conexion->query($sql);
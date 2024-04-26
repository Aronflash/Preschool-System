function openAlert(data){
    var string = `<ul style="list-style:none;padding-left:0;"><div class="p-4">
    <li style="padding:5px;margin: 5px 0;"><a class='btn btn-success btn-sm' style="width:210px;border-radius:5px;padding:5px 2px;" href='../php/generar_constancia.php?codigo_inscripcion=${data.codigo_inscripcion}' target='_blank'><i class='fa fa-edit'></i>&nbsp; Generar Constancia de Inscripcion</a></li>
    <li style="padding:5px;margin: 5px 0;"><a class='btn btn-primary btn-sm' style="width:210px;border-radius:5px;padding:5px 2px;" href='../php/generar_constanciaestudio.php?codigo_inscripcion=${data.codigo_inscripcion}&cedula_escolar=${data.cedula_escolar}' target='_blank'><i class='fa fa-edit'></i>&nbsp; Generar Constancia de Estudio</a></li>`;
    if(data.nivelDescripcion == 'Grupo C'){
        string += `<li style="padding:5px;margin: 5px 0 0 0;"><a class='btn btn-success btn-sm' style="width:210px;border-radius:5px;padding:5px 2px;" href='../php/generar_constancia_graduacion.php?codigo_inscripcion=${data.codigo_inscripcion}&cedula_escolar=${data.cedula_escolar}' target='_blank'><i class='fa fa-graduation-cap'></i>&nbsp; Generar Constancia de Graduación</a></li>`;
    }
    string += `</div></ul>`;
    swal({
        title: 'Seleccione una opción:',
        html: string,
        confirmButtonText: "Cerrar",
        confirmButtonColor: "red"
    });

    console.log(data);
}
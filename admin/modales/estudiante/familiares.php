<div class="modal fade" id="fami<?php echo $r['cedula_escolar']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 ALIGN="center">Datos del Niño(a)</h1>
            </div>
            <div class="modal-body">
                <form action="p" method="POST">
                    <input type="hidden" name="cedula_escolar" value="<?php echo $r['cedula_escolar']; ?>">

                    <label for="telefono_habitacion">Cedula de la Mama</label>
                    <input type="text" class="form-control" id="telefono_habitacion" name="telefono_habitacion"
                        placeholder="" readonly value="<?php echo $r['cedula_mama']; ?>">
                    <label for="direccion_habitacion">Nombre y Apellido de la Mama</label>
                    <input type="text" class="form-control" id="telefono_habitacion" name="telefono_habitacion"
                        placeholder="" readonly value="<?php echo $r['nombre_mama'] . ' ' . $r['apellido_mama']; ?>">
                    <label for="telefono_trabajo">Cedula del Papa</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder=""
                        readonly value="<?php echo $r['cedula_papa']; ?>">
                    <label for="telefono_trabajo">Nombre y Apellido del Papa</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder=""
                        readonly value="<?php echo $r['nombre_papa'] . ' ' . $r['apellido_papa']; ?>">
                    <label for="telefono_trabajo">Cedula del Representante</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder=""
                        readonly value="<?php echo $r['cedula_representante']; ?>">
                        <label for="telefono_trabajo">Nombre del Representante</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder=""
                        readonly value="<?php echo $r['nombre_representante'] . ' ' . $r['apellido_representante']; ?>">
                        <label for="telefono_trabajo">Caso de Emergencia</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder=""
                        readonly value="<?php echo $r['nombre_caso_emergencia']; ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
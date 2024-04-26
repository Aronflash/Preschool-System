<div class="modal fade" id="datosn<?php echo $r['cedula_escolar']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 ALIGN="center">Datos del Niño(a)</h1>
            </div>
            <div class="modal-body">
                <form action="p" method="POST">
                    <input type="hidden" name="cedula_escolar" value="<?php echo $r['cedula_escolar']; ?>">

                    <label for="direccion_habitacion">Fecha de Nacimiento</label>
                    <input type="text" class="form-control" id="telefono_habitacion" name="telefono_habitacion" placeholder="" readonly value="<?php echo $r['fecha_nacimiento']; ?>">
                    <label for="telefono_habitacion">Lugar Nacimiento</label>
                    <input type="text" class="form-control" id="telefono_habitacion" name="telefono_habitacion" placeholder="" readonly value="<?php echo $r['lugar_nacimiento']; ?>">
                    <label for="telefono_trabajo">Estado</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" readonly value="<?php echo $r['estado']; ?>">
                    <label for="telefono_trabajo">Procedencia</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" readonly value="<?php echo $r['procedencia']; ?>">
                    <label for="telefono_trabajo">Nacionalidad</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" readonly value="<?php echo $r['nacionalidad']; ?>">
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
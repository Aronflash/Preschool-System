<div class="modal fade" id="verd<?php echo $r['cedula_mama']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 ALIGN="center">Direcciones y Telefonos</h1>
            </div>
            <div class="modal-body">
                <form action="p" method="POST">
                    <input type="hidden" name="cedula_mama" value="<?php echo $r['cedula_mama']; ?>">

                    <label for="direccion_habitacion">Direccion de Habitacion</label>
                    <textarea class="form-control" id="direccion_habitacion" name="direccion_habitacion" placeholder="" readonly><?php echo $r['direccion_habitacion']; ?></textarea>

                    <label for="telefono_habitacion">Telefono de Habitacion</label>
                    <input type="text" class="form-control" id="telefono_habitacion" name="telefono_habitacion" placeholder="" readonly value="<?php echo $r['telefono_habitacion']; ?>">

                    <label for="direccion_trabajo">Direccion de Trabajo</label>
                    <textarea class="form-control" id="direccion_trabajo" name="direccion_trabajo" placeholder="" readonly><?php echo $r['direccion_trabajo']; ?></textarea>

                    <label for="telefono_trabajo">Telefono de Trabajo</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" readonly value="<?php echo $r['telefono_trabajo']; ?>">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
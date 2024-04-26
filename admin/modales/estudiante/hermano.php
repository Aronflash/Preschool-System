<div class="modal fade" id="herm<?php echo $r['cedula_escolar']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 ALIGN="center">Datos del Niño(a)</h1>
            </div>
            <div class="modal-body">
                <form action="p" method="POST">
                    <input type="hidden" name="cedula_escolar" value="<?php echo $r['cedula_escolar']; ?>">

                    <label for="direccion_habitacion">Hermanos(as)</label>
                    <input type="text" class="form-control" id="telefono_habitacion" name="telefono_habitacion" placeholder="" readonly value="<?php echo $r['estado_hermano']; ?>">
                    <label for="telefono_habitacion">Cantidad Hermano(a)</label>
                    <input type="text" class="form-control" id="telefono_habitacion" name="telefono_habitacion" placeholder="" readonly value="<?php echo $r['cantidad_hermano']; ?>">
                    <label for="telefono_trabajo">Sexo del Hermano(a)</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" readonly value="<?php echo $r['sexo_hermano']; ?>">
                    <label for="telefono_trabajo">Lugar Hermano(a)</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" readonly value="<?php echo $r['lugar_hermano']; ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
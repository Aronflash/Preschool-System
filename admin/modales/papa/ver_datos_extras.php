<div class="modal fade" id="verde<?php echo $r['cedula_papa']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 ALIGN="center">Informacion adicional</h1>
            </div>
            <div class="modal-body">
                <form action="p" method="POST">
                    <input type="hidden" name="cedula_papa" value="<?php echo $r['cedula_papa']; ?>">

                    <label for="direccion_habitacion">Estado Civil</label>
                    <input type="text" class="form-control" id="telefono_habitacion" name="telefono_habitacion" placeholder="" readonly value="<?php echo $r['estadoc']; ?>">
                    <label for="telefono_habitacion">Nacionalidad</label>
                    <input type="text" class="form-control" id="telefono_habitacion" name="telefono_habitacion" placeholder="" readonly value="<?php echo $r['nacionalidad']; ?>">
                    <label for="telefono_trabajo">Nivel Academico</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" readonly value="<?php echo $r['nivela']; ?>">
                    <label for="telefono_trabajo">Ocupacion</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" readonly value="<?php echo $r['ocupacion']; ?>">
                    <label for="telefono_trabajo">Profesion</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" readonly value="<?php echo $r['profesion']; ?>">
                    <label for="telefono_trabajo">Datos Extras</label>
                    <input type="text" class="form-control" id="telefono_trabajo" name="telefono_trabajo" placeholder="" readonly value="<?php echo $r['datos_extras']; ?>">
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
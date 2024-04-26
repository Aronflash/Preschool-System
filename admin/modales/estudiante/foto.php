<div class="modal fade" id="foto<?php echo $r['cedula_escolar']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 ALIGN="center">Foto del Estudiante</h1>
            </div>
            <div class="modal-body">
                <form action="p" method="POST">
                    <input type="hidden" name="cedula_escolar" value="<?php echo $r['cedula_escolar']; ?>">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($r['foto_estudiante']); ?>" class="card-img-top rounded-0"  height="400" alt="...">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
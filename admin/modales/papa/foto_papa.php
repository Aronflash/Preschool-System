<div class="modal fade" id="ver<?php echo $r['cedula_papa']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 ALIGN="center">Foto del Padre</h1>
            </div>
            <div class="modal-body">
                <form action="p" method="POST">
                    <input type="hidden" name="cedula_papa" value="<?php echo $r['cedula_papa']; ?>">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($r[15]); ?>" class="card-img-top rounded-0"  height="400" alt="...">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ver<?php echo $r['cedula_representante']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 ALIGN="center">Foto del Representante Legal</h1>
            </div>
            <div class="modal-body">
                <form action="p" method="POST">
                    <input type="hidden" name="cedula_representante" value="<?php echo $r['cedula_representante']; ?>">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($r[5]); ?>" class="card-img-top rounded-0"  height="400" alt="...">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
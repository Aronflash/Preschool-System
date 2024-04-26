<div class="modal fade" id="elim<?php echo $r['cedula_mama']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white"><h4>Eliminar Madre</h4></div>
            <div class="modal-body">
                <form action="../php/eliminar/eliminar_mama.php" method="POST">
                    <input type="hidden" name="cedula_mama" value="<?php echo $r['cedula_mama']; ?>">
                    <p class="text-center">¿Está seguro de eliminar al Madre <?php echo $r['nombres'] ?>?</p>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

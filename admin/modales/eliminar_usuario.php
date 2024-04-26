<div class="modal fade" id="elim<?php echo $r['codigo_usuario']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white"><h4>Eliminar Usuario</h4></div>
            <div class="modal-body">
                <form action="../php/eliminar/eliminar_usuario.php" method="POST">
                    <input type="hidden" name="codigo_usuario" value="<?php echo $r['codigo_usuario']; ?>">
                    <p class="text-center">¿Está seguro de eliminar al Usuario <?php echo $r['nombre_usuario'] ?>?</p>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

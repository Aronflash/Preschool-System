<div class="modal fade" id="act<?php echo $r['codigo_nivelseccion']; ?>">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white"><h4>Activar Nivel Academico/Seccion</h4></div>
            <div class="modal-body">
                <form action="../php/activar_nivel.php" method="POST">
                    <input type="hidden" name="codigo_nivelseccion" value="<?php echo $r['codigo_nivelseccion']; ?>">
                    <p class="text-center">¿Está seguro de activar el Nivel <?php echo $r['descripcion'] ?> y Seccion <?php echo $r['nombre'] ?> ?</p>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Confirmar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

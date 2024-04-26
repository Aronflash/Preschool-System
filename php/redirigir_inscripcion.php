
<script>
    <?php echo "
        alert('Inscripción realizada con éxito.');
        window.open('./generar_planillainscripcion.php?codigo_inscripcion=$codigoInscripcion', '_blank');
        setTimeout(function(){
            window.location.href = '../admin/registroestudiante.php';
        }, 1000);";
    ?>
</script>

<?php
    require_once("c://laragon/www/CRUD_APRENDICES/Views/head/head.php");

?>

    <form action="store.php" method="POST" autocomplete="off">

        <div class="mb-3">
            <label for="primer_nombre" class="form-label">Primer Nombre:</label>
            <input type="text" class="form-control" id="primer_nombre" name="primer_nombre" required ="">
        </div>
        
        <button type="submit" class="btn btn-primary">Crear</button>
        <a class="btn btn-danger" href="index.php">Cancelar</a>
    </form>

<?php
    require_once("c://laragon/www/CRUD_APRENDICES/Views/head/footer.php");
?>
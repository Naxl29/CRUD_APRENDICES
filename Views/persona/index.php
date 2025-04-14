<?php
    require_once("c://laragon/www/CRUD_APRENDICES/Views/head/head.php");
    require_once("c://laragon/www/CRUD_APRENDICES/Controllers/PersonaController.php");
    $obj = new PersonaController();
    $rows = $obj->index();
?>
<div class="mb-3">
    <a href="/CRUD_APRENDICES/Views/persona/create.php" class="btn btn-primary">Agregar nueva persona</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Número de documento</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if($rows): ?>
            <?php foreach($rows as $row): ?>
                <tr>
                    <th><?= $row['id'] ?></th>
                    <th><?= $row['primer_nombre'] . ' ' . $row['segundo_nombre'] ?></th>
                    <th><?= $row['primer_apellido'] . ' ' . $row['segundo_apellido'] ?></th>
                    <th><?= $row['n_documento'] ?></th>
                    <th>
                        <a href="show.php?id=<?= $row[0] ?>" class="btn btn-primary">Ver</a>
                        <a href="edit.php?id=<?= $row[0] ?>" class="btn btn-success">Actualizar</a>
                    </th>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3" class="text-center">No hay registros</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
    require_once("c://laragon/www/CRUD_APRENDICES/Views/head/footer.php");
?>
<?php
    require_once("c://laragon/www/CRUD_APRENDICES/Controllers/PersonaController.php");
    $obj = new PersonaController();
    $obj->guardar($_POST['primer_nombre']);
    
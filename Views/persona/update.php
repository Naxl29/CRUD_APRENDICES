<?php
        require_once("c://laragon/www/CRUD_APRENDICES/Controllers/PersonaController.php");
        $obj = new PersonaController();
        $obj->update($_POST['id'], $_POST['primer_nombre']);
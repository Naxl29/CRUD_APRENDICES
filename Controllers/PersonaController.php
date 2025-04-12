<?php

require_once '../Models/Persona.php';
require_once '../Views/PersonaView.php';

class PersonaController
{
    private $view;
    private $model;

    public function __construct()
    {
        $this->view = new PersonaView();
        $this->model = new Persona();
    }

    public function store()
    {
        $datos = $_POST; // Obtener los datos del formulario

        $resultado = $this->model->crearPersona($datos);

        if (is_numeric($resultado)) {
            // Éxito: Redirigir o mostrar un mensaje
            $this->view->mostrarCrearPersona('Registro creado correctamente', 'success');
        } else {
            // Error: Mostrar un mensaje de error
            $this->view->mostrarCrearPersona('Error al crear el registro: ' . $resultado, 'danger', $datos);
        }
    }

    // ... (Otros métodos del controlador)

    public function handleRequest()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : '';

        switch ($action) {
            case 'store':
                $this->store();
                break;
            // Otros casos para editar, eliminar, etc.
            default:
                // Acción por defecto o error
                break;
        }
    }
}

$controller = new PersonaController();
$controller->handleRequest();

?>
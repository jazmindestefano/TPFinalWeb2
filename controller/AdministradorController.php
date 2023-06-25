<?php

class AdministradorController
{
    private $administradorModel;
    private $renderer;


    public function __construct($administradorModel, $renderer)
    {
        $this->administradorModel = $administradorModel;
        $this->renderer = $renderer;
    }


    public function list()
    {
        $cantUsuariosMenores = $this->administradorModel->getCantidadDeUsuariosMenores()[0][0];
        $cantUsuariosMayores = $this->administradorModel->getCantidadDeUsuariosMayores()[0][0];
        $cantUsuariosJubilados = $this->administradorModel->getCantidadDeUsuariosJubilados()[0][0];



        $data = array(
            "cantUsuariosMenores" => $cantUsuariosMenores,
            "cantUsuariosMayores" => $cantUsuariosMayores,
            "cantUsuariosJubilados" => $cantUsuariosJubilados
        );
        $this->renderer->render('vistaDelAdministrador', $data);
    }




    public function filtrar()
    {
        $filtro = $_GET['filtro'];

        switch ($filtro) {
            case 'aprobada':
                $preguntas = $this->editorModel->getPreguntasPorAprobadas();
                break;
            case 'reportada':
                $preguntas = $this->editorModel->getPreguntasPorReportadas();
                break;
            case 'desaprobada':
                $preguntas = $this->editorModel->getPreguntasPorDesaprobados();
                break;
            default:
                $preguntas = $this->editorModel->getPreguntasByIdASC();
                break;
        }
        $response = ['preguntas' => $preguntas];

        header('Content-Type: application/json');
        echo json_encode($response);
    }


}

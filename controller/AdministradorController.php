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

        $cantUsuariosSexoFemenino = $this->administradorModel->getCantidadDeUsuariosPorSexoFemenino()[0][0];
        $cantUsuariosSexoMasculino = $this->administradorModel->getCantidadDeUsuariosPorSexoMasculino()[0][0];
        $cantUsuariosSexoOtro = $this->administradorModel->getCantidadDeUsuariosPorSexoOtro()[0][0];

        $provConMasUsuarios = $this->administradorModel->getProvinciaConMasUsuarios();
        $segProvConMasUsuarios = $this->administradorModel->getSegundaProvinciaConMasUsuarios();
        $terProvConMasUsuarios = $this->administradorModel->getTerceraProvinciaConMasUsuarios();

        $primeraProvincia = $provConMasUsuarios[0]['ubicacion'];
        $cantidadUsersPrimeraProvincia = $provConMasUsuarios[0]['cantidadUsuarios'];

        $segundaProvincia = $segProvConMasUsuarios[0]['ubicacion'];
        $cantidadUsersSegundaProvincia = $segProvConMasUsuarios[0]['cantidadUsuarios'];

        $terceraProvincia = $terProvConMasUsuarios[0]['ubicacion'];
        $cantidadUsersTerceraProvincia = $terProvConMasUsuarios[0]['cantidadUsuarios'];

        $UsuarioMasPreguntasRespondidas = $this->administradorModel->getUsuarioConMayorPorcentajeDePreguntasRespondidasCorrectamente();




        $data = array(
            "cantUsuariosMenores" => $cantUsuariosMenores,
            "cantUsuariosMayores" => $cantUsuariosMayores,
            "cantUsuariosJubilados" => $cantUsuariosJubilados,
            "cantUsuariosSexoFemenino" =>$cantUsuariosSexoFemenino,
            "cantUsuariosSexoMasculino" =>$cantUsuariosSexoMasculino,
            "cantUsuariosSexoOtro" =>$cantUsuariosSexoOtro,
            "primeraProvincia" =>$primeraProvincia,
            "cantidadUsersPrimeraProvincia" => $cantidadUsersPrimeraProvincia,
            "segundaProvincia"=>$segundaProvincia,
            "cantidadUsersSegundaProvincia" =>$cantidadUsersSegundaProvincia,
            "terceraProvincia"=>$terceraProvincia,
            "cantidadUsersTerceraProvincia"=>$cantidadUsersTerceraProvincia
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

<?php

class AdministradorModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getCantidadTotalDeJugadores()
    {
        $query = "SELECT count(idUsuario) FROM usuarios WHERE rol = 'jugador'";
        return $this->database->query($query);
    }

    public function getCantidadTotalDePartidasJugadas()
    {
        $query = "SELECT SUM(partidasJugadas) FROM usuarios";
        return $this->database->query($query);
    }

    public function getCantidadTotalDePreguntas()
    {
        $query = "SELECT count(idPregunta) FROM preguntas";
        return $this->database->query($query);
    }

    public function getCantidadTotalDePreguntasCreadasPorUsuarios()
    {
        $query = "SELECT count(idPregunta) FROM preguntas WHERE creadaPorUsuario = '1'";
        return $this->database->query($query);
    }

    public function getCantidadTotalDeUsuariosNuevos()
    {
        $query = "SELECT count(idUsuario) FROM usuarios WHERE fechaDeRegistro > '2023-06-20'";
        return $this->database->query($query);
    }

    public function getPorcentajeDePreguntasRespondidasCorrectamentePorUsuario()
    {
        $query = "SELECT idUsuario, (COUNT(CASE WHEN acertada = 1 THEN 1 END) / COUNT(*)) * 100 FROM preguntasrespondidas GROUP BY idUsuario";
        return $this->database->query($query);
    }

    public function getCantidadDeUsuariosPorPais()
    {
        $query = "SELECT count(idUsuario), ubicacion FROM usuarios GROUP BY ubicacion";
        return $this->database->query($query);
    }

    public function getCantidadDeUsuariosPorSexoFemenino()
    {
        $query = "SELECT count(idUsuario), sexo FROM usuarios WHERE sexo = 'femenino'";
        return $this->database->query($query);
    }

    public function getCantidadDeUsuariosPorSexoMasculino()
    {
        $query = "SELECT count(idUsuario), sexo FROM usuarios WHERE sexo = 'masculino'";
        return $this->database->query($query);
    }

    public function getCantidadDeUsuariosPorSexoOtro()
    {
        $query = "SELECT count(idUsuario), sexo FROM usuarios WHERE sexo = 'otro'";
        return $this->database->query($query);
    }

    public function getCantidadDeUsuariosMenores()
    {
        $query = "SELECT COUNT(idUsuario) FROM usuarios WHERE DATEDIFF(CURDATE(), fechaDeNacimiento) < 6570";
        return $this->database->query($query);
    }

    public function getCantidadDeUsuariosMayores()
    {
        $query = "SELECT COUNT(idUsuario) FROM usuarios WHERE DATEDIFF(CURDATE(), fechaDeNacimiento) >= 6570 AND DATEDIFF(CURDATE(), fechaDeNacimiento) < 23725";
        return $this->database->query($query);
    }
    public function getCantidadDeUsuariosJubilados()
    {
        $query = "SELECT COUNT(idUsuario) FROM usuarios WHERE DATEDIFF(CURDATE(), fechaDeNacimiento) >= 23725";
        return $this->database->query($query);
    }

}
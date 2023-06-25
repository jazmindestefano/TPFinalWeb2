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

    public function getCantidadDeUsuariosPorSexo()
    {
        $query = "SELECT count(idUsuario), sexo FROM usuarios GROUP BY sexo";
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
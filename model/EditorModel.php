<?php

	class EditorModel

	{
		private $database;

		public function __construct($database) {
			$this->database = $database;
		}


        public function listaDePreguntas(){
            $query = "SELECT * FROM preguntas";
            return $this->database->query($query);
        }
        public function aprobarPregunta($idPregunta){
            $query = "UPDATE preguntas SET estado='aprobado' WHERE idPregunta='$idPregunta'";
            return $this->database->insert($query);
        }

        public function desaprobarPregunta($idPregunta){
            $query = "UPDATE preguntas SET estado='desaprobado' WHERE idPregunta='$idPregunta'";
            return $this->database->insert($query);
        }


        public function eliminarPregunta($idPregunta){
            $query = "DELETE FROM preguntas WHERE idPregunta='$idPregunta'";
            return $this->database->insert($query);
        }

	}
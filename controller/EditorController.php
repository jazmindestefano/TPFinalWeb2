<?php

    class EditorController
    {
        private $editorModel;
        private $renderer;


        public function __construct($editorModel, $renderer)
        {
            $this->editorModel = $editorModel;
            $this->renderer = $renderer;
        }


        public function list()
        {

            $listaDePreguntas = $this->editorModel->listaDePreguntas();
            $data = array("preguntas" => $listaDePreguntas);
            $this->renderer->render('vistaDelEditor', $data);


        }

        public function aprobar()
        {
            $idPregunta = $_GET["id_pregunta"];
            $this->editorModel->aprobarPregunta($idPregunta);
            header("Location: /editor");


        }

        public function desaprobar()
        {
            $idPregunta = $_GET["id_pregunta"];
            $this->editorModel->desaprobarPregunta($idPregunta);
            header("Location: /editor");


        }


        public function eliminar()
        {
            $idPregunta = $_GET["id_pregunta"];
            $this->editorModel->eliminarPregunta($idPregunta);
            header("Location: /editor");


        }

        public function editar()
        {
            $idPregunta = $_GET["id_pregunta"];
            $this->editorModel->editarPregunta($idPregunta);
            header("Location: /editor");


        }

        public function preguntaDetalle()
        {
            $idPregunta = $_GET["idPregunta"];
            $pregunta= $this->editorModel->getPreguntaById($idPregunta);
            $respuestas=$this->editorModel->getRespuestasByIdDePregunta($idPregunta);

            $data= array("pregunta"=>$pregunta,
                "respuestas"=>$respuestas);

            $this->renderer->render('preguntaDetalle', $data);



        }

        public function filtrar()
        {

            $filtro = $_GET['filtro'];

            switch ($filtro) {
                case 'aprobadas':
                    $preguntas = $this->editorModel->getPreguntasPorAprobadas();
                    break;
                case 'reportadas':
                    $preguntas = $this->editorModel->getPreguntasPorDesaprobado();
                    break;
                case 'sugeridas':
                    $preguntas = $this->editorModel->getPreguntasPorSugeridas();
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




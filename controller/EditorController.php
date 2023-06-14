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


        public function editor()
        {

            $listaDePreguntas=$this->editorModel->listaDePreguntas();
            $data= array("preguntas"=>$listaDePreguntas);
            $this->renderer->render('vistaDelEditor',$data);


        }

        public function aprobar()
        {
            $idPregunta=$_GET["id_pregunta"];
            $this->editorModel->aprobarPregunta($idPregunta);
            header("Location: /editor/editor");


        }

        public function desaprobar()
        {
            $idPregunta=$_GET["id_pregunta"];
            $this->editorModel->desaprobarPregunta($idPregunta);
            header("Location: /editor/editor");


        }


        public function eliminar()
        {
            $idPregunta=$_GET["id_pregunta"];
            $this->editorModel->eliminarPregunta($idPregunta);
            header("Location: /editor/editor");


        }


        public function filtrar()
        {

            $filtro = $_GET['filtroEditor'];

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
                    $preguntas = $this->editorModel->getPreguntasById();
                    break;
            }

            $response = ['preguntas' => $preguntas];

            header('Content-Type: application/json');
            echo json_encode($response);
        }


    }




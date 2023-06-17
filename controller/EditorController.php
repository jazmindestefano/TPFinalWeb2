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


	public function eliminar()
	{

		$idPregunta = $_GET["id_pregunta"];

		$this->editorModel->eliminarRespuestasDePregunta($idPregunta);
		$this->editorModel->eliminarPreguntaById($idPregunta);

		header("Location: /editor");
	}

    public function editar()
    {
        $idPregunta = $_POST["idPregunta"];
        $pregunta = $_POST["pregunta"];
        $categoria = $_POST["categoria"];
        $respuestas = $_POST["idRespuesta"];


        $AIdRespuesta = $_POST["idRespuesta"][0];
        $ARespuesta = $_POST["respuesta"][0];
        $AEsCorrecta = $_POST["escorrecto"][0];


        $BIdRespuesta = $_POST["idRespuesta"][1];
        $BRespuesta = $_POST["respuesta"][1];
        $BEsCorrecta = $_POST["escorrecto"][1];


        $CIdRespuesta = $_POST["idRespuesta"][2];
        $CRespuesta = $_POST["respuesta"][2];
        $CEsCorrecta = $_POST["escorrecto"][2];


        $DIdRespuesta = $_POST["idRespuesta"][3];
        $DRespuesta = $_POST["respuesta"][3];
        $DEsCorrecta = $_POST["escorrecto"][3];


        $this->editorModel->editarPregunta($idPregunta, $pregunta, $categoria);
        $this->editorModel->editarRespuesta($AIdRespuesta, $ARespuesta, $AEsCorrecta);
        $this->editorModel->editarRespuesta($BIdRespuesta, $BRespuesta, $BEsCorrecta);
        $this->editorModel->editarRespuesta($CIdRespuesta, $CRespuesta, $CEsCorrecta);
        $this->editorModel->editarRespuesta($DIdRespuesta, $DRespuesta, $DEsCorrecta);
        header("Location: /editor");


    }

    public function preguntaDetalle()
    {
        $idPregunta = $_GET["idPregunta"];
        $pregunta = $this->editorModel->getPreguntaById($idPregunta);
        $respuestas = $this->editorModel->getRespuestasByIdDePregunta($idPregunta);

        $categorias = ['Historia', 'General', 'Arte', 'Geografia', 'Quimica'];


        // Encontrar la posición del elemento de la pregunta categoria en el array
        $posicionCategoria = array_search($pregunta[0]['categoria'], $categorias);
        if ($posicionCategoria !== false && $posicionCategoria !== 0) {
            unset($categorias[$posicionCategoria]);
            // Insertar el elemento "Arte" en la primera posición del array
            array_unshift($categorias, $pregunta[0]['categoria']);
        }

        $data = array("pregunta" => $pregunta,
            "respuestas" => $respuestas,
            "categorias" => $categorias);

        $this->renderer->render('preguntaDetalle', $data);
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




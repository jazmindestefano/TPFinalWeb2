function filtrar() {
    let filtro = $("#filtro").val();
    if (filtro) {
        $.ajax({
            url: 'http://localhost/editor/filtrar',
            method: "GET",
            data: {filtro: filtro},
            success: function (response) {

                $("#editor-table tbody").empty();

                response.preguntas.forEach(function (pregunta) {
                    let fila = `
                                <tr>
                                    <td><a href="#">${pregunta.pregunta}</a></td>
                                     <td><p>${pregunta.estado}</p></td>
                                    <td>  <a href="/editor/aprobar&id_pregunta={{idPregunta}}"> <button type="submit" class="btn-gral">Aprobar</button></a> <a href="/editor/desaprobar&id_pregunta={{idPregunta}}"> <button type="submit" class="btn-gral">desaprobar</button></a>
                                      <a href="/editor/eliminar&id_pregunta={{idPregunta}}"> <button type="submit" class="btn-gral">Eliminar</button></a> </td>
                                    </tr>`;
                    $("#editor-table tbody").append(fila);
                });
            },

            error: function () {
                alert("Error");
            }
        });
    }
}

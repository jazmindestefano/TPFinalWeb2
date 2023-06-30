function filtrar() {
    let filtro = $("#filtro").val();
    if (filtro) {
        $.ajax({
            url: 'http://localhost/ranking/filtrar',
            method: "GET",
            data: {filtro: filtro},
            success: function (response) {
                console.log(response)

                $("#ranking-table tbody").empty();

                response.users.forEach(function (user) {
                    let fila = `<tr>
                                <td>${user.posicion}</td>
                                <td><a href="/perfil/perfil&idUsuario=${user.idUsuario}">${user.username}</a></td>
                                <td>${user.puntaje}</td>
                                <td>${user.partidasJugadas}</td>
                            </tr>`;
                    $("#ranking-table tbody").append(fila);
                });
            },

            error: function () {
                alert("Error");
            }
        });
    }
}
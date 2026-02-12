<header>
    <p>APLICACIÓN FINAL</p>
    <h2>MANTENIMIENTO USUARIOS</h2>
    <form method="post">
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <div class="controlMtoUsuarios">
        <form method="post">
            <input type="submit" name="volver" value="Volver" id="volverMtoUsuarios" />
        </form>
        <input type="text" name="DescUsuarioBuscado" class="buscar" id="campoBusquedaUsuario" />
    </div>
    <table id="tablaUsuarios">
        <thead>
            <th>Codigo</th>
            <th>Descripción</th>
            <th>Numero Conexiones</th>
            <th>Fecha Ultima Conexion</th>
            <th>Perfil</th>
            <th>Acciones</th>
        </thead>
    </table>

    <script>
        var tablaUsuarios = document.getElementById("tablaUsuarios");

        function mostrarUsuarios(usuarios) {
            tablaUsuarios.innerHTML = `<thead>
                    <th>Codigo</th>
                    <th>Descripción</th>
                    <th>Numero Conexiones</th>
                    <th>Fecha Ultima Conexion</th>
                    <th>Perfil</th>
                    <th>Acciones</th>
                    <th>Acciones</th>
                </thead>`;
            for (i = 0; i < usuarios.length; i++) {
                var fila = document.createElement("tr");

                var celda1 = document.createElement("td");
                celda1.textContent = usuarios[i].codUsuario;
                fila.appendChild(celda1);

                celda2 = document.createElement("td");
                celda2.textContent = usuarios[i].descUsuario;
                fila.appendChild(celda2);

                celda3 = document.createElement("td");
                celda3.textContent = usuarios[i].numConexiones;
                fila.appendChild(celda3);

                celda4 = document.createElement("td");
                celda4.textContent = usuarios[i].fechaHoraUltimaConexion.date;
                fila.appendChild(celda4);

                celda5 = document.createElement("td");
                celda5.textContent = usuarios[i].perfilUsuario;
                fila.appendChild(celda5);

                tablaUsuarios.appendChild(fila);

            }
        }

        var urlApi = "http://192.168.1.100/AHFDWESAplicacionFinal/api/wsBuscaUsuariosPorDesc.php";

        fetch(urlApi)
            .then((response) => {
                return response.json()
            })

            .then((datos) => {
                mostrarUsuarios(datos);
            })

        var inputBusqueda = document.getElementById("campoBusquedaUsuario");

        inputBusqueda.addEventListener("input", () => {

            fetch(urlApi + "?descUsuario=" + inputBusqueda.value)
                .then((response) => {
                    return response.json()
                })

                .then((datos) => {
                    mostrarUsuarios(datos);
                })
        })
    </script>
</main>
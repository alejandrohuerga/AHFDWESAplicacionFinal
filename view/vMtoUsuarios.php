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
                    <th>Borrar</th>
                    <th>Editar</th>
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

                // --- COLUMNA BORRAR (Ahora va primero) ---
                var celdaBorrar = document.createElement("td");
                celdaBorrar.style.textAlign = "center";

                var btnEliminar = document.createElement("button");
                btnEliminar.textContent = "Eliminar";
                btnEliminar.style.fontSize = "11px";
                btnEliminar.style.padding = "2px 8px";
                btnEliminar.style.backgroundColor = "#ff4d4d";
                btnEliminar.style.color = "white";
                btnEliminar.style.border = "none";
                btnEliminar.style.cursor = "pointer";
                btnEliminar.style.borderRadius = "3px";

                const codUsuarioFila = usuarios[i].codUsuario;
                btnEliminar.onclick = function() {
                    eliminarUsuarioEnApi(codUsuarioFila);
                };
                celdaBorrar.appendChild(btnEliminar);
                fila.appendChild(celdaBorrar);

                var celdaEditar = document.createElement("td");
                celdaEditar.style.textAlign = "center";
                
                var btnConsultar = document.createElement("button");
                btnConsultar.textContent = "Consultar";
                btnConsultar.style.fontSize = "11px";
                btnConsultar.style.padding = "2px 8px";
                btnConsultar.style.backgroundColor = "#3498db";
                btnConsultar.style.color = "white";
                btnConsultar.style.border = "none";
                btnConsultar.style.cursor = "pointer";
                btnConsultar.style.borderRadius = "3px";
                
                const objetoUsuario = usuarios[i];
                btnConsultar.onclick = function() {
                    mostrarUsuarioDesc(objetoUsuario);
                };
                celdaEditar.appendChild(btnConsultar);
                fila.appendChild(celdaEditar);

                tablaUsuarios.appendChild(fila);
            }
        }

<<<<<<< HEAD
        var urlApi = "https://alejandrohuefer.ieslossauces.es//AHFDWESAplicacionFinal/api/wsBuscaUsuariosPorDesc.php";
=======
        var urlApi = "http://192.168.1.100/AHFDWESAplicacionFinal/api/wsBuscaUsuariosPorDesc.php";
>>>>>>> developerAHF

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

        function eliminarUsuarioEnApi(codigo) {
            let fondoCnf = document.createElement("div");
            fondoCnf.style = "position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); display:flex; justify-content:center; align-items:flex-start; z-index:4000; padding-top:80px;";

            let tarjetaCnf = document.createElement("div");
            tarjetaCnf.style = "background:white; padding:25px; border-radius:10px; width:320px; box-shadow:0px 10px 30px rgba(0,0,0,0.5); text-align:center; animation: caer 0.3s ease-out;";

            tarjetaCnf.innerHTML = `
                <h3 style="margin-top:0; color:#333;">¿Confirmar eliminación?</h3>
                <p style="color:#666; font-size:14px; margin-bottom:20px;">Estás a punto de borrar al usuario <b>${codigo}</b>. Esta acción no se puede deshacer.</p>
                <div style="display:flex; justify-content:center; gap:10px;">
                    <button id="btnConfirmarSi" style="padding:8px 15px; background:#ff4d4d; color:white; border:none; border-radius:4px; cursor:pointer; font-weight:bold;">Sí, Eliminar</button>
                    <button id="btnConfirmarNo" style="padding:8px 15px; background:#ccc; color:#333; border:none; border-radius:4px; cursor:pointer;">Cancelar</button>
                </div>
            `;

            fondoCnf.appendChild(tarjetaCnf);
            document.body.appendChild(fondoCnf);

            document.getElementById("btnConfirmarNo").onclick = () => fondoCnf.remove();
            document.getElementById("btnConfirmarSi").onclick = () => {
                fondoCnf.remove(); // Quitamos el de confirmación y procedemos al fetch
                var urlApiEliminar = "http://192.168.1.100/AHFDWESAplicacionFinal/api/wsEliminarUsuario.php?codUsuario=" + codigo;

                fetch(urlApiEliminar)
                    .then(r => r.json())
                    .then(datos => {
                        let fondoRes = document.createElement("div");
                        fondoRes.style = "position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); display:flex; justify-content:center; align-items:flex-start; z-index:5000; padding-top:80px;";
                        let tarjetaRes = document.createElement("div");
                        tarjetaRes.style = "background:white; padding:25px; border-radius:10px; width:320px; box-shadow:0px 10px 30px rgba(0,0,0,0.5); text-align:center; animation: caer 0.3s ease-out;";

                        if (datos.resultado) {
                            tarjetaRes.innerHTML = `
                                <h3 style="margin-top:0; color:#27ae60;">¡Logrado!</h3>
                                <p style="color:#666; font-size:14px;">Usuario <b>${codigo}</b> eliminado correctamente.</p>
                                <button id="btnFinalizar" style="margin-top:15px; padding:8px 25px; background:#27ae60; color:white; border:none; border-radius:4px; cursor:pointer; width:100%;">Aceptar</button>`;
                        } else {
                            tarjetaRes.innerHTML = `
                                <h3 style="margin-top:0; color:#ff4d4d;">Error</h3>
                                <p style="color:#666; font-size:14px;">${datos.error}</p>
                                <button id="btnFinalizar" style="margin-top:15px; padding:8px 25px; background:#333; color:white; border:none; border-radius:4px; cursor:pointer; width:100%;">Cerrar</button>`;
                        }

                        fondoRes.appendChild(tarjetaRes);
                        document.body.appendChild(fondoRes);

                        document.getElementById("btnFinalizar").onclick = () => {
                            fondoRes.remove();
                            if (datos.resultado) location.reload(); 
                        };
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Error crítico en la comunicación con la API.");
                    });
            };
        }

        function mostrarUsuarioDesc(usuario) {
            let modalPrevio = document.getElementById("modalDetalle");
            if (modalPrevio) modalPrevio.remove();

            let fondo = document.createElement("div");
            fondo.id = "modalDetalle";
            fondo.style = `
                position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                background: rgba(0,0,0,0.7); display: flex; justify-content: center;
                align-items: flex-start; z-index: 1000; padding-top: 50px;
            `;

            let tarjeta = document.createElement("div");
            tarjeta.style = `
                background: white; padding: 25px; border-radius: 12px; width: 380px;
                box-shadow: 0 15px 35px rgba(0,0,0,0.4); position: relative;
                font-family: Arial, sans-serif; animation: caer 0.3s ease-out;
            `;

            if (!document.getElementById("estiloModal")) {
                let estilo = document.createElement("style");
                estilo.id = "estiloModal";
                estilo.innerHTML = "@keyframes caer { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }";
                document.head.appendChild(estilo);
            }

            tarjeta.innerHTML = `
                <h2 style="margin-top:0; color:#2c3e50; border-bottom:2px solid #3498db; padding-bottom:10px;">Detalles Usuario</h2>
                <div style="line-height: 1.8; color: #34495e;">
                    <p><strong>Código:</strong> ${usuario.codUsuario}</p>
                    <p><strong>Descripción:</strong> ${usuario.descUsuario}</p>
                    <p><strong>Nº Conexiones:</strong> ${usuario.numConexiones}</p>
                    <p><strong>Perfil:</strong> ${usuario.perfilUsuario}</p>
                    <p><strong>Última Conexión:</strong> ${usuario.fechaHoraUltimaConexion.date || 'N/A'}</p>
                </div>
                <button id="cerrarBtn" style="
                    width: 100%; margin-top: 20px; padding: 10px; background: #2c3e50;
                    color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold;
                ">Cerrar</button>
            `;

            fondo.appendChild(tarjeta);
            document.body.appendChild(fondo);

            document.getElementById("cerrarBtn").onclick = () => fondo.remove();
            
            fondo.onclick = (e) => { if (e.target === fondo) fondo.remove(); };
        }

    </script>
</main>
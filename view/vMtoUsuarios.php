<header>
    <p>APLICACIÓN FINAL</p>
    <h2>MANTENIMIENTO USUARIOS</h2>
    <form method="post">
        <input type="submit" name="cerrarSesion" value="Cerrar Sesion" />
    </form>
</header>
<main>
    <input type="text" name="DescUsuarioBuscado" class="buscar" value="" id="campoBusquedaUsuario"/>
    <table id="tablaUsuarios">
        <thead> 
                <td>Codigo</td>
                <td>Descripción</td>
                <td>Numero Conexiones</td>
                <td>Fecha Ultima Conexion</td>
                <td>Perfil</td>
                <td>Acciones</td>
                <td>Acciones</td>
        </thead>
    </table>
    <form method="post">
        <input type="submit" name="volver" value="Volver" />
    </form>
    <script>
        var tablaUsuarios=document.getElementById("tablaUsuarios");
        function mostrarUsuarios(usuarios){
            
            for(i=0;i<usuarios.length;i++){
                var fila=document.createElement("tr");
                var celda=document.createElement("td");
                celda.textContent=usuarios[i].codUsuario;
                fila.appendChild(celda);
                celda=document.createElement("td");
                celda.textContent=usuarios[i].descUsuario;
                fila.appendChild(celda);
                celda=document.createElement("td");
                celda.textContent=usuarios[i].numConexiones;
                fila.appendChild(celda);
                tablaUsuarios.appendChild(fila);
            }
        }

        var urlApi="http://daw202.local.ieslossauces.es/AHFDWESAplicacionFinal/api/wsBuscaUsuariosPorDesc.php";
    
        fetch(urlApi)
            .then((response)=>{
                return response.json()
            })

            .then((datos)=>{
                mostrarUsuarios(datos);
            })

        var inputBusqueda=document.getElementById("campoBusquedaUsuario");
        
        inputBusqueda.addEventListener("keyup",(event)=>{

            fetch(urlApi+"?descUsuario="+inputBusqueda.value)
                .then((response)=>{
                    return response.json()
                })

                .then((datos)=>{
                    tablaUsuarios.innerHTML=`<thead>
                        <td>Codigo</td>
                        <td>Descripción</td>
                        <td>Numero Conexiones</td>
                        <td>Fecha Ultima Conexion</td>
                        <td>Perfil</td>
                        <td>Acciones</td>
                        <td>Acciones</td>
                    </thead>`;
                    mostrarUsuarios(datos);

                })
            })

    </script>
</main>
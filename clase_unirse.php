<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
}
require_once "includes/config.php";

if (isset($_POST["codigoClase"])) {
    $codigo = $_POST["codigoClase"];

    $sql = "SELECT id FROM ClasesEscolares WHERE LOWER(codigo) = LOWER('$codigo')";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id_clase = $row["id"];

        $sql_insert = "INSERT INTO clase_usuario (id_usuario, id_clase, estado) VALUES ('" . $_SESSION["usuario"]["id"] . "', '$id_clase', 'activa')";

        if (mysqli_query($link, $sql_insert)) {
            $sql = "select id from tareas WHERE clase_id = " . $id_clase . " AND fecha_entrega > NOW()";
            $query = mysqli_query($link, $sql);
            $tareas = array();

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $tareas[] = $row;
                }
            } else {
                header("Location: clase.php?id=$id_clase");
            }
            $sql = "INSERT INTO tarea_usuario(tarea_id,usuario_id,estado) VALUES ";
            for($i = 0; $i < count($tareas);$i++){
                $sql .= "(".$tareas[$i]["id"].",".$_SESSION["usuario"]["id"].",1)";
                if($i != count($tareas)-1){
                    $sql .= " , ";
                }
            }
            $query = mysqli_query($link, $sql);

            echo "Te has unido a la clase correctamente.";
            header("Location: clase.php?id=$id_clase");
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($link);
        }
    } else {
        echo '
    <div id="errorModal" style="display: block; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000;">
        <div style="background: white; margin: 15% auto; padding: 20px; border-radius: 5px; width: 300px; position: relative;">
            <span onclick="closeModal()" style="position: absolute; top: 10px; right: 15px; cursor: pointer; font-size: 20px;">&times;</span>
            <p style="color: red; font-size: 17px;">Error</p>
            <p style="font-size: 16px;">No se encontró ninguna clase con ese código.</p>
        </div>
    </div>
    <script>
        function closeModal() {
            document.getElementById("errorModal").style.display = "none";
        }
    </script>
    ';
    }
}

$view = "clase_unirse";
require_once "views/layout.php";

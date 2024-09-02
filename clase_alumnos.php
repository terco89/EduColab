<?php
require_once "includes/config.php";

session_start();

if (!isset($_SESSION["usuario"]) || !isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_clase = intval($_GET['id']); 
$idEspacio = isset($_GET['espacio']) ? intval($_GET['espacio']) : null;

// Obtener información de la clase y del profesor
$sql = "SELECT ClasesEscolares.id, ClasesEscolares.nombre, codigo, id_usuario_creador, 
               usuarios.apellido as profe_apellido, usuarios.nombre as profe_nombre 
        FROM ClasesEscolares 
        INNER JOIN usuarios ON ClasesEscolares.id_usuario_creador = usuarios.id 
        WHERE ClasesEscolares.id = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id_clase);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$nombre_clase = $result["nombre"];
if (!$result) {
    header("Location: clases.php");
    exit();
}

$id_profesor_creador = $result['id_usuario_creador']; 

// Obtener todos los usuarios (profesores y alumnos) de la clase, excluyendo al creador
$sql = "SELECT usuarios.* 
        FROM clase_usuario 
        INNER JOIN usuarios ON clase_usuario.id_usuario = usuarios.id 
        WHERE clase_usuario.id_clase = ? ";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id_clase);
$stmt->execute();
$result1 = $stmt->get_result();
$usuarios = $result1->fetch_all(MYSQLI_ASSOC);

// Obtener los profesores desde la tabla clase_profesor
$sql_profesores = "SELECT usuarios.* 
                   FROM clase_profesor 
                   INNER JOIN usuarios ON clase_profesor.id_usuario = usuarios.id 
                   WHERE clase_profesor.id_clase = ?";
$stmt_profesores = $link->prepare($sql_profesores);
$stmt_profesores->bind_param("i", $id_clase);
$stmt_profesores->execute();
$result_profesores = $stmt_profesores->get_result();
$profesores = $result_profesores->fetch_all(MYSQLI_ASSOC);

// Separar a los alumnos
$solo_alumnos = array_filter($usuarios, function($usuario) use ($profesores) {
    foreach ($profesores as $profesor) {
        if ($usuario['id'] == $profesor['id']) {
            return false; // Excluir los profesores
        }
    }
    return true;
});
$total_alumnos = count($solo_alumnos);

// Procesar el formulario si se ha enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $operation_type = isset($_POST['operation_type']) ? $_POST['operation_type'] : '';

    if ($operation_type === 'ascender' && isset($_POST['ascender_alumno'])) {
        $alumno_id = intval($_POST['ascender_alumno']);
        $sql = "INSERT INTO clase_profesor (id_clase, id_usuario) VALUES (?, ?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ii", $id_clase, $alumno_id);
        if ($stmt->execute()) {
            header("Location: clase_alumnos.php?id=" . $id_clase);
            exit();
        } else {
            echo "Error al ascender al alumno.";
        }
    } elseif ($operation_type === 'newUser' && isset($_POST['newUserName'])) {
        $nombre_usuario = trim($_POST['newUserName']);
    
        $sql = "SELECT id FROM usuarios WHERE name = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
    
        if ($result) {
            $nuevo_profesor_id = $result['id'];
    
            $sql = "INSERT INTO clase_profesor (id_clase, id_usuario) VALUES (?, ?)";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("ii", $id_clase, $nuevo_profesor_id);
            $stmt->execute();
    
            $estado = "activa";  
            $sql1 = "INSERT INTO clase_usuario (id_clase, id_usuario, estado) VALUES (?, ?, ?)";
            $stmt1 = $link->prepare($sql1);
            $stmt1->bind_param("iis", $id_clase, $nuevo_profesor_id, $estado);  
            $stmt1->execute();
    
            
        } else {
            echo "El nombre de usuario no existe.";
        }
    
        $stmt->close();
        if (isset($stmt1)) {
            $stmt1->close();
        }
    }
    elseif ($operation_type === 'delete' && isset($_POST['delete_user'])) {
        $id_usuario = intval($_POST['delete_user']);
        echo "ID del usuario a eliminar: " . $id_usuario;
    
        $sql = "DELETE FROM clase_usuario WHERE id_usuario = ? AND id_clase = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ii", $id_usuario, $id_clase);
        $delete_clase_usuario = $stmt->execute();
    
        $sql1 = "DELETE FROM clase_profesor WHERE id_usuario = ? AND id_clase = ?";
        $stmt1 = $link->prepare($sql1);
        $stmt1->bind_param("ii", $id_usuario, $id_clase);
        $delete_clase_profesor = $stmt1->execute();
    
        if ($delete_clase_usuario && $delete_clase_profesor) {
            header("Location: clase_alumnos.php?id=" . $id_clase);
            exit();
        } else {
            if (!$delete_clase_usuario) {
                echo "Error al eliminar al integrante de la clase_usuario: " . $stmt->error;
            }
            if (!$delete_clase_profesor) {
                echo "Error al eliminar al profesor de clase_profesor: " . $stmt1->error;
            }
        }
    
        $stmt->close();
        $stmt1->close();
    }
}


// Obtener información del espacio si existe
$espacio = null;
if ($idEspacio) {
    $sqlEspacio = "SELECT nombre FROM Espacios WHERE id = ?";
    $stmtEspacio = $link->prepare($sqlEspacio);
    $stmtEspacio->bind_param("i", $idEspacio);
    $stmtEspacio->execute();
    $espacio = $stmtEspacio->get_result()->fetch_assoc();
}

$view = "clase_alumnos";
require_once "views/layout.php";
?>

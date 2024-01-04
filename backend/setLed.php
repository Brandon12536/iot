<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
require '../config/connection.php';

try {
    $db = new Database();
    $con = $db->conectar();

    $status = isset($_GET['setstatus']) ? $_GET['setstatus'] : null;

    if ($status !== null) {
        $sql = "CALL inserta_led(:status)";
        $stmt = $con->prepare($sql);

        $stmt->bindParam(':status', $status, PDO::PARAM_INT);

        $stmt->execute();

        echo json_encode(array('success' => true, 'message' => 'Registro actualizado: ' . $status));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Parámetro "setstatus" no proporcionado'));
    }
} catch (PDOException $e) {
    echo json_encode(array('success' => false, 'message' => 'Error: ' . $e->getMessage()));
} finally {
    $con = null;
}
?>

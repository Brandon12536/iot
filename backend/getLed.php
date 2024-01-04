<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

include("../config/connection.php");
$db = new Database();
$con = $db->conectar();

/*try {
    $sql = "call seleccionar_led()";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    foreach ($result as $row) {
        echo json_encode(['success' => true, 'status' => $row['status']]);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}finally {
    $con = null;
}*/
try {
    $sql = "call seleccionar_led()";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $response = ['success' => true, 'status' => null];

    foreach ($result as $row) {
        $response['status'] = $row['status'];
    }

    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error executing query: ' . $e->getMessage()]);
} finally {
    $con = null;
}

?>

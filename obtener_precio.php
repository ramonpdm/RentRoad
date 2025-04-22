<?php
require_once 'config.php';

$vehiculo_id = $_GET['vehiculo_id'];
$stmt = $pdo->prepare("SELECT precio_dia FROM vehiculos WHERE vehiculo_id = ?");
$stmt->execute([$vehiculo_id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode(['precio_dia' => $data['precio_dia']]);
?>
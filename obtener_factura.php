<?php
require_once 'config.php';

$reserva_id = $_GET['reserva_id'];
$stmt = $pdo->prepare("SELECT total FROM facturas WHERE reserva_id = ?");
$stmt->execute([$reserva_id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($data ?: ['total' => 0]);
?>
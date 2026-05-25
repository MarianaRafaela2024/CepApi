<?php
header('Content-Type: application/json');
require '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];
$cep = $_GET['cep'] ?? null;
$body = json_decode(
    file_get_contents('php://input'), true
);

switch($method){
    case 'GET':
        $cep = preg_replace('/\D/','', $cep);
        $stmt = $pdo->prepare(
            'SELECT * FROM cep
            WHERE REPLACE(cep,"-","")=?'
        );
    $stmt->execute([$cep]);
    echo json_encode($stmt->fetch());
    break;
    case 'POST': /* inserir */ break;
    case 'PUT':  /* atualizar */ break;
    case 'DELETE': /* remover */ break;
}
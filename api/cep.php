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
    case 'POST':

        if(
            empty($body['cep']) ||
            empty($body['logradouro']) ||
            empty($body['bairro']) ||
            empty($body['cidade']) ||
            empty($body['uf'])
        ){
            http_response_code(400);
    
            echo json_encode([
                'error' => 'Preencha todos os campos'
            ]);
    
            exit;
        }
    
        $cep = preg_replace('/\D/', '', $body['cep']);
    
        $stmt = $pdo->prepare(
            'INSERT INTO cep
            (cep, logradouro, bairro, cidade, uf)
            VALUES (?, ?, ?, ?, ?)'
        );
    
        $stmt->execute([
            $cep,
            $body['logradouro'],
            $body['bairro'],
            $body['cidade'],
            strtoupper($body['uf'])
        ]);
    
        http_response_code(201);
    
        echo json_encode([
            'success' => true,
            'message' => 'CEP cadastrado com sucesso'
        ]);
    
    break;
    case 'PUT':
        
        
    break;
    case 'DELETE': 
        $cep = preg_replace('/\D/', '', $cep);
        
        $stmt = $pdo->prepare(
            'DELETE FROM cep  
            WHERE REPLACE(cep,"-","")=?'
        );

        $stmt->execute([$cep]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'CEP removido com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'CEP não encontrado']);
        }
    break;
}
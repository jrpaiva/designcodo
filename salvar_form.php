<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$pass = "123"; 
$db   = "design_cursos";

// Criar conexão
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexão
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(["error" => "Erro na conexão: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar e sanitizar dados
    $nome = trim($conn->real_escape_string($_POST['nome'] ?? ''));
    $idade = intval($_POST['idade'] ?? 0);
    $curso = trim($conn->real_escape_string($_POST['curso'] ?? ''));
    $whatsapp = trim($conn->real_escape_string($_POST['whatsapp'] ?? ''));

    // Validações básicas
    if (empty($nome) || empty($curso) || empty($whatsapp) || $idade < 1) {
        http_response_code(400);
        echo json_encode(["error" => "Dados incompletos ou inválidos"]);
        exit;
    }

    // Usar prepared statements para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO formularios (nome, idade, curso, whatsapp) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $nome, $idade, $curso, $whatsapp);

    if ($stmt->execute()) {
        echo json_encode(["success" => " Dados salvos com sucesso!", "id" => $stmt->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => " Erro ao salvar: " . $stmt->error]);
    }

    $stmt->close();
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido"]);
}

$conn->close();
?>


<?php
// Backend para a busca AJAX e exportações

// Configuração do PDO com tratamento de erros
try {
    // IMPORTANTE: Use as mesmas credenciais do seu arquivo principal
    $pdo = new PDO("mysql:host=localhost;dbname=design_cursos", "root", "123", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Erro de conexão com o banco de dados']);
    exit;
}

// Função para obter dados com filtros (a mesma do painel principal)
function obterDadosFiltrados($pdo) {
    $where = [];
    $params = [];

    if (!empty($_GET['pesquisa'])) {
        $pesquisa = '%' . $_GET['pesquisa'] . '%';
        $where[] = "(nome LIKE ? OR curso LIKE ? OR whatsapp LIKE ?)";
        array_push($params, $pesquisa, $pesquisa, $pesquisa);
    }
    if (!empty($_GET['curso'])) {
        $where[] = "curso = ?";
        $params[] = $_GET['curso'];
    }
    if (!empty($_GET['data_inicio'])) {
        $where[] = "DATE(criado_em) >= ?";
        $params[] = $_GET['data_inicio'];
    }
    if (!empty($_GET['data_fim'])) {
        $where[] = "DATE(criado_em) <= ?";
        $params[] = $_GET['data_fim'];
    }

    $whereClause = count($where) > 0 ? 'WHERE ' . implode(' AND ', $where) : '';
    $sql = "SELECT * FROM formularios $whereClause ORDER BY criado_em DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

// Lógica de Exportação
if (isset($_GET['export'])) {
    $dados_export = obterDadosFiltrados($pdo);
    $filename = 'formularios_' . date('Y-m-d');

    if ($_GET['export'] == 'csv') {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename . '.csv');
        $saida = fopen('php://output', 'w');
        fputcsv($saida, ['ID', 'Nome', 'Idade', 'Curso', 'Whatsapp', 'Criado em']);
        foreach ($dados_export as $row) {
            fputcsv($saida, $row);
        }
        fclose($saida);
        exit;
    }

    if ($_GET['export'] == 'excel') {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=' . $filename . '.xls');
        echo "<table border='1'><tr><th>ID</th><th>Nome</th><th>Idade</th><th>Curso</th><th>Whatsapp</th><th>Criado em</th></tr>";
        foreach ($dados_export as $row) {
            echo "<tr>";
            foreach($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        exit;
    }
}


// Resposta padrão (busca AJAX)
header('Content-Type: application/json');
$dados = obterDadosFiltrados($pdo);
echo json_encode($dados);

?>
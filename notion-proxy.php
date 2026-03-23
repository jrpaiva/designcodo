<?php
// Headers para permitir CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Configuração do banco de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'notion_dashboard');
define('DB_USER', 'root');
define('DB_PASS', '123');

// Responder imediatamente para requisições OPTIONS (pré-voo)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Conexão com o banco de dados
function getDBConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        error_log("Erro de conexão com o banco: " . $e->getMessage());
        echo json_encode([
            'success' => false, 
            'error' => 'Erro de conexão com o banco de dados. Verifique as credenciais.'
        ]);
        exit;
    }
}

// Verificar se a tabela existe
function checkTableExists($pdo) {
    try {
        $stmt = $pdo->query("SELECT COUNT(*) FROM information_schema.tables 
                            WHERE table_schema = '" . DB_NAME . "' 
                            AND table_name = 'notion_config'");
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Erro ao verificar tabela: " . $e->getMessage());
        return false;
    }
}

// Salvar configurações no banco
function saveConfigToDB($apiKey, $databaseId) {
    $pdo = getDBConnection();
    
    // Verificar se a tabela existe
    if (!checkTableExists($pdo)) {
        throw new Exception("Tabela 'notion_config' não encontrada no banco '" . DB_NAME . "'.");
    }
    
    // Verificar se já existe uma configuração
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM notion_config");
    $result = $stmt->fetch();
    $count = $result['count'];
    
    if ($count > 0) {
        // Atualizar configuração existente
        $stmt = $pdo->prepare("UPDATE notion_config SET api_key = ?, database_id = ?, updated_at = NOW()");
        $success = $stmt->execute([$apiKey, $databaseId]);
    } else {
        // Inserir nova configuração
        $stmt = $pdo->prepare("INSERT INTO notion_config (api_key, database_id) VALUES (?, ?)");
        $success = $stmt->execute([$apiKey, $databaseId]);
    }
    
    return $success;
}

// Obter configurações do banco
function getConfigFromDB() {
    $pdo = getDBConnection();
    
    // Verificar se a tabela existe
    if (!checkTableExists($pdo)) {
        throw new Exception("Tabela 'notion_config' não encontrada.");
    }
    
    try {
        $stmt = $pdo->query("SELECT api_key, database_id FROM notion_config ORDER BY id DESC LIMIT 1");
        $config = $stmt->fetch();
        return $config ?: null;
    } catch (PDOException $e) {
        error_log("Erro ao obter configurações: " . $e->getMessage());
        throw new Exception("Erro ao acessar o banco de dados.");
    }
}

// Verificar se é uma requisição GET para obter configurações
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getConfig') {
    try {
        $config = getConfigFromDB();
        echo json_encode(['success' => true, 'config' => $config]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}

// Verificar se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ler os dados JSON da requisição
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['success' => false, 'error' => 'JSON inválido: ' . json_last_error_msg()]);
        exit;
    }
    
    $action = $input['action'] ?? '';
    $apiKey = $input['apiKey'] ?? '';
    $databaseId = $input['databaseId'] ?? '';
    
    // Ação para salvar configurações
    if ($action === 'saveConfig') {
        if (empty($apiKey) || empty($databaseId)) {
            echo json_encode(['success' => false, 'error' => 'Credenciais obrigatórias não fornecidas']);
            exit;
        }
        
        try {
            $success = saveConfigToDB($apiKey, $databaseId);
            if ($success) {
                echo json_encode(['success' => true, 'message' => 'Configurações salvas com sucesso no banco de dados!']);
            } else {
                echo json_encode(['success' => false, 'error' => 'Erro ao salvar configurações.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        exit;
    }
    
    if (empty($apiKey) || empty($databaseId)) {
        // Tentar obter do banco de dados
        try {
            $config = getConfigFromDB();
            if ($config) {
                $apiKey = $config['api_key'];
                $databaseId = $config['database_id'];
            } else {
                echo json_encode(['success' => false, 'error' => 'Credenciais não configuradas. Configure primeiro.']);
                exit;
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            exit;
        }
    }
    
    try {
        if ($action === 'test') {
            // Testar a conexão com a API do Notion
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.notion.com/v1/databases/$databaseId");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $apiKey",
                "Notion-Version: 2022-06-28",
                "Content-Type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($httpCode === 200) {
                $data = json_decode($response, true);
                echo json_encode(['success' => true, 'message' => 'Conexão bem-sucedida com o Notion!', 'database_properties' => $data['properties']]);
            } else {
                $errorData = json_decode($response, true);
                $errorMsg = $errorData['message'] ?? $error ?? "Erro $httpCode";
                echo json_encode(['success' => false, 'error' => $errorMsg]);
            }
            
        } elseif ($action === 'query') {
            // Consultar o banco de dados do Notion
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.notion.com/v1/databases/$databaseId/query");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $apiKey",
                "Notion-Version: 2022-06-28",
                "Content-Type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['page_size' => 100]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($httpCode === 200) {
                $data = json_decode($response, true);
                
                // Obter informações da estrutura do database
                $dbInfoCh = curl_init();
                curl_setopt($dbInfoCh, CURLOPT_URL, "https://api.notion.com/v1/databases/$databaseId");
                curl_setopt($dbInfoCh, CURLOPT_HTTPHEADER, [
                    "Authorization: Bearer $apiKey",
                    "Notion-Version: 2022-06-28",
                    "Content-Type: application/json"
                ]);
                curl_setopt($dbInfoCh, CURLOPT_RETURNTRANSFER, true);
                $dbInfoResponse = curl_exec($dbInfoCh);
                curl_close($dbInfoCh);
                
                $dbInfo = json_decode($dbInfoResponse, true);
                $properties = $dbInfo['properties'] ?? [];
                
                echo json_encode([
                    'success' => true, 
                    'results' => $data['results'],
                    'properties' => $properties // ← ESTRUTURA DINÂMICA
                ]);
            } else {
                $errorData = json_decode($response, true);
                $errorMsg = $errorData['message'] ?? $error ?? "Erro $httpCode";
                echo json_encode(['success' => false, 'error' => $errorMsg]);
            }
            
        } else {
            echo json_encode(['success' => false, 'error' => 'Ação não reconhecida: ' . $action]);
        }
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    
    exit;
}

// Se não for POST, retornar erro
echo json_encode(['success' => false, 'error' => 'Método não permitido']);
?>
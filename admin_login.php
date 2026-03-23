<?php
session_start();

// Se já estiver logado, redireciona para o admin
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header('Location: /admin');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['senha'] ?? '';
    
    // Usuário e senha fixos (pode mudar depois ou usar DB)
    if ($user === 'admin' && $pass === '1234') {
        $_SESSION['logado'] = true;
        header('Location: /admin'); // MUDANÇA: usar URL amigável
        exit;
    } else {
        $erro = 'Usuário ou senha incorretos!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Design Informática</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-6 text-center">Painel Administrativo</h2>
        
        <?php if($erro): ?>
            <p class="text-red-500 mb-4 text-center"><?php echo htmlspecialchars($erro); ?></p>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-4">
                <label class="block mb-2 font-medium">Usuário</label>
                <input type="text" name="usuario" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-6">
                <label class="block mb-2 font-medium">Senha</label>
                <input type="password" name="senha" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                Entrar
            </button>
        </form>
    </div>
</body>
</html>

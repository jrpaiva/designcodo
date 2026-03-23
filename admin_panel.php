<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: /login');
    exit;
}

// Configuração do PDO com tratamento de erros
try {
    $pdo = new PDO("mysql:host=localhost;dbname=design_cursos", "root", "123", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Função para sanitizar dados
function sanitizeString($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

// Processar exclusão
if (isset($_GET['excluir'])) {
    $id = filter_var($_GET['excluir'], FILTER_SANITIZE_NUMBER_INT);
    if ($id) {
        $stmt = $pdo->prepare("DELETE FROM formularios WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: /admin?sucesso=Registro excluído');
        exit;
    }
}

// Processar edição
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $nome = sanitizeString($_POST['nome'] ?? '');
    $idade = filter_var($_POST['idade'], FILTER_SANITIZE_NUMBER_INT);
    $curso = sanitizeString($_POST['curso'] ?? '');
    $whatsapp = sanitizeString($_POST['whatsapp'] ?? '');

    if ($id && $nome && $idade && $curso && $whatsapp) {
        $stmt = $pdo->prepare("UPDATE formularios SET nome = ?, idade = ?, curso = ?, whatsapp = ? WHERE id = ?");
        $stmt->execute([$nome, $idade, $curso, $whatsapp, $id]);
        header('Location: /admin?sucesso=Registro atualizado');
        exit;
    }
}

// Função para obter dados para o carregamento inicial da página
function obterDadosIniciais($pdo) {
    $sql = "SELECT * FROM formularios ORDER BY criado_em DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Obter dados iniciais
try {
    $dados = obterDadosIniciais($pdo);
    $cursos = $pdo->query("SELECT DISTINCT curso FROM formularios ORDER BY curso")->fetchAll(PDO::FETCH_COLUMN);
} catch (Exception $e) {
    $dados = [];
    $cursos = [];
    error_log("Erro ao obter dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - Design Informática</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* CORREÇÃO APLICADA AQUI: A regra agora só afeta telas menores que 768px (breakpoint 'md' do Tailwind) */
        @media (max-width: 767px) {
            #filtro-container.hidden {
                max-height: 0;
                opacity: 0;
                padding-top: 0;
                padding-bottom: 0;
                margin-bottom: 0;
            }
        }
        #filtro-container {
            transition: all 0.3s ease-in-out;
            max-height: 500px; /* Altura suficiente para os filtros */
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto p-4 md:p-6">
        <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6 gap-4">
            <h1 class="text-3xl font-bold text-gray-800">Painel Administrativo</h1>
            <div class="flex items-center space-x-2">
                <a href="buscar_admin.php?export=csv" id="export-csv" class="bg-green-500 text-white px-3 py-2 text-sm rounded hover:bg-green-600 transition-colors">
                    <i class="fas fa-file-csv"></i><span class="hidden sm:inline ml-2">Exportar CSV</span>
                </a>
                <a href="buscar_admin.php?export=excel" id="export-excel" class="bg-blue-500 text-white px-3 py-2 text-sm rounded hover:bg-blue-600 transition-colors ml-2">
                    <i class="fas fa-file-excel"></i><span class="hidden sm:inline ml-2">Exportar Excel</span>
                </a>
                <a href="/logout" class="bg-red-500 text-white px-3 py-2 text-sm rounded hover:bg-red-600 transition-colors ml-2">
                    <i class="fas fa-sign-out-alt"></i><span class="hidden sm:inline ml-2">Sair</span>
                </a>
            </div>
        </div>

        <?php if (isset($_GET['sucesso'])): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-r-lg" role="alert">
                <p><?php echo htmlspecialchars($_GET['sucesso']); ?></p>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['erro'])): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-r-lg" role="alert">
                <p><?php echo htmlspecialchars($_GET['erro']); ?></p>
            </div>
        <?php endif; ?>

        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <button id="toggle-filtros" class="md:hidden w-full text-left text-xl font-semibold mb-4 text-gray-700 flex justify-between items-center">
                <span>Filtros</span>
                <i id="filtro-icone" class="fas fa-chevron-down transition-transform"></i>
            </button>
            <div id="filtro-container" class="hidden md:block">
                <form id="form-filtros" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="filtro-pesquisa" class="block text-sm font-medium text-gray-700">Pesquisa</label>
                        <input type="text" id="filtro-pesquisa" name="pesquisa" placeholder="Nome, curso ou WhatsApp" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    </div>
                    <div>
                        <label for="filtro-curso" class="block text-sm font-medium text-gray-700">Curso</label>
                        <select id="filtro-curso" name="curso" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                            <option value="">Todos os cursos</option>
                            <?php foreach ($cursos as $curso): ?>
                                <option value="<?php echo htmlspecialchars($curso); ?>"><?php echo htmlspecialchars($curso); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="filtro-data-inicio" class="block text-sm font-medium text-gray-700">Data Início</label>
                        <input type="date" id="filtro-data-inicio" name="data_inicio" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    </div>
                    <div>
                        <label for="filtro-data-fim" class="block text-sm font-medium text-gray-700">Data Fim</label>
                        <input type="date" id="filtro-data-fim" name="data_fim" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                    </div>
                    <div class="md:col-span-4 flex justify-end space-x-2 mt-4">
                        <button type="button" id="botao-filtrar" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                            <i class="fas fa-filter"></i> Aplicar Filtros
                        </button>
                        <a href="/admin" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors">
                            <i class="fas fa-times"></i> Limpar
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div id="container-resultados">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg hidden md:block">
                <table class="min-w-full">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Nome</th>
                            <th class="px-4 py-3 text-left">Idade</th>
                            <th class="px-4 py-3 text-left">Curso</th>
                            <th class="px-4 py-3 text-left">Whatsapp</th>
                            <th class="px-4 py-3 text-left">Criado em</th>
                            <th class="px-4 py-3 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tabela-resultados-corpo-desktop">
                        </tbody>
                </table>
            </div>
            <div id="tabela-resultados-corpo-mobile" class="md:hidden space-y-4">
                </div>
        </div>
        
    </div>

    <div id="modalEditar" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h3 class="text-xl font-semibold">Editar Registro</h3>
                <button onclick="fecharModalEditar()" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
            </div>
            <form method="POST" class="px-6 py-4">
                <input type="hidden" name="editar" value="1">
                <input type="hidden" name="id" id="editar_id">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
                    <input type="text" name="nome" id="editar_nome" required class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Idade</label>
                    <input type="number" name="idade" id="editar_idade" required class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Curso</label>
                    <input type="text" name="curso" id="editar_curso" required class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">WhatsApp</label>
                    <input type="text" name="whatsapp" id="editar_whatsapp" required class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="fecharModalEditar()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Funções do Modal
    function abrirModalEditar(dados) {
        document.getElementById('editar_id').value = dados.id;
        document.getElementById('editar_nome').value = dados.nome;
        document.getElementById('editar_idade').value = dados.idade;
        document.getElementById('editar_curso').value = dados.curso;
        document.getElementById('editar_whatsapp').value = dados.whatsapp;
        document.getElementById('modalEditar').classList.remove('hidden');
    }
    function fecharModalEditar() {
        document.getElementById('modalEditar').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        const corpoTabelaDesktop = document.getElementById('tabela-resultados-corpo-desktop');
        const corpoTabelaMobile = document.getElementById('tabela-resultados-corpo-mobile');
        const formFiltros = document.getElementById('form-filtros');
        const botaoFiltrar = document.getElementById('botao-filtrar');
        const exportCsv = document.getElementById('export-csv');
        const exportExcel = document.getElementById('export-excel');
        const toggleFiltrosBtn = document.getElementById('toggle-filtros');
        const filtroContainer = document.getElementById('filtro-container');
        const filtroIcone = document.getElementById('filtro-icone');

        toggleFiltrosBtn.addEventListener('click', () => {
            const isHidden = filtroContainer.classList.contains('hidden');
            if (isHidden) {
                // Remove 'hidden' para que as propriedades de transição possam funcionar
                filtroContainer.classList.remove('hidden');
            } else {
                // Adiciona 'hidden' após a transição terminar para garantir a acessibilidade (display: none)
                // A estilização no <head> cuida da animação de altura e opacidade
                filtroContainer.classList.add('hidden');
            }
            filtroIcone.classList.toggle('rotate-180');
        });

        const escapeHTML = str => str ? str.toString().replace(/[&<>"']/g, m => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[m]) : '';

        function construirLinhaDesktop(linha) {
            const dadosLinha = JSON.stringify(linha);
            return `
                <tr class="border-b hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3">${escapeHTML(linha.id)}</td>
                    <td class="px-4 py-3">${escapeHTML(linha.nome)}</td>
                    <td class="px-4 py-3">${escapeHTML(linha.idade)}</td>
                    <td class="px-4 py-3">${escapeHTML(linha.curso)}</td>
                    <td class="px-4 py-3">${escapeHTML(linha.whatsapp)}</td>
                    <td class="px-4 py-3">${escapeHTML(linha.criado_em)}</td>
                    <td class="px-4 py-3">
                        <button onclick='abrirModalEditar(${dadosLinha})' class="text-blue-500 hover:text-blue-700 mr-2"><i class="fas fa-edit"></i></button>
                        <a href="?excluir=${linha.id}" onclick="return confirm('Tem certeza?')" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>`;
        }
        
        function construirCartaoMobile(linha) {
            const dadosLinha = JSON.stringify(linha);
            return `
                <div class="bg-white rounded-lg shadow p-4 space-y-3">
                    <div class="flex justify-between items-center border-b pb-2">
                        <div>
                            <p class="text-sm text-gray-500">Nome</p>
                            <p class="font-bold text-lg text-gray-800">${escapeHTML(linha.nome)}</p>
                        </div>
                        <div class="text-right">
                           <p class="text-sm text-gray-500">ID</p>
                           <p class="font-mono text-gray-600">${escapeHTML(linha.id)}</p>
                        </div>
                    </div>
                    <div><p class="text-sm text-gray-500">Curso: <span class="font-medium text-gray-700">${escapeHTML(linha.curso)}</span></p></div>
                    <div><p class="text-sm text-gray-500">Idade: <span class="font-medium text-gray-700">${escapeHTML(linha.idade)}</span></p></div>
                    <div><p class="text-sm text-gray-500">WhatsApp: <span class="font-medium text-gray-700">${escapeHTML(linha.whatsapp)}</span></p></div>
                    <div><p class="text-sm text-gray-500">Data: <span class="font-medium text-gray-700">${escapeHTML(linha.criado_em)}</span></p></div>
                    <div class="flex justify-end space-x-4 pt-2 border-t mt-2">
                        <button onclick='abrirModalEditar(${dadosLinha})' class="flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm hover:bg-blue-200"><i class="fas fa-edit"></i> Editar</button>
                        <a href="?excluir=${linha.id}" onclick="return confirm('Tem certeza?')" class="flex items-center gap-2 px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm hover:bg-red-200"><i class="fas fa-trash"></i> Excluir</a>
                    </div>
                </div>`;
        }

        function atualizarResultados(dados) {
            corpoTabelaDesktop.innerHTML = '';
            corpoTabelaMobile.innerHTML = '';
            if (dados.length > 0) {
                dados.forEach(linha => {
                    corpoTabelaDesktop.innerHTML += construirLinhaDesktop(linha);
                    corpoTabelaMobile.innerHTML += construirCartaoMobile(linha);
                });
            } else {
                const semResultados = '<div class="text-center py-8 text-gray-500 bg-white rounded-lg shadow">Nenhum registro encontrado.</div>';
                corpoTabelaDesktop.innerHTML = `<tr><td colspan="7" class="py-8 text-center text-gray-500">Nenhum registro encontrado.</td></tr>`;
                corpoTabelaMobile.innerHTML = semResultados;
            }
        }

        function executarBusca() {
            const formData = new FormData(formFiltros);
            const params = new URLSearchParams(formData).toString();
            
            exportCsv.href = `buscar_admin.php?export=csv&${params}`;
            exportExcel.href = `buscar_admin.php?export=excel&${params}`;

            const buscandoDesktop = '<tr><td colspan="7" class="py-8 text-center text-gray-500">Buscando...</td></tr>';
            const buscandoMobile = '<div class="text-center py-8 text-gray-500 bg-white rounded-lg shadow">Buscando...</div>';
            corpoTabelaDesktop.innerHTML = buscandoDesktop;
            corpoTabelaMobile.innerHTML = buscandoMobile;
            
            fetch(`buscar_admin.php?${params}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) { throw new Error(data.error); }
                    atualizarResultados(data);
                })
                .catch(error => {
                    console.error('Erro na busca:', error);
                    const erroMsg = `<tr><td colspan="7" class="py-8 text-center text-red-500">Erro ao carregar os dados.</td></tr>`;
                    corpoTabelaDesktop.innerHTML = erroMsg;
                    corpoTabelaMobile.innerHTML = `<div class="text-center py-8 text-red-500 bg-white rounded-lg shadow">Erro ao carregar os dados.</div>`;
                });
        }
        
        // Carrega os dados iniciais na página
        atualizarResultados(<?php echo json_encode($dados); ?>);

        formFiltros.addEventListener('input', executarBusca);
        botaoFiltrar.addEventListener('click', executarBusca);

        document.getElementById('modalEditar').addEventListener('click', function(e) {
            if (e.target.id === 'modalEditar') fecharModalEditar();
        });
    });
    </script>
</body>
</html>
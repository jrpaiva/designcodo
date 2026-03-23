<?php
// Valida o parâmetro do curso
if (!isset($_GET['nome']) || !preg_match('/^[a-z0-9-]+$/', $_GET['nome'])) {
    http_response_code(404);
    echo "Curso não encontrado.";
    exit;
}
$cursoSlug = $_GET['nome'];
$arquivoCurso = __DIR__ . '/dados-cursos/' . $cursoSlug . '.php';

if (!file_exists($arquivoCurso)) {
    http_response_code(404);
    echo "Detalhes do curso não encontrados.";
    exit;
}

// Inclui o arquivo de dados do curso, que define a variável $curso
require $arquivoCurso;

// Define o título da página para o cabeçalho
$pageTitle = htmlspecialchars($curso['titulo']) . ' - Design Informática';

// Inclui o cabeçalho
include 'cabecalho.php';
?>

<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white pt-20 pb-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" data-aos="fade-up"><?php echo htmlspecialchars($curso['titulo']); ?></h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200"><?php echo htmlspecialchars($curso['descricao_curta']); ?></p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-6 grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <div class="lg:col-span-2">
            <div class="space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">O que você vai aprender?</h2>
                    <p class="text-gray-600 leading-relaxed"><?php echo nl2br(htmlspecialchars($curso['o_que_aprendera'])); ?></p>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Público-Alvo</h2>
                    <p class="text-gray-600 leading-relaxed"><?php echo nl2br(htmlspecialchars($curso['publico_alvo'])); ?></p>
                </div>
                 <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Local de Atuação</h2>
                    <p class="text-gray-600 leading-relaxed"><?php echo nl2br(htmlspecialchars($curso['local_atuacao'])); ?></p>
                </div>
            </div>
        </div>

        <aside class="lg:col-span-1 space-y-8">
            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6 text-center sticky top-28" data-aos="fade-left">
                <h3 class="text-xl font-bold text-gray-900">Gostou deste curso?</h3>
                <p class="text-gray-600 my-4">Não perca tempo! Fale conosco agora mesmo e garanta sua vaga.</p>
                <a href="https://wa.me/559991199793?text=Olá!%20Tenho%20interesse%20no%20curso%20de%20<?php echo urlencode($curso['titulo']); ?>" 
                   target="_blank" 
                   class="inline-block w-full bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-transform hover:scale-105">
                    <i class="fab fa-whatsapp"></i> Falar no WhatsApp
                </a>
            </div>

            <div>
                 <h3 class="text-2xl font-bold text-gray-800 mb-4">Tags de Habilidade</h3>
                 <div class="flex flex-wrap gap-2">
                    <?php foreach ($curso['tags'] as $tag): ?>
                        <span class="bg-gray-200 text-gray-700 text-sm font-medium px-3 py-1 rounded-full"><?php echo htmlspecialchars($tag); ?></span>
                    <?php endforeach; ?>
                 </div>
            </div>
        </aside>

    </div>
</section>

<?php
// Inclui o rodapé
include 'rodape.php';
?>
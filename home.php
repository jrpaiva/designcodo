<?php
// Define o título da página para o cabeçalho
$pageTitle = 'Design Informática - Cursos Profissionalizantes';
include 'cabecalho.php'; 

// --- LÓGICA PARA CARREGAR OS CURSOS E ÍCONES ---
$cursos_slugs = [
    'auxiliar-administrativo', 'atendente-de-farmacia', 'operador-de-caixa',
    'auxiliar-contabil', 'designer-grafico', 'informatica-kids',
    'informatica-basica', 'informatica-basica-avancada', 'informatica-basica-profissionalizante',
    'lider-do-administrativo', 'mestre-em-excel', 'professor-do-futuro', 
    'social-media-pro', 'vendedor-digital', 'desenvolvedor-web', 'youtuber'
];
$icones_cursos = [
    'auxiliar-administrativo' => '/assets/images/adm.png',
    'atendente-de-farmacia' => '/assets/images/at.farmacia.png',
    'operador-de-caixa' => '/assets/images/caixa.png',
    'auxiliar-contabil' => '/assets/images/contabil.png',
    'designer-grafico' => '/assets/images/grafico.png',
    'informatica-basica' => '/assets/images/info.essencial.png',
    'informatica-basica-avancada' => '/assets/images/info.essencial+avancado.png',
    'informatica-basica-profissionalizante' => '/assets/images/info.essencial+prof.png',
    'informatica-kids' => '/assets/images/info.kids.png',
    'lider-do-administrativo' => '/assets/images/lider.png',
    'mestre-em-excel' => '/assets/images/mestre-excel.png',
    'professor-do-futuro' => '/assets/images/prof.png',
    'social-media-pro' => '/assets/images/social.png',
    'vendedor-digital' => '/assets/images/vendedor.png',
    'desenvolvedor-web' => '/assets/images/web.png',
    'youtuber' => '/assets/images/youtuber.png'
];
?>

<section class="hero-gradient pt-8 pb-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6" data-aos="fade-up" data-aos-duration="1000">
            Invista no seu futuro com a<br>
            <span class="text-orange-300">Design Informática</span>
        </h1>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
            Transforme sua carreira com nossos cursos profissionalizantes. Aprenda com quem entende do mercado.
        </p>
        <a href="#inscricao" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-lg text-lg font-semibold btn-hover inline-block" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
            Quero me inscrever
        </a>
    </div>
</section>

<section id="loja" class="py-20 bg-gradient-to-br from-slate-900 via-blue-900 to-slate-900 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-32 h-32 border border-blue-400 rounded-lg transform rotate-12"></div>
        <div class="absolute top-32 right-20 w-24 h-24 border border-cyan-400 rounded-full"></div>
        <div class="absolute bottom-20 left-32 w-40 h-40 border border-purple-400 rounded-lg transform -rotate-6"></div>
        <div class="absolute bottom-32 right-10 w-28 h-28 border border-green-400 rounded-full"></div>
        <svg class="absolute top-0 left-0 w-full h-full" viewBox="0 0 1000 1000" fill="none">
            <path d="M100 100L200 100L200 200L300 200" stroke="currentColor" stroke-width="1" opacity="0.3"/>
            <path d="M400 150L500 150L500 250L600 250L600 350" stroke="currentColor" stroke-width="1" opacity="0.3"/>
            <path d="M700 100L800 100L800 200L900 200L900 300" stroke="currentColor" stroke-width="1" opacity="0.3"/>
            <circle cx="200" cy="100" r="4" fill="currentColor" opacity="0.5"/>
            <circle cx="500" cy="150" r="4" fill="currentColor" opacity="0.5"/>
            <circle cx="800" cy="200" r="4" fill="currentColor" opacity="0.5"/>
        </svg>
    </div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up" data-aos-duration="800">
            <div class="inline-flex items-center space-x-3 bg-blue-500/10 backdrop-blur-sm px-6 py-3 rounded-full border border-blue-500/20 mb-6">
                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <span class="text-blue-300 font-semibold">Nossa Loja</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Tecnologia Completa<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-cyan-400 to-purple-400">
                    em um só lugar
                </span>
            </h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Além dos cursos profissionalizantes, oferecemos uma loja completa com acessórios, peças de computadores e assistência técnica especializada para todas as suas necessidades tecnológicas.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <div class="group relative" data-aos="fade-up" data-aos-duration="600" data-aos-delay="0">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                <div class="relative bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-8 hover:bg-white/15 transition-all duration-300 hover:scale-105">
                    <h3 class="text-2xl font-bold text-white mb-4">Acessórios de Informática</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">Mouses, teclados, headsets, webcams, cabos, adaptadores e muito mais. Tudo que você precisa para seu setup.</p>
                </div>
            </div>
            <div class="group relative" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                <div class="relative bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-8 hover:bg-white/15 transition-all duration-300 hover:scale-105">
                    <h3 class="text-2xl font-bold text-white mb-4">Peças de Computadores</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">Processadores, memórias, placas de vídeo, HDs, SSDs e todos os componentes para montar ou upgradar seu PC.</p>
                </div>
            </div>
            <div class="group relative md:col-span-2 lg:col-span-1" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                <div class="absolute inset-0 bg-gradient-to-r from-green-600 to-emerald-600 rounded-2xl blur opacity-25 group-hover:opacity-40 transition-opacity duration-300"></div>
                <div class="relative bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-8 hover:bg-white/15 transition-all duration-300 hover:scale-105">
                    <h3 class="text-2xl font-bold text-white mb-4">Assistência Técnica</h3>
                    <p class="text-gray-300 mb-6 leading-relaxed">Manutenção especializada para computadores e notebooks. Diagnóstico gratuito e orçamento sem compromisso.</p>
                </div>
            </div>
        </div>
        <div class="text-center" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
            <a href="https://wa.me/559981491353?text=Olá!%20Gostaria%20de%20saber%20mais%20sobre%20os%20produtos%20e%20serviços%20da%20loja." target="_blank" class="inline-flex items-center space-x-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-8 py-4 rounded-2xl font-semibold text-lg transition-all duration-300 hover:scale-105 group">
                <i class="fab fa-whatsapp text-2xl"></i>
                <span>Fale com atendente</span>
            </a>
        </div>
    </div>
</section>
<section id="cursos" class="py-16 bg-white dark:bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4" data-aos="fade-up">Nossos Cursos</h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg" data-aos="fade-up" data-aos-delay="100">Escolha o curso ideal para sua carreira</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($cursos_slugs as $index => $slug): ?>
                <?php
                $caminho_curso = __DIR__ . '/dados-cursos/' . $slug . '.php';
                if (file_exists($caminho_curso)) {
                    include $caminho_curso;
                } else { continue; }
                
                $icone_path = $icones_cursos[$slug] ?? '/assets/images/logodesign25.png';
                $delay = ($index % 3) * 100;
                ?>
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 card-hover flex flex-col" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mb-4 p-1">
                        <img src="<?php echo htmlspecialchars($icone_path); ?>" alt="Ícone do curso <?php echo htmlspecialchars($curso['titulo']); ?>" class="max-h-full max-w-full">
                    </div>
                    <div class="flex-grow">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2"><?php echo htmlspecialchars($curso['titulo']); ?></h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4"><?php echo htmlspecialchars($curso['descricao_curta']); ?></p>
                    </div>
                    <a href="/curso/<?php echo htmlspecialchars($slug); ?>" class="text-blue-600 hover:text-blue-800 font-medium btn-hover mt-auto">Saiba mais →</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="inscricao" class="py-16 bg-gray-50 dark:bg-gray-800">
    <div class="container mx-auto px-6">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-900 rounded-xl shadow-lg p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white text-center mb-6">Tenho interesse em um curso</h2>
            <form id="interesseForm" class="space-y-6">
                <div>
                    <label for="nome" class="block text-sm font-medium">Nome completo</label>
                    <input type="text" id="nome" name="nome" required class="w-full mt-1 px-4 py-3 border rounded-lg">
                </div>
                <div>
                    <label for="idade" class="block text-sm font-medium">Idade</label>
                    <input type="number" id="idade" name="idade" min="1" required class="w-full mt-1 px-4 py-3 border rounded-lg">
                </div>
                <div>
                    <label for="curso" class="block text-sm font-medium">Curso desejado</label>
                    <select id="curso" name="curso" required class="w-full mt-1 px-4 py-3 border rounded-lg">
                        <option value="">Selecione um curso</option>
                        <?php foreach ($cursos_slugs as $slug): ?>
                            <?php
                            $caminho_curso_option = __DIR__ . '/dados-cursos/' . $slug . '.php';
                            if (file_exists($caminho_curso_option)) {
                                include $caminho_curso_option;
                                echo '<option value="' . htmlspecialchars($slug) . '">' . htmlspecialchars($curso['titulo']) . '</option>';
                            }
                            ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="whatsapp" class="block text-sm font-medium">WhatsApp</label>
                    <input type="tel" id="whatsapp" name="whatsapp" placeholder="(99) 91234-5678" required class="w-full mt-1 px-4 py-3 border rounded-lg">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold btn-hover">
                    Quero saber mais
                </button>
            </form>
        </div>
    </div>
</section>

<?php include 'rodape.php'; ?>
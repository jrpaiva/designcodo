<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Design Informática'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; padding-top: 0 !important; margin: 0 !important; }
        .hero-gradient { background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%); margin-top: 0 !important; padding-top: 6rem !important; }
        .glassmorphism { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
        .hamburger-btn.active .hamburger-line:nth-child(1) { transform: rotate(45deg) translate(6px, 6px); }
        .hamburger-btn.active .hamburger-line:nth-child(2) { opacity: 0; }
        .hamburger-btn.active .hamburger-line:nth-child(3) { transform: rotate(-45deg) translate(6px, -6px); }
        #modernHeader { position: sticky !important; top: 20px !important; margin: 20px auto !important; max-width: calc(100% - 40px) !important; border-radius: 16px !important; box-shadow: 0 8px 32px rgba(0,0,0,0.12) !important; border: 1px solid rgba(255,255,255,0.2) !important; z-index: 50; }
        section { scroll-margin-top: 100px !important; }
        @media (max-width: 768px) {
            #modernHeader { top: 10px !important; margin: 10px auto !important; max-width: calc(100% - 20px) !important; border-radius: 12px !important; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <header id="modernHeader" class="transition-all duration-300 glassmorphism" role="banner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <a href="/home" class="flex items-center space-x-3 flex-shrink-0">
                    <div class="w-12 h-12 flex items-center justify-center transform transition-transform duration-300 hover:scale-110">
                        <img src="/assets/images/logodesign25.png" alt="Logo" class="max-w-full max-h-full rounded-lg">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Design Informática</h1>
                        <span class="text-xs text-blue-600 font-semibold uppercase">Cursos Profissionalizantes</span>
                    </div>
                </a>
                <nav class="hidden md:flex items-center space-x-1">
                    <a href="/home#cursos" class="px-4 py-2 text-gray-700 font-medium hover:text-blue-600">Cursos</a>
                    <a href="/home#inscricao" class="px-4 py-2 text-gray-700 font-medium hover:text-blue-600">Inscrição</a>
                    <a href="https://wa.me/559991199793" target="_blank" class="px-4 py-2 text-gray-700 font-medium hover:text-blue-600">Contato</a>
                </nav>
                <button id="modernMobileMenuBtn" class="md:hidden p-3 rounded-xl hamburger-btn group">
                    <div class="w-6 h-6 flex flex-col justify-center items-center space-y-1.5">
                        <span class="hamburger-line w-6 h-0.5 bg-gray-600 rounded-full transition-all duration-300"></span>
                        <span class="hamburger-line w-6 h-0.5 bg-gray-600 rounded-full transition-all duration-300"></span>
                        <span class="hamburger-line w-6 h-0.5 bg-gray-600 rounded-full transition-all duration-300"></span>
                    </div>
                </button>
            </div>
        </div>
    </header>
    <div id="mobileMenu" class="fixed inset-0 z-40 hidden">
        <div id="menuOverlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm"></div>
        <div id="menuSidebar" class="fixed top-0 right-0 h-full w-80 max-w-sm bg-white/95 backdrop-blur-xl shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out">
            <div class="flex items-center justify-between p-6 border-b">
                <h2 class="text-lg font-bold">Menu</h2>
                <a href="javascript:void(0);" id="fechar-menu-btn" class="text-3xl font-bold text-gray-700 hover:text-red-500 transition-colors" aria-label="Fechar menu">&times;</a>
            </div>
            <div class="flex flex-col justify-between h-[calc(100%-81px)]">
                <nav class="p-6">
                    <div class="space-y-2">
                        <a href="/home#cursos" class="mobile-menu-link flex items-center space-x-4 p-4 rounded-xl hover:bg-blue-50 group">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800 group-hover:text-blue-600">Cursos</span>
                                <p class="text-xs text-gray-500">Veja todos os cursos</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        <a href="/home#inscricao" class="mobile-menu-link flex items-center space-x-4 p-4 rounded-xl hover:bg-blue-50 group">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div class="flex-1">
                                <span class="font-semibold text-gray-800 group-hover:text-blue-600">Inscrição</span>
                                <p class="text-xs text-gray-500">Faça sua inscrição</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </nav>
                <div class="p-6 border-t">
                    <h3 class="text-sm font-semibold text-gray-800 mb-4">Informações de Contato</h3>
                    <div class="space-y-4">
                        <a href="https://wa.me/559981491353" target="_blank" class="flex items-center space-x-3 text-sm text-gray-600 hover:text-green-600">
                            <i class="fab fa-whatsapp text-lg text-green-500"></i>
                            <span class="font-medium">WhatsApp da Loja</span>
                        </a>
                        <a href="https://wa.me/559991199793" target="_blank" class="flex items-center space-x-3 text-sm text-gray-600 hover:text-green-600">
                            <i class="fab fa-whatsapp text-lg text-green-500"></i>
                            <span class="font-medium">WhatsApp dos Cursos</span>
                        </a>
                        <div class="flex items-center space-x-3 text-sm text-gray-600">
                           <i class="fa-solid fa-location-dot text-lg text-gray-400"></i>
                           <span class="font-medium">Av. Augusto Teixeira 2284 - Centro, Codó-MA</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
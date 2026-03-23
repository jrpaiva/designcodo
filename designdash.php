<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Design Informática</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3b82f6;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #1f2937;
            --light: #f9fafb;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            min-height: 100vh;
        }
        
        .dashboard-card {
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .stats-card {
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-3px);
        }
        
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            background-color: #e5e7eb;
        }
        
        .progress-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            transform: translateY(-2px);
        }
        
        .notification-dot {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ef4444;
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
</head>
<body class="antialiased">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 极 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-gray-800">Dashboard Notion</h1>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="notification-dot"></span>
                    </button>
                </div>
                
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-semibold">DI</span>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Admin</span>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-6">
        <!-- Page Title -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Painel de Atividades</h2>
            <p class="text-gray-600">Visualize e gerencie todas as atividades da empresa</p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="stats-card bg-white rounded-xl p-5 shadow border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total de Itens</p>
                        <h3 class="text-2xl font-bold text-gray-800">24</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 极 012-2h2a2 2 0 012 2M9 5a2 2 0 002 2h2a2 2 0 002-2"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="progress-bar">
                        <div class="progress-fill bg-blue-500" style="width: 75%"></div>
                    </div>
                </div>
            </div>
            
            <div class="stats-card bg-white rounded-xl p-5 shadow border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Concluídos</p>
                        <h3 class="text-2xl font-bold text-gray-800">12</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="progress-bar">
                        <div class="progress-fill bg-green-500" style="width: 50%"></div>
                    </div>
                </div>
            </div>
            
            <div class="stats-card bg-white rounded-xl p-5 shadow border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Em Andamento</p>
                        <h3 class="text-2xl font-bold text-gray-800">8</h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 极 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="progress-bar">
                        <div class="progress-fill bg-yellow-500" style="width: 33%"></div>
                    </div>
                </div>
            </div>
            
            <div class="stats-card bg-white rounded-xl p-5 shadow border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Atrasados</p>
                        <h3 class="text-2xl font-bold text-gray-800">4</h3>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg极 items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="progress-bar">
                        <div class="progress-fill bg-red-500" style="width: 17%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Actions -->
        <div class="bg-white rounded-xl shadow mb-6 p-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                    <input type="text" placeholder="Buscar..." class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Todos os Status</option>
                        <option>Concluído</option>
                        <option>Em Andamento</option>
                        <option>Pendente</option>
                        <option>Atrasado</option>
                    </select>
                    
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Todos os Tipos</option>
                        <option>Projeto</option>
                        <option>Meta</option>
                        <option>Campanha</option>
                        <option>Tarefa</option>
                    </select>
                </div>
                
                <div class="flex space-x-3">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-sync-alt mr-2"></i> Atualizar
                    </button>
                    <button class="btn-primary px-4 py-2 text-white rounded-lg font-medium">
                        <i class="fas fa-plus mr-2"></i> Novo Item
                    </button>
                </div>
            </div>
        </div>

        <!-- Cards View -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Visualização em Cards</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Sample Card 1 -->
                <div class="dashboard-card bg-white rounded-xl shadow p-5">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="font-semibold text-gray-800">Campanha de Marketing Digital</h4>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Campanha</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Implementação de nova campanha nas redes sociais para o lançamento do produto.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                        <span><i class="far fa-calendar-alt mr-1"></i> 30/08/2023</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full">Concluído</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-blue-500 border-2 border-white"></div>
                            <div class="w-8 h-8 rounded-full bg-green-500 border-2 border-white"></div>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detalhes <i class="fas fa-arrow-right ml-1"></i></button>
                    </div>
                </div>
                
                <!-- Sample Card 2 -->
                <div class="dashboard-card bg-white rounded-xl shadow p-5">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="font-semibold text-gray-800">Redesign do Site Institucional</h4>
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">Projeto</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Atualização do design e implementação de novas funcionalidades no site.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                        <span><i class="far fa-calendar-alt mr-1"></i> 15/09/2023</span>
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">Em Andamento</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full bg-purple-500 border-2 border-white"></div>
                            <div class="w-8 h-8 rounded-full bg-red-500 border-2 border-white"></div>
                            <div class="w-8 h-8 rounded-full bg-gray-500 border-2 border-white flex items-center justify-center text-white text-xs">+2</div>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detalhes <i class="fas fa-arrow-right ml-1"></i></button>
                    </div>
                </div>
                
                <!-- Sample Card 3 -->
                <div class="dashboard-card bg-white rounded-xl shadow p-5">
                    <div class="flex items-start justify-between mb-3">
                        <h4 class="font-semibold text-gray-800">Meta de Vendas Trimestral</h4>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Meta</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Atingir R$ 150.000 em vendas no trimestre com foco em novos clientes.</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                        <span><i class="far fa-calendar-alt mr-1"></i> 30/09/2023</span>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full">Pendente</span>
                    </div>
                    <div class="mb-3">
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Progresso</span>
                            <span>65%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill bg-green-500" style="width: 65%"></div>
                        </div>
                    </div>
                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Detalhes <i class="fas fa-arrow-right ml-1"></i></button>
                </div>
            </div>
        </div>

        <!-- Table View -->
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <h3 class="text-lg font-semibold text-gray-800 p-5 border-b">Visualização em Tabela</h3>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Sample Row 1 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Campanha de Marketing Digital</div>
                                        <div class="text-sm text-gray-500">Lançamento de novo produto</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Campanha</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                30/08/2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Concluído</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                                <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        
                        <!-- Sample Row 2 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 极 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Redesign do Site Institucional</div>
                                        <div class="text-sm text-gray-500">Atualização de layout e recursos</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">Projeto</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                15/09/2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Em Andamento</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                                <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        
                        <!-- Sample Row 3 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Meta de Vendas Trimestral</div>
                                        <div class="text-sm text-gray-500">Atingir R$ 150.000 em vendas</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Meta</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                30/09/2023
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Pendente</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                                <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        
                        <!-- Sample Row 4 -->
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-red-100 rounded-lg flex items-center justify-center">
                                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">Treinamento de Nova Equipe</div>
                                        <div class="text-sm text-gray-500">Capacitação de novos funcionários</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Tarefa</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                10/08/2023
                            </td>
                            <td class="px-6极 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Atrasado</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i></a>
                                <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Mostrando
                            <span class="font-medium">1</span>
                            a
                            <span class="font-medium">4</span>
                            de
                            <span class="font-medium">24</span>
                            resultados
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600 hover:bg-blue-100">1</a>
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">2</a>
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">3</a>
                            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">6</a>
                            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simulação de dados (será substituído pela API do Notion)
        document.addEventListener('DOMContentLoaded', function() {
            // Atualizar a cada 30 segundos (quando conectar com a API)
            setInterval(() => {
                console.log('Atualizando dados...');
                // Aqui virá a chamada para a API do Notion
            }, 30000);
            
            // Filtros e busca
            const searchInput = document.querySelector('input[type="text"]');
            searchInput.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    console.log('Buscar por:', this.value);
                    // Implementar lógica de filtro
                }
            });
        });
    </script>
</body>
</html>
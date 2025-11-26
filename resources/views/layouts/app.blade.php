<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Море Событий' }}</title>

    <!-- Подключаем Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Шрифты -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite('resources/css/app.css')
    @livewireStyles

    <style>
        .ocean-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 25%, #3b82f6 50%, #60a5fa 75%, #93c5fd 100%);
            background-size: 400% 400%;
            animation: oceanFlow 8s ease-in-out infinite;
        }

        .nav-gradient {
            background: linear-gradient(90deg, rgba(30, 58, 138, 0.9) 0%, rgba(30, 64, 175, 0.8) 100%);
            backdrop-filter: blur(10px);
        }

        .card-gradient {
            background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
            border: 1px solid #dbeafe;
        }

        .footer-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        }

        .wave-divider {
            height: 150px;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .wave-divider svg {
            height: 100%;
            width: 100%;
        }

        .wave-divider .shape-fill {
            fill: #f8fafc;
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #bfdbfe;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        @keyframes oceanFlow {
            0% {
                background-position: 0% 50%
            }

            50% {
                background-position: 100% 50%
            }

            100% {
                background-position: 0% 50%
            }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px)
            }

            50% {
                transform: translateY(-10px)
            }

            100% {
                transform: translateY(0px)
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="font-inter antialiased bg-gradient-to-br from-blue-50 to-indigo-100">

    <!-- Header -->
    <header class="ocean-gradient text-white relative overflow-hidden">
        <!-- Декоративные волны -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 left-10 w-20 h-20 rounded-full bg-blue-300 blur-xl"></div>
            <div class="absolute top-20 right-20 w-32 h-32 rounded-full bg-indigo-300 blur-xl"></div>
            <div class="absolute bottom-10 left-1/4 w-24 h-24 rounded-full bg-cyan-300 blur-xl"></div>
        </div>

        <div class="relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <!-- Логотип -->
                    <div class="flex items-center space-x-3">
                        <div class="floating">
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" />
                                </svg>
                            </div>
                        </div>
                        <h1 class="text-logo text-3xl md:text-4xl font-black text-glow">
                            Море Событий
                        </h1>
                    </div>

                    <!-- Навигация -->
                    <nav class="nav-gradient rounded-2xl px-6 py-3 shadow-xl">
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-8">
                            <a href="#"
                                class="nav-link text-blue-100 hover:text-white font-semibold text-lg transition-all duration-300 text-center">
                                Главная
                            </a>
                            <a href="#"
                                class="nav-link text-blue-100 hover:text-white font-semibold text-lg transition-all duration-300 text-center">
                                События
                            </a>
                            <a href="#"
                                class="nav-link text-blue-100 hover:text-white font-semibold text-lg transition-all duration-300 text-center">
                                Контакты
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Волнообразный разделитель -->
        <div class="wave-divider">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape-fill"></path>
            </svg>
        </div>
    </header>

    <!-- Main Content -->
    <main class="relative">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            @yield('content')

            <!-- Красивый демонстрационный блок -->
            <div class="mt-12">
                <div
                    class="card-gradient rounded-2xl p-8 shadow-2xl border border-blue-100 transform hover:scale-[1.02] transition-all duration-300">
                    <div class="flex items-center mb-6">
                        <div class="w-3 h-8 bg-blue-500 rounded-full mr-4"></div>
                        <h2
                            class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">
                            Добро пожаловать в Море Событий
                        </h2>
                    </div>
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        Погрузитесь в мир увлекательных мероприятий и незабываемых впечатлений.
                        Наша платформа объединяет лучшие события города в одном месте.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div
                            class="glass-effect rounded-xl p-6 text-center group hover:bg-blue-500 transition-all duration-300">
                            <div
                                class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-white transition-colors">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-blue-900 group-hover:text-white">Календарь</h3>
                            <p class="text-sm text-gray-600 group-hover:text-blue-100 mt-2">Все события в одном
                                календаре</p>
                        </div>

                        <div
                            class="glass-effect rounded-xl p-6 text-center group hover:bg-indigo-500 transition-all duration-300">
                            <div
                                class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-white transition-colors">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-indigo-900 group-hover:text-white">Сообщество</h3>
                            <p class="text-sm text-gray-600 group-hover:text-indigo-100 mt-2">Присоединяйтесь к
                                единомышленникам</p>
                        </div>

                        <div
                            class="glass-effect rounded-xl p-6 text-center group hover:bg-cyan-500 transition-all duration-300">
                            <div
                                class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-white transition-colors">
                                <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-cyan-900 group-hover:text-white">Мгновенно</h3>
                            <p class="text-sm text-gray-600 group-hover:text-cyan-100 mt-2">Быстрое получение информации
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-gradient text-white mt-20 relative">
        <!-- Волнообразный верх подвала -->
        <div class="wave-divider" style="transform: rotate(0deg); height: 100px;">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                    class="shape-fill" fill="#1e3a8a"></path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <div class="flex justify-center items-center mb-6">
                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white">Море Событий</h3>
                </div>

                <p class="text-blue-100 text-lg mb-6 max-w-2xl mx-auto">
                    Откройте для себя мир незабываемых мероприятий и станьте частью нашего растущего сообщества
                </p>

                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-8 mb-8">
                    <a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">О нас</a>
                    <a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Политика
                        конфиденциальности</a>
                    <a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Условия
                        использования</a>
                    <a href="#" class="text-blue-100 hover:text-white transition-colors duration-300">Помощь</a>
                </div>

                <div class="border-t border-blue-400 pt-6">
                    <p class="text-blue-200">
                        Море Событий &copy; {{ date('Y') }}. Все права защищены.
                        <span class="mx-4 hidden sm:inline">|</span>
                        <br class="sm:hidden">
                        Свяжитесь с нами: <a href="mailto:info@more-sobytiy.ru"
                            class="text-white hover:text-blue-200 transition-colors">info@more-sobytiy.ru</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>

</html>

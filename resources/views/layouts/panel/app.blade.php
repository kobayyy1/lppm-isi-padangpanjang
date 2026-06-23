<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ISI Padangpanjang - LPPM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#fafafa] text-[#0f2440] antialiased overflow-x-hidden">

    <!-- HEADER & NAVBAR UTAMA -->
    <header x-data="{ mobileMenuOpen: false }" class="w-full bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between relative">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-isi.png') }}" alt="Logo ISI Padangpanjang"
                    class="h-12 w-auto object-contain">
            </div>

            <!-- MENU NAVIGASI DESKTOP -->
            <nav class="hidden md:flex items-center gap-8 font-medium text-gray-500">
                <a href="{{ route('home') }}" @class([
                    'transition-colors pb-1',
                    'text-[#0f2440] font-semibold border-b-2 border-orange-500' => request()->routeIs(
                        'home'),
                    'hover:text-[#0f2440]' => !request()->routeIs('home'),
                ])>
                    Home
                </a>

                <a href="{{ route('research.index') }}" @class([
                    'transition-colors pb-1',
                    'text-[#0f2440] font-semibold border-b-2 border-orange-500' => request()->routeIs(
                        'research.*'),
                    'hover:text-[#0f2440]' => !request()->routeIs('research.*'),
                ])>
                    Researchers
                </a>

                <a href="{{ route('information.index') }}" @class([
                    'transition-colors pb-1',
                    'text-[#0f2440] font-semibold border-b-2 border-orange-500' => request()->routeIs(
                        'information*'),
                    'hover:text-[#0f2440]' => !request()->routeIs('information*'),
                ])>
                    Information
                </a>

                <a href="{{ route('about.index') }}" @class([
                    'transition-colors pb-1',
                    'text-[#0f2440] font-semibold border-b-2 border-orange-500' => request()->routeIs(
                        'about*'),
                    'hover:text-[#0f2440]' => !request()->routeIs('about*'),
                ])>
                    About
                </a>
            </nav>
            <div class="flex items-center gap-2 sm:gap-4">
                <div x-data="{
                    open: false,
                    currentLang: localStorage.getItem('goog_lang') || 'id',
                    langNames: { id: 'Indonesia', en: 'English', ar: 'العربية', ja: '日本語', ko: '한국어', 'zh-CN': '简体中文' },
                    changeLang(code) {
                        this.currentLang = code;
                        localStorage.setItem('goog_lang', code);
                        this.open = false;
                
                        let selectBox = document.querySelector('.goog-te-combo');
                        if (selectBox) {
                            selectBox.value = code;
                            selectBox.dispatchEvent(new Event('change'));
                        }
                    }
                }" @click.away="open = false"
                    class="relative inline-block text-left select-none">

                    <button @click="open = !open"
                        class="flex items-center gap-2 border border-gray-300 rounded-md px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-50 transition-colors focus:outline-none">
                        <span x-text="langNames[currentLang]"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 transform transition-transform duration-200"
                            :class="open ? 'rotate-180' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-40 rounded-xl bg-white shadow-xl border border-gray-100 py-1 z-50 overflow-hidden"
                        style="display: none;">

                        <template x-for="(name, code) in langNames" :key="code">
                            <button @click="changeLang(code)"
                                :class="currentLang === code ? 'bg-slate-50 text-black font-bold' :
                                    'text-gray-600 hover:bg-slate-50'"
                                class="w-full text-left px-4 py-2 text-xs transition-colors focus:outline-none"
                                x-text="name">
                            </button>
                        </template>
                    </div>
                </div>

                <div id="google_translate_element" style="display: none !important;"></div>
                <a href="{{ route('admin.login') }}"
                    class="w-10 h-10 flex items-center justify-center transition-all active:scale-90 hover:opacity-80 flex-shrink-0">
                    <img src="{{ asset('images/icon/profile-icon.png') }}" alt="Profile Admin"
                        class="w-5 h-5 object-contain">
                </a>

                <!-- TOMBOL HAMBURGER MOBILE -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="block md:hidden text-[#0f2440] p-1.5 rounded-lg hover:bg-gray-50 focus:outline-none transition-colors ml-1"
                    aria-label="Toggle Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" x-show="!mobileMenuOpen" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"
                            x-show="mobileMenuOpen" style="display: none;" />
                    </svg>
                </button>
            </div>

        </div>

        <!-- AREA DROPDOWN MENU MOBILE -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4" @click.away="mobileMenuOpen = false"
            class="md:hidden bg-white border-b border-gray-100 px-6 py-5 space-y-3 shadow-2xl absolute w-full left-0 top-20 z-40"
            style="display: none;">

            <a href="{{ route('home') }}" @class([
                'py-3 text-sm font-bold transition-all border-l-4 rounded-r-xl flex items-center justify-between',
                'text-white bg-[#0f2440] border-[#ff9f1c] pl-5 shadow-[0_4px_12px_rgba(15,36,64,0.25)]' => request()->routeIs(
                    'home'),
                'text-gray-500 border-transparent hover:text-[#0f2440] hover:bg-gray-50 pl-3' => !request()->routeIs(
                    'home'),
            ]) interstitial>
                <span>Home</span>
                @if (request()->routeIs('home'))
                    <span class="w-2 h-2 rounded-full bg-[#ff9f1c] animate-pulse mr-2"></span>
                @endif
            </a>

            <a href="{{ route('research.index') }}" @class([
                'py-3 text-sm font-bold transition-all border-l-4 rounded-r-xl flex items-center justify-between',
                'text-white bg-[#0f2440] border-[#ff9f1c] pl-5 shadow-[0_4px_12px_rgba(15,36,64,0.25)]' => request()->routeIs(
                    'research.*'),
                'text-gray-500 border-transparent hover:text-[#0f2440] hover:bg-gray-50 pl-3' => !request()->routeIs(
                    'research.*'),
            ])>
                <span>Researchers</span>
                @if (request()->routeIs('research.*'))
                    <span class="w-2 h-2 rounded-full bg-[#ff9f1c] animate-pulse mr-2"></span>
                @endif
            </a>

            <a href="{{ route('information.index') }}" @class([
                'py-3 text-sm font-bold transition-all border-l-4 rounded-r-xl flex items-center justify-between',
                'text-white bg-[#0f2440] border-[#ff9f1c] pl-5 shadow-[0_4px_12px_rgba(15,36,64,0.25)]' => request()->routeIs(
                    'information*'),
                'text-gray-500 border-transparent hover:text-[#0f2440] hover:bg-gray-50 pl-3' => !request()->routeIs(
                    'information*'),
            ])>
                <span>Information</span>
                @if (request()->routeIs('information*'))
                    <span class="w-2 h-2 rounded-full bg-[#ff9f1c] animate-pulse mr-2"></span>
                @endif
            </a>

            <a href="{{ route('about.index') }}" @class([
                'py-3 text-sm font-bold transition-all border-l-4 rounded-r-xl flex items-center justify-between',
                'text-white bg-[#0f2440] border-[#ff9f1c] pl-5 shadow-[0_4px_12px_rgba(15,36,64,0.25)]' => request()->routeIs(
                    'about*'),
                'text-gray-500 border-transparent hover:text-[#0f2440] hover:bg-gray-50 pl-3' => !request()->routeIs(
                    'about*'),
            ])>
                <span>About</span>
                @if (request()->routeIs('about*'))
                    <span class="w-2 h-2 rounded-full bg-[#ff9f1c] animate-pulse mr-2"></span>
                @endif
            </a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- ========================================================================= -->
    <!-- MASTER FOOTER RESPONSIF -->
    <!-- ========================================================================= -->
    <footer class="w-full text-white font-sans mt-auto">
        <div
            class="bg-[#ff9f1c] min-h-[48px] md:h-10 w-full relative flex items-center py-3 md:py-0 px-4 sm:px-6 lg:px-8">
            <div
                class="max-w-7xl mx-auto w-full flex flex-col md:flex-row items-center justify-between relative gap-3 md:gap-0">
                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                    class="static md:absolute md:left-4 md:top-0 bg-[#ff9f1c] text-[#0f2440] hover:text-black w-12 h-12 md:w-24 md:h-24 rounded-full md:rounded-b-3xl flex items-center justify-center shadow-lg transition-all transform hover:translate-y-1 z-20 group -mt-9 md:mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                        stroke="currentColor"
                        class="w-6 h-6 md:w-10 md:h-10 transform group-hover:-translate-y-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                    </svg>
                </button>
                <div
                    class="w-full md:w-auto md:ml-auto flex items-center justify-center md:justify-end gap-2 text-[#0f2440] text-xs sm:text-sm font-semibold opacity-90 text-center">
                    <span>Institut Seni Indonesia Padangpanjang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4 hidden sm:block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9s2.015-9 4.5-9m0 0a9.015 9.015 0 0 1 0 18M12 3a9.004 9.004 0 0 0-8.716 6.748M12 3a9.004 9.004 0 0 1 8.716 6.748" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-[#0f2440] pt-10 pb-12 md:pb-16 px-4 sm:px-6 lg:px-8 relative border-t border-white/10">
            <div class="max-w-7xl mx-auto flex flex-col gap-8 md:gap-10">

                <div class="flex items-center justify-center md:justify-end gap-4 flex-wrap w-full">
                    <div class="relative group">
                        <span
                            class="absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap bg-white text-[#0f2440] text-[10px] font-bold px-2.5 py-1 rounded-md shadow-lg opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 pointer-events-none z-30">YouTube</span>
                        <a href="#"
                            class="relative flex items-center justify-center w-11 h-11 rounded-xl bg-[#ff9f1c] border-2 border-[#ff9f1c] hover:bg-white hover:border-white transition-all duration-300 shadow-md group-hover:scale-110">
                            <img src="{{ asset('images/icon/icon-YT.png') }}" alt="YouTube"
                                class="w-6 h-6 object-contain">
                        </a>
                    </div>
                    <div class="relative group">
                        <span
                            class="absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap bg-white text-[#0f2440] text-[10px] font-bold px-2.5 py-1 rounded-md shadow-lg opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 pointer-events-none z-30">Instagram</span>
                        <a href="#"
                            class="relative flex items-center justify-center w-11 h-11 rounded-xl bg-[#ff9f1c] border-2 border-[#ff9f1c] hover:bg-white hover:border-white transition-all duration-300 shadow-md group-hover:scale-110">
                            <img src="{{ asset('images/icon/icon-IG.png') }}" alt="Instagram"
                                class="w-6 h-6 object-contain">
                        </a>
                    </div>
                    <div class="relative group">
                        <span
                            class="absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap bg-white text-[#0f2440] text-[10px] font-bold px-2.5 py-1 rounded-md shadow-lg opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 pointer-events-none z-30">Website</span>
                        <a href="#"
                            class="relative flex items-center justify-center w-11 h-11 rounded-xl bg-[#ff9f1c] border-2 border-[#ff9f1c] hover:bg-white hover:border-white transition-all duration-300 shadow-md group-hover:scale-110">
                            <img src="{{ asset('images/icon/icon-book.png') }}" alt="Website"
                                class="w-6 h-6 object-contain">
                        </a>
                    </div>
                    <div class="relative group">
                        <span
                            class="absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap bg-white text-[#0f2440] text-[10px] font-bold px-2.5 py-1 rounded-md shadow-lg opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 pointer-events-none z-30">Email</span>
                        <a href="#"
                            class="relative flex items-center justify-center w-11 h-11 rounded-xl bg-[#ff9f1c] border-2 border-[#ff9f1c] hover:bg-white hover:border-white transition-all duration-300 shadow-md group-hover:scale-110">
                            <img src="{{ asset('images/icon/icon-SMS.png') }}" alt="Email"
                                class="w-6 h-6 object-contain">
                        </a>
                    </div>
                    <div class="relative group">
                        <span
                            class="absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap bg-white text-[#0f2440] text-[10px] font-bold px-2.5 py-1 rounded-md shadow-lg opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 pointer-events-none z-30">Telepon</span>
                        <a href="#"
                            class="relative flex items-center justify-center w-11 h-11 rounded-xl bg-[#ff9f1c] border-2 border-[#ff9f1c] hover:bg-white hover:border-white transition-all duration-300 shadow-md group-hover:scale-110">
                            <img src="{{ asset('images/icon/icon-HP.png') }}" alt="Phone"
                                class="w-6 h-6 object-contain">
                        </a>
                    </div>
                    <div class="relative group">
                        <span
                            class="absolute -top-10 left-1/2 -translate-x-1/2 whitespace-nowrap bg-white text-[#0f2440] text-[10px] font-bold px-2.5 py-1 rounded-md shadow-lg opacity-0 translate-y-1 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 pointer-events-none z-30">Lokasi</span>
                        <a href="#"
                            class="relative flex items-center justify-center w-11 h-11 rounded-xl bg-[#ff9f1c] border-2 border-[#ff9f1c] hover:bg-white hover:border-white transition-all duration-300 shadow-md group-hover:scale-110">
                            <img src="{{ asset('images/icon/alamat.png') }}" alt="Location"
                                class="w-6 h-6 object-contain">
                        </a>
                    </div>
                </div>
                <div
                    class="flex flex-col md:flex-row items-center justify-between gap-6 border-t border-white/10 pt-8 w-full text-center md:text-left">
                    <div
                        class="w-full md:w-auto flex justify-center md:justify-start text-xs text-gray-500 italic order-2 md:order-1">
                        LPPM - Multi Language Enabled
                    </div>

                    <div class="text-center md:max-w-md order-3 md:order-2">
                        <p class="text-xs sm:text-sm text-gray-400 font-normal leading-relaxed">
                            © All Copyrights and reserved Goes to Muhammad Bintang Ramadhan & Bayu Ady Nugrho
                        </p>
                    </div>

                    <div class="w-full md:w-auto flex justify-center md:justify-end order-1 md:order-3">
                        <div
                            class="w-16 h-16 md:w-20 md:h-20 bg-white rounded-full flex items-center justify-center overflow-hidden shadow-md">
                            <img src="{{ asset('images/logo-isi.png') }}" alt="Logo ISI Padangpanjang"
                                class="w-full h-full object-cover">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </footer>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en,ar,ja,ko,zh-CN',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>

    <style>
        .goog-te-banner-frame.skiptranslate,
        .goog-te-banner-frame {
            display: none !important;
        }

        body {
            top: 0px !important;
        }

        iframe.goog-te-banner-frame {
            display: none !important;
        }

        .goog-te-balloon-frame {
            display: none !important;
        }
    </style>
</body>

</html>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>ISI Padangpanjang - LPPM</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-isi.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $media->title }} - LPPM ISI Padangpanjang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

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
</head>

<body class="bg-white antialiased">

    <div class="bg-white min-h-screen py-12 md:py-16">
        <div class="w-full px-4 sm:px-8 md:px-16 lg:px-24">

            <div class="mb-12">
                <a href="{{ route('home') }}"
                    class="group inline-flex items-center gap-2.5 text-[11px] font-bold text-slate-400 hover:text-[#0f2440] uppercase tracking-widest transition-colors select-none">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform flex-shrink-0"
                        fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="space-y-4 mb-12 text-left select-none">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/icon-notice.png') }}" alt="Notice"
                        class="h-6 object-contain flex-shrink-0">
                    <div class="flex items-center gap-1.5 flex-wrap">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="grid grid-cols-2 gap-0.5 flex-shrink-0">
                                <span class="w-2.5 h-2.5 bg-[#ff9f1c] rounded-[2px]"></span>
                                <span class="w-2.5 h-2.5 bg-transparent"></span>
                                <span class="w-2.5 h-2.5 bg-transparent"></span>
                                <span class="w-2.5 h-2.5 bg-[#ff9f1c] rounded-[2px]"></span>
                            </div>
                        @endfor
                    </div>
                </div>
                <h2 class="text-4xl font-extrabold text-[#0f2440] tracking-tight relative pb-2 uppercase">
                    {{ $media->title }}a
                    <span class="absolute bottom-0 left-0 w-16 h-0.5 bg-[#0f2440] border-dashed border-b"></span>
                </h2>
            </div>

            <header class="text-left space-y-4 mb-10">
                <div class="flex flex-wrap items-center gap-2">
                    <span
                        class="inline-flex items-center gap-2 bg-orange-50 border border-orange-200 text-orange-700 px-4 py-1.5 rounded-full text-[11px] font-bold tracking-widest uppercase select-none flex-shrink-0">
                        <span class="w-1.5 h-1.5 bg-[#ff9f1c] rounded-full animate-pulse flex-shrink-0"></span>
                        Diterbitkan: {{ \Carbon\Carbon::parse($media->created_at)->format('d F Y') }}
                    </span>
                    <span
                        class="bg-[#0f2440] text-white text-[10px] font-bold tracking-widest uppercase px-3 py-1.5 rounded-full flex-shrink-0">Dokumentasi</span>
                </div>
                <div class="flex max-w-full text-left">
                    <div class="w-1 bg-[#ff9f1c] flex-shrink-0"></div>
                    <div class="bg-orange-50 px-5 py-4 rounded-r-xl w-full">
                        <p class="text-slate-600 text-base italic leading-relaxed font-light break-words">
                            {{ $media->deskripsi_singkat }}</p>
                    </div>
                </div>
            </header>

            <div class="border-t border-slate-100 my-10"></div>

            <div class="flex items-center gap-2 mb-5 select-none">
                <span class="w-2 h-2 bg-[#ff9f1c] rounded-full"></span>
                <span class="text-[10px] font-black text-[#0f2440] uppercase tracking-[.15em]">Dokumentasi Media</span>
            </div>

            @if ($media->video || $media->image)
                <div
                    class="grid grid-cols-1 {{ $media->video && $media->image ? 'sm:grid-cols-2' : 'sm:grid-cols-1 max-w-2xl' }} gap-6 mb-12 text-left">

                    @if ($media->video)
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white flex flex-col">
                            <div
                                class="bg-[#0f2440] px-5 py-3 flex items-center justify-between select-none flex-shrink-0">
                                <div
                                    class="flex items-center gap-2 text-slate-300 text-[11px] font-bold tracking-widest uppercase">
                                    <svg class="w-4 h-4 text-[#ff9f1c] flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 010 1.972l-11.54 6.347a1.125 1.125 0 01-1.667-.986V5.653z" />
                                    </svg>
                                    Video Player
                                </div>
                                <span
                                    class="bg-[#ff9f1c] text-[#7c3a00] text-[9px] font-black tracking-widest uppercase px-2.5 py-1 rounded-full">MP4</span>
                            </div>

                            <div class="w-full bg-[#0a1628] flex-1 min-h-0">
                                <div class="aspect-video w-full">
                                    <video class="w-full h-full object-contain" controls preload="metadata">
                                        <source src="{{ asset('storage/' . $media->video) }}" type="video/mp4">
                                    </video>
                                </div>
                            </div>

                            <div
                                class="px-5 py-3 border-t border-slate-100 bg-white flex items-center justify-between flex-shrink-0">
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#ff9f1c] rounded-full flex-shrink-0"></span>
                                    <span class="text-[11px] font-black text-[#0f2440] uppercase tracking-wider">Video
                                        Dokumentasi</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($media->image)
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-white flex flex-col">
                            <div
                                class="bg-[#0f2440] px-5 py-3 flex items-center justify-between select-none flex-shrink-0">
                                <div
                                    class="flex items-center gap-2 text-slate-300 text-[11px] font-bold tracking-widest uppercase">
                                    <svg class="w-4 h-4 text-[#ff9f1c] flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5M3.75 3.75h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6A2.25 2.25 0 013.75 3.75z" />
                                    </svg>
                                    Image Viewer
                                </div>
                                <span
                                    class="bg-[#ff9f1c] text-[#7c3a00] text-[9px] font-black tracking-widest uppercase px-2.5 py-1 rounded-full">JPG</span>
                            </div>

                            <div class="w-full flex-1 min-h-0">
                                <div class="aspect-video w-full bg-slate-50">
                                    <img src="{{ asset('storage/' . $media->image) }}" alt="{{ $media->title }}"
                                        class="w-full h-full object-cover">
                                </div>
                            </div>

                            <div
                                class="px-5 py-3 border-t border-slate-100 bg-white flex items-center justify-between flex-shrink-0">
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-[#0f2440] rounded-full flex-shrink-0"></span>
                                    <span class="text-[11px] font-black text-[#0f2440] uppercase tracking-wider">Foto
                                        Dokumentasi</span>
                                </div>
                                <a href="{{ asset('storage/' . $media->image) }}" target="_blank"
                                    class="inline-flex items-center gap-1.5 text-[11px] font-bold text-orange-600 hover:text-[#0f2440] uppercase tracking-wider transition-colors">
                                    Lihat Penuh
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            @endif

            <div class="border-t border-slate-100 pt-10 mb-12 text-left">
                <div class="text-slate-600 text-base leading-[1.9] font-light break-words">
                    {!! nl2br(e($media->deskripsi_lengkap)) !!}
                </div>
            </div>
        </div>
    </div>

    <div id="google_translate_element" style="display: none !important;"></div>

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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let savedLang = localStorage.getItem('goog_lang') || 'id';
            if (savedLang !== 'id') {
                setTimeout(() => {
                    let selectBox = document.querySelector('.goog-te-combo');
                    if (selectBox) {
                        selectBox.value = savedLang;
                        selectBox.dispatchEvent(new Event('change'));
                    }
                }, 700);
            }
        });
    </script>
</body>

</html>

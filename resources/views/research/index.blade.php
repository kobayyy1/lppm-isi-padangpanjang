@extends('layouts.panel.app')

@section('content')
    <div>
        <section class="bg-white py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative mb-8 sm:mb-10">
                    <div class="absolute -top-7 sm:-top-9 left-4 sm:left-8 z-10 flex items-end gap-2 sm:gap-3 select-none">
                        <img src="{{ asset('images/icon-doc.png') }}" alt="Docs"
                            class="h-8 sm:h-12 w-auto object-contain drop-shadow-md">
                        <img src="{{ asset('images/icon-notice.png') }}" alt="Notice"
                            class="h-5 sm:h-7 object-contain drop-shadow-md">

                        <div class="inline-flex items-center gap-1">
                            @for ($i = 0; $i < 3; $i++)
                                <div class="grid grid-cols-2 gap-0.5">
                                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-[#ff9f1c] rounded-[1px]"></span>
                                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-transparent"></span>
                                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-transparent"></span>
                                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-[#ff9f1c] rounded-[1px]"></span>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div
                        class="absolute top-1/2 -translate-y-1/2 right-6 sm:right-8 z-10 hidden sm:flex flex-col items-end gap-1 select-none">
                        <div class="w-36 h-[1.5px] bg-white opacity-20"></div>
                        <img src="{{ asset('images/icon/arrow-bold.png') }}" alt="Aksen"
                            class="h-10 w-auto object-contain drop-shadow-md">
                    </div>
                    <div
                        class="bg-[#0f2440] text-white px-5 sm:px-8 pt-11 sm:pt-8 pb-5 sm:pb-6 rounded-2xl shadow-sm overflow-hidden min-h-[90px] sm:min-h-[100px] relative">
                        <div class="absolute bottom-0 left-0 w-full h-1.5 bg-[#ff9f1c]"></div>
                        <h1 class="text-xl sm:text-4xl font-black tracking-tight">Data Penelitian:</h1>
                    </div>
                </div>
                <div class="flex justify-start mb-8">
                    <button
                        class="inline-flex items-center gap-2 bg-[#0f2440] text-white text-xs font-bold px-4 py-2 rounded-lg shadow-sm hover:bg-[#ff9f1c] hover:text-[#0f2440] transition-colors group">
                        Terbaru
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="currentColor"
                            class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform text-[#ff9f1c] group-hover:text-[#0f2440]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </div>
                <!-- ========================================================================= -->
                <!-- START: GRID DATA PENELITIAN (CAROUSEL SYSTEM)                            -->
                <!-- ========================================================================= -->
                @php
                    $perPage = 9;
                    $totalPenelitian = $penelitians->count();
                    $totalPages = $totalPenelitian > 0 ? (int) ceil($totalPenelitian / $perPage) : 1;
                @endphp

                <div id="carousel-wrapper">

                    @forelse ($penelitians->chunk($perPage) as $pageIndex => $chunk)
                        <div class="carousel-page {{ $pageIndex === 0 ? '' : 'hidden' }}" data-page="{{ $pageIndex }}">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 sm:mb-12">
                                @foreach ($chunk as $i => $item)
                                    @php $isFirst = ($pageIndex === 0 && $i === 0); @endphp

                                    <a href="{{ route('detail.penelitian', $item->id) }}"
                                        class="w-full aspect-[4/3] rounded-2xl overflow-hidden shadow-xl bg-gray-900 relative block
                                            {{ $isFirst ? 'border-2 border-[#ff9f1c]' : 'border border-gray-100 hover:shadow-2xl' }}
                                            group transition-all duration-300 transform hover:-translate-y-1">

                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-[#0f2440]/95 via-transparent to-transparent z-10">
                                        </div>

                                        @php
                                            $frontCoverPath = 'images/berita1.png';
                                            if (
                                                !empty($item->image) &&
                                                is_array($item->image) &&
                                                isset($item->image[0])
                                            ) {
                                                $frontCoverPath = 'storage/' . $item->image[0];
                                            } elseif (!empty($item->image) && is_string($item->image)) {
                                                $frontCoverPath = 'storage/' . $item->image;
                                            }
                                        @endphp

                                        <img src="{{ asset($frontCoverPath) }}" alt="{{ $item->judul }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            onerror="this.src='{{ asset('images/berita1.png') }}'">
                                        <div class="absolute bottom-0 inset-x-0 p-4 sm:p-5 z-20 text-left">
                                            <div class="flex items-start gap-1.5 mb-1.5">
                                                <div class="grid grid-cols-2 gap-0.5 mt-1 flex-shrink-0">
                                                    <span class="w-1.5 h-1.5 bg-[#ff9f1c] rounded-[1px]"></span>
                                                    <span class="w-1.5 h-1.5 bg-transparent"></span>
                                                    <span class="w-1.5 h-1.5 bg-transparent"></span>
                                                    <span class="w-1.5 h-1.5 bg-[#ff9f1c] rounded-[1px]"></span>
                                                </div>
                                                <h3
                                                    class="text-white font-extrabold text-sm sm:text-base leading-snug group-hover:text-[#ff9f1c] transition-colors line-clamp-2 text-left">
                                                    {{ $item->judul }}
                                                </h3>
                                            </div>
                                            <p
                                                class="text-gray-300 text-[10px] sm:text-xs font-light pl-4 leading-normal line-clamp-2 text-left">
                                                {{ $item->deskripsi_singkat }}
                                            </p>
                                        </div>
                                        <span
                                            class="absolute bottom-3 right-4 text-[8px] text-gray-400 opacity-60 font-light hidden sm:flex items-center gap-1 z-20">
                                            Institut Seni Indonesia Padangpanjang
                                            <svg class="w-2.5 h-2.5 text-[#ff9f1c]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                            </svg>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="carousel-page" data-page="0">
                            <div class="text-center py-12 text-gray-400 font-medium italic text-sm">
                                Belum ada berkas riset penelitian resmi yang diterbitkan, Dy. Silakan isi melalui dashboard
                                control panel admin.
                            </div>
                        </div>
                    @endforelse

                </div>
                <!-- ========================================================================= -->
                <!-- END: GRID DATA PENELITIAN                                                 -->
                <!-- ========================================================================= -->
                <div
                    class="flex flex-col sm:flex-row items-center justify-between gap-6 border-t border-gray-100 pt-8 relative">
                    <div class="hidden sm:block w-24"></div>
                    <div class="flex items-center gap-2 select-none" id="pagination-controls">
                        <button id="btn-prev"
                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-[#0f2440] hover:bg-[#0f2440] hover:text-white transition-all focus:outline-none shadow-sm disabled:opacity-30 disabled:cursor-not-allowed"
                            disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                stroke="currentColor" class="w-3.5 h-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>

                        <div class="flex items-center gap-1.5 text-xs font-bold font-mono" id="page-numbers">
                            @for ($p = 0; $p < $totalPages; $p++)
                                <button
                                    class="page-btn w-8 h-8 rounded-lg transition-colors {{ $p === 0 ? 'bg-[#0f2440] text-white' : 'text-gray-400 hover:bg-gray-100 hover:text-[#0f2440]' }}"
                                    data-target="{{ $p }}">
                                    {{ str_pad($p + 1, 2, '0', STR_PAD_LEFT) }}
                                </button>
                            @endfor
                        </div>

                        <button id="btn-next"
                            class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-[#0f2440] hover:bg-[#0f2440] hover:text-white transition-all focus:outline-none shadow-sm {{ $totalPages <= 1 ? 'disabled:opacity-30 disabled:cursor-not-allowed' : '' }}"
                            {{ $totalPages <= 1 ? 'disabled' : '' }}>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                                stroke="currentColor" class="w-3.5 h-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-center justify-center select-none self-center sm:self-end">
                        <img src="{{ asset('images/icon/arrow-bold.png') }}" alt="Aksen"
                            class="w-20 h-20 sm:w-36 sm:h-36 object-contain transform drop-shadow-md">
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JAVASCRIPT CAROUSEL SYSTEM LOGIC -->
    <script>
        (function() {
            const totalPages = {{ $totalPages }};
            let currentPage = 0;

            const pages = document.querySelectorAll('.carousel-page');
            const pageBtns = document.querySelectorAll('.page-btn');
            const btnPrev = document.getElementById('btn-prev');
            const btnNext = document.getElementById('btn-next');

            function goTo(page) {
                if (page < 0 || page >= totalPages) return;

                pages[currentPage].classList.add('hidden');
                pages[page].classList.remove('hidden');

                pageBtns[currentPage].classList.remove('bg-[#0f2440]', 'text-white');
                pageBtns[currentPage].classList.add('text-gray-400', 'hover:bg-gray-100', 'hover:text-[#0f2440]');

                pageBtns[page].classList.add('bg-[#0f2440]', 'text-white');
                pageBtns[page].classList.remove('text-gray-400', 'hover:bg-gray-100', 'hover:text-[#0f2440]');

                currentPage = page;

                if (btnPrev) btnPrev.disabled = currentPage === 0;
                if (btnNext) btnNext.disabled = currentPage === totalPages - 1;

                // Auto scroll-up halus pas ganti halaman biar memanjakan user mobile
                document.getElementById('carousel-wrapper').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            if (btnPrev) btnPrev.addEventListener('click', () => goTo(currentPage - 1));
            if (btnNext) btnNext.addEventListener('click', () => goTo(currentPage + 1));

            pageBtns.forEach(btn => {
                btn.addEventListener('click', () => goTo(parseInt(btn.dataset.target)));
            });
        })();
    </script>
@endsection

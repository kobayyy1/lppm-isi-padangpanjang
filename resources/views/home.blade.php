@extends('layouts.panel.app')

@section('content')
    @php
        $formattedBeritas = $beritas->map(function ($berita) {
            return [
                'title' => $berita->title,
                'subTitle' => \Illuminate\Support\Str::limit(strip_tags($berita->content), 120, '...'),
                'date' => \Carbon\Carbon::parse($berita->start_date ?? $berita->created_at)->format('d-m-Y'),
                'image' => $berita->image ? asset('storage/' . $berita->image) : asset('images/berita1.png'),
            ];
        });

        $formattedMedias = $medias->map(function ($m) {
            return [
                'title' => $m->title,
                'subTitle' => $m->deskripsi_singkat,
                'date' => \Carbon\Carbon::parse($m->created_at)->format('d-m-Y'),
                'image' => $m->image ? asset('storage/' . $m->image) : asset('images/berita1.png'),
                'videoUrl' => $m->video ? asset('storage/' . $m->video) : null,
                'detailUrl' => route('media.detail', $m->id),
            ];
        });

        $formattedInformations = $informations->map(function ($info) {
            return [
                'title' => $info->title,
                'subTitle' => $info->deskripsi_singkat,
                'date' => \Carbon\Carbon::parse($info->created_at)->format('d-m-Y'),
                'image' => $info->image ? asset('storage/' . $info->image) : asset('images/berita1.png'),
            ];
        });
    @endphp

    <section class="relative min-h-[calc(100vh-80px)] w-full overflow-hidden bg-white flex items-center">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center w-full relative z-10 py-12 lg:py-0">

            <div class="order-1 lg:order-none lg:col-span-6 flex flex-col justify-center text-left items-start z-20">
                <h1 class="text-4xl sm:text-5xl lg:text-[40px] xl:text-[52px] font-black text-[#0f2440] leading-[1.15] tracking-tight mb-6"
                    style="font-family: 'Roboto', sans-serif;">
                    <span class="block">Mentransformasi</span>
                    <span class="block whitespace-nowrap">Data Menjadi Solusi</span>
                    <span class="block whitespace-nowrap">Nyata Bagi Industri</span>
                    <span class="flex flex-wrap items-center gap-3">
                        Nasional
                        <span class="inline-flex items-center gap-2 select-none font-sans">
                            <span
                                class="bg-[#ff9f1c] text-white text-[10px] sm:text-xs font-bold px-2.5 py-1 rounded-md tracking-wide normal-case">
                                LPPM
                            </span>
                            <span class="flex items-center gap-1">
                                @for ($j = 0; $j < 3; $j++)
                                    <div class="grid grid-cols-2 gap-0.5">
                                        <span class="w-2.5 h-2.5 bg-[#ff9f1c] rounded-[2px]"></span>
                                        <span class="w-2.5 h-2.5 bg-transparent"></span>
                                        <span class="w-2.5 h-2.5 bg-transparent"></span>
                                        <span class="w-2.5 h-2.5 bg-[#ff9f1c] rounded-[2px]"></span>
                                    </div>
                                @endfor
                            </span>
                        </span>
                    </span>
                </h1>
                <p class="text-[#0f2440]/80 text-base sm:text-lg lg:text-xl font-medium leading-relaxed max-w-xl"
                    style="font-family: 'Roboto', sans-serif;">
                    Eksplorasi riset multidisiplin<br>untuk solusi masa depan.
                </p>
            </div>

            <div
                class="order-2 lg:order-none lg:col-span-6 relative flex items-center justify-center w-full h-full min-h-[350px] sm:min-h-[450px] lg:min-h-[calc(100vh-80px)] overflow-visible">
                <div class="relative w-full h-full flex items-center justify-center lg:justify-start z-10 overflow-visible">
                    <img src="{{ asset('images/hero-isometric.png') }}" alt="Mentransformasi Data Menjadi Solusi Nyata"
                        class="w-full max-w-[320px] sm:max-w-[420px] lg:max-w-[520px] xl:max-w-[580px] h-auto object-contain transition-transform duration-300 transform scale-100 lg:-translate-x-2 xl:-translate-x-4 origin-center lg:origin-left rounded-2xl">
                </div>
            </div>

        </div>

        <div class="absolute bottom-0 left-0 w-full h-2 flex z-20">
            <div class="w-[20%] sm:w-[25%] bg-[#ff9f1c] h-full"></div>
            <div class="w-[80%] sm:w-[75%] bg-[#0f2440] h-full"></div>
        </div>
    </section>

    <section class="bg-white py-16 border-t border-gray-100" x-data="newsComponent({{ $formattedBeritas->toJson() }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div class="flex flex-col">
                    <div class="flex items-center gap-3 mb-1 select-none">
                        <img src="{{ asset('images/icon-notice.png') }}" alt="Notice" class="h-6 object-contain">
                        <div class="flex items-center gap-1.5">
                            <template x-for="i in 3">
                                <div class="grid grid-cols-2 gap-0.5">
                                    <span class="w-2 h-2 bg-[#ff9f1c] rounded-[2px]"></span>
                                    <span class="w-2 h-2 bg-transparent"></span>
                                    <span class="w-2 h-2 bg-transparent"></span>
                                    <span class="w-2 h-2 bg-[#ff9f1c] rounded-[2px]"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                    <h1 class="text-6xl font-black text-[#0f2440] tracking-tight leading-none mt-1">Berita</h1>
                    <div class="flex items-center mt-2" style="gap:4px;">
                        <div class="bg-[#0f2440] rounded-full" style="width:100px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:30px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                    </div>
                    <span class="text-xs text-gray-400 mt-3 flex items-center gap-1.5">
                        <span class="w-1 h-3 bg-[#ff9f1c] rounded-full"></span>
                        Upload <span class="ml-1" x-text="beritaList[activeSlide].date"></span>
                    </span>
                </div>
                <div class="flex items-center justify-end gap-4 mb-2">
                    <img src="{{ asset('images/icon-arrow.png') }}" alt="Aksen" class="w-8 h-8 object-contain">
                    <img src="{{ asset('images/icon-doc.png') }}" alt="Docs" class="h-12 w-auto object-contain">
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
                <div class="lg:col-span-6 flex flex-col items-center w-full">
                    <div
                        class="relative w-full aspect-[4/3] rounded-2xl overflow-hidden shadow-md group border border-gray-100 bg-gray-900">
                        <div class="absolute inset-0 w-full h-full cursor-pointer">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#0f2440]/90 via-transparent to-transparent z-10">
                            </div>
                            <div class="absolute inset-0 bg-slate-800 z-0"></div>
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 relative z-10"
                                :src="beritaList[activeSlide].image" :alt="beritaList[activeSlide].title">
                            <div class="absolute bottom-0 inset-x-0 p-6 z-20 text-left">
                                <div class="flex items-center gap-1.5 mb-2">
                                    <div class="grid grid-cols-2 gap-0.5">
                                        <div class="w-1.5 h-1.5 bg-[#ff9f1c]"></div>
                                        <div class="w-1.5 h-1.5 bg-[#ff9f1c]"></div>
                                        <div class="w-1.5 h-1.5 bg-[#ff9f1c]"></div>
                                        <div class="w-1.5 h-1.5 bg-transparent"></div>
                                    </div>
                                    <h3 class="text-white font-bold text-sm sm:text-base md:text-lg leading-snug lg:max-w-md"
                                        x-text="beritaList[activeSlide].title"></h3>
                                </div>
                                <p class="text-gray-300 text-[11px] sm:text-xs font-light pl-4"
                                    x-text="beritaList[activeSlide].subTitle"></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mt-4">
                        <template x-for="(item, index) in beritaList" :key="index">
                            <button class="h-2 rounded-full transition-all duration-300" @click="activeSlide = index"
                                :class="activeSlide === index ? 'w-6 bg-[#0f2440]' : 'w-2 bg-gray-300'"></button>
                        </template>
                    </div>
                </div>

                <div class="lg:col-span-6 grid grid-cols-12 gap-4 w-full relative lg:aspect-[4/3] animate-fade-in">
                    <div class="col-span-11 relative h-full">
                        <div class="w-full h-full overflow-y-auto pl-10 pr-2 flex flex-col scroll-smooth no-scrollbar"
                            style="scrollbar-width: none; -ms-overflow-style: none;">
                            <div class="space-y-0 h-full">
                                <template x-for="(item, index) in beritaList" :key="index">
                                    <div class="w-full h-[33.33%] flex-shrink-0 flex flex-col justify-center relative group cursor-pointer border-b border-gray-100/50 last:border-0 py-2"
                                        @click="activeSlide = index">
                                        <div class="absolute left-[-23px] top-0 bottom-0 w-1.5 pointer-events-none flex flex-col overflow-hidden"
                                            :class="index === 0 ? 'rounded-t-full' : (index === beritaList.length - 1 ?
                                                'rounded-b-full' : '')">
                                            <div class="w-full h-1/2 transition-colors duration-300"
                                                :class="index <= activeSlide ? 'bg-[#0f2440]' : 'bg-slate-200'"></div>
                                            <div class="w-full h-1/2 transition-colors duration-300"
                                                :class="index < activeSlide ? 'bg-[#0f2440]' : 'bg-slate-200'"></div>
                                        </div>
                                        <div class="absolute left-[-30px] top-1/2 -translate-y-1/2 w-5 h-5 rounded-full border-2 transition-all duration-300 z-10 flex items-center justify-center shadow-sm"
                                            :class="activeSlide === index ?
                                                'border-[#0f2440] bg-white scale-110 ring-4 ring-[#ff9f1c]/30' :
                                                'border-gray-300 bg-white group-hover:border-[#0f2440]'">
                                            <div class="w-2.5 h-2.5 rounded-full bg-[#0f2440]"
                                                x-show="activeSlide === index"></div>
                                        </div>
                                        <div class="text-left w-full">
                                            <h3 class="text-sm sm:text-base md:text-lg transition-all duration-300 leading-tight mb-1 line-clamp-1"
                                                :class="activeSlide === index ?
                                                    'text-[#0f2440] font-extrabold underline decoration-sky-400 decoration-2 underline-offset-4' :
                                                    'text-gray-400 font-bold group-hover:text-[#0f2440]'"
                                                x-text="item.title"></h3>
                                            <p class="text-gray-400 text-xs font-normal leading-normal mb-1 line-clamp-2"
                                                x-text="item.subTitle"></p>
                                            <span class="text-[10px] text-gray-400 flex items-center gap-1">
                                                <span class="w-0.5 h-2.5 bg-[#ff9f1c]"></span>
                                                Upload <span class="ml-1" x-text="item.date"></span>
                                            </span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1 hidden lg:flex justify-end h-full pl-2">
                        <div
                            class="relative w-4 bg-slate-100 border border-slate-200/50 rounded-full h-full overflow-hidden shadow-inner">
                            <div class="absolute w-full bg-[#0f2440] rounded-full h-20 transition-all duration-500 shadow-md"
                                :style="`top: ${beritaList.length > 1 ? (activeSlide / (beritaList.length - 1)) * 75 : 0}%`">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section
        class="relative min-h-[550px] sm:min-h-[650px] lg:min-h-[700px] w-full overflow-hidden bg-[#0f2440] text-white"
        x-data="mediaComponent({{ $formattedMedias->toJson() }})">
        <div class="absolute inset-0 w-full h-full z-0 transition-all duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0f2440] via-[#0f2440]/70 to-[#0f2440]/50 z-10"></div>
            <div class="absolute inset-0 bg-black/30 z-10"></div>
            <template x-if="total > 0">
                <img class="w-full h-full object-cover transition-all duration-500" :src="mediaList[activeMedia].image"
                    alt="Background Media">
            </template>
        </div>

        <div class="absolute top-0 left-0 w-full h-2 flex z-30">
            <div class="w-[45%] bg-white h-full opacity-90"></div>
            <div class="w-[40%] bg-[#0f2440] h-full"></div>
            <div class="w-[15%] bg-[#ff9f1c] h-full"></div>
        </div>

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 pt-16 pb-12 flex flex-col justify-between min-h-[550px] sm:min-h-[650px] lg:min-h-[700px]">
            <div class="flex flex-col items-start text-left">
                <div class="flex items-center gap-2 mb-1">
                    <span class="inline-flex items-center justify-center select-none w-auto h-auto">
                        <img src="{{ asset('images/icon-notice.png') }}" alt="Notice"
                            class="w-auto h-5 sm:h-6 object-contain">
                    </span>
                    <div class="flex items-center gap-1.5">
                        <template x-for="i in 3">
                            <div class="grid grid-cols-2 gap-0.5">
                                <span class="w-2 h-2 bg-[#ff9f1c] rounded-[2px]"></span>
                                <span class="w-2 h-2 bg-transparent"></span>
                                <span class="w-2 h-2 bg-transparent"></span>
                                <span class="w-2 h-2 bg-[#ff9f1c] rounded-[2px]"></span>
                            </div>
                        </template>
                    </div>
                </div>
                <h1 class="text-6xl font-white text-white tracking-tight leading-none mt-1"
                    style="font-family: 'Roboto', sans-serif;">Media</h1>
                <div class="flex items-center mt-2" style="gap:4px;">
                    <div class="bg-white rounded-full" style="width:100px;height:3px;"></div>
                    <div class="bg-white rounded-full" style="width:20px;height:3px;"></div>
                    <div class="bg-white rounded-full" style="width:6px;height:3px;"></div>
                    <div class="bg-white rounded-full" style="width:6px;height:3px;"></div>
                    <div class="bg-white rounded-full" style="width:6px;height:3px;"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mt-12 w-full">
                <div class="lg:col-span-5 flex flex-col items-start text-left">
                    <template x-if="total > 0">
                        <div class="w-full">
                            <span class="text-xs text-gray-300 font-medium mb-2 flex items-center gap-1.5">
                                <span class="w-1 h-3 bg-[#ff9f1c] rounded-full"></span>
                                Upload <span class="ml-1" x-text="mediaList[activeMedia].date"></span>
                            </span>
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white leading-tight tracking-tight mb-3 max-w-xl"
                                x-text="mediaList[activeMedia].title"></h1>
                            <p class="text-gray-300 text-xs sm:text-sm font-light leading-relaxed max-w-lg mb-8"
                                x-text="mediaList[activeMedia].subTitle"></p>
                        </div>
                    </template>

                    <template x-if="total === 0">
                        <div class="w-full mb-8">
                            <h1
                                class="text-2xl sm:text-3xl lg:text-4xl font-black text-gray-400 leading-tight tracking-tight mb-3">
                                Belum Ada Media</h1>
                            <p class="text-gray-400 text-xs sm:text-sm italic">Silakan unggah data media galeri baru dari
                                dashboard admin panel.</p>
                        </div>
                    </template>

                    <div class="flex items-center gap-4 flex-wrap">
                        <button
                            class="w-12 h-12 rounded-xl flex items-center justify-center font-bold shadow-lg transition-all transform hover:scale-105"
                            @click="openVideoModal(mediaList[activeMedia].videoUrl)"
                            :disabled="!mediaList[activeMedia].videoUrl"
                            :class="mediaList[activeMedia].videoUrl ? 'bg-[#ff9f1c] text-[#0f2440] hover:bg-white' :
                                'bg-gray-600 text-gray-400 cursor-not-allowed'">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <a class="inline-flex items-center gap-3 bg-[#0f2440]/60 backdrop-blur-md border border-white/20 text-white font-semibold text-xs tracking-wide px-5 py-3.5 rounded-xl hover:bg-white hover:text-[#0f2440] hover:border-white transition-all shadow-md"
                            :href="mediaList[activeMedia].detailUrl">
                            <span class="w-1 h-3 bg-[#ff9f1c] rounded-full"></span>Lihat Selengkapnya
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-7 w-full flex items-center justify-center lg:justify-end gap-3 select-none"
                    x-show="total > 1">
                    <button
                        class="flex-shrink-0 bg-white text-[#0f2440] hover:bg-[#ff9f1c] w-10 h-10 rounded-full flex items-center justify-center shadow-lg border border-gray-100 z-30 transition-all focus:outline-none"
                        @click="prevMedia()">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="3" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <div class="flex items-center gap-3 overflow-hidden w-full lg:max-w-[600px] py-3">
                        <div class="flex items-center gap-3 transition-transform duration-300">
                            <template x-for="(media, index) in mediaList" :key="index">
                                <div class="relative w-[160px] sm:w-[185px] h-[120px] sm:h-[140px] rounded-xl overflow-hidden cursor-pointer transition-all duration-300 bg-slate-800 flex-shrink-0"
                                    @click="activeMedia = index"
                                    :class="activeMedia === index ? 'border-2 border-[#ff9f1c] opacity-100 shadow-2xl z-10' :
                                        'border border-white/10 opacity-40 hover:opacity-70'">
                                    <img class="w-full h-full object-cover" :src="media.image">
                                    <div
                                        class="absolute bottom-2 right-2 bg-black/60 backdrop-blur-sm px-2 py-0.5 rounded text-[10px] text-white/90 font-medium">
                                        <span x-text="String(index + 1).padStart(2, '0')"></span> / <span
                                            x-text="String(total).padStart(2, '0')"></span>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <button
                        class="flex-shrink-0 bg-white text-[#0f2440] hover:bg-[#ff9f1c] w-10 h-10 rounded-full flex items-center justify-center shadow-lg border border-gray-100 z-30 transition-all focus:outline-none"
                        @click="nextMedia()">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="3" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-md"
            x-show="showVideo" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @keydown.escape.window="closeVideoModal()" style="display: none;">
            <button class="absolute top-6 right-6 text-white hover:text-[#ff9f1c] transition-colors focus:outline-none"
                @click="closeVideoModal()">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="w-full max-w-4xl aspect-video rounded-2xl overflow-hidden shadow-2xl bg-black border border-white/10"
                @click.away="closeVideoModal()">
                <template x-if="showVideo && activeVideoUrl">
                    <video class="w-full h-full object-contain" x-ref="modalVideo" controls autoplay>
                        <source :src="activeVideoUrl" type="video/mp4">
                    </video>
                </template>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 border-t border-gray-100 overflow-hidden relative" x-data="informationComponent({{ $formattedInformations->toJson() }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8">
                <div class="flex flex-col text-left">
                    <div class="flex items-center gap-1.5 mb-1 select-none">
                        <img src="{{ asset('images/icon-notice.png') }}" alt="Notice"
                            class="h-5 sm:h-6 object-contain">
                        <template x-for="i in 3">
                            <div class="grid grid-cols-2 gap-0.5">
                                <span class="w-2 h-2 bg-[#ff9f1c] rounded-[2px]"></span>
                                <span class="w-2 h-2 bg-transparent"></span>
                                <span class="w-2 h-2 bg-transparent"></span>
                                <span class="w-2 h-2 bg-[#ff9f1c] rounded-[2px]"></span>
                            </div>
                        </template>
                    </div>

                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl font-black text-[#0f2440] tracking-tight leading-none mt-1">
                        Information</h1>

                    <div class="flex items-center mt-2" style="gap:4px;">
                        <div class="bg-[#0f2440] rounded-full w-28 sm:w-[220px]" style="height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full w-10 sm:w-[60px]" style="height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full w-1.5" style="height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full w-1.5" style="height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full w-1.5" style="height:3px;"></div>
                    </div>
                    <span class="text-xs text-gray-400 mt-3 flex items-center gap-1.5">
                        <span class="w-1 h-3 bg-[#ff9f1c] rounded-full"></span>
                        Upload <span x-text="infoList[activeIndex].date"></span>
                    </span>
                </div>

                <div class="flex items-center justify-start sm:justify-end gap-3 sm:gap-4 self-start sm:self-center">
                    <img src="{{ asset('images/icon-arrow.png') }}" alt="Aksen"
                        class="w-6 h-6 sm:w-8 sm:h-8 object-contain">
                    <img src="{{ asset('images/icon-doc.png') }}" alt="Docs"
                        class="h-8 sm:h-12 w-auto object-contain">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-6 overflow-x-auto pb-6 pt-2 scrollbar-none w-full snap-x snap-mandatory scroll-smooth"
            x-ref="infoSlider" @scroll="updateActiveIndex()">
            <template x-for="(info, index) in infoList" :key="index">
                <div class="snap-start w-[85vw] sm:w-[420px] md:w-[450px] lg:w-[480px] aspect-[4/3] rounded-2xl overflow-hidden bg-gray-900 relative cursor-pointer group flex-shrink-0 transition-all duration-300"
                    @click="openPreview(info.image)"
                    :class="index === activeIndex ?
                        'border-2 border-[#ff9f1c] shadow-xl opacity-100 scale-100 ring-4 ring-[#ff9f1c]/10' :
                        'border border-gray-100 shadow-md opacity-40 hover:opacity-70 scale-98'">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f2440]/95 via-transparent to-transparent z-10">
                    </div>
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        :src="info.image" :alt="info.title">
                    <div class="absolute bottom-0 inset-x-0 p-6 z-20 text-left">
                        <div class="flex items-center gap-1.5 mb-2">
                            <div class="grid grid-cols-2 gap-[1px]">
                                <span class="w-1.5 h-1.5 bg-[#ff9f1c] rounded-[1px]"></span>
                                <span class="w-1.5 h-1.5 bg-transparent"></span>
                                <span class="w-1.5 h-1.5 bg-transparent"></span>
                                <span class="w-1.5 h-1.5 bg-[#ff9f1c] rounded-[1px]"></span>
                            </div>
                            <h3 class="text-white font-extrabold text-base sm:text-lg leading-tight" x-text="info.title">
                            </h3>
                        </div>
                        <p class="text-gray-300 text-xs font-light pl-5" x-text="info.subTitle"></p>
                    </div>
                    <span
                        class="absolute bottom-4 right-4 text-[9px] text-gray-400 opacity-80 font-light flex items-center gap-1 z-20">
                        Institut Seni Indonesia Padangpanjang
                        <svg class="w-3 h-3 text-[#ff9f1c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 0119 0" />
                        </svg>
                    </span>
                </div>
            </template>

            <template x-if="infoList.length === 1 && infoList[0].date === '---'">
                <div class="w-full text-center py-12 text-gray-400 italic font-medium">
                    Belum ada data informasi terbaru yang diterbitkan.
                </div>
            </template>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-6 mt-4 justify-start w-full">
                <div class="flex items-center gap-2.5" x-show="infoList.length > 1 && infoList[0].date !== '---'">
                    <button
                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-[#0f2440] hover:bg-[#0f2440] hover:text-white transition-all focus:outline-none shadow-sm active:scale-95"
                        @click="scrollInfo('prev')">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/xl" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                    <button
                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-[#0f2440] hover:bg-[#0f2440] hover:text-white transition-all focus:outline-none shadow-sm active:scale-95"
                        @click="scrollInfo('next')">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
                <a class="inline-flex items-center gap-3 bg-[#0f2440] text-white font-bold text-xs tracking-wide px-6 py-3.5 rounded-xl hover:bg-[#ff9f1c] hover:text-[#0f2440] transition-all shadow-md"
                    href="{{ route('information.index') }}">
                    <span class="w-0.5 h-3 bg-[#ff9f1c] rounded-full"></span>Lihat Selengkapnya
                </a>
            </div>
        </div>

        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
            x-show="openModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            @keydown.escape.window="openModal = false" style="display: none;">
            <button class="absolute top-6 right-6 text-white hover:text-[#ff9f1c] transition-colors focus:outline-none"
                @click="openModal = false">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="max-w-4xl max-h-[85vh] overflow-hidden rounded-xl shadow-2xl bg-gray-900 border border-white/10"
                @click.away="openModal = false" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="scale-95 opacity-0" x-transition:enter-end="scale-100 opacity-100">
                <img class="w-full h-full object-contain max-h-[85vh]" :src="modalImage" alt="Preview Full">
            </div>
        </div>
    </section>

    <script>
        function newsComponent(laravelBerita) {
            const defaultPlaceholder = [{
                title: "Belum Ada Berita Terbaru, Dy!",
                subTitle: "Silakan isi data berita utama dari dashboard control panel admin terlebih dahulu.",
                date: "---",
                image: "{{ asset('images/berita1.png') }}"
            }];
            return {
                activeSlide: 0,
                beritaList: laravelBerita && laravelBerita.length > 0 ? laravelBerita : defaultPlaceholder
            }
        }

        function mediaComponent(laravelMedia) {
            const defaultPlaceholder = [{
                title: "Belum Ada Media Terbaru, Dy!",
                subTitle: "Silakan isi documentation galeri media dari dashboard control panel admin terlebih dahulu.",
                date: "---",
                image: "{{ asset('images/berita1.png') }}",
                videoUrl: null,
                detailUrl: "#"
            }];
            return {
                activeMedia: 0,
                showVideo: false,
                activeVideoUrl: '',
                mediaList: laravelMedia && laravelMedia.length > 0 ? laravelMedia : defaultPlaceholder,
                get total() {
                    return this.mediaList.length;
                },
                openVideoModal(url) {
                    if (!url) return;
                    this.activeVideoUrl = url;
                    this.showVideo = true;
                    this.$nextTick(() => {
                        if (this.$refs.modalVideo) {
                            this.$refs.modalVideo.load();
                            this.$refs.modalVideo.play();
                        }
                    });
                },
                closeVideoModal() {
                    if (this.$refs.modalVideo) {
                        this.$refs.modalVideo.pause();
                    }
                    this.showVideo = false;
                    this.activeVideoUrl = '';
                },
                prevMedia() {
                    this.activeMedia = this.activeMedia === 0 ? this.total - 1 : this.activeMedia - 1;
                },
                nextMedia() {
                    this.activeMedia = this.activeMedia === this.total - 1 ? 0 : this.activeMedia + 1;
                }
            }
        }

        function informationComponent(laravelInformation) {
            const defaultPlaceholder = [{
                title: "Belum Ada Informasi Terbaru, Dy!",
                subTitle: "Silakan isi data papan pengumuman informasi dari dashboard control panel admin terlebih dahulu.",
                date: "---",
                image: "{{ asset('images/berita1.png') }}"
            }];
            return {
                activeIndex: 0,
                openModal: false,
                modalImage: '',
                infoList: laravelInformation && laravelInformation.length > 0 ? laravelInformation : defaultPlaceholder,
                openPreview(imageSrc) {
                    if (this.infoList[0].date === '---') return;
                    this.modalImage = imageSrc;
                    this.openModal = true;
                },
                scrollInfo(direction) {
                    if (this.infoList[0].date === '---') return;
                    const slider = this.$refs.infoSlider;
                    if (!slider) return;
                    const cards = Array.from(slider.querySelectorAll(':scope > div'));
                    if (!cards.length) return;
                    let targetIndex;
                    if (direction === 'next') {
                        targetIndex = this.activeIndex + 1 >= cards.length ? 0 : this.activeIndex + 1;
                    } else {
                        targetIndex = this.activeIndex - 1 < 0 ? cards.length - 1 : this.activeIndex - 1;
                    }
                    const targetCard = cards[targetIndex];
                    slider.scrollTo({
                        left: targetCard.offsetLeft - slider.offsetLeft,
                        behavior: 'smooth'
                    });
                    this.activeIndex = targetIndex;
                },
                updateActiveIndex() {
                    const slider = this.$refs.infoSlider;
                    if (!slider) return;
                    const cards = Array.from(slider.querySelectorAll(':scope > div'));
                    if (!cards.length) return;
                    let closestIndex = 0;
                    let minDistance = Infinity;
                    cards.forEach((card, i) => {
                        const distance = Math.abs((card.offsetLeft - slider.offsetLeft) - slider.scrollLeft);
                        if (distance < minDistance) {
                            minDistance = distance;
                            closestIndex = i;
                        }
                    });
                    this.activeIndex = closestIndex;
                }
            }
        }
    </script>
@endsection

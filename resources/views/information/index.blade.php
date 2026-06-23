@extends('layouts.panel.app')

@section('content')
    @php
        $formattedPenelitians = $penelitians->map(function ($p) {
            $cover = asset('images/berita1.png');
            if (!empty($p->image) && is_array($p->image) && isset($p->image[0])) {
                $cover = asset('storage/' . $p->image[0]);
            } elseif (!empty($p->image) && is_string($p->image)) {
                $cover = asset('storage/' . $p->image);
            }
            return [
                'id' => $p->id,
                'judul' => $p->judul,
                'nama_peneliti' => $p->nama_peneliti ?? 'Dr. Yusril, S.S., M.Sn.',
                'deskripsi_singkat' => $p->deskripsi_singkat,
                'image' => $cover,
                'url' => route('detail.penelitian', $p->id),
            ];
        });

        $formattedBeritas = $beritas->map(function ($berita) {
            return [
                'title' => $berita->title,
                'subTitle' => \Illuminate\Support\Str::limit(strip_tags($berita->content), 120, '...'),
                'date' => \Carbon\Carbon::parse($berita->start_date ?? $berita->created_at)->format('d-m-Y'),
                'image' => $berita->image ? asset('storage/' . $berita->image) : asset('images/berita1.png'),
            ];
        });

        $formattedInformations = $informations->map(function ($info) {
            return [
                'title' => $info->title,
                'deskripsi_singkat' => $info->deskripsi_singkat ?? $info->sub_title,
                'deskripsi_lengkap' => nl2br(e($info->deskripsi_lengkap)),
                'image' => $info->image ? asset('storage/' . $info->image) : null,
                'date' => \Carbon\Carbon::parse($info->created_at)->format('d F Y'),
            ];
        });
    @endphp

    <div x-data="researchComponent({{ $formattedPenelitians->toJson() }})">
        <!-- SECTION 1: DATA PENELITIAN -->
        <section class="bg-white pt-12 sm:pt-16 pb-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Banner -->
                <div class="relative mb-10">
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
                                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-[#ff9f1c] rounded-[2px]"></span>
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
                        class="bg-[#0f2440] text-white px-5 sm:px-8 pt-10 sm:pt-8 pb-5 sm:pb-6 rounded-2xl shadow-sm overflow-hidden min-h-[90px] sm:min-h-[100px] relative">
                        <div class="absolute bottom-0 left-0 w-full h-1.5 bg-[#ff9f1c]"></div>
                        <h1 class="text-xl sm:text-4xl font-black tracking-tight">Data Penelitian:</h1>
                    </div>
                </div>

                <!-- Main Showcase Container -->
                <div
                    class="flex flex-col lg:flex-row items-stretch w-full bg-white rounded-3xl lg:rounded-[2.5rem] overflow-hidden shadow-2xl p-4 sm:p-8 gap-6 sm:gap-8 border border-gray-100">

                    <!-- Left Preview Panel -->
                    <div class="w-full lg:w-[45%] flex flex-col justify-between gap-4 flex-shrink-0">
                        <div
                            class="w-full aspect-video sm:aspect-[4/3] relative rounded-2xl overflow-hidden bg-slate-950 shadow-md">
                            <template x-if="total > 0">
                                <img :src="list[activeIdx].image" alt="Sorotan Riset Utama"
                                    class="absolute inset-0 w-full h-full object-cover transition-all duration-500 animate-fade-in">
                            </template>
                            <template x-if="total === 0">
                                <img src="{{ asset('images/berita1.png') }}" alt="Default"
                                    class="absolute inset-0 w-full h-full object-cover">
                            </template>
                        </div>

                        <div class="flex items-center justify-center gap-2 py-1 flex-wrap select-none" x-show="total > 1">
                            <template x-for="(item, index) in list" :key="index">
                                <button @click="activeIdx = index"
                                    :class="activeIdx === index ? 'w-6 sm:w-8 bg-[#0f2440]' :
                                        'w-2 bg-gray-300 hover:bg-slate-400'"
                                    class="h-2 rounded-full transition-all duration-300 focus:outline-none"></button>
                            </template>
                        </div>
                    </div>

                    <!-- Right Vertical List Panel -->
                    <div class="flex-1 flex flex-row items-stretch h-[280px] sm:h-[450px] min-w-0">
                        <div class="flex-1 overflow-y-auto pl-7 sm:pl-10 pr-2 text-left scroll-smooth no-scrollbar"
                            style="scrollbar-width: none; -ms-overflow-style: none;">
                            <template x-if="total > 0">
                                <div class="space-y-0 h-full relative">
                                    <template x-for="(item, index) in list" :key="item.id">
                                        <div class="w-full flex flex-col justify-center relative group cursor-pointer border-b border-gray-100/50 last:border-0 py-3 sm:py-4 min-w-0"
                                            @click="activeIdx = index">

                                            <div class="absolute left-[-20px] sm:left-[-23px] top-0 bottom-0 w-1.5 pointer-events-none flex flex-col overflow-hidden"
                                                :class="index === 0 ? 'rounded-t-full' : (index === total - 1 ?
                                                    'rounded-b-full' : '')">
                                                <div class="w-full h-1/2 transition-colors duration-300"
                                                    :class="index <= activeIdx ? 'bg-[#0f2440]' : 'bg-slate-200'"></div>
                                                <div class="w-full h-1/2 transition-colors duration-300"
                                                    :class="index < activeIdx ? 'bg-[#0f2440]' : 'bg-slate-200'"></div>
                                            </div>

                                            <div class="absolute left-[-27px] sm:left-[-30px] top-1/2 -translate-y-1/2 w-4 h-4 sm:w-5 sm:h-5 rounded-full border-2 transition-all duration-300 z-10 flex items-center justify-center shadow-sm"
                                                :class="activeIdx === index ?
                                                    'border-[#0f2440] bg-white scale-110 ring-4 ring-[#ff9f1c]/30' :
                                                    'border-gray-300 bg-white group-hover:border-[#0f2440]'">
                                                <div class="w-2 sm:w-2.5 h-2 sm:h-2.5 rounded-full bg-[#0f2440]"
                                                    x-show="activeIdx === index"></div>
                                            </div>

                                            <div class="text-left w-full pl-1 sm:pl-2">
                                                <h3 :class="activeIdx === index ?
                                                    'text-[#0f2440] font-extrabold underline decoration-[#ff9f1c] decoration-2 underline-offset-4' :
                                                    'text-gray-400 font-bold group-hover:text-[#0f2440]'"
                                                    class="text-sm sm:text-lg transition-all duration-300 leading-tight line-clamp-1 break-all"
                                                    x-text="item.judul"></h3>
                                                <div :class="activeIdx === index ? 'text-black font-extrabold' : 'text-slate-400'"
                                                    class="text-[9px] sm:text-[10px] font-bold uppercase tracking-wider mt-1 sm:mt-1.5 select-none transition-colors"
                                                    x-text="'Peneliti: ' + item.nama_peneliti"></div>
                                                <p :class="activeIdx === index ? 'text-slate-600' : 'text-gray-400'"
                                                    class="text-xs sm:text-sm font-light leading-relaxed mt-1.5 sm:mt-2 line-clamp-2 break-all"
                                                    x-text="item.deskripsi_singkat"></p>
                                                <div class="pt-2 sm:pt-3 mt-1 select-none" x-show="activeIdx === index">
                                                    <a :href="item.url"
                                                        class="inline-flex items-center text-[11px] sm:text-xs font-black text-black hover:text-[#ff9f1c] transition-colors uppercase tracking-wider gap-1">
                                                        <span class="w-1 h-2.5 bg-[#ff9f1c] rounded-full"></span> Lihat
                                                        Publikasi Utuh &rarr;
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </template>
                                </div>
                            </template>

                            <template x-if="total === 0">
                                <div class="py-12 text-center text-gray-400 font-medium italic select-none text-sm">
                                    Belum ada berkas riset penelitian resmi yang diterbitkan, Dy. Silakan isi melalui
                                    dashboard control panel admin.
                                </div>
                            </template>
                        </div>

                        <div class="hidden lg:flex justify-end h-full pl-4 flex-shrink-0 w-6">
                            <div
                                class="relative w-3 bg-slate-100 border border-slate-200/50 rounded-full h-full overflow-hidden shadow-inner">
                                <div class="absolute w-full bg-[#0f2440] rounded-full h-20 transition-all duration-500 shadow-md"
                                    :style="`top: ${total > 1 ? (activeIdx / (total - 1)) * 75 : 0}%`"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Divider Strip -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white py-8 sm:py-12">
            <div class="grid grid-cols-12 w-full h-2.5 sm:h-3 rounded-full overflow-hidden shadow-sm">
                <div class="col-span-5 bg-[#ff9f1c]"></div>
                <div class="col-span-7 bg-[#0f2440]"></div>
            </div>
        </div>

        <!-- SECTION 2: INFORMASI TERKINI -->
        <section x-data="informationComponent({{ $formattedInformations->toJson() }})" class="bg-white pb-16 pt-4 border-t border-gray-100 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header Title Content Layout Responsif -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
                    <div class="flex flex-col text-left">
                        <div class="flex items-center gap-3 mb-1 select-none">
                            <img src="{{ asset('images/icon-notice.png') }}" alt="Notice"
                                class="h-5 sm:h-6 object-contain">
                            <div class="flex items-center gap-[3px]">
                                @for ($i = 0; $i < 3; $i++)
                                    <div class="grid grid-cols-2 gap-[1px]">
                                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-[#ff9f1c] rounded-[1px]"></span>
                                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-transparent"></span>
                                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-transparent"></span>
                                        <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 bg-[#ff9f1c] rounded-[1px]"></span>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-black text-[#0f2440] tracking-tight leading-none mt-1"
                            style="font-family: 'Roboto', sans-serif;">Informasi Terkini</h1>
                        <div class="flex items-center mt-2" style="gap:4px;">
                            <div class="bg-[#0f2440] rounded-full w-28 sm:w-[205px]" style="height:3px;"></div>
                            <div class="bg-[#0f2440] rounded-full w-12 sm:w-[80px]" style="height:3px;"></div>
                            <div class="bg-[#0f2440] rounded-full w-1.5" style="height:3px;"></div>
                            <div class="bg-[#0f2440] rounded-full w-1.5" style="height:3px;"></div>
                            <div class="bg-[#0f2440] rounded-full w-1.5" style="height:3px;"></div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-start sm:justify-end gap-3 select-none self-start sm:self-center">
                        <img src="{{ asset('images/icon-arrow.png') }}" alt="Aksen"
                            class="w-6 h-6 sm:w-8 sm:h-8 object-contain">
                        <img src="{{ asset('images/icon-doc.png') }}" alt="Docs"
                            class="h-8 sm:h-12 w-auto object-contain">
                    </div>
                </div>

                <!-- Info Stack Cards Output Container -->
                <div class="space-y-6 sm:space-y-10 w-full">
                    <template x-for="(info, index) in infoList" :key="index">
                        <div
                            class="bg-white rounded-2xl sm:rounded-[2rem] border border-gray-100 shadow-xl shadow-slate-100/60 p-5 sm:p-8 flex flex-col md:flex-row gap-5 sm:gap-8 items-stretch min-w-0">

                            <template x-if="info.image">
                                <div
                                    class="w-full md:w-[35%] aspect-[4/3] md:aspect-auto rounded-xl sm:rounded-2xl overflow-hidden bg-slate-50 flex-shrink-0 shadow-inner">
                                    <img :src="info.image" :alt="info.title"
                                        class="w-full h-full object-cover">
                                </div>
                            </template>

                            <div class="flex-1 flex flex-col justify-between min-w-0 text-left space-y-4">
                                <div class="space-y-3 sm:space-y-4 min-w-0 w-full">
                                    <div class="flex flex-wrap items-center gap-2 select-none">
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-orange-50 border border-orange-100 text-orange-700 px-3 py-0.5 sm:py-1 rounded-full text-[9px] sm:text-[10px] font-bold tracking-wider uppercase">
                                            <span class="w-1 h-1 bg-[#ff9f1c] rounded-full animate-pulse"></span>
                                            Diumumkan: <span x-text="info.date"></span>
                                        </span>
                                    </div>

                                    <h3 class="text-lg sm:text-2xl font-black text-[#0f2440] uppercase tracking-tight break-all"
                                        x-text="info.title"></h3>

                                    <div class="flex min-w-0 w-full">
                                        <div class="w-1 bg-[#ff9f1c] flex-shrink-0"></div>
                                        <div class="bg-orange-50/50 px-3 sm:px-4 py-2 sm:py-3 rounded-r-xl w-full">
                                            <p class="text-slate-600 text-xs sm:text-base italic leading-relaxed font-normal break-all"
                                                x-text="info.deskripsi_singkat"></p>
                                        </div>
                                    </div>

                                    <div class="text-xs sm:text-base text-gray-600 leading-relaxed space-y-2 sm:space-y-3 font-light break-all w-full"
                                        x-html="info.deskripsi_lengkap"></div>
                                </div>
                            </div>

                        </div>
                    </template>

                    <template x-if="infoList.length === 1 && infoList[0].date === '---'">
                        <div
                            class="w-full text-center py-12 text-gray-400 italic font-medium bg-gray-50 border border-dashed border-gray-200 rounded-2xl sm:rounded-3xl select-none text-sm">
                            Belum ada data informasi terbaru yang diterbitkan.
                        </div>
                    </template>
                </div>

            </div>
        </section>
    </div>

    <script>
        function researchComponent(laravelData) {
            return {
                activeIdx: 0,
                list: laravelData ? laravelData : [],
                get total() {
                    return this.list.length;
                }
            }
        }

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

        function informationComponent(laravelInformation) {
            const defaultPlaceholder = [{
                title: "Belum Ada Informasi Terbaru, Dy!",
                deskripsi_singkat: "Silakan isi data papan pengumuman informasi dari dashboard control panel admin terlebih dahulu.",
                deskripsi_lengkap: "Konten papan informasi kosong.",
                date: "---",
                image: null
            }];
            return {
                infoList: laravelInformation && laravelInformation.length > 0 ? laravelInformation : defaultPlaceholder
            }
        }
    </script>
@endsection

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
                'id' => $info->id,
                'title' => $info->title,
                'deskripsi_singkat' => $info->deskripsi_singkat ?? $info->sub_title,
                'deskripsi_lengkap' => nl2br(e($info->deskripsi_lengkap)),
                'image' => $info->image ? asset('storage/' . $info->image) : null,
                'date' => \Carbon\Carbon::parse($info->created_at)->format('d F Y'),
            ];
        });
    @endphp

    <div x-data="informationsComponent({{ $formattedInformations->toJson() }})">
        <section class="bg-white pt-12 sm:pt-16 pb-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                        <h1 class="text-xl sm:text-4xl font-black tracking-tight">Information</h1>
                    </div>
                </div>

                <div class="flex items-center gap-6 overflow-x-auto pb-6 pt-2 scrollbar-none w-full snap-x snap-mandatory scroll-smooth"
                    x-ref="infoSlider" @scroll="updateActiveIndex()">
                    <template x-for="(info, index) in infoList" :key="index">
                        <div class="snap-start w-[85vw] sm:w-[420px] md:w-[450px] lg:w-[480px] aspect-[4/3] rounded-2xl overflow-hidden bg-gray-900 relative cursor-pointer group flex-shrink-0 transition-all duration-300"
                            @click="window.location.href = '/information/detail/' + info.id"
                            :class="index === activeIndex ?
                                'border-2 border-[#ff9f1c] shadow-xl opacity-100 scale-100 ring-4 ring-[#ff9f1c]/10' :
                                'border border-gray-100 shadow-md opacity-40 hover:opacity-70 scale-98'">

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#0f2440]/95 via-transparent to-transparent z-10">
                            </div>
                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                :src="info.image ? info.image : '{{ asset('images/berita1.png') }}'" :alt="info.title">

                            <div class="absolute bottom-0 inset-x-0 p-6 z-20 text-left">
                                <div class="flex items-center gap-1.5 mb-2">
                                    <div class="grid grid-cols-2 gap-[1px]">
                                        <span class="w-1.5 h-1.5 bg-[#ff9f1c] rounded-[1px]"></span>
                                        <span class="w-1.5 h-1.5 bg-transparent"></span>
                                        <span class="w-1.5 h-1.5 bg-transparent"></span>
                                        <span class="w-1.5 h-1.5 bg-[#ff9f1c] rounded-[1px]"></span>
                                    </div>
                                    <h3 class="text-white font-extrabold text-base sm:text-lg leading-tight"
                                        x-text="info.title"></h3>
                                </div>
                                <p class="text-gray-300 text-xs font-light pl-5 line-clamp-1"
                                    x-text="info.deskripsi_singkat"></p>
                            </div>
                            <span
                                class="absolute bottom-4 right-4 text-[9px] text-gray-400 opacity-80 font-light flex items-center gap-1 z-20">
                                Institut Seni Indonesia Padangpanjang
                                <svg class="w-3 h-3 text-[#ff9f1c]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
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

                <div class="flex items-center gap-6 mt-4 justify-start w-full">
                    <div class="flex items-center gap-2.5" x-show="infoList.length > 1 && infoList[0].date !== '---'">
                        <button
                            class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-[#0f2440] hover:bg-[#0f2440] hover:text-white transition-all focus:outline-none shadow-sm active:scale-95"
                            @click="scrollInfo('prev')">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                            </svg>
                        </button>
                        <button
                            class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-[#0f2440] hover:bg-[#0f2440] hover:text-white transition-all focus:outline-none shadow-sm active:scale-95"
                            @click="scrollInfo('next')">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                stroke="currentColor">
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
        </section>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-white py-8 sm:py-12">
        <div class="grid grid-cols-12 w-full h-2.5 sm:h-3 rounded-full overflow-hidden shadow-sm">
            <div class="col-span-5 bg-[#ff9f1c]"></div>
            <div class="col-span-7 bg-[#0f2440]"></div>
        </div>
    </div>

    <section x-data="informationComponent({{ $formattedInformations->toJson() }})" class="bg-white pb-16 pt-4 border-t border-gray-100 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
                <div class="flex flex-col text-left">
                    <div class="flex items-center gap-3 mb-1 select-none">
                        <img src="{{ asset('images/icon-notice.png') }}" alt="Notice" class="h-5 sm:h-6 object-contain">
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

                <div class="flex items-center justify-start sm:justify-end gap-3 select-none self-start sm:self-center">
                    <img src="{{ asset('images/icon-arrow.png') }}" alt="Aksen"
                        class="w-6 h-6 sm:w-8 sm:h-8 object-contain">
                    <img src="{{ asset('images/icon-doc.png') }}" alt="Docs"
                        class="h-8 sm:h-12 w-auto object-contain">
                </div>
            </div>

            <div class="space-y-6 sm:space-y-10 w-full">
                @foreach ($formattedInformations as $info)
                    @if ($loop->iteration > 3)
                        @break
                    @endif

                    <div class="bg-white rounded-2xl sm:rounded-[2rem] border border-gray-100 shadow-xl shadow-slate-100/60 p-5 sm:p-8 flex flex-col md:flex-row gap-5 sm:gap-8 items-stretch min-w-0 cursor-pointer transition-transform duration-300 hover:scale-[1.01]"
                        @click="window.location.href = '/information/detail/' + '{{ $info['id'] }}'">

                        @if ($info['image'])
                            <div
                                class="w-full md:w-[35%] aspect-[4/3] md:aspect-auto rounded-xl sm:rounded-2xl overflow-hidden bg-slate-50 flex-shrink-0 shadow-inner">
                                <img src="{{ $info['image'] }}" alt="{{ $info['title'] }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @endif

                        <div class="flex-1 flex flex-col justify-between min-w-0 text-left space-y-4">
                            <div class="space-y-3 sm:space-y-4 min-w-0 w-full">
                                <div class="flex flex-wrap items-center gap-2 select-none">
                                    <span
                                        class="inline-flex items-center gap-1.5 bg-orange-50 border border-orange-100 text-orange-700 px-3 py-0.5 sm:py-1 rounded-full text-[9px] sm:text-[10px] font-bold tracking-wider uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Diumumkan: <span>{{ $info['date'] }}</span>
                                    </span>
                                </div>

                                <h3
                                    class="text-lg sm:text-2xl font-black text-[#0f2440] uppercase tracking-tight break-words">
                                    {{ $info['title'] }}
                                </h3>

                                <div class="flex min-w-0 w-full">
                                    <div class="w-1 bg-[#ff9f1c] flex-shrink-0"></div>
                                    <div class="bg-orange-50/50 px-3 sm:px-4 py-2 sm:py-3 rounded-r-xl w-full">
                                        <p
                                            class="text-slate-600 text-xs sm:text-base italic leading-relaxed font-normal break-words">
                                            {{ $info['deskripsi_singkat'] }}
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="text-xs sm:text-base text-gray-600 leading-relaxed space-y-2 sm:space-y-3 font-light break-words w-full">
                                    {!! $info['deskripsi_lengkap'] !!}
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

                @if (count($formattedInformations) === 0)
                    <div
                        class="w-full text-center py-12 text-gray-400 italic font-medium bg-gray-50 border border-dashed border-gray-200 rounded-2xl sm:rounded-3xl select-none text-sm">
                        Belum ada data informasi terbaru yang diterbitkan.
                    </div>
                @endif
            </div>

        </div>
    </section>

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

        function informationsComponent(laravelInformation) {
            const defaultPlaceholder = [{
                title: "Belum Ada Informasi Terbaru, Dy!",
                deskripsi_singkat: "Silakan isi data papan pengumuman informasi dari dashboard control panel admin terlebih dahulu.",
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

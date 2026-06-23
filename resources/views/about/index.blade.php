@extends('layouts.panel.app')

@section('content')
    <div class="bg-white" style="font-family: 'Roboto', sans-serif;">

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">
            <div class="flex flex-col items-start gap-1">
                <div class="flex items-center gap-3 mb-1 select-none">
                    <img src="{{ asset('images/icon-notice.png') }}" alt="Notice" class="h-8 object-contain">
                    <div class="inline-flex items-center gap-1">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="grid grid-cols-2 gap-0.5">
                                <span class="w-2.5 h-2.5 bg-[#ff9f1c] rounded-[1px]"></span>
                                <span class="w-2.5 h-2.5 bg-transparent"></span>
                                <span class="w-2.5 h-2.5 bg-transparent"></span>
                                <span class="w-2.5 h-2.5 bg-[#ff9f1c] rounded-[1px]"></span>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="relative inline-block">
                    <h1 class="text-6xl font-black text-[#0f2440] tracking-tight  leading-none mt-1">About</h1>
                    <div class="flex items-center mt-2" style="gap:4px;">
                        <div class="bg-[#0f2440] rounded-full" style="width:120px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:30px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                    </div>
                </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="flex flex-col lg:flex-row gap-12 items-start">

                <div class="w-full lg:w-[400px] flex-shrink-0">
                    <div class="flex flex-row bg-[#0f2440] rounded-[2.5rem] overflow-hidden shadow-2xl h-[450px] relative">
                        <div class="w-20 sm:w-24 flex-shrink-0 flex justify-center py-6 overflow-visible">
                            <div
                                class="bg-[#ff9f1c] w-9 rounded-full h-full flex flex-col items-center justify-between py-8 relative overflow-visible shadow-inner border-r border-orange-400/30">
                                <div class="flex items-start justify-center pt-2 w-full relative overflow-visible">
                                    <h2 class="text-white font-black text-4xl tracking-widest uppercase drop-shadow-[2px_4px_3px_rgba(0,0,0,0.4)] absolute left-[60%] z-10 whitespace-nowrap"
                                        style="writing-mode: vertical-rl;">
                                        LPPM
                                    </h2>
                                </div>
                                <div class="mt-auto flex flex-col items-center gap-4 w-full text-center pb-2 select-none">
                                    <p class="text-[#0f2440] font-bold text-[8px] tracking-wider uppercase whitespace-nowrap mx-auto"
                                        style="writing-mode: vertical-rl;">
                                        Institut Seni Indonesia Padangpanjang
                                    </p>
                                    <img src="{{ asset('images/icon/globe.png') }}" alt="Globe"
                                        class="w-4 h-4 object-contain opacity-80">
                                </div>
                            </div>
                        </div>

                        <div class="flex-1 relative bg-gray-800">
                            <img src="{{ $about && $about->image ? asset('storage/' . $about->image) : asset('images/foto-ketua.png') }}"
                                alt="{{ $about->name ?? 'Dr. Yusril, S.S., M.Sn.' }}"
                                class="absolute inset-0 w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-500">
                            <div class="absolute top-4 right-4 opacity-20">
                                <div class="grid grid-cols-4 gap-1">
                                    @for ($i = 0; $i < 16; $i++)
                                        <div class="w-1 h-1 bg-white rounded-full"></div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="flex-1 space-y-8">

                    <div class="space-y-2">
                        <h2 class="text-3xl md:text-4xl font-black text-[#0f2440] tracking-tight uppercase">
                            {{ $about->name ?? 'Dr. Yusril, S.S., M.Sn.' }}
                        </h2>
                        <span
                            class="inline-block bg-[#0f2440] text-white text-[10px] font-bold px-4 py-1 rounded-full uppercase tracking-widest">
                            {{ $about->title ?? 'Ketua' }}
                        </span>
                    </div>

                    <div class="prose prose-slate max-w-none">
                        <h3 class="text-xl font-black text-[#0f2440] uppercase tracking-tight mb-4 leading-snug">
                            {{ $about->headline ?? 'LPPM ISI Padang Panjang (Lembaga Penelitian Dan Pengabdian kepada Masyarakat)' }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed text-justify font-normal">
                            {{ $about->description ?? 'lembaga di bawah Institut Seni Indonesia (ISI) Padangpanjang yang bertugas mengoordinasikan, melaksanakan, memantau, dan mengevaluasi kegiatan penelitian dan pengabdian kepada masyarakat.' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-3xl border-l-4 border-[#ff9f1c] shadow-sm">
                        <h3 class="text-2xl font-black text-[#0f2440] uppercase tracking-tight mb-4">
                            Visi dan Misi
                        </h3>
                        <p class="text-gray-600 leading-relaxed text-justify italic font-normal">
                            {{ $about->vision_mission ?? 'Menjadi pusat unggulan penelitian dan pengabdian masyarakat yang bermutu, relevan, serta berdaya saing, sejalan dengan visi ISI Padangpanjang menghasilkan ilmuwan dan entrepreneur berbasis seni budaya tahun 2044.' }}
                        </p>
                    </div>

                </div>
            </div>
        </section>

    </div>
@endsection

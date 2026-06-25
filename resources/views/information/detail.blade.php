@extends('layouts.panel.app')

@section('content')
    <div class="bg-white" style="font-family: 'Roboto', sans-serif;">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">
            <div class="flex flex-col items-start gap-1">
                <div class="flex items-center gap-3 mb-1 select-none">
                    <img src="{{ asset('images/icon-notice.png') }}" alt="Notice" class="h-6 object-contain">
                    <div class="inline-flex items-center gap-1">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="grid grid-cols-2 gap-0.5">
                                <span class="w-2 h-2 bg-[#ff9f1c] rounded-[1px]"></span>
                                <span class="w-2 h-2 bg-transparent"></span>
                                <span class="w-2 h-2 bg-transparent"></span>
                                <span class="w-2 h-2 bg-[#ff9f1c] rounded-[1px]"></span>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="relative inline-block">
                    <h1 class="text-4xl sm:text-4xl font-black text-[#0f2440] tracking-tight leading-none mt-1 uppercase">
                        Information</h1>
                    <div class="flex items-center mt-2" style="gap:4px;">
                        <div class="bg-[#0f2440] rounded-full" style="width:180px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:60px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                        <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
            <div class="flex flex-col lg:flex-row gap-12 items-start">
                <div class="w-full lg:w-[460px] flex-shrink-0">
                    <div
                        class="flex flex-row bg-[#0f2440] rounded-[2.5rem] overflow-hidden shadow-2xl h-[460px] sm:h-[480px] relative">
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
                        <div class="flex-1 relative bg-white">
                            <img src="{{ $information->image ? asset('storage/' . $information->image) : asset('images/berita1.png') }}"
                                alt="{{ $information->title }}" class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute top-4 right-4 opacity-20">
                                <div class="grid grid-cols-4 gap-1">
                                    @for ($i = 0; $i < 16; $i++)
                                        <div class="w-1 h-1 bg-white rounded-full shadow-sm"></div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="flex-1 text-left space-y-4 pt-2">
                    <h1
                        class="text-xl sm:text-2xl md:text-3xl font-extrabold text-black tracking-tight leading-tight break-words">
                        {{ $information->title }}
                    </h1>
                    <div class="flex items-center gap-2 select-none text-sm text-gray-500 font-medium pt-1">
                        <span class="text-[#ff9f1c] font-black text-lg leading-none">|</span>
                        <span class="text-gray-800 font-bold tracking-wide">Upload</span>
                        <span
                            class="text-gray-500">{{ \Carbon\Carbon::parse($information->created_at)->format('d-m-Y') }}</span>
                    </div>
                    <div
                        class="text-gray-800 text-sm sm:text-base leading-relaxed text-left font-normal space-y-5 break-words pt-4">
                        {!! nl2br(e($information->deskripsi_lengkap)) !!}
                    </div>

                </div>
            </div>
        </section>

    </div>
@endsection

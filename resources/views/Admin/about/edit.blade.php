@extends('admin.app')

@section('content')
    <div class="flex min-h-screen bg-gray-100 font-['Roboto']" style="font-family: 'Roboto', sans-serif;">

        <div class="w-64 bg-[#0f2440] text-white flex-shrink-0 hidden md:flex flex-col shadow-xl">
            <div class="p-6 border-b border-slate-700/50 flex items-center gap-3">
                <div class="bg-[#ff9f1c] p-2 rounded-lg select-none">
                    <img src="{{ asset('images/icon/globe.png') }}" alt="Logo" class="w-5 h-5 object-contain invert">
                </div>
                <div>
                    <h1 class="font-black text-lg tracking-tight text-white uppercase">Admin Panel</h1>
                    <p class="text-[9px] text-[#ff9f1c] font-bold tracking-wider uppercase">LPPM ISI Padangpanjang</p>
                </div>
            </div>

            @include(' admin.sidebar')

            <div class="p-4 border-t border-slate-700/50 space-y-1">
                <a href="{{ route('home') }}" target="_blank"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs text-slate-400 hover:text-[#ff9f1c] transition-all">
                    <span>Lihat Website Front-end</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="flex-1 flex flex-col min-w-0 overflow-x-hidden">
            <main class="flex-1 p-6 md:p-8 space-y-6 overflow-y-auto">

                <div class="flex items-center gap-4 border-b border-gray-200 pb-4">
                    <a href="{{ route('admin.about.index') }}"
                        class="w-9 h-9 border border-gray-300 rounded-full flex items-center justify-center text-[#0f2440] hover:bg-[#0f2440] hover:text-white transition-colors flex-shrink-0">
                        &larr;
                    </a>
                    <div>
                        <h2 class="text-2xl font-black text-[#0f2440] uppercase tracking-tight">Edit Data About</h2>
                        <p class="text-xs text-gray-400">Perbarui data informasi berkas penanggung jawab LPPM.</p>
                    </div>
                </div>

                <form action="{{ route('admin.about.update', $about->id) }}" method="POST" enctype="multipart/form-data"
                    class="bg-white border border-gray-100 shadow-sm rounded-3xl p-6 sm:p-8 space-y-6 max-w-4xl">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black uppercase text-[#0f2440] tracking-wider mb-2">Nama
                                Pimpinan</label>
                            <input type="text" name="name" value="{{ old('name', $about->name) }}"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#ff9f1c]"
                                required>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase text-[#0f2440] tracking-wider mb-2">Jabatan /
                                Gelar</label>
                            <input type="text" name="title" value="{{ old('title', $about->title) }}"
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#ff9f1c]"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase text-[#0f2440] tracking-wider mb-2">Headline / Nama
                            Lembaga</label>
                        <input type="text" name="headline" value="{{ old('headline', $about->headline) }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#ff9f1c]"
                            required>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase text-[#0f2440] tracking-wider mb-2">Deskripsi
                            Lembaga</label>
                        <textarea name="description" rows="4"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#ff9f1c]"
                            required>{{ old('description', $about->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase text-[#0f2440] tracking-wider mb-2">Visi & Misi
                            Utama</label>
                        <textarea name="vision_mission" rows="4"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-[#ff9f1c]"
                            required>{{ old('vision_mission', $about->vision_mission) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase text-[#0f2440] tracking-wider mb-2">Foto Profil
                            Pimpinan</label>
                        <div class="flex items-center gap-5 mt-2">
                            <div
                                class="w-24 h-24 rounded-2xl overflow-hidden bg-slate-100 border border-gray-200 flex-shrink-0">
                                <img src="{{ $about->image ? asset('storage/' . $about->image) : asset('images/foto-ketua.png') }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <input type="file" name="image"
                                class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 text-right">
                        <button type="submit"
                            class="bg-[#0f2440] text-white font-bold text-xs uppercase tracking-widest px-8 py-3.5 rounded-xl hover:bg-[#ff9f1c] hover:text-[#0f2440] transition-colors shadow-md">
                            Perbarui Data
                        </button>
                    </div>
                </form>

            </main>
        </div>
    </div>
@endsection

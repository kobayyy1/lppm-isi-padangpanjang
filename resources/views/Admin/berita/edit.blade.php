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

                <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                    <div>
                        <h2 class="text-2xl font-black text-[#0f2440] uppercase tracking-tight">Edit Berita</h2>
                        <p class="text-xs text-gray-400">Ubah informasi, gambar cover, atau masa aktif berita yang sudah
                            diterbitkan.</p>
                    </div>
                    <a href="{{ route('admin.berita.index') }}"
                        class="border border-[#0f2440] text-[#0f2440] hover:bg-slate-100 font-bold text-xs px-4 py-2 rounded-xl uppercase tracking-wider transition-all">
                        Kembali
                    </a>
                </div>

                <div class="bg-white rounded-3xl p-6 md:p-8 border border-gray-100 shadow-sm max-w-4xl">
                    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT') 

                        <div class="space-y-1.5">
                            <label for="title"
                                class="text-sm font-bold text-[#0f2440] uppercase tracking-wider block">Judul Berita</label>
                            <input type="text" id="title" name="title" required
                                value="{{ old('title', $berita->title) }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f2440] transition-all"
                                placeholder="Masukkan judul berita">
                            @error('title')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-3">
                            <label class="text-sm font-bold text-[#0f2440] uppercase tracking-wider block">Cover Berita /
                                Gambar</label>

                            @if ($berita->image)
                                <div class="space-y-1">
                                    <span class="text-xs text-gray-400 block font-medium">Cover Saat Ini:</span>
                                    <div
                                        class="w-44 h-28 rounded-xl overflow-hidden border border-gray-200 shadow-sm bg-gray-50 flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $berita->image) }}" alt="Current Cover"
                                            class="w-full h-full object-cover">
                                    </div>
                                </div>
                            @endif

                            <input type="file" name="image"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#0f2440] file:text-white hover:file:bg-slate-800 transition-all">
                            <p class="text-[11px] text-gray-400">Pilih berkas baru jika ingin mengganti cover. Format: JPG,
                                JPEG, PNG. Maksimal 2MB.</p>
                            @error('image')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="space-y-1.5">
                                <label for="start_date"
                                    class="text-sm font-bold text-[#0f2440] uppercase tracking-wider block">Tanggal Mulai
                                    Aktif</label>
                                <input type="date" id="start_date" name="start_date"
                                    value="{{ old('start_date', $berita->start_date) }}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f2440] text-gray-600 transition-all">
                                @error('start_date')
                                    <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1.5">
                                <label for="end_date"
                                    class="text-sm font-bold text-[#0f2440] uppercase tracking-wider block">Tanggal Selesai
                                    Aktif</label>
                                <input type="date" id="end_date" name="end_date"
                                    value="{{ old('end_date', $berita->end_date) }}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f2440] text-gray-600 transition-all">
                                @error('end_date')
                                    <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label for="content"
                                class="text-sm font-bold text-[#0f2440] uppercase tracking-wider block">Isi Berita</label>
                            <textarea id="content" name="content" rows="8" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f2440] transition-all"
                                placeholder="Tuliskan detail berita di sini...">{{ old('content', $berita->content) }}</textarea>
                            @error('content')
                                <p class="text-xs text-red-500 font-medium mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4 flex justify-start">
                            <button type="submit"
                                class="bg-[#0f2440] text-white font-bold text-xs px-8 py-3.5 rounded-xl uppercase tracking-widest hover:bg-slate-800 transition-all shadow-md">
                                | &nbsp; Perbarui Berita
                            </button>
                        </div>
                    </form>
                </div>

            </main>
        </div>
    </div>
@endsection

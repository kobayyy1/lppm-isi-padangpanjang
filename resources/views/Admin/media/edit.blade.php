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
        </div>

        <div class="flex-1 flex flex-col min-w-0 overflow-x-hidden">
            <header
                class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-6 md:px-8 flex-shrink-0 shadow-sm">
                <h2 class="text-xl font-black text-[#0f2440] uppercase tracking-tight">Edit Media</h2>
                <a href="{{ route('admin.media.index') }}"
                    class="text-xs font-bold text-gray-400 hover:text-[#0f2440] uppercase tracking-wider flex items-center gap-1">
                    &larr; Kembali
                </a>
            </header>

            <main class="flex-1 p-6 md:p-8 max-w-4xl w-full">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8">
                    <form action="{{ route('admin.media.update', $media->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col text-left space-y-2">
                            <label class="text-xs font-black text-[#0f2440] uppercase tracking-widest">Judul Media</label>
                            <input type="text" name="title" value="{{ old('title', $media->title) }}"
                                class="w-full h-12 px-4 rounded-xl border border-gray-200 focus:outline-none focus:border-[#0f2440] font-medium text-sm @error('title') border-red-500 @enderror">
                            @error('title')
                                <span class="text-xs text-red-500 font-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col text-left space-y-2">
                            <label class="text-xs font-black text-[#0f2440] uppercase tracking-widest">Deskripsi
                                Singkat</label>
                            <input type="text" name="deskripsi_singkat"
                                value="{{ old('deskripsi_singkat', $media->deskripsi_singkat) }}"
                                class="w-full h-12 px-4 rounded-xl border border-gray-200 focus:outline-none focus:border-[#0f2440] font-medium text-sm @error('deskripsi_singkat') border-red-500 @enderror">
                            @error('deskripsi_singkat')
                                <span class="text-xs text-red-500 font-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col text-left space-y-2">
                            <label class="text-xs font-black text-[#0f2440] uppercase tracking-widest">Video Saat
                                Ini</label>
                            @if ($media->video)
                                <div
                                    class="text-xs bg-gray-50 border border-gray-200 p-3 rounded-xl text-emerald-600 font-medium truncate max-w-xl">
                                    {{ basename($media->video) }}
                                </div>
                            @else
                                <div class="text-xs bg-gray-50 border border-gray-200 p-3 rounded-xl text-gray-400 italic">
                                    Belum ada video diupload.
                                </div>
                            @endif
                            <label class="text-xs font-black text-[#0f2440] uppercase tracking-widest pt-2">Ganti Video MP4
                                (Opsional)</label>
                            <input type="file" name="video" accept="video/mp4,video/x-m4v,video/*"
                                class="w-full p-2 rounded-xl border border-gray-200 file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 @error('video') border-red-500 @enderror">
                            @error('video')
                                <span class="text-xs text-red-500 font-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col text-left space-y-2">
                            <label class="text-xs font-black text-[#0f2440] uppercase tracking-widest">Deskripsi
                                Lengkap</label>
                            <textarea name="deskripsi_lengkap" rows="6"
                                class="w-full p-4 rounded-xl border border-gray-200 focus:outline-none focus:border-[#0f2440] font-light text-sm leading-relaxed @error('deskripsi_lengkap') border-red-500 @enderror">{{ old('deskripsi_lengkap', $media->deskripsi_lengkap) }}</textarea>
                            @error('deskripsi_lengkap')
                                <span class="text-xs text-red-500 font-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col text-left space-y-2">
                            <label class="text-xs font-black text-[#0f2440] uppercase tracking-widest">Gambar Cover Saat
                                Ini</label>
                            <div
                                class="w-44 h-28 rounded-2xl overflow-hidden border border-gray-200 shadow-sm bg-slate-50 mb-2">
                                <img src="{{ $media->image ? asset('storage/' . $media->image) : asset('images/berita1.png') }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <label class="text-xs font-black text-[#0f2440] uppercase tracking-widest pt-2">Ganti Gambar
                                (Opsional)</label>
                            <input type="file" name="image"
                                class="w-full p-2 rounded-xl border border-gray-200 file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 @error('image') border-red-500 @enderror">
                            @error('image')
                                <span class="text-xs text-red-500 font-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="pt-4 flex items-center justify-end gap-3">
                            <a href="{{ route('admin.media.index') }}"
                                class="px-6 py-3 rounded-xl border border-gray-200 text-xs font-bold text-gray-400 uppercase tracking-wider hover:bg-gray-50 transition-colors">Batal</a>
                            <button type="submit"
                                class="bg-[#0f2440] text-white hover:bg-slate-800 font-bold text-xs px-8 py-3.5 rounded-xl uppercase tracking-widest shadow-md transition-all">Perbarui
                                Data</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection

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
                <a href="{{ route('admin.penelitian.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 text-xs text-slate-400 hover:text-[#ff9f1c] transition-all">
                    <span>← Kembali ke Tabel</span>
                </a>
            </div>
        </div>

        <div class="flex-1 flex flex-col min-w-0 overflow-x-hidden">
            <main class="flex-1 p-6 md:p-8 space-y-6 overflow-y-auto">

                @if ($errors->any())
                    <div
                        class="p-4 bg-rose-50 border-l-4 border-rose-500 rounded-r-xl text-rose-800 text-sm font-medium shadow-sm text-left">
                        <p class="font-bold mb-1">Ada kolom inputan yang terlewat, Dy:</p>
                        <ul class="list-disc pl-5 space-y-0.5 text-xs text-rose-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                    <div class="text-left">
                        <h2 class="text-2xl font-black text-[#0f2440] uppercase tracking-tight">Tambah Riset Penelitian</h2>
                        <p class="text-xs text-gray-400">Unggah berkas dokumen publikasi ilmiah baru beserta rangkuman
                            ringkas riset.</p>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden p-6 sm:p-8">
                    <form action="{{ route('admin.penelitian.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6 text-left">
                        @csrf

                        <div class="flex flex-col gap-1.5">
                            <label for="judul" class="text-xs font-bold uppercase tracking-wider text-[#0f2440]">Judul
                                Penelitian / Riset</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                                placeholder="Masukkan nama judul penelitian riset ilmiah lengkap..."
                                class="w-full rounded-xl border border-gray-200 p-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2440] focus:border-transparent transition-all font-medium text-gray-700">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-1.5">
                                <label for="nama_peneliti"
                                    class="text-xs font-bold uppercase tracking-wider text-[#0f2440]">Nama Peneliti Utama
                                    (Dosen)</label>
                                <input type="text" name="nama_peneliti" id="nama_peneliti"
                                    value="{{ old('nama_peneliti') }}" required
                                    placeholder="Contoh: Dr. Yusril, S.S., M.Sn."
                                    class="w-full rounded-xl border border-gray-200 p-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2440] focus:border-transparent transition-all font-medium text-gray-700">
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="tanggal_penelitian"
                                    class="text-xs font-bold uppercase tracking-wider text-[#0f2440]">Tanggal
                                    Publikasi/Riset</label>
                                <input type="date" name="tanggal_penelitian" id="tanggal_penelitian"
                                    value="{{ old('tanggal_penelitian') }}" required
                                    class="w-full rounded-xl border border-gray-200 p-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2440] focus:border-transparent transition-all font-medium text-gray-700">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-1.5">
                                <label for="avatar"
                                    class="text-xs font-bold uppercase tracking-wider text-[#0f2440]">Upload Kartu Avatar
                                    Peneliti (.png, .jpg)</label>
                                <input type="file" name="avatar" id="avatar" accept="image/*"
                                    class="w-full rounded-xl border border-gray-200 p-2.5 text-sm bg-slate-50 focus:outline-none file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#0f2440] file:text-white hover:file:bg-opacity-90 cursor-pointer text-gray-400">
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label for="images"
                                    class="text-xs font-bold uppercase tracking-wider text-[#0f2440]">Dokumentasi Foto Riset
                                    (Bisa Pilih Lebih Dari Satu)</label>
                                <input type="file" name="images[]" id="images" accept="image/*" multiple
                                    class="w-full rounded-xl border border-gray-200 p-2.5 text-sm bg-slate-50 focus:outline-none file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#0f2440] file:text-white hover:file:bg-opacity-90 cursor-pointer text-gray-400">
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="file_pdf" class="text-xs font-bold uppercase tracking-wider text-[#0f2440]">Upload
                                Berkas Dokumen PDF Riset Utama (Maks 10MB)</label>
                            <input type="file" name="file_pdf" id="file_pdf" accept=".pdf"
                                class="w-full rounded-xl border border-gray-200 p-2.5 text-sm bg-slate-50 focus:outline-none file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-rose-600 file:text-white hover:file:bg-opacity-90 cursor-pointer text-gray-400">
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="deskripsi_singkat"
                                class="text-xs font-bold uppercase tracking-wider text-[#0f2440]">Deskripsi Preview
                                Singkat</label>
                            <textarea name="deskripsi_singkat" id="deskripsi_singkat" rows="3" required
                                placeholder="Tuliskan rangkuman 1-2 kalimat untuk pratinjau kartu di landing page depan..."
                                class="w-full rounded-xl border border-gray-200 p-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2440] focus:border-transparent transition-all resize-none font-medium text-gray-700">{{ old('deskripsi_singkat') }}</textarea>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label for="deskripsi_lengkap"
                                class="text-xs font-bold uppercase tracking-wider text-[#0f2440]">Isi Pembahasan Lengkap
                                Hasil Riset</label>
                            <textarea name="deskripsi_lengkap" id="deskripsi_lengkap" rows="6" required
                                placeholder="Tuliskan full abstract, landasan teori, metodologi riset, dsb..."
                                class="w-full rounded-xl border border-gray-200 p-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f2440] focus:border-transparent transition-all font-medium text-gray-700">{{ old('deskripsi_lengkap') }}</textarea>
                        </div>

                        <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                            <button type="reset"
                                class="px-5 py-3 rounded-xl border border-gray-200 text-xs font-bold text-gray-400 hover:bg-gray-50 transition-colors">Reset</button>
                            <button type="submit"
                                class="bg-[#ff9f1c] hover:bg-[#e08b14] text-[#0f2440] font-black text-sm px-6 py-3.5 rounded-xl shadow-md transition-all transform hover:scale-[1.01]">
                                Simpan Berkas Riset
                            </button>
                        </div>
                    </form>
                </div>

            </main>
        </div>
    </div>
@endsection

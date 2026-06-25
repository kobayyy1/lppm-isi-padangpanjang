@extends('admin.app')

@section('content')
    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100 font-['Roboto']"
        style="font-family: 'Roboto', sans-serif;">

        <!-- ========================================================================= -->
        <!-- SIDEBAR MOBILE (DRAWER)                                                   -->
        <!-- ========================================================================= -->
        <div x-show="sidebarOpen" class="fixed inset-0 z-50 flex md:hidden" style="display: none;">
            <div x-show="sidebarOpen" x-transition:opacity class="fixed inset-0 bg-black/50 backdrop-blur-sm"
                @click="sidebarOpen = false"></div>

            <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
                class="relative w-64 bg-[#0f2440] text-white flex flex-col shadow-xl z-10">
                <div class="p-5 border-b border-slate-700/50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-[#ff9f1c] p-2 rounded-lg">
                            <img src="{{ asset('images/icon/globe.png') }}" alt="Logo"
                                class="w-4 h-4 object-contain invert">
                        </div>
                        <div>
                            <h1 class="font-black text-sm tracking-tight text-white uppercase">Admin Panel</h1>
                            <p class="text-[8px] text-[#ff9f1c] font-bold tracking-wider uppercase">LPPM ISI</p>
                        </div>
                    </div>
                    <button @click="sidebarOpen = false" class="text-white hover:text-[#ff9f1c] focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto">
                    @include(' admin.sidebar')
                </div>
                <div class="p-4 border-t border-slate-700/50">
                    <a href="{{ route('home') }}" target="_blank"
                        class="flex items-center justify-between px-3 py-2 text-xs text-slate-400 hover:text-[#ff9f1c] transition-all">
                        <span>Lihat Website Front-end</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- SIDEBAR DESKTOP                                                           -->
        <!-- ========================================================================= -->
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
            <div class="flex-1 overflow-y-auto">
                @include(' admin.sidebar')
            </div>
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

        <!-- ========================================================================= -->
        <!-- MAIN CONTENT AREA                                                         -->
        <!-- ========================================================================= -->
        <div class="flex-1 flex flex-col min-w-0 overflow-x-hidden">

            <!-- Global Header -->
            <header
                class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 md:px-8 flex-shrink-0 shadow-sm">
                <div class="flex items-center gap-3 min-w-0">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="text-[#0f2440] p-1.5 rounded-lg hover:bg-gray-100 block md:hidden focus:outline-none flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h2 class="text-base sm:text-xl font-black text-[#0f2440] uppercase tracking-tight truncate">Dashboard
                        Overview</h2>
                </div>

                <div class="flex items-center gap-3 sm:gap-4 flex-shrink-0">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-black text-[#0f2440]">Administrator LPPM</p>
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Super Admin</p>
                    </div>

                    <form action="{{ route('admin.logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-1 sm:gap-2 text-red-600 hover:text-red-700 hover:bg-red-50 px-2.5 py-2 rounded-xl transition-all text-xs font-bold uppercase tracking-widest select-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="hidden xs:inline">Logout</span>
                        </button>
                    </form>

                    <div
                        class="w-9 h-9 sm:w-10 sm:h-10 bg-[#0f2440] text-[#ff9f1c] font-black rounded-full flex items-center justify-center border-2 border-[#ff9f1c] shadow-sm select-none text-sm">
                        A
                    </div>
                </div>
            </header>

            <!-- Main Body Grid Container -->
            <main class="flex-1 p-4 sm:p-6 md:p-8 space-y-6 sm:space-y-8 overflow-y-auto">

                <!-- Welcome Banner Card -->
                <div
                    class="bg-gradient-to-r from-[#0f2440] to-[#173761] p-5 sm:p-6 rounded-2xl sm:rounded-3xl text-white shadow-md relative overflow-hidden">
                    <div class="relative z-10 space-y-1.5 max-w-xl">
                        <h3 class="text-lg sm:text-2xl font-black uppercase tracking-tight">Selamat Datang Kembali, Admin!
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-300 font-light leading-relaxed">
                            Melalui panel ini Anda dapat mengelola seluruh aset digital penelitian, pengabdian masyarakat,
                            serta data publikasi institut dengan mudah dan cepat.
                        </p>
                    </div>
                    <div class="absolute top-4 right-4 opacity-10 select-none hidden sm:block">
                        <div class="grid grid-cols-4 gap-1">
                            @for ($i = 0; $i < 16; $i++)
                                <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Statistics Widgets Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    <div
                        class="bg-white p-5 sm:p-6 rounded-2xl border-l-4 border-[#ff9f1c] shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">Total
                                Penelitian</p>
                            <h4 class="text-2xl sm:text-3xl font-black text-[#0f2440]">{{ $totalPenelitian ?? 0 }}</h4>
                        </div>
                        <div class="p-2.5 bg-orange-50 text-[#ff9f1c] rounded-xl flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                    </div>

                    <div
                        class="bg-white p-5 sm:p-6 rounded-2xl border-l-4 border-[#0f2440] shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">Total Berita
                            </p>
                            <h4 class="text-2xl sm:text-3xl font-black text-[#0f2440]">{{ $totalBerita ?? 0 }}</h4>
                        </div>
                        <div class="p-2.5 bg-blue-50 text-[#0f2440] rounded-xl flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2zM12 11l5 3H7l5-3z" />
                            </svg>
                        </div>
                    </div>

                    <div
                        class="bg-white p-5 sm:p-6 rounded-2xl border-l-4 border-emerald-500 shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">Total Media
                            </p>
                            <h4 class="text-2xl sm:text-3xl font-black text-[#0f2440]">{{ $totalMedia ?? 0 }}</h4>
                        </div>
                        <div class="p-2.5 bg-emerald-50 text-emerald-500 rounded-xl flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <div
                        class="bg-white p-5 sm:p-6 rounded-2xl border-l-4 border-indigo-500 shadow-sm flex items-center justify-between">
                        <div class="space-y-1">
                            <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">Total
                                Informasi</p>
                            <h4 class="text-2xl sm:text-3xl font-black text-[#0f2440]">{{ $totalInformasi ?? 0 }}</h4>
                        </div>
                        <div class="p-2.5 bg-indigo-50 text-indigo-500 rounded-xl flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities Table Log -->
                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div
                        class="p-4 sm:p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="text-left">
                            <h3 class="text-base sm:text-lg font-black text-[#0f2440] uppercase tracking-tight">Aktivitas
                                Konten Terbaru</h3>
                            <p class="text-xs text-gray-400 font-normal">Data publikasi riset ilmiah kebudayaan dan seni
                                yang baru saja ditambahkan.</p>
                        </div>
                        <a href="{{ route('admin.penelitian.index') }}"
                            class="bg-[#0f2440] text-white hover:bg-slate-800 font-bold text-xs px-4 py-2.5 rounded-xl uppercase tracking-wider transition-all select-none text-center w-full sm:w-auto">
                            Kelola Semua Data
                        </a>
                    </div>

                    <div class="w-full overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[600px]">
                            <thead>
                                <tr
                                    class="bg-gray-50 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-gray-400 border-b border-gray-100">
                                    <th class="py-4 px-5 sm:px-6">Konten / Judul</th>
                                    <th class="py-4 px-5 sm:px-6">Peneliti Utama</th>
                                    <th class="py-4 px-5 sm:px-6">Tanggal Upload</th>
                                    <th class="py-4 px-5 sm:px-6">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-xs sm:text-sm font-normal text-gray-600">
                                @forelse($latestPenelitians as $activity)
                                    <tr class="hover:bg-gray-50/80 transition-colors">
                                        <td
                                            class="py-4 px-5 sm:px-6 font-medium text-gray-800 max-w-xs md:max-w-md truncate">
                                            {{ $activity->judul }}
                                        </td>
                                        <td class="py-4 px-5 sm:px-6 font-semibold text-[#0f2440]">
                                            {{ $activity->nama_peneliti }}
                                        </td>
                                        <td class="py-4 px-5 sm:px-6 font-mono text-xs">
                                            {{ $activity->tanggal_penelitian ? \Carbon\Carbon::parse($activity->tanggal_penelitian)->format('d-m-Y') : $activity->created_at->format('d-m-Y') }}
                                        </td>
                                        <td class="py-4 px-5 sm:px-6">
                                            <span
                                                class="inline-flex items-center gap-1.5 text-emerald-600 font-bold text-xs">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="py-12 text-center text-gray-400 italic font-medium text-sm">
                                            Belum ada data aktivitas penelitian terbaru di sistem.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

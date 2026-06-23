@extends('admin.app')

@section('content')
    <div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100 font-['Roboto']"
        style="font-family: 'Roboto', sans-serif;">

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
                    @include('Admin.sidebar')
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
                @include('Admin.sidebar')
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

        <div class="flex-1 flex flex-col min-w-0 overflow-x-hidden">

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
                    <h2 class="text-base sm:text-xl font-black text-[#0f2440] uppercase tracking-tight truncate">Kelola
                        About</h2>
                </div>

                <div class="flex items-center gap-3 sm:gap-4 flex-shrink-0">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-black text-[#0f2440]">Administrator LPPM</p>
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Super Admin</p>
                    </div>
                    <div
                        class="w-9 h-9 sm:w-10 sm:h-10 bg-[#0f2440] text-[#ff9f1c] font-black rounded-full flex items-center justify-center border-2 border-[#ff9f1c] shadow-sm select-none text-sm">
                        A
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 md:p-8 space-y-6 overflow-y-auto">

                @if (session('success'))
                    <div
                        class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl text-xs font-bold shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-200 pb-4">
                    <div class="text-left">
                        <h2 class="text-xl sm:text-2xl font-black text-[#0f2440] uppercase tracking-tight">Kelola About</h2>
                        <p class="text-xs text-gray-400">Daftar seluruh profil pimpinan, berkas visi, dan misi tim LPPM.</p>
                    </div>
                    <a href="{{ route('admin.about.create') }}"
                        class="bg-[#0f2440] text-white hover:bg-slate-800 font-bold text-xs px-5 py-3 rounded-xl uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2 select-none w-full sm:w-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Data About
                    </a>
                </div>

                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[700px]">
                            <thead>
                                <tr
                                    class="bg-gray-50 text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-gray-400 border-b border-gray-100 whitespace-nowrap">
                                    <th class="py-4 px-4 sm:px-6 w-24">Cover</th>
                                    <th class="py-4 px-4 sm:px-6 w-64">Pimpinan / Jabatan</th>
                                    <th class="py-4 px-4 sm:px-6">Headline Lembaga</th>
                                    <th class="py-4 px-4 sm:px-6 text-center w-36">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-xs sm:text-sm font-normal text-gray-600">
                                @forelse ($abouts as $item)
                                    <tr class="hover:bg-gray-50/80 transition-colors">
                                        <td class="py-4 px-4 sm:px-6">
                                            <div
                                                class="w-16 h-12 rounded-lg overflow-hidden bg-gray-100 border border-gray-200 shadow-sm flex items-center justify-center flex-shrink-0">
                                                @if ($item->image)
                                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Cover"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <img src="{{ asset('images/foto-ketua.png') }}" alt="Placeholder"
                                                        class="w-full h-full object-cover opacity-50">
                                                @endif
                                            </div>
                                        </td>

                                        <td class="py-4 px-4 sm:px-6 text-left max-w-xs truncate">
                                            <div class="text-sm sm:text-base font-bold text-[#0f2440] mb-0.5">
                                                {{ $item->name }}</div>
                                            <span
                                                class="text-[11px] font-medium text-gray-400 font-mono">{{ $item->title }}</span>
                                        </td>

                                        <td
                                            class="py-4 px-4 sm:px-6 max-w-xs md:max-w-sm truncate text-gray-500 font-light">
                                            {{ $item->headline }}
                                        </td>

                                        <td class="py-4 px-4 sm:px-6 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-1">
                                                <a href="{{ route('admin.about.edit', $item->id) }}"
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-all"
                                                    title="Edit About">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('admin.about.destroy', $item->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin mau hapus data about ini, Jon?')"
                                                    class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 text-red-600 hover:bg-red-50 rounded-xl transition-all"
                                                        title="Hapus About">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="py-12 text-center text-gray-400 italic font-medium text-sm">
                                            Belum ada dokumentasi data About yang tersimpan, Jon. Klik "Tambah Data About"
                                            di atas buat mengisi data.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($abouts->hasPages())
                        <div class="p-4 sm:p-6 border-t border-gray-100 bg-gray-50/50">
                            {{ $abouts->links() }}
                        </div>
                    @endif
                </div>

            </main>
        </div>
    </div>
@endsection

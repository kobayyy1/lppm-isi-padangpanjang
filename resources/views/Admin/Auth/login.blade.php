<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator | LPPM ISI Padangpanjang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body class="min-h-screen bg-white font-['Roboto'] select-none overflow-x-hidden">

    <div class="hidden lg:flex h-screen w-full overflow-hidden">

        <div class="flex-1 flex flex-col min-w-0 relative">
            <div class="px-14 pt-12 pb-0">
                <div class="flex items-center gap-3 mb-1 select-none">
                    <img src="{{ asset('images/icon-notice.png') }}" alt="Notice" class="h-6 object-contain">
                    <div class="flex items-center gap-1.5">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="grid grid-cols-2 gap-0.5">
                                <span class="w-2.5 h-2.5 bg-[#ff9f1c] rounded-[2px]"></span>
                                <span class="w-2.5 h-2.5 bg-transparent"></span>
                                <span class="w-2.5 h-2.5 bg-transparent"></span>
                                <span class="w-2.5 h-2.5 bg-[#ff9f1c] rounded-[2px]"></span>
                            </div>
                        @endfor
                    </div>
                </div>
                <h1 class="text-6xl font-black text-[#0f2440] tracking-tight leading-none mt-1">Login</h1>
                <div class="flex items-center mt-2" style="gap:4px;">
                    <div class="bg-[#0f2440] rounded-full" style="width:80px;height:3px;"></div>
                    <div class="bg-[#0f2440] rounded-full" style="width:20px;height:3px;"></div>
                    <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                    <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                    <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                </div>
            </div>

            <div class="flex-1 flex items-center justify-center min-h-0 px-10 py-6">
                <img src="{{ asset('images/hero-isometric.png') }}" alt="Hero Isometrik LPPM"
                    class="max-w-full max-h-full object-contain">
            </div>
        </div>

        <div class="w-[480px] flex-shrink-0 flex flex-col justify-center px-14 py-12">
            <div class="mb-8">
                <div class="flex items-center justify-end gap-3 mb-2">
                    <img src="{{ asset('images/icon-arrow.png') }}" alt="Aksen" class="w-4 h-4 object-contain">
                    <img src="{{ asset('images/icon-doc.png') }}" alt="Docs" class="h-8 w-auto object-contain">
                </div>
                <div class="flex items-center justify-end" style="gap:4px;">
                    <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                    <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                    <div class="bg-[#0f2440] rounded-full" style="width:6px;height:3px;"></div>
                    <div class="bg-[#0f2440] rounded-full" style="width:20px;height:3px;"></div>
                    <div class="bg-[#0f2440] rounded-full" style="width:80px;height:3px;"></div>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-4xl font-black text-[#0f2440] tracking-tight leading-none">Welcome Back!</h2>
                <p class="text-sm text-gray-400 font-light mt-3">Log in in to start explore documents</p>
            </div>

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf
                @if (session('status'))
                    <div
                        class="bg-emerald-50 text-emerald-600 p-3 rounded-xl text-xs font-bold uppercase border border-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="space-y-1.5">
                    <label for="desktop-email" class="text-sm font-medium text-[#0f2440] block">Email</label>
                    <input type="email" id="desktop-email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:border-[#0f2440] transition-all @error('email') border-red-500 @enderror"
                        placeholder="Input your email">
                    @error('email')
                        <p class="text-xs text-red-500 font-medium mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label for="desktop-password" class="text-sm font-medium text-[#0f2440] block">Password</label>
                    <input type="password" id="desktop-password" name="password" required
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl text-sm focus:outline-none focus:border-[#0f2440] transition-all @error('password') border-red-500 @enderror"
                        placeholder="Input your password">
                    @error('password')
                        <p class="text-xs text-red-500 font-medium mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-500 hover:text-gray-700">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded border border-gray-300 accent-[#0f2440] focus:ring-0">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-gray-400 hover:underline hover:text-[#0f2440]">Forget
                        Password?</a>
                </div>

                <div class="pt-2 flex justify-center">
                    <button type="submit"
                        class="bg-[#0f2440] text-white font-bold text-sm px-12 py-3.5 rounded-xl uppercase tracking-widest hover:bg-slate-800 transition-all">
                        <span class="text-[#ff9f1c]">|</span> &nbsp; Login
                    </button>
                </div>
            </form>
        </div>

        <div
            class="w-20 bg-[#0f2440] flex-shrink-0 flex flex-col items-center justify-center py-6 select-none z-30 shadow-2xl border-l border-white/5 overflow-visible">
            <div
                class="bg-[#ff9f1c] w-9 rounded-full h-[90%] flex flex-col items-center justify-between py-8 relative overflow-visible shadow-inner border-r border-orange-400/30">
                <div class="flex items-start justify-center pt-2 w-full relative overflow-visible">
                    <h2 class="text-white font-black text-4xl tracking-widest uppercase drop-shadow-[2px_4px_3px_rgba(0,0,0,0.4)] absolute left-[60%] z-10 whitespace-nowrap"
                        style="writing-mode: vertical-rl; font-family: 'Roboto', sans-serif;">
                        LPPM
                    </h2>
                </div>
                <div class="mt-auto flex flex-col items-center gap-4 w-full text-center pb-2 select-none">
                    <p class="text-[#0f2440] font-bold text-[8px] tracking-wider uppercase whitespace-nowrap mx-auto"
                        style="writing-mode: vertical-rl;">
                        Institut Seni Indonesia Padangpanjang
                    </p>
                    <img src="{{ asset('images/icon/globe.png') }}" alt="Globe"
                        class="w-4 h-4 object-contain opacity-80 mx-auto">
                </div>
            </div>
        </div>
    </div>


    <div
        class="block lg:hidden min-h-screen w-full bg-[#f8fafc] px-4 sm:px-8 py-10 flex flex-col justify-center items-center">

        <div
            class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-gray-100 p-6 sm:p-8 relative overflow-hidden">

            <div class="absolute top-0 left-0 w-full h-1.5 bg-[#ff9f1c]"></div>

            <div class="mb-6">
                <div class="flex items-center gap-2 mb-1.5 select-none">
                    <img src="{{ asset('images/icon-notice.png') }}" alt="Notice" class="h-5 object-contain">
                    <div class="flex items-center gap-1">
                        @for ($i = 0; $i < 2; $i++)
                            <div class="grid grid-cols-2 gap-0.5">
                                <span class="w-2 h-2 bg-[#ff9f1c] rounded-[1px]"></span>
                                <span class="w-2 h-2 bg-transparent"></span>
                                <span class="w-2 h-2 bg-transparent"></span>
                                <span class="w-2 h-2 bg-[#ff9f1c] rounded-[1px]"></span>
                            </div>
                        @endfor
                    </div>
                </div>
                <h1 class="text-4xl font-black text-[#0f2440] tracking-tight leading-none">Login</h1>
                <div class="flex items-center mt-2" style="gap:4px;">
                    <div class="bg-[#0f2440] rounded-full" style="width:70px;height:3px;"></div>
                    <div class="bg-[#0f2440] rounded-full" style="width:20px;height:3px;"></div>
                    <div class="bg-[#0f2440] rounded-full" style="width:5px;height:3px;"></div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-2xl font-black text-[#0f2440] tracking-tight leading-none">Welcome Back!</h2>
                <p class="text-xs text-gray-400 font-light mt-2">Log in to start explore documents</p>
            </div>

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4.5">
                @csrf
                @if (session('status'))
                    <div
                        class="bg-emerald-50 text-emerald-600 p-3 rounded-xl text-xs font-bold uppercase border border-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="space-y-1">
                    <label for="mobile-email" class="text-xs font-semibold text-[#0f2440] block">Email</label>
                    <input type="email" id="mobile-email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f2440] focus:bg-white transition-all @error('email') border-red-500 @enderror"
                        placeholder="Input your email">
                    @error('email')
                        <p class="text-xs text-red-500 font-medium mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="mobile-password" class="text-xs font-semibold text-[#0f2440] block">Password</label>
                    <input type="password" id="mobile-password" name="password" required
                        class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#0f2440] focus:bg-white transition-all @error('password') border-red-500 @enderror"
                        placeholder="Input your password">
                    @error('password')
                        <p class="text-xs text-red-500 font-medium mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-0.5 text-xs">
                    <label class="flex items-center gap-1.5 cursor-pointer text-gray-400 hover:text-gray-600">
                        <input type="checkbox" name="remember"
                            class="w-3.5 h-3.5 rounded border border-gray-300 accent-[#0f2440] focus:ring-0">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="text-gray-400 hover:underline hover:text-[#0f2440]">Forget Password?</a>
                </div>

                <div class="pt-3">
                    <button type="submit"
                        class="w-full bg-[#0f2440] text-white font-bold text-sm py-3 rounded-xl uppercase tracking-widest hover:bg-slate-800 transition-all shadow-md">
                        <span class="text-[#ff9f1c]">|</span> &nbsp; Login
                    </button>
                </div>
            </form>

            <div
                class="mt-8 pt-4 border-t border-gray-100 flex items-center justify-between text-[9px] text-gray-400 font-medium uppercase tracking-wider select-none">
                <span class="truncate pr-2">ISI Padangpanjang — LPPM</span>
                <img src="{{ asset('images/icon/globe.png') }}" alt="Globe"
                    class="w-3.5 h-3.5 object-contain opacity-50 flex-shrink-0">
            </div>

        </div>
    </div>

</body>

</html>

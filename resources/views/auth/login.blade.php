<!DOCTYPE html>
<html lang="id" class="h-full" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Masuk Akun - Sistem Magang PLN UP3 Jambi' }}</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Laravel Vite Assets (CSS & JS Build) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-gradient-to-br from-teal-900 via-teal-800 to-slate-900 text-slate-800 font-sans antialiased min-h-screen flex items-center justify-center p-4 sm:p-6 md:p-10 selection:bg-teal-500 selection:text-white">

    <main
        class="w-full max-w-4xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-white/20 flex flex-col-reverse md:flex-row my-auto">
        <div class="w-full md:w-7/12 p-6 sm:p-8 md:p-12 flex flex-col justify-center bg-slate-50/60">
            <div class="mb-6 sm:mb-8">
                <span
                    class="inline-block text-[11px] font-bold text-teal-800 bg-teal-50 px-3 py-1 rounded-full border border-teal-200/80 mb-2">
                    Portal Presensi & Tugas
                </span>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Masuk Akun</h1>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">Silahkan masukkan email dan password anda
                </p>
            </div>

            <!-- Login Form (Blade Native) -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Field 1: E-mail -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">E-mail</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Inputkan e-mail"
                            class="w-full text-xs px-4 py-3 sm:py-3.5 pl-10 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 placeholder:text-slate-400 font-medium shadow-xs"
                            required autofocus />
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <span class="text-[11px] text-rose-500 font-semibold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field 2: Password -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-bold text-slate-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-[11px] font-semibold text-teal-700 hover:underline">Lupa Password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Inputkan password"
                            class="w-full text-xs px-4 py-3 sm:py-3.5 pl-10 pr-10 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 placeholder:text-slate-400 font-medium shadow-xs"
                            required />
                        <div class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <button type="button" onclick="togglePasswordVisibility('password', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-700 p-1 transition-colors"
                            tabIndex="-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-[11px] text-rose-500 font-semibold mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember" id="remember_me"
                            class="w-4 h-4 rounded border-slate-300 text-teal-700 focus:ring-teal-600/30 transition-all cursor-pointer" />
                        <span class="text-xs text-slate-600 font-medium">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-3">
                    <button type="submit"
                        class="w-full bg-teal-700 hover:bg-teal-800 active:scale-[0.99] text-white font-bold text-xs py-3.5 px-4 rounded-xl shadow-lg shadow-teal-700/20 transition-all cursor-pointer flex items-center justify-center gap-2">
                        <span>Masuk</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>

            </form>

            <!-- Register Redirect Link -->
            <div class="mt-8 pt-4 border-t border-slate-200/80 text-center">
                <p class="text-xs text-slate-600 font-medium">
                    Belum punya akun? silahkan <a href="{{ route('register') }}"
                        class="font-extrabold text-teal-700 hover:underline">Daftar</a>
                </p>
            </div>

        </div>

        <!-- RIGHT PANEL: PLN Branding & Hero Banner -->
        <div
            class="w-full md:w-5/12 bg-gradient-to-br from-teal-800 via-teal-700 to-teal-900 text-white p-6 sm:p-8 md:p-10 flex flex-col justify-between relative overflow-hidden shrink-0">

            <!-- Subtle Energy Pattern Background -->
            <div
                class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px]">
            </div>

            <!-- Brand Header -->
            <div class="relative z-10 flex items-center gap-3">
                <img src="{{ asset('img/logo_pln.png') }}" alt="" class="w-24">
            </div>

            <!-- Hero Banner Graphic & Description -->
            <div class="relative z-10 my-6 md:my-8 space-y-4">
                <h2 class="text-lg sm:text-xl md:text-2xl font-black text-white leading-tight">
                    Selamat Datang Kembali
                </h2>
                <p class="text-xs text-teal-100/90 leading-relaxed">
                    Masuk ke portal untuk mengisi presensi harian, mengunggah laporan logbook, serta melihat progres
                    magang anda.
                </p>
            </div>

            <!-- Footer Info -->
            <div
                class="relative z-10 pt-4 border-t border-teal-600/40 text-[10px] sm:text-[11px] text-teal-200 flex items-center justify-between">
                <span>© {{ date('Y') }} PLN UP3 Jambi</span>
                <span class="font-medium">Portal Magang Resmi</span>
            </div>
        </div>

    </main>

    <!-- Eye Password Toggle Logic -->
    <script>
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.classList.add('text-teal-700');
                btn.classList.remove('text-slate-400');
            } else {
                input.type = 'password';
                btn.classList.remove('text-teal-700');
                btn.classList.add('text-slate-400');
            }
        }
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Akun | PT PLN UP3 Jambi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0 20px 40px -15px rgba(15, 118, 110, 0.12), 0 4px 16px -2px rgba(0, 0, 0, 0.04)',
                    }
                }
            }
        }
    </script>
</head>

<body
    class="bg-linear-to-br from-teal-900 via-teal-800 to-slate-900 text-slate-800 font-sans antialiased min-h-screen flex items-center justify-center selection:bg-teal-500 selection:text-white">
    <main class="w-full md:h-screen bg-white shadow-2xl overflow-hidden  flex flex-col md:flex-row">
        @if (session('error') || $errors->any() || session('success'))
            <div id="toast-notification"
                class="fixed top-5 right-5 z-50 max-w-sm w-full bg-white border border-slate-200/90 shadow-2xl rounded-2xl p-4 transition-all duration-300 transform translate-y-0 opacity-100 flex items-start gap-3 border-l-4 {{ session('success') ? 'border-l-emerald-500' : 'border-l-rose-500' }}">

                @if (session('success'))
                    <div
                        class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-xs font-bold text-slate-800">Pendaftaran Berhasil!</h4>
                        <p class="text-[11px] text-slate-600 mt-0.5 leading-snug">{{ session('success') }}</p>
                    </div>
                @else
                    <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-xs font-bold text-rose-900">Gagal Registrasi</h4>
                        <p class="text-[11px] text-rose-700 mt-0.5 leading-snug">
                            {{ session('error') ?? 'Terdapat kesalahan pada isian form registrasi Anda.' }}
                        </p>
                    </div>
                @endif

                <!-- Tombol Close (X) -->
                <button type="button" onclick="closeRegisterToast()"
                    class="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-100 transition-colors shrink-0 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        <!-- LEFT PANEL: PLN Branding & Graphic (Shows on Desktop md:flex, hidden or compact on mobile) -->
        <div
            class="w-full md:w-5/12 bg-linear-to-br from-teal-800 via-teal-700 to-teal-900 text-white p-6 sm:p-8 md:p-10 flex flex-col justify-between relative overflow-hidden shrink-0">
            <!-- Subtle Background Mesh Pattern -->
            <div
                class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px]">
            </div>

            <!-- Top Brand Header -->
            <div class="relative z-10 flex flex-col items-start gap-3">
                <button onclick="history.back()"
                    class="flex items-center gap-1.5 text-xs font-semibold text-teal-800 hover:text-teal-950 p-1 -ml-1 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Kembali</span>
                </button>
                <img src="{{ asset('img/logo_pln.png') }}" alt="" class="w-18">
                <div class="relative z-10 my-6 md:my-8 space-y-4">
                    <h2 class="text-lg sm:text-xl md:text-2xl font-black text-white leading-tight">
                        Portal Registrasi Magang
                    </h2>
                    <p class="text-xs text-teal-100/90 leading-relaxed">
                        Buat akun untuk mengakses portal presensi harian, penugasan proyek PLN UP3 Jambi.
                    </p>
                </div>
            </div>

            <!-- Footer Info -->
            <div
                class="relative z-10 pt-4 border-t border-teal-600/40 text-[10px] sm:text-[11px] text-teal-200 flex items-center justify-between">
                <span>© 2026 PLN UP3 Jambi</span>
                <span class="font-medium">Sistem Integrasi SDM</span>
            </div>
        </div>

        <!-- RIGHT PANEL: Form Registrasi Akun -->
        <div class="w-full md:w-7/12 p-6 sm:p-8 md:p-10 flex flex-col justify-center bg-slate-50/60">

            <!-- Card Header -->
            <div class="mb-6">
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">Daftar Akun</h1>
                <p class="text-xs text-teal-800/80 font-medium mt-1">Buat akun dan mulai magang anda</p>
            </div>

            <!-- Registration Form (Identical Labels & Placeholders) -->
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Field 1: Token Pendaftaran (Full Width) -->
                <div>
                    <label for="token" class="block text-xs font-bold text-slate-700 mb-1.5">Token
                        Pendaftaran</label>
                    <input type="text" id="token" name="token" placeholder="Inputkan token pendaftaran"
                        class="w-full text-xs px-3.5 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 placeholder:text-slate-400 font-medium shadow-xs"
                        required />
                </div>

                <!-- Grid 2 Kolom di Desktop for Nama & NIM/NISN -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <!-- Field 2: Nama Lengkap -->
                    <div>
                        <label for="nama" class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" placeholder="Inputkan nama"
                            class="w-full text-xs px-3.5 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 placeholder:text-slate-400 font-medium shadow-xs"
                            required />
                    </div>

                    <!-- Field 3: NIM/NISN -->
                    <div>
                        <label for="nim_nisn" class="block text-xs font-bold text-slate-700 mb-1.5">NIM/NISN</label>
                        <input type="text" id="nim_nisn" name="nim_nisn" placeholder="Inputkan NIM/NISN"
                            class="w-full text-xs px-3.5 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 placeholder:text-slate-400 font-medium shadow-xs"
                            required />
                    </div>
                </div>

                <!-- Grid 2 Kolom di Desktop for Email & Nomor Telepon -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <!-- Field 4: E-mail -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="Inputkan e-mail"
                            class="w-full text-xs px-3.5 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 placeholder:text-slate-400 font-medium shadow-xs"
                            required />
                    </div>

                    <!-- Field 5: Nomor Telepon -->
                    <div>
                        <label for="no_hp" class="block text-xs font-bold text-slate-700 mb-1.5">Nomor
                            Telepon</label>
                        <input type="tel" id="no_hp" name="no_hp" placeholder="Inputkan nomor telepon"
                            class="w-full text-xs px-3.5 py-2.5 sm:py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 placeholder:text-slate-400 font-medium shadow-xs"
                            required />
                    </div>
                </div>

                <!-- Grid 2 Kolom di Desktop for Password & Konfirmasi Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <!-- Field 6: Password -->
                    <div>
                        <label for="password" class="block text-xs font-bold text-slate-700 mb-1.5">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Inputkan password"
                                class="w-full text-xs px-3.5 py-2.5 sm:py-3 pr-10 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 placeholder:text-slate-400 font-medium shadow-xs"
                                required />
                            <button type="button" onclick="togglePasswordVisibility('password', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-700 p-1 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Field 7: Konfirmasi Password -->
                    <div>
                        <label for="password_confirmation"
                            class="block text-xs font-bold text-slate-700 mb-1.5">Konfirmasi Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Konfirmasi password"
                                class="w-full text-xs px-3.5 py-2.5 sm:py-3 pr-10 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 placeholder:text-slate-400 font-medium shadow-xs"
                                required />
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-teal-700 p-1 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-teal-600 hover:bg-teal-800 active:scale-[0.99] text-white font-bold text-xs py-3 sm:py-3.5 px-4 rounded-xl shadow-md shadow-teal-700/20 transition-all cursor-pointer">
                        Daftar
                    </button>
                </div>

            </form>

            <!-- Login Redirect Footer Link -->
            <div class="mt-6 pt-4 border-t border-slate-200/80 text-center">
                <p class="text-xs text-slate-600 font-medium">
                    Sudah punya akun? silahkan <a href="{{ route('login') }}"
                        class="font-extrabold text-teal-700 hover:underline">Masuk</a>
                </p>
            </div>
        </div>
    </main>


    @vite('resources/js/app.js')
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

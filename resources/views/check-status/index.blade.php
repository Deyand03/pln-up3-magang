@extends('layouts.base')
@section('title', 'Cek Status Pengajuan Magang')

@section('content')
    <!-- TOASTER NOTIFIKASI BERHASIL (Top-Right Fixed) -->
    @if (session('success'))
    <div id="toast-success"
        class="fixed top-5 right-5 z-50 max-w-sm w-full bg-white text-white p-4 rounded-2xl shadow-2xl border border-teal-500/30 flex items-start gap-3 transform transition-all duration-300 animate-slide-in">
        <div class="w-8 h-8 rounded-xl bg-teal-500/20 border border-teal-500/40 text-teal-400 flex items-center justify-center shrink-0 mt-0.5">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div class="flex-1 pr-2">
            <h4 class="text-xs font-bold text-teal-400">Pengajuan Berhasil!</h4>
            <p class="text-[11px] text-slate-700 mt-0.5 leading-snug">
                {{ session('success') }}
            </p>
        </div>
        <button onclick="dismissToast()" class="text-slate-400 hover:text-black p-1 rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    <div class="min-h-[85vh] flex justify-center items-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50/50">
        <div
            class="w-full md:max-w-xl max-w-md bg-white rounded-2xl p-6 sm:p-8 shadow-xl shadow-slate-200/60 border border-slate-200/80 text-center relative overflow-hidden transition-all">

            <!-- Glow Accent Header -->
            <div class="absolute -top-12 -left-12 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl pointer-events-none"></div>

            <!-- Header Icon -->
            <div
                class="w-14 h-14 rounded-2xl bg-linear-to-br from-teal-500 to-teal-700 text-white flex items-center justify-center mx-auto mb-4 shadow-lg shadow-teal-600/20 shrink-0">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>

            <h2 class="text-xl sm:text-2xl font-black text-slate-800 leading-snug tracking-tight">
                Pengecekan Status<br />
                <span class="text-teal-700">Pengajuan Magang PLN UP3 Jambi</span>
            </h2>
            <p class="text-xs text-slate-500 mt-1.5 max-w-xs mx-auto leading-relaxed">
                Masukkan nomor pendaftaran Anda untuk memantau progress verifikasi berkas secara real-time.
            </p>


            <!-- Alert Not Found / Error -->
            @if (session('notFound'))
                <div
                    class="my-4 p-3.5 bg-rose-50 border border-rose-200/90 rounded-xl text-left flex items-start gap-3 animate-fade-in">
                    <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-xs font-medium text-rose-700 leading-snug">
                        {{ session('notFound') }}
                    </p>
                </div>
            @endif

            <!-- Form Pencarian Status -->
            <form action="{{ route('check-status.check') }}" method="GET" class="mt-6 space-y-3">
                <div class="text-left">
                    @if (session('registration_number'))
                        <div class="mb-3 p-3 bg-teal-50/90 border border-teal-200 rounded-xl flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2 pr-2 overflow-hidden">
                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-lg bg-teal-600 text-white font-bold text-[10px] shrink-0">📋</span>
                                <div class="truncate">
                                    <span class="text-[10px] text-teal-800 font-bold block leading-tight">Nomor Pendaftaran Anda:</span>
                                    <span class="font-mono font-extrabold text-teal-950 text-xs sm:text-sm tracking-wider select-all truncate block">
                                        {{ session('registration_number') }}
                                    </span>
                                </div>
                            </div>
                            <button type="button" onclick="copyRegNumber('{{ session('registration_number') }}', this)"
                                class="px-3 py-1.5 bg-teal-600 hover:bg-teal-700 active:scale-95 text-white font-bold rounded-lg text-[11px] transition-all flex items-center gap-1 shrink-0 cursor-pointer shadow-xs">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 012-2v-8a2 2 0 01-2-2h-8a2 2 0 01-2 2v8a2 2 0 012 2z" />
                                </svg>
                                <span>Salin</span>
                            </button>
                        </div>
                    @endif

                    <label for="registration_number"
                        class="block text-[11px] font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nomor Pendaftaran
                    </label>
                    <div class="relative">
                        <input type="text" name="registration_number" id="registration_number"
                            value="{{ request('registration_number') }}"
                            placeholder="Contoh: PLN-MG-20260921-A1B2" required
                            class="w-full text-xs font-mono uppercase tracking-wider px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all placeholder:text-slate-400 placeholder:normal-case placeholder:tracking-normal font-semibold text-slate-800" />

                        @if (request('registration_number'))
                            <a href="{{ route('check-status') }}"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs font-semibold">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 active:scale-98 text-white font-bold text-xs py-3 px-4 rounded-xl shadow-sm shadow-teal-700/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cek Status Pengajuan
                </button>
            </form>

            @if ($application ?? null)
                <!-- Badge Overview Status -->
                <div class="mt-6 pt-5 border-t border-slate-100">
                    <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block mb-2">Status Saat
                        Ini</span>

                    @if ($application->status === 'pending')
                        <div
                            class="bg-amber-50 border border-amber-200/80 rounded-xl py-2.5 px-4 text-amber-800 text-xs font-bold inline-flex items-center justify-center gap-2 shadow-xs w-full">
                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                            Dokumen Dalam Proses Verifikasi HRD
                        </div>
                    @elseif($application->status === 'approved')
                        <div
                            class="bg-emerald-50 border border-emerald-200/80 rounded-xl py-3 px-4 text-emerald-800 text-xs font-bold shadow-xs w-full text-left space-y-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Pengajuan Magang Disetujui!</span>
                            </div>

                            @if ($application->registration_token)
                                <div class="pt-2 border-t border-emerald-200/60 text-[11px] font-normal text-emerald-950">
                                    <p>Gunakan Token Pendaftaran berikut untuk membuat akun mahasiswa:</p>
                                    <div
                                        class="bg-white border border-emerald-300 font-mono font-extrabold text-sm text-center py-1.5 rounded-lg my-1.5 select-all text-emerald-900">
                                        {{ $application->registration_token }}
                                    </div>
                                    <p class="text-[10px] text-emerald-700">Kuota: {{ $application->token_used }} /
                                        {{ $application->token_quota }} Akun Terdaftar</p>
                                </div>
                            @endif
                        </div>
                    @elseif($application->status === 'rejected')
                        <div
                            class="bg-rose-50 border border-rose-200/80 rounded-xl py-3 px-4 text-rose-800 text-xs font-bold shadow-xs w-full text-left">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Pengajuan Ditolak</span>
                            </div>
                            @if ($application->notes)
                                <p class="text-[11px] font-normal text-rose-700 mt-1 pl-6">
                                    Catatan: {{ $application->notes }}
                                </p>
                            @endif
                        </div>
                    @elseif($application->status === 'revision')
                        <div
                            class="bg-yellow-50 border border-yellow-200/80 rounded-xl py-3 px-4 text-yellow-800 text-xs font-bold shadow-xs w-full text-left">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-yellow-600 shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Pengajuan Belum Dapat Disetujui</span>
                            </div>
                            @if ($application->notes)
                                <p class="text-[11px] font-normal text-yellow-700 mt-1 pl-6">
                                    Catatan: {{ $application->notes }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Dynamic Vertical Status Stepper -->
                <div
                    class="mt-6 text-left space-y-4 relative before:absolute before:left-3.5 before:top-3 before:bottom-3 before:w-0.5 before:bg-slate-200">

                    <!-- Step 1: Dokumen Diajukan (Selalu Done) -->
                    <div class="relative flex items-start gap-3">
                        <div
                            class="w-7 h-7 rounded-full bg-teal-600 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs">
                            ✓
                        </div>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/80 w-full">
                            <div class="flex items-center justify-between">
                                <p class="text-xs font-bold text-slate-800">Dokumen Diajukan</p>
                                <span
                                    class="text-[10px] text-slate-400 font-mono">{{ $application->created_at->format('d/m/Y') }}</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mt-0.5">Dokumen pengajuan Anda berhasil terkirim dan
                                tercatat di sistem.</p>
                        </div>
                    </div>

                    <!-- Step 2: Verifikasi Dokumen -->
                    <div class="relative flex items-start gap-3">
                        @if ($application->status === 'pending')
                            <div
                                class="w-7 h-7 rounded-full bg-amber-500 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs animate-pulse">
                                2
                            </div>
                            <div class="bg-amber-50/50 p-3 rounded-xl border border-amber-200/80 w-full">
                                <p class="text-xs font-bold text-amber-900">Verifikasi Berkas</p>
                                <p class="text-[11px] text-amber-700 mt-0.5">Tim HRD PLN UP3 Jambi sedang meninjau berkas &
                                    kuota divisi.</p>
                            </div>
                        @else
                            <div
                                class="w-7 h-7 rounded-full bg-teal-600 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs">
                                ✓
                            </div>
                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/80 w-full">
                                <p class="text-xs font-bold text-slate-800">Verifikasi Berkas Selesai</p>
                                <p class="text-[11px] text-slate-500 mt-0.5">Pemeriksaan berkas dan kuota unit kerja telah
                                    selesai.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Step 3: Hasil Keputusan -->
                    <div class="relative flex items-start gap-3">
                        @if ($application->status === 'pending')
                            <div
                                class="w-7 h-7 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white">
                                3
                            </div>
                            <div class="bg-slate-50/50 p-3 rounded-xl border border-slate-200/50 w-full opacity-60">
                                <p class="text-xs font-bold text-slate-700">Hasil Keputusan</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Surat penerimaan & token registrasi akun
                                    magang.</p>
                            </div>
                        @elseif($application->status === 'approved')
                            <div
                                class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs">
                                ✓
                            </div>
                            <div class="bg-emerald-50/50 p-3 rounded-xl border border-emerald-200/80 w-full">
                                <p class="text-xs font-bold text-emerald-900">Diterima Magang</p>
                                <p class="text-[11px] text-emerald-700 mt-0.5">Silakan gunakan token di atas untuk
                                    mendaftarkan akun magang kelompok Anda.</p>
                            </div>
                        @elseif($application->status === 'revision')
                            <div
                                class="w-7 h-7 rounded-full bg-rose-600 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs">
                                ✕
                            </div>
                            <div class="bg-rose-50/50 p-3 rounded-xl border border-rose-200/80 w-full">
                                <p class="text-xs font-bold text-rose-900">Data Anda Bermasalah</p>
                                <p class="text-[11px] text-rose-700 mt-0.5">Mohon maaf, Silahkan Perbaiki data anda</p>
                            </div>
                        @elseif($application->status === 'rejected')
                            <div
                                class="w-7 h-7 rounded-full bg-rose-600 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs">
                                ✕
                            </div>
                            <div class="bg-rose-50/50 p-3 rounded-xl border border-rose-200/80 w-full">
                                <p class="text-xs font-bold text-rose-900">Pengajuan Ditolak</p>
                                <p class="text-[11px] text-rose-700 mt-0.5">Mohon maaf, kuota penerimaan magang periode ini
                                    sedang penuh.</p>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($application->status === 'approved')
                <div class="flex justify-center pt-3">
                    <a href="{{ route('register') }}" class="bg-teal-600 py-3 text-xs tracking- text-white font-bold rounded-xl w-full shadow hover:shadow-lg shadow-teal-500/30 hover:bg-teal-700 active:scale-95 duration-300 transition-all transform-gpu">
                        Buat Akun
                    </a>

                </div>
                @endif
            @else
                <!-- Default State: Belum Mencari Status -->
                <div class="mt-8 pt-4 border-t border-slate-100 text-slate-400 text-[11px]">
                    <p class="flex items-center justify-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pastikan format nomor pendaftaran benar (contoh: <code
                            class="font-mono text-slate-600">PLN-MG-...</code>)
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- SCRIPT COPY TO CLIPBOARD & TOAST AUTO-DISMISS -->
    <script>
        function copyRegNumber(text, btn) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text);
            } else {
                let textArea = document.createElement("textarea");
                textArea.value = text;
                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                document.execCommand('copy');
                textArea.remove();
            }

            // Visual feedback pada tombol salin
            const originalHTML = btn.innerHTML;
            btn.innerHTML = `
                <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
                <span>Tersalin!</span>
            `;
            btn.classList.remove('bg-teal-600', 'hover:bg-teal-700');
            btn.classList.add('bg-emerald-700');

            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('bg-emerald-700');
                btn.classList.add('bg-teal-600', 'hover:bg-teal-700');
            }, 2500);
        }

        function dismissToast() {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-10px)';
                setTimeout(() => toast.remove(), 300);
            }
        }

        // Auto dismiss toast setelah 5 detik
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                dismissToast();
            }, 5000);
        });
    </script>
@endsection

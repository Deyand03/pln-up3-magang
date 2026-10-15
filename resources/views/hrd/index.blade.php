@extends('layouts.base')
@section('title', 'Dashboard HRD')

@section('content')
    @if(session('success') || session('error'))
        <div class="fixed top-6 right-6 z-50 flex flex-col gap-3" x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)" x-show="show"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-10"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 sm:translate-x-10" style="display: none;">

            @if(session('success'))
                <div
                    class="bg-white border-l-4 border-emerald-500 rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] p-4 max-w-sm w-full flex items-start gap-3">
                    <div class="shrink-0 text-emerald-500 bg-emerald-50 p-1.5 rounded-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-1 mt-0.5">
                        <h3 class="text-sm font-extrabold text-slate-800">Berhasil!</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false"
                        class="text-slate-400 hover:text-slate-600 transition-colors bg-slate-50 hover:bg-slate-100 p-1 rounded-md">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <!-- Toast Error (Merah) -->
                <div
                    class="bg-white border-l-4 border-rose-500 rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] p-4 max-w-sm w-full flex items-start gap-3">
                    <div class="shrink-0 text-rose-500 bg-rose-50 p-1.5 rounded-lg">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="flex-1 mt-0.5">
                        <h3 class="text-sm font-extrabold text-slate-800">Terjadi Kesalahan</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">{{ session('error') }}</p>
                    </div>
                    <button @click="show = false"
                        class="text-slate-400 hover:text-slate-600 transition-colors bg-slate-50 hover:bg-slate-100 p-1 rounded-md">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    @endif
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        <div
            class="bg-linear-to-br from-slate-900 via-teal-950 to-teal-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-teal-900/10 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6 border border-slate-700/50">
            <!-- Deco Pattern -->
            <div
                class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] bg-size-[20px_20px]">
            </div>
            <div
                class="absolute -right-20 -top-20 w-64 h-64 bg-teal-500 rounded-full blur-[80px] opacity-20 pointer-events-none">
            </div>

            <div class="relative z-10 space-y-2">
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-[10px] font-bold text-teal-100 backdrop-blur-md border border-white/10 uppercase tracking-wider">
                    Overview Kepegawaian
                </span>
                <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight leading-tight">
                    Dashboard HRD
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 max-w-xl leading-relaxed">
                    Pantau pergerakan pengajuan dan data peserta magang di tahun {{ $tahunIni }}.
                </p>
            </div>

            <div class="relative z-10 shrink-0">
                <div class="text-right">
                    <a href="{{ route('dashboard-hrd.pendaftar') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-700 hover:bg-teal-800 text-white text-sm font-bold rounded-xl transition-colors shadow-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Tinjau Pendaftaran
                    </a>
                </div>
            </div>
        </div>

        <!-- 4 STAT CARDS ACTIONABLE -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5">

            <!-- Tim Pending -->
            <div
                class="bg-white p-5 rounded-2xl border border-amber-200 shadow-[0_4px_20px_rgb(251,191,36,0.05)] relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 p-4 opacity-10 transform translate-x-2 -translate-y-2 group-hover:scale-110 transition-transform">
                    <svg class="w-16 h-16 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-[11px] font-extrabold text-amber-600 uppercase tracking-wider block mb-1">Verifikasi
                    Tertunda</span>
                <span class="text-3xl font-black text-slate-900">{{ $pendingVerifikasi }} <span
                        class="text-sm font-semibold text-slate-400">Tim</span></span>
            </div>

            <!-- Peserta Aktif -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden">
                <span class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider block mb-1">Peserta Aktif
                    Saat Ini</span>
                <span class="text-3xl font-black text-slate-900">{{ $pesertaAktif }} <span
                        class="text-sm font-semibold text-slate-400">Orang</span></span>
            </div>

            <!-- Instansi Bermitra -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden">
                <span class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider block mb-1">Instansi
                    Bermitra</span>
                <span class="text-3xl font-black text-slate-900">{{ $totalInstansi }} <span
                        class="text-sm font-semibold text-slate-400">Kampus/Sekolah</span></span>
            </div>

            <!-- Selesai Bulan Ini -->
            <div
                class="bg-white p-5 rounded-2xl border border-emerald-200 shadow-[0_4px_20px_rgb(16,185,129,0.05)] relative overflow-hidden">
                <div class="absolute top-0 right-0 p-4 opacity-10 transform translate-x-2 -translate-y-2">
                    <svg class="w-16 h-16 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="text-[11px] font-extrabold text-emerald-600 uppercase tracking-wider block mb-1">Selesai Bulan
                    Ini</span>
                <span class="text-3xl font-black text-slate-900">{{ $selesaiBulanIni }} <span
                        class="text-sm font-semibold text-slate-400">Orang</span></span>
            </div>

        </div>

        <!-- 2 CHARTS AREA -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Chart Tren (Lebar 2 Kolom) -->
            <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-sm font-black text-slate-900">Tren Peserta Magang</h2>
                        <p class="text-[11px] text-slate-500 font-semibold mt-0.5">Akumulasi penerimaan peserta sepanjang
                            tahun {{ $tahunIni }}</p>
                    </div>
                </div>
                <div class="relative h-72 w-full">
                    <!-- Canvas Chart.js -->
                    <canvas id="chartTren"></canvas>
                </div>
            </div>

            <!-- Chart Instansi (Lebar 1 Kolom) -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 shadow-sm flex flex-col">
                <div class="mb-6">
                    <h2 class="text-sm font-black text-slate-900">Distribusi Instansi</h2>
                    <p class="text-[11px] text-slate-500 font-semibold mt-0.5">Top 5 asal peserta magang aktif & selesai</p>
                </div>
                <div class="relative flex-1 min-h-[250px] w-full flex items-center justify-center">
                    <!-- Canvas Chart.js -->
                    <canvas id="chartInstansi"></canvas>

                    <!-- Custom Label di tengah Donut -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none mt-[-10px]">
                        <span class="text-3xl font-black text-slate-900">{{ $totalInstansi }}</span>
                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Instansi</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- SECTION TIM MAGANG -->
        <div class="mt-8">
            <h2 class="text-xs font-extrabold text-slate-500 uppercase tracking-wider mb-4">Tim Magang Aktif & Selesai</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                @forelse($timMagang as $tim)
                    <!-- Wrapper Card + State Alpine JS (Untuk Dropdown & 2 Modal) -->
                    <div x-data="{ openKelola: false, openDivisiModal: false, openStatusModal: false }"
                        class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:border-teal-300 hover:shadow-md transition-all flex flex-col justify-between relative overflow-hidden group">

                        <!-- Dekorasi Background -->
                        <div
                            class="absolute -right-10 -top-10 w-32 h-32 bg-slate-50 rounded-full opacity-50 pointer-events-none group-hover:bg-teal-50/50 transition-colors">
                        </div>

                        <div class="relative z-10">
                            <!-- Header Tim -->
                            <div class="flex items-start justify-between gap-4 mb-5">
                                <div>
                                    <h3 class="text-base font-black text-slate-900 leading-tight">{{ $tim->institusi }}</h3>
                                    <p class="text-[11px] font-semibold text-slate-500 mt-1 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($tim->start_date)->translatedFormat('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($tim->end_date)->translatedFormat('d M Y') }}
                                    </p>
                                </div>

                                <!-- Badge Status Tim Global -->
                                <div class="shrink-0">
                                    @if(now()->isBefore($tim->end_date))
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-teal-50 text-teal-700 text-[10px] font-extrabold border border-teal-100 uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-pulse"></span> Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 text-[10px] font-extrabold border border-slate-200 uppercase tracking-wider">
                                            Selesai
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Daftar Anggota Tim -->
                            <div class="space-y-3">
                                <p class="text-[10px] font-bold text-slate-400 uppercase border-b border-slate-100 pb-1.5">
                                    Anggota Tim ({{ $tim->internship->count() }} Orang)</p>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @forelse($tim->internship as $intern)
                                        <div class="flex items-center gap-2.5 bg-slate-50 p-2 rounded-xl border border-slate-100">
                                            <div class="w-8 h-8 rounded-full overflow-hidden border border-slate-200 shrink-0">
                                                <img src="{{ $intern->user->foto_profil ? Storage::url($intern->user->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($intern->user->name) . '&background=0D8B94&color=fff' }}"
                                                    alt="Avatar" class="w-full h-full object-cover">
                                            </div>
                                            <div class="overflow-hidden">
                                                <p class="text-xs font-bold text-slate-800 truncate"
                                                    title="{{ $intern->user->name }}">{{ $intern->user->name }}</p>
                                                <p
                                                    class="text-[10px] font-semibold {{ $intern->status === 'terminated' ? 'text-rose-600' : 'text-teal-600' }} truncate">
                                                    {{ $intern->status === 'terminated' ? 'Diberhentikan' : ($intern->department ?? 'Menunggu Divisi') }}
                                                </p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-[10px] font-semibold text-slate-400 col-span-2 text-center">Peserta Belum
                                            Mendaftar Akun Magang</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Area Dokumen Surat Selesai -->
                            <div class="mt-4 pt-4 border-t border-slate-100 mb-6">
                                <h4 class="text-[10px] font-bold text-slate-400 uppercase mb-2">Dokumen Surat Selesai</h4>

                                @if($tim->surat_selesai)
                                    <div
                                        class="flex items-center justify-between bg-emerald-50 border border-emerald-100 p-2.5 rounded-xl">
                                        <div class="flex items-center gap-2.5 overflow-hidden">
                                            <div
                                                class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div class="truncate">
                                                <p class="text-xs font-bold text-emerald-800 truncate">
                                                    Surat_Selesai_{{ $tim->name }}.pdf</p>
                                                <p class="text-[9px] font-semibold text-emerald-600">Telah diunggah</p>
                                            </div>
                                        </div>
                                        <!-- Aksi Dokumen -->
                                        <div class="flex items-center gap-2 shrink-0">
                                            <a href="{{ Storage::url($tim->surat_selesai) }}" target="_blank"
                                                class="p-1.5 text-emerald-600 hover:bg-emerald-200 rounded-md transition-colors"
                                                title="Lihat"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg></a>
                                            <form action="{{ route('dashboard-hrd.upload-surat-selesai', $tim->id) }}" method="post"
                                                class="h-fit flex" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <label for="surat_selesai_{{ $tim->id }}"
                                                    class="p-1.5 text-amber-600 hover:bg-amber-100 rounded-md transition-colors cursor-pointer inline-flex items-center justify-center"
                                                    title="Ganti Surat">
                                                    <input type="file" id="surat_selesai_{{ $tim->id }}" name="surat_selesai"
                                                        accept=".pdf" hidden onchange="this.form.submit()">
                                                    <div>
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                            stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                        </svg>
                                                    </div>
                                                </label>
                                            </form>
                                            <form action="{{ route('dashboard-hrd.hapus-surat-selesai', $tim->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="p-1.5 text-rose-600 hover:bg-rose-100 rounded-md transition-colors"
                                                    title="Hapus"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <form action="{{ route('dashboard-hrd.upload-surat-selesai', $tim->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <label for="surat_selesai_{{ $tim->id }}"
                                            class="w-full flex flex-col items-center justify-center p-4 border-2 border-dashed border-slate-200 rounded-xl hover:border-teal-400 hover:bg-teal-50 transition-colors group">
                                            <input type="file" id="surat_selesai_{{ $tim->id }}" name="surat_selesai" accept=".pdf"
                                                hidden onchange="this.form.submit()">
                                            <div
                                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-teal-100 group-hover:text-teal-600 mb-2 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                </svg>
                                            </div>
                                            <span class="text-xs font-bold text-slate-600 group-hover:text-teal-700">Upload Surat
                                                Selesai</span>
                                        </label>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Footer Card: Dropdown Kelola Tim -->
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between relative z-20">
                            <div class="text-[11px] font-bold text-slate-500">
                                Reg: <span class="text-slate-800 font-mono">{{ $tim->registration_number }}</span>
                            </div>

                            <div class="relative">
                                <button @click="openKelola = !openKelola" @click.away="openKelola = false"
                                    class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-slate-900 hover:bg-slate-800 text-white text-[11px] font-extrabold rounded-lg transition-all shadow-sm">
                                    Kelola Tim
                                    <svg class="w-3.5 h-3.5 transition-transform" :class="openKelola ? 'rotate-180' : ''"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- Menu Dropdown -->
                                <div x-show="openKelola" x-transition.opacity.duration.150ms
                                    class="absolute right-0 bottom-full mb-2 w-48 rounded-xl bg-white border border-slate-200 shadow-xl overflow-hidden z-50"
                                    style="display: none;">
                                    <div class="p-1.5 space-y-0.5">
                                        <button @click="openDivisiModal = true; openKelola = false"
                                            class="w-full text-left px-3 py-2 text-xs font-bold text-slate-600 hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-colors flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            Penempatan Divisi
                                        </button>
                                        <button @click="openStatusModal = true; openKelola = false"
                                            class="w-full text-left px-3 py-2 text-xs font-bold text-slate-600 hover:text-amber-700 hover:bg-amber-50 rounded-lg transition-colors flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            Kelola Status Individu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ============================================== -->
                        <!-- MODAL 1: PENEMPATAN DIVISI & MENTOR -->
                        <!-- ============================================== -->
                        <div x-show="openDivisiModal" style="display: none;"
                            class="fixed inset-0 z-100 flex items-center justify-center p-4 sm:p-6">
                            <div x-show="openDivisiModal" x-transition.opacity
                                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="openDivisiModal = false"></div>

                            <div x-show="openDivisiModal" x-transition.scale.origin.bottom
                                class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
                                <div
                                    class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                                    <div>
                                        <h3 class="text-base font-black text-slate-900">Penempatan Divisi & Mentor</h3>
                                        <p class="text-[11px] font-semibold text-slate-500 mt-0.5">Satu divisi diwakili oleh
                                            satu mentor pembimbing.</p>
                                    </div>
                                    <button @click="openDivisiModal = false"
                                        class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-colors">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <form action="{{ route('dashboard-hrd.update-divisi', $tim->id) }}" method="POST" class="overflow-y-auto p-6 space-y-4">
                                    @csrf
                                    @method('PATCH')

                                    @foreach($tim->internship as $intern)
                                        <div
                                            class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center gap-4">
                                            <div class="flex items-center gap-3 md:w-5/12 shrink-0">
                                                <div class="w-10 h-10 rounded-full overflow-hidden border border-slate-200">
                                                    <img src="{{ $intern->user->foto_profil ? Storage::url($intern->user->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($intern->user->name) . '&background=0D8B94&color=fff' }}"
                                                        class="w-full h-full object-cover">
                                                </div>
                                                <div class="overflow-hidden">
                                                    <p class="text-xs font-bold text-slate-900 truncate">{{ $intern->user->name }}
                                                    </p>
                                                    <p class="text-[10px] font-semibold text-slate-500 truncate">
                                                        {{ $intern->nim_nisn }}
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- Input Dropdown Tunggal (Divisi/Mentor) -->
                                            <div class="flex-1">
                                                <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Penempatan
                                                    Divisi</label>
                                                <select name="internships[{{ $intern->id }}][mentor_id]"
                                                    class="w-full py-2.5 px-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500">
                                                    <option value="">-- Pilih Divisi Penempatan --</option>
                                                    @foreach($mentors as $mentor)
                                                        <option value="{{ $mentor->id }}" {{ $intern->mentor_id == $mentor->id ? 'selected' : '' }}>
                                                            Divisi {{ $mentor->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <p class="text-[9px] text-slate-400 mt-1.5 font-medium">Otomatis menautkan peserta
                                                    ke pembimbing lapangan divisi terkait.</p>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="pt-4 flex justify-end gap-3 sticky bottom-0 bg-white/90 backdrop-blur-sm">
                                        <button type="button" @click="openDivisiModal = false"
                                            class="px-5 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl">Batal</button>
                                        <button type="submit"
                                            class="px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white text-xs font-extrabold rounded-xl shadow-sm flex items-center gap-2">Simpan
                                            Penempatan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- ============================================== -->
                        <!-- MODAL 2: KELOLA STATUS INDIVIDU -->
                        <!-- ============================================== -->
                        <div x-show="openStatusModal" style="display: none;"
                            class="fixed inset-0 z-100 flex items-center justify-center p-4 sm:p-6">
                            <div x-show="openStatusModal" x-transition.opacity
                                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="openStatusModal = false"></div>

                            <div x-show="openStatusModal" x-transition.scale.origin.bottom
                                class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
                                <div
                                    class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-amber-50/50">
                                    <div>
                                        <h3 class="text-base font-black text-amber-900">Kelola Status Peserta</h3>
                                        <p class="text-[11px] font-semibold text-amber-700 mt-0.5">Ubah status secara individual
                                            (Terminated/Completed).</p>
                                    </div>
                                    <button @click="openStatusModal = false"
                                        class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-colors">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <form action="{{ route('dashboard-hrd.update-status-peserta', $tim->id) }}" method="POST" class="overflow-y-auto p-6 space-y-4">
                                    @csrf
                                    @method('PATCH')

                                    @foreach($tim->internship as $intern)
                                        <div
                                            class="bg-white border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center gap-4">
                                            <div class="flex items-center gap-3 md:w-1/2 shrink-0">
                                                <div class="w-10 h-10 rounded-full overflow-hidden border border-slate-200">
                                                    <img src="{{ $intern->user->foto_profil ? Storage::url($intern->user->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($intern->user->name) . '&background=0D8B94&color=fff' }}"
                                                        class="w-full h-full object-cover">
                                                </div>
                                                <div class="overflow-hidden">
                                                    <p class="text-xs font-bold text-slate-900 truncate">
                                                        {{ $intern->user->name }}
                                                    </p>
                                                    <p class="text-[10px] font-semibold text-slate-500 truncate">
                                                        {{ $intern->department ?? 'Menunggu Divisi' }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <select name="internship[{{ $intern->id }}][status]"
                                                    class="w-full py-2.5 px-3 border border-slate-200 rounded-xl text-xs font-bold focus:ring-2 focus:border-amber-500"
                                                    :class="{
                                                                                                                                            'bg-teal-50 text-teal-700': '{{ $intern->status }}' === 'active',
                                                                                                                                            'bg-slate-100 text-slate-700': '{{ $intern->status }}' === 'completed',
                                                                                                                                            'bg-rose-50 text-rose-700': '{{ $intern->status }}' === 'terminated',
                                                                                                                                            'bg-amber-50 text-amber-700': '{{ $intern->status }}' === 'pending'
                                                                                                                                        }">
                                                    <option value="pending" {{ $intern->status === 'pending' ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="active" {{ $intern->status === 'active' ? 'selected' : '' }}>Active
                                                        (Aktif)</option>
                                                    <option value="completed" {{ $intern->status === 'completed' ? 'selected' : '' }}>
                                                        Completed (Selesai)</option>
                                                    <option value="terminated" {{ $intern->status === 'terminated' ? 'selected' : '' }}>Terminated (Diberhentikan)</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="pt-4 flex justify-end gap-3 sticky bottom-0 bg-white/90 backdrop-blur-sm">
                                        <button type="button" @click="openStatusModal = false"
                                            class="px-5 py-2.5 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl">Batal</button>
                                        <button type="submit"
                                            class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-extrabold rounded-xl shadow-sm flex items-center gap-2">Update
                                            Status</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white border border-slate-200 rounded-2xl border-dashed">
                        <h3 class="text-sm font-bold text-slate-800">Belum ada tim magang</h3>
                        <p class="text-xs text-slate-500 mt-1">Tim yang sudah disetujui akan muncul di sini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- SCRIPT UNTUK RENDER CHART -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                // Render Chart 1: Tren Bulanan
                const ctxTren = document.getElementById('chartTren').getContext('2d');
                new Chart(ctxTren, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($chartBulan) !!},
                        datasets: [{
                            label: 'Peserta Baru',
                            data: {!! json_encode($chartDataTren) !!},
                            borderColor: '#0f766e',
                            backgroundColor: 'rgba(15, 118, 110, 0.1)',
                            borderWidth: 2.5,
                            tension: 0.4,
                            fill: true,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#0f766e',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { backgroundColor: '#1e293b', padding: 10, cornerRadius: 8 }
                        },
                        scales: {
                            y: { beginAtZero: true, border: { dash: [4, 4] }, grid: { color: '#f1f5f9' } },
                            x: { grid: { display: false } }
                        }
                    }
                });

                // Render Chart 2: Donut Distribusi Instansi
                const ctxInstansi = document.getElementById('chartInstansi').getContext('2d');
                new Chart(ctxInstansi, {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode($chartLabelInstansi) !!},
                        datasets: [{
                            data: {!! json_encode($chartDataInstansi) !!},
                            backgroundColor: ['#0f766e', '#14b8a6', '#f59e0b', '#3b82f6', '#8b5cf6'],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '75%',
                        plugins: {
                            legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8 } }
                        }
                    }
                });
            });
        </script>
@endsection

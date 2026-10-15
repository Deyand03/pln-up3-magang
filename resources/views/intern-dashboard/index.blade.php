@extends('layouts.base')
@section('title', 'Dashboard Intern')
@section('content')
    <div
        class="font-sans antialiased text-slate-800 bg-slate-50/80 min-h-screen flex flex-col selection:bg-teal-500 selection:text-white pb-16">
        <main class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-6">
            <div class="flex flex-col lg:grid lg:grid-cols-12 gap-6 items-start">
                <div class="contents lg:block lg:col-span-7 xl:col-span-8 lg:space-y-6">
                    <div
                        class="w-full order-1 lg:order-0 bg-linear-to-br from-teal-800 via-teal-700 to-teal-900 rounded-3xl p-6 sm:p-7 text-white shadow-xl shadow-teal-900/10 relative overflow-hidden border border-teal-600/30">
                        <div
                            class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] bg-size-[18px_18px]">
                        </div>

                        <div class="relative z-10">
                            <div class="space-y-1.5">
                                <span
                                    class="inline-block text-xs font-semibold text-teal-200 tracking-wide uppercase bg-white/10 px-3 py-0.5 rounded-full backdrop-blur-xs border border-white/15">
                                    Selamat Datang 👋
                                </span>
                                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                                    {{ Auth::user()->name ?? 'N/A' }}
                                </h1>
                                <div class="flex flex-wrap items-center gap-2 pt-1 justify-between">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 text-[11px] font-bold text-white backdrop-blur-xs">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                        Divisi {{ Auth::user()->internship->department ?? 'N/A' }}
                                    </span>
                                    <span class="text-xs text-teal-100/90 font-medium">
                                        NIM/NISN: <span
                                            class="font-mono uppercase font-bold">{{ Auth::user()->internship->nim_nisn ?? 'N/A' }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. METRIC STATS CARDS (Mobile Order: 2) -->
                    <div class="order-2 lg:order-0 w-full">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-xs font-extrabold text-slate-500 uppercase tracking-wider">Ringkasan Progres
                            </h2>
                            <span
                                class="text-xs text-teal-700 font-bold bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-100">Periode:
                                {{ $periode ?? 'N/A' }}</span>
                        </div>

                        <div class="grid grid-cols-3 gap-3 sm:gap-4">
                            <div
                                class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs text-center flex flex-col justify-between hover:border-teal-500/50 hover:shadow-md transition-all">
                                <span class="text-xs font-extrabold text-slate-500 tracking-tight block">Presensi</span>
                                <div class="my-2">
                                    <span
                                        class="text-3xl sm:text-4xl font-black text-teal-700 block tracking-tight">{{ $jumlahKehadiran }}</span>
                                </div>
                                <span
                                    class="inline-block text-[11px] font-bold text-teal-800 bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-100">
                                    Kehadiran
                                </span>
                            </div>

                            <div
                                class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs text-center flex flex-col justify-between hover:border-teal-500/50 hover:shadow-md transition-all">
                                <span class="text-xs font-extrabold text-slate-500 tracking-tight block">Jumlah
                                    Logbook</span>
                                <div class="my-2">
                                    <span
                                        class="text-3xl sm:text-4xl font-black text-teal-700 block tracking-tight">{{ $jumlahLogbook }}</span>
                                </div>
                                <span
                                    class="inline-block text-[11px] font-bold text-teal-800 bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-100">
                                    Logbook
                                </span>
                            </div>

                            <div
                                class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs text-center flex flex-col justify-between hover:border-amber-500/50 hover:shadow-md transition-all">
                                <span class="text-xs font-extrabold text-slate-500 tracking-tight block">Hari Tersisa</span>
                                <div class="my-2">
                                    <span
                                        class="text-3xl sm:text-4xl font-black text-amber-600 block tracking-tight">{{ $hariTersisa }}</span>
                                </div>
                                <span
                                    class="inline-block text-[11px] font-bold text-amber-800 bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-100">
                                    Hari Lagi
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="order-4 lg:order-0 w-full">
                        <h2 class="text-xs font-extrabold text-slate-500 uppercase tracking-wider mb-3">Menu Utama</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div
                                class="bg-linear-to-br from-teal-600 via-teal-700 to-emerald-800 rounded-3xl p-5 text-white shadow-md shadow-teal-700/15 border border-teal-500/30 flex flex-col justify-between relative overflow-hidden min-h-45">
                                <div
                                    class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] bg-size-[12px_12px]">
                                </div>

                                <div class="relative z-10 space-y-1">
                                    <span
                                        class="inline-block text-[10px] font-extrabold text-teal-900 bg-teal-100 px-2.5 py-0.5 rounded-full mb-1">
                                        Absensi Online
                                    </span>
                                    <h3 class="text-lg font-black text-white leading-tight">Presensi Kehadiran</h3>
                                    <p class="text-xs text-teal-100/90 leading-relaxed">Lakukan absensi masuk & pulang
                                        sesuai jam kerja.</p>
                                </div>

                                <div class="relative z-10 pt-4">
                                    <a href="{{ route('presensi-intern') }}"
                                        class="inline-flex items-center gap-2 bg-white text-teal-900 font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-md hover:bg-teal-50 active:scale-95 transition-all w-full justify-center">
                                        <span>Buka Presensi</span>
                                        <svg class="w-4 h-4 text-teal-700" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div
                                class="bg-linear-to-br from-slate-800 via-teal-900 to-slate-900 rounded-3xl p-5 text-white shadow-md border border-slate-700/60 flex flex-col justify-between relative overflow-hidden min-h-45">
                                <div class="relative z-10 space-y-1">
                                    <span
                                        class="inline-block text-[10px] font-extrabold text-amber-900 bg-amber-300 px-2.5 py-0.5 rounded-full mb-1">
                                        Laporan Harian
                                    </span>
                                    <h3 class="text-lg font-black text-white leading-tight">Isi Logbook Harian</h3>
                                    <p class="text-xs text-slate-300 leading-relaxed">Catat rincian kegiatan magang untuk
                                        direview mentor.</p>
                                </div>

                                <div class="relative z-10 pt-4">
                                    <a href="{{ route('logbook-intern') }}"
                                        class="inline-flex items-center gap-2 bg-white text-slate-900 font-extrabold text-xs px-5 py-2.5 rounded-xl shadow-md hover:bg-slate-100 active:scale-95 transition-all w-full justify-center">
                                        <span>+ Tambah Logbook</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div
                        class="w-full order-6 lg:order-0 bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div>
                                <h2 class="text-base font-extrabold text-slate-900">Aktivitas Magang Terbaru</h2>
                                <p class="text-xs text-slate-500">Riwayat pengisian logbook kegiatan harian Anda</p>
                            </div>
                            <a href="{{ route('logbook-intern') }}"
                                class="text-xs font-bold text-teal-700 hover:text-teal-900 transition-colors hidden sm:block">
                                Lihat Semua →
                            </a>
                        </div>

                        <div class="space-y-3">
                            <div id="logbook-wrapper" class="">
                                <div id="loading-spinner"
                                    class="hidden bg-white/60 backdrop-blur-sm z-50 justify-center items-center rounded-3xl transition-all">
                                    <span class="loading loading-spinner text-teal-600 loading-lg"></span>
                                </div>

                                <div id="logbook-data">
                                    @include('intern-dashboard.partials.list-logbook-dashboard')
                                </div>
                            </div>
                        </div>

                        <!-- Button Aktivitas Lainnya -->
                        <div
                            class="pt-2 border-t border-slate-100 text-center {{ !$dataLogbook->isEmpty() ? 'block' : 'hidden' }} block sm:hidden">
                            <a href="{{ route('logbook-intern') }}"
                                class="w-full bg-teal-700 hover:bg-teal-800 text-white font-extrabold text-xs py-3 px-4 rounded-xl shadow-md shadow-teal-700/20 active:scale-98 transition-all inline-flex items-center justify-center gap-2 cursor-pointer">
                                <span>Lihat Semua Aktivitas</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="contents lg:block lg:col-span-5 xl:col-span-4 lg:space-y-6 lg:sticky lg:top-20">
                    <div
                        class="order-3 lg:order-0 bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs space-y-4 w-full">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-12 h-12 rounded-2xl bg-teal-100 border border-teal-200 text-teal-800 font-black flex items-center justify-center text-base shrink-0 shadow-xs">
                                👨‍💼
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-teal-700 uppercase tracking-wider block">Mentor
                                    Pembimbing</span>
                                <h3 class="text-sm font-extrabold text-slate-900">
                                    {{ $dataMentor->name ?? 'Belum ada Mentor' }}
                                </h3>
                                <span class="text-[11px] text-slate-500">Supervisor Divisi
                                    {{ Auth::user()->internship->department ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <p
                            class="text-xs text-slate-600 leading-relaxed bg-slate-50 p-3 rounded-2xl border border-slate-100">
                            Memiliki kendala atau ingin konsultasi terkait laporan kegiatan harian? Hubungi mentor Anda.
                        </p>
                        @php
                            $waLink = '#';
                            if ($dataMentor && !empty($dataMentor->phone)) {
                                $formattedPhone = preg_replace(
                                    '/^0/',
                                    '62',
                                    preg_replace('/[^0-9]/', '', $dataMentor->phone),
                                );
                                $waLink = 'https://wa.me/' . $formattedPhone;
                            }
                        @endphp
                        <a href="{{ $waLink }}" target="_blank" @if (!$dataMentor || empty($dataMentor->phone))
                        onclick="alert('Nomor WhatsApp mentor belum tersedia!'); return false;" @endif
                            class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs py-3 px-4 rounded-xl shadow-md shadow-emerald-600/20 transition-all inline-flex items-center justify-center gap-2 active:scale-98 @if (!$dataMentor || empty($dataMentor->phone)) opacity-50 cursor-not-allowed @endif">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z" />
                            </svg>
                            <span>Hubungi Mentor via WhatsApp</span>
                        </a>
                    </div>

                    <div
                        class="w-full order-5 lg:order-0 bg-linear-to-br {{ $suratSelesai ? 'from-emerald-500/10 via-emerald-500/5 to-slate-100' : 'from-amber-500/10 via-amber-500/5 to-slate-100' }} rounded-3xl p-5 border {{ $suratSelesai ? 'border-emerald-200/90' : 'border-amber-200/90' }} shadow-xs space-y-3">
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-block text-[10px] font-extrabold {{ $suratSelesai ? 'text-emerald-900 bg-emerald-200/90' : 'text-amber-900 bg-amber-200/90' }} px-2.5 py-0.5 rounded-full">
                                Sertifikat & Surat
                            </span>
                            <span
                                class="inline-flex items-center gap-1 text-[10px] font-bold {{ $suratSelesai ? 'text-emerald-700 bg-emerald-100/60' : 'text-amber-700 bg-amber-100/60' }} px-2 py-0.5 rounded-md">
                                {{ $suratSelesai ? 'Sudah Terbit' : '⚠️ Belum Terbit' }}
                            </span>
                        </div>

                        <div id="riwayat-logbook">
                            <h3 class="text-sm font-extrabold text-slate-900 leading-tight">Unduh Surat Selesai</h3>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                Dapat diunduh secara otomatis setelah seluruh periode magang selesai disetujui.
                            </p>
                        </div>

                        @if ($suratSelesai)
                            <a href="{{ route('intern.download-surat-selesai') }}" target="_blank"
                                class="flex justify-center w-full border border-emerald-200/90 bg-teal-600 text-white shadow-lg shadow-teal-500/20 font-bold text-xs py-3 px-4 rounded-xl cursor-pointer text-center hover:bg-teal-800 active:scale-95 transition-all duration-200">
                                Unduh
                            </a>
                        @else
                            <button disabled
                                class="flex justify-center w-full bg-slate-200 text-slate-400 font-bold text-xs py-3 px-4 rounded-xl cursor-not-allowed text-center">
                                Belum Tersedia
                            </button>
                        @endif
                    </div>

                    <div
                        class="w-full order-7 lg:order-0 bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs space-y-4">
                        <div>
                            <h2 class="text-base font-extrabold text-slate-900">Tata Tertib Magang</h2>
                            <p class="text-xs text-slate-500">Panduan etika & kedisiplinan PLN UP3 Jambi</p>
                        </div>

                        <div class="space-y-2.5">

                            <!-- ITEM A: Pakaian dan Penampilan -->
                            <details
                                class="group bg-slate-50/80 rounded-2xl border border-slate-200/80 overflow-hidden transition-all duration-300 open:bg-white open:ring-2 open:ring-teal-500/20"
                                open>
                                <summary
                                    class="flex items-center justify-between p-3.5 text-xs font-extrabold text-slate-800 cursor-pointer list-none select-none">
                                    <span class="flex items-center gap-2">
                                        <span
                                            class="w-5 h-5 rounded-md bg-teal-100 text-teal-800 font-black flex items-center justify-center text-[10px]">A</span>
                                        Pakaian dan Penampilan
                                    </span>
                                    <svg class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform duration-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </summary>
                                <div class="p-3.5 pt-1 text-xs text-slate-600 border-t border-slate-100 space-y-2.5">
                                    <div class="grid grid-cols-1 gap-2 pt-1">
                                        <div class="p-2.5 bg-white rounded-xl border border-slate-200/80">
                                            <span
                                                class="inline-block px-2 py-0.5 text-[9px] font-extrabold text-teal-900 bg-teal-100 rounded mb-1">Senin</span>
                                            <p class="text-[11px] text-slate-600 leading-relaxed">Kemeja putih dengan
                                                celana panjang/rok kain hitam.</p>
                                        </div>
                                        <div class="p-2.5 bg-white rounded-xl border border-slate-200/80">
                                            <span
                                                class="inline-block px-2 py-0.5 text-[9px] font-extrabold text-teal-900 bg-teal-100 rounded mb-1">Selasa</span>
                                            <p class="text-[11px] text-slate-600 leading-relaxed">Kemeja atau blus
                                                bernuansa warna biru.</p>
                                        </div>
                                        <div class="p-2.5 bg-white rounded-xl border border-slate-200/80">
                                            <span
                                                class="inline-block px-2 py-0.5 text-[9px] font-extrabold text-teal-900 bg-teal-100 rounded mb-1">Rabu
                                                & Kamis</span>
                                            <p class="text-[11px] text-slate-600 leading-relaxed">Kemeja/polo shirt rapi
                                                (tanpa jeans robek).</p>
                                        </div>
                                        <div class="p-2.5 bg-white rounded-xl border border-slate-200/80">
                                            <span
                                                class="inline-block px-2 py-0.5 text-[9px] font-extrabold text-teal-900 bg-teal-100 rounded mb-1">Jum'at</span>
                                            <p class="text-[11px] text-slate-600 leading-relaxed">Baju olahraga (jika ada
                                                senam) atau batik/formal.</p>
                                        </div>
                                    </div>
                                    <div
                                        class="p-2.5 bg-amber-50 rounded-xl border border-amber-200/80 text-[10px] text-amber-900 flex items-start gap-1.5">
                                        <span class="font-bold shrink-0">🪪 ID Card:</span>
                                        <span>Wajib mengenakan Tanda Pengenal Magang.</span>
                                    </div>
                                </div>
                            </details>

                            <!-- ITEM B: Kehadiran dan Waktu Kerja -->
                            <details
                                class="group bg-slate-50/80 rounded-2xl border border-slate-200/80 overflow-hidden transition-all duration-300 open:bg-white open:ring-2 open:ring-teal-500/20">
                                <summary
                                    class="flex items-center justify-between p-3.5 text-xs font-extrabold text-slate-800 cursor-pointer list-none select-none">
                                    <span class="flex items-center gap-2">
                                        <span
                                            class="w-5 h-5 rounded-md bg-teal-100 text-teal-800 font-black flex items-center justify-center text-[10px]">B</span>
                                        Kehadiran & Waktu Kerja
                                    </span>
                                    <svg class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform duration-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </summary>
                                <div class="p-3.5 pt-1 text-xs text-slate-600 border-t border-slate-100 space-y-1.5">
                                    <ul class="space-y-1.5 text-[11px] text-slate-600">
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-600 mt-1.5 shrink-0"></span>
                                            <span>Jam kerja Senin - Kamis, 08.00 s.d. 16.30 WIB.</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-600 mt-1.5 shrink-0"></span>
                                            <span>Jam kerja Jumat, 07.00 s.d. 16.30 WIB.</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-600 mt-1.5 shrink-0"></span>
                                            <span>Presensi masuk & pulang di sistem aplikasi.</span>
                                        </li>
                                    </ul>
                                </div>
                            </details>

                            <!-- ITEM C: Tugas dan Evaluasi -->
                            <details
                                class="group bg-slate-50/80 rounded-2xl border border-slate-200/80 overflow-hidden transition-all duration-300 open:bg-white open:ring-2 open:ring-teal-500/20">
                                <summary
                                    class="flex items-center justify-between p-3.5 text-xs font-extrabold text-slate-800 cursor-pointer list-none select-none">
                                    <span class="flex items-center gap-2">
                                        <span
                                            class="w-5 h-5 rounded-md bg-teal-100 text-teal-800 font-black flex items-center justify-center text-[10px]">C</span>
                                        Tugas & Evaluasi
                                    </span>
                                    <svg class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform duration-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </summary>
                                <div class="p-3.5 pt-1 text-xs text-slate-600 border-t border-slate-100 space-y-1.5">
                                    <p class="text-[11px] text-slate-600 leading-relaxed">Mengisi Logbook harian serta
                                        menjalankan penugasan dari Mentor secara penuh tanggung jawab.</p>
                                </div>
                            </details>

                            <!-- ITEM D: Perilaku dan Etika -->
                            <details
                                class="group bg-slate-50/80 rounded-2xl border border-slate-200/80 overflow-hidden transition-all duration-300 open:bg-white open:ring-2 open:ring-teal-500/20">
                                <summary
                                    class="flex items-center justify-between p-3.5 text-xs font-extrabold text-slate-800 cursor-pointer list-none select-none">
                                    <span class="flex items-center gap-2">
                                        <span
                                            class="w-5 h-5 rounded-md bg-teal-100 text-teal-800 font-black flex items-center justify-center text-[10px]">D</span>
                                        Perilaku & Etika
                                    </span>
                                    <svg class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform duration-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </summary>
                                <div class="p-3.5 pt-1 text-xs text-slate-600 border-t border-slate-100 space-y-1.5">
                                    <p class="text-[11px] text-slate-600 leading-relaxed">Terapkan 3S (Senyum, Sapa, Salam)
                                        dan menjaga nama baik instansi.</p>
                                </div>
                            </details>

                            <!-- ITEM E: Kerahasiaan Informasi -->
                            <details
                                class="group bg-slate-50/80 rounded-2xl border border-slate-200/80 overflow-hidden transition-all duration-300 open:bg-white open:ring-2 open:ring-teal-500/20">
                                <summary
                                    class="flex items-center justify-between p-3.5 text-xs font-extrabold text-slate-800 cursor-pointer list-none select-none">
                                    <span class="flex items-center gap-2">
                                        <span
                                            class="w-5 h-5 rounded-md bg-teal-100 text-teal-800 font-black flex items-center justify-center text-[10px]">E</span>
                                        Kerahasiaan Informasi
                                    </span>
                                    <svg class="w-4 h-4 text-slate-400 group-open:rotate-180 transition-transform duration-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </summary>
                                <div class="p-3.5 pt-1 text-xs text-slate-600 border-t border-slate-100 space-y-1.5">
                                    <p class="text-[11px] text-rose-700 font-medium leading-relaxed">Dilarang keras
                                        menyebarluaskan dokumen atau data rahasia internal instansi.</p>
                                </div>
                            </details>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const $ = (selector) => {
                    return document.querySelector(selector)
                }

                document.addEventListener('click', function (e) {
                    const paginationLink = e.target.closest('.pagination-links a');
                    if (paginationLink) {
                        e.preventDefault();
                        const targetUrl = paginationLink.href;
                        fetchData(targetUrl);
                    }
                });

                function fetchData(url, updateUrl = true) {
                    const u = new URL(url, window.location.origin);
                    const safeUrl = u.pathname + u.search;

                    const wrapper = document.getElementById('logbook-data');
                    const spinner = document.getElementById('loading-spinner');

                    spinner.classList.remove('hidden');
                    wrapper.classList.add('hidden')
                    document.getElementById('riwayat-logbook').scrollIntoView({
                        behavior: 'smooth'
                    });

                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin',
                    })
                        .then(response => {
                            if (!response.ok) throw new Error('Gagal mengambil data!');
                            return response.text();
                        })
                        .then(html => {
                            wrapper.innerHTML = html;
                            if (updateUrl) {
                                window.history.pushState(null, '', safeUrl);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                            alert(
                                'Gagal memuat data halaman selanjutnya. Coba cek koneksi internetmu!');
                        })
                        .finally(() => {
                            spinner.classList.add('hidden');
                            wrapper.classList.remove('hidden');
                        });
                }

                window.addEventListener('popstate', function () {
                    fetchData(window.location.href, false);
                });
            })
        </script>
    @endpush
@endsection

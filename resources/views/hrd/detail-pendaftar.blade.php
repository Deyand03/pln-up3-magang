@extends('layouts.base')
@section('title', 'Detail Pendaftaran - ' . $application->name)

@section('content')
<div class="min-h-screen bg-slate-50/60 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">

        <!-- NAVIGASI BACK & BREADCRUMB -->
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('dashboard-hrd.pendaftar') }}"
               class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-teal-600 transition-all group bg-white border border-slate-200/80 px-4 py-2.5 rounded-xl shadow-xs hover:shadow-md hover:border-teal-200">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform text-slate-400 group-hover:text-teal-600"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Antrean Pengajuan</span>
            </a>

            <div class="hidden sm:flex items-center gap-2 text-xs font-medium text-slate-400">
                <span>Dashboard</span>
                <span>/</span>
                <span>Pendaftar</span>
                <span>/</span>
                <span class="text-slate-700 font-bold">Detail</span>
            </div>
        </div>

        <!-- HERO HEADER BANNER -->
        <div class="relative overflow-hidden bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs mb-8">
            <!-- Background Accent Watermark -->
            <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-teal-500/5 rounded-full blur-3xl pointer-events-none"></div>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
                <div class="flex items-center gap-5">
                    <!-- Avatar Initials -->
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-br from-teal-500 to-teal-700 text-white shadow-lg shadow-teal-600/20 flex items-center justify-center shrink-0 font-black text-2xl sm:text-3xl ring-4 ring-teal-50">
                        {{ strtoupper(substr($application->name, 0, 1)) }}
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2.5 flex-wrap">
                            <span class="font-mono text-xs font-black tracking-wider text-teal-700 bg-teal-50 border border-teal-200/80 px-3 py-1 rounded-lg">
                                #{{ $application->registration_number }}
                            </span>
                            <span class="text-xs font-semibold text-slate-400">•</span>
                            <span class="text-xs font-bold text-slate-500">Pengajuan Magang</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                            {{ $application->name }}
                        </h1>
                        <p class="text-xs sm:text-sm font-semibold text-slate-500 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-slate-400 inline shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            {{ $application->institusi }}
                        </p>
                    </div>
                </div>

                <!-- Status Badge Banner -->
                <div class="shrink-0 flex items-center">
                    @if($application->status === 'pending')
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-2xl bg-amber-50 text-amber-900 border border-amber-200/80 shadow-xs">
                            <span class="relative flex h-3 w-3">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span>
                            </span>
                            <div class="text-left">
                                <p class="text-[10px] font-extrabold uppercase tracking-widest text-amber-600">Status Berkala</p>
                                <p class="text-xs font-black">MENUNGGU EVALUASI</p>
                            </div>
                        </div>
                    @elseif($application->status === 'revision')
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-2xl bg-sky-50 text-sky-900 border border-sky-200/80 shadow-xs">
                            <span class="w-3 h-3 rounded-full bg-sky-500 ring-4 ring-sky-100"></span>
                            <div class="text-left">
                                <p class="text-[10px] font-extrabold uppercase tracking-widest text-sky-600">Status Berkala</p>
                                <p class="text-xs font-black">SEDANG DIREVISI</p>
                            </div>
                        </div>
                    @elseif($application->status === 'approved')
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-2xl bg-emerald-50 text-emerald-900 border border-emerald-200/80 shadow-xs">
                            <div class="w-7 h-7 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <p class="text-[10px] font-extrabold uppercase tracking-widest text-emerald-600">Keputusan Final</p>
                                <p class="text-xs font-black">DISETUJUI</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-2xl bg-rose-50 text-rose-900 border border-rose-200/80 shadow-xs">
                            <div class="w-7 h-7 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <p class="text-[10px] font-extrabold uppercase tracking-widest text-rose-600">Keputusan Final</p>
                                <p class="text-xs font-black">DITOLAK</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- GRID UTAMA DASHBOARD (2 Kolom Kiri, 1 Kolom Kanan Sticky) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- KOLOM KIRI (2 Cols): INFORMASI LENGKAP PENGAJUAN -->
            <div class="lg:col-span-2 space-y-6">

                <!-- CARD 1: INFORMASI ketua & KONTAK -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 border border-teal-100 flex items-center justify-center font-bold">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Profil Ketua Tim</h2>
                                <p class="text-[11px] font-semibold text-slate-400">Identitas utama penanggung jawab kelompok</p>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold text-teal-700 bg-teal-50 px-3 py-1 rounded-full border border-teal-100">
                            Ketua Kelompok
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Nama -->
                        <div class="p-3.5 rounded-2xl bg-slate-50/80 border border-slate-100">
                            <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</span>
                            <span class="text-sm font-bold text-slate-800 block">{{ $application->name }}</span>
                        </div>

                        <!-- NIM / NISN -->
                        <div class="p-3.5 rounded-2xl bg-slate-50/80 border border-slate-100">
                            <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">NIM / NISN</span>
                            <span class="text-xs font-mono font-bold text-slate-800 bg-white px-2.5 py-1 rounded-lg border border-slate-200 inline-block shadow-2xs">
                                {{ $application->nim_nisn }}
                            </span>
                        </div>

                        <!-- Email -->
                        <div class="p-3.5 rounded-2xl bg-slate-50/80 border border-slate-100">
                            <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">Alamat Email</span>
                            <a href="mailto:{{ $application->email }}" class="text-xs font-bold text-teal-600 hover:text-teal-700 hover:underline inline-flex items-center gap-1.5 truncate max-w-full">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="truncate">{{ $application->email }}</span>
                            </a>
                        </div>

                        <!-- WhatsApp -->
                        <div class="p-3.5 rounded-2xl bg-slate-50/80 border border-slate-100">
                            <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">Nomor WhatsApp</span>
                            @php
                                $cleanPhone = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $application->phone));
                            @endphp
                            <a href="https://wa.me/{{ $cleanPhone }}" target="_blank"
                               class="text-xs font-bold text-emerald-700 hover:text-emerald-800 inline-flex items-center gap-1.5 bg-emerald-100/70 hover:bg-emerald-200/80 px-3 py-1 rounded-lg border border-emerald-300/60 transition-colors shadow-2xs">
                                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z" />
                                </svg>
                                <span>Hubungi ({{ $application->phone }})</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: INSTITUSI & JADWAL PELAKSANAAN -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 border border-teal-100 flex items-center justify-center font-bold">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Detail Instansi & Timeline Magang</h2>
                                <p class="text-[11px] font-semibold text-slate-400">Informasi akademik dan durasi pelaksanaan</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <!-- Instansi & Jurusan -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 rounded-2xl bg-gradient-to-r from-slate-900 to-slate-800 text-white shadow-sm">
                            <div class="sm:col-span-2">
                                <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Asal Sekolah / Perguruan Tinggi</span>
                                <h3 class="text-base font-black text-white leading-snug">{{ $application->institusi }}</h3>
                            </div>
                            <div class="border-t sm:border-t-0 sm:border-l border-slate-700/80 pt-3 sm:pt-0 sm:pl-4">
                                <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Jurusan / Program Studi</span>
                                <p class="text-xs font-bold text-teal-300 leading-snug">{{ $application->jurusan }}</p>
                            </div>
                        </div>

                        <!-- TIMELINE WIDGET -->
                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs font-extrabold text-slate-700 uppercase tracking-wider flex items-center gap-2">
                                    <svg class="w-4 h-4 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Rencana Periode Pelaksanaan
                                </span>
                                <span class="inline-flex items-center gap-1.5 text-xs font-black text-slate-800 bg-white px-3 py-1 rounded-xl border border-slate-200 shadow-2xs">
                                    <svg class="w-3.5 h-3.5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Total: {{ $application->total_interns }} Orang
                                </span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 relative">
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200/80">
                                    <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">Tanggal Mulai</span>
                                    <p class="text-sm font-black text-slate-900">
                                        {{ \Carbon\Carbon::parse($application->start_date)->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                                <div class="bg-white p-3.5 rounded-xl border border-slate-200/80">
                                    <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">Tanggal Selesai</span>
                                    <p class="text-sm font-black text-slate-900">
                                        {{ \Carbon\Carbon::parse($application->end_date)->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: BERKAS LAMPIRAN -->
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 border border-teal-100 flex items-center justify-center font-bold">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Lampiran Berkas Pendaftaran</h2>
                                <p class="text-[11px] font-semibold text-slate-400">Dokumen verifikasi kelengkapan magang</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Surat Pengantar -->
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-teal-300 hover:bg-teal-50/20 transition-all flex flex-col justify-between group">
                            <div class="flex items-start gap-3.5 mb-4">
                                <div class="w-11 h-11 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-2xs">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="overflow-hidden">
                                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-teal-700 bg-teal-100/70 px-2 py-0.5 rounded-md">Wajib</span>
                                    <h4 class="text-xs font-extrabold text-slate-900 mt-1 truncate">Surat Pengantar / Rekomendasi</h4>
                                    <p class="text-[11px] font-medium text-slate-500 mt-0.5">Format PDF Resmi Instansi</p>
                                </div>
                            </div>

                            <a href="{{ Storage::url($application->recommendation_letter) }}" target="_blank"
                               class="w-full py-2.5 px-3 bg-white hover:bg-teal-600 hover:text-white border border-slate-200 hover:border-teal-600 text-slate-700 text-xs font-extrabold rounded-xl transition-all text-center flex items-center justify-center gap-2 shadow-2xs group-hover:shadow-xs">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Buka / Unduh Dokumen
                            </a>
                        </div>

                        <!-- Proposal Magang -->
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-sky-300 hover:bg-sky-50/20 transition-all flex flex-col justify-between group">
                            <div class="flex items-start gap-3.5 mb-4">
                                <div class="w-11 h-11 rounded-2xl bg-sky-100 text-sky-700 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform shadow-2xs">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div class="overflow-hidden">
                                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-500 bg-slate-200/70 px-2 py-0.5 rounded-md">Opsional</span>
                                    <h4 class="text-xs font-extrabold text-slate-900 mt-1 truncate">Proposal Kegiatan Magang</h4>
                                    <p class="text-[11px] font-medium text-slate-500 mt-0.5">Rincian Rencana Kegiatan</p>
                                </div>
                            </div>

                            @if($application->proposal)
                                <a href="{{ Storage::url($application->proposal) }}" target="_blank"
                                   class="w-full py-2.5 px-3 bg-white hover:bg-sky-600 hover:text-white border border-slate-200 hover:border-sky-600 text-slate-700 text-xs font-extrabold rounded-xl transition-all text-center flex items-center justify-center gap-2 shadow-2xs group-hover:shadow-xs">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Buka / Unduh Proposal
                                </a>
                            @else
                                <div class="w-full py-2.5 px-3 bg-slate-100/80 text-slate-400 border border-dashed border-slate-300 text-xs font-semibold rounded-xl text-center cursor-not-allowed">
                                    Tidak melampirkan proposal
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- RIWAYAT CATATAN EVALUASI (JIKA ADA) -->
                @if($application->notes)
                    <div class="bg-amber-50/90 border border-amber-200/90 rounded-3xl p-6 shadow-xs relative overflow-hidden">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <div class="space-y-2 flex-1">
                                <h3 class="text-xs font-black text-amber-900 uppercase tracking-wider">Catatan Evaluasi / Pesan Revisi Sebelumnya</h3>
                                <div class="p-4 rounded-2xl bg-white/80 border border-amber-200/60 text-xs font-medium text-amber-950 leading-relaxed shadow-2xs">
                                    {{ $application->notes }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <!-- KOLOM KANAN (1 Col): STICKY HRD DECISION DESK -->
            <div class="space-y-6 lg:sticky lg:top-6">

                @if($application->status === 'pending' || $application->status === 'revision')
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-lg shadow-slate-200/50 relative overflow-hidden">
                        <div class="flex items-center gap-3 pb-4 mb-4 border-b border-slate-100">
                            <div class="w-9 h-9 rounded-xl bg-teal-600 text-white flex items-center justify-center font-bold shadow-xs">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider">Tindakan Evaluasi HRD</h2>
                                <p class="text-[11px] font-semibold text-slate-400">Tentukan status pengajuan peserta</p>
                            </div>
                        </div>

                        <form action="{{ route('dashboard-hrd.pendaftar.detail.update', $application->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label class="text-[11px] font-extrabold text-slate-700 uppercase tracking-wider mb-2 flex items-center justify-between">
                                    <span>Catatan / Pesan Evaluasi</span>
                                    <span class="text-[10px] text-slate-400 font-normal">Opsional</span>
                                </label>
                                <textarea name="notes" rows="4"
                                    placeholder="Tuliskan catatan revisi, alasan penolakan, atau instruksi selanjutnya untuk peserta..."
                                    class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-medium text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-600 transition-all shadow-2xs resize-none"></textarea>
                            </div>

                            <!-- TOMBOL AKSI UTAMA HRD -->
                            <div class="space-y-2.5 pt-2">
                                <!-- Setujui -->
                                <button type="submit" name="status" value="approved"
                                    class="w-full py-3.5 px-4 bg-teal-600 hover:bg-teal-700 text-white text-xs font-extrabold rounded-2xl shadow-lg shadow-teal-600/25 active:scale-[0.98] transition-all flex items-center justify-center gap-2 group cursor-pointer">
                                    <svg class="w-4 h-4 transform group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Setujui & Buat Token Registrasi
                                </button>

                                <div class="grid grid-cols-2 gap-2.5">
                                    <!-- Revisi -->
                                    <button type="submit" name="status" value="revision"
                                        class="w-full py-3 px-3 bg-sky-50 hover:bg-sky-100 text-sky-800 text-xs font-bold rounded-2xl border border-sky-200 active:scale-[0.98] transition-all cursor-pointer text-center">
                                        Minta Revisi
                                    </button>

                                    <!-- Tolak -->
                                    <button type="submit" name="status" value="rejected"
                                        class="w-full py-3 px-3 bg-rose-50 hover:bg-rose-100 text-rose-800 text-xs font-bold rounded-2xl border border-rose-200 active:scale-[0.98] transition-all cursor-pointer text-center">
                                        Tolak Pengajuan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- KARTU STATUS KETIKA SUDAH SELESAI DIEVALUASI -->
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs text-center space-y-3">
                        <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-600 mx-auto flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-extrabold text-slate-900">Evaluasi Selesai</h3>
                        <p class="text-xs font-medium text-slate-500 leading-relaxed">
                            Pengajuan ini telah diproses dengan status <strong class="uppercase text-slate-800">{{ $application->status }}</strong>.
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

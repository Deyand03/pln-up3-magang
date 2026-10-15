@extends('layouts.base')
@section('title', 'Dashboard Mentor - PLN UP3 Jambi')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8" x-data="{
                            searchQuery: '',
                            activeFilter: 'all',

                            interns: [
                                @foreach($dataIntern as $intern)
                                    {
                                        name: '{{ addslashes(strtolower($intern->user->name)) }}',
                                        institusi: '{{ addslashes(strtolower($intern->applications->institusi)) }}',
                                        pendingCount: {{ $intern->pending_logbooks_count }},
                                        statusAbsen: '{{ $intern->attendanceToday ? $intern->attendanceToday->status : 'alfa' }}'
                                    }{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            ],

                            get filteredInterns() {
                                return this.interns.filter(i => {
                                    let matchFilter = (this.activeFilter === 'all' ||
                                                      (this.activeFilter === 'pending' && i.pendingCount > 0) ||
                                                      (this.activeFilter === 'hadir' && i.statusAbsen === 'hadir') ||
                                                      (this.activeFilter === 'tidak_hadir' && i.statusAbsen !== 'hadir'));

                                    let q = this.searchQuery.toLowerCase();
                                    let matchSearch = (q === '' || i.name.includes(q) || i.institusi.includes(q));

                                    return matchFilter && matchSearch;
                                });
                            }
                         }">

        <!-- HEADER BANNER -->
        <div
            class="bg-gradient-to-br from-slate-900 via-teal-950 to-teal-900 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-teal-900/10 relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6 border border-slate-700/50">
            <!-- Deco Pattern -->
            <div
                class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:20px_20px]">
            </div>
            <div
                class="absolute -right-20 -top-20 w-64 h-64 bg-teal-500 rounded-full blur-[80px] opacity-20 pointer-events-none">
            </div>

            <div class="relative z-10 space-y-2">
                <span
                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-[10px] font-bold text-teal-100 backdrop-blur-md border border-white/10 uppercase tracking-wider">
                    Dashboard Pembimbing
                </span>
                <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight leading-tight">
                    Ringkasan Bimbingan Magang
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 max-w-xl leading-relaxed">
                    Pantau aktivitas harian, persetujuan logbook, dan presensi peserta magang di bawah bimbingan Anda secara
                    real-time.
                </p>
            </div>

            <div class="relative z-10 shrink-0">
                <div class="text-right">
                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider mb-1">Tanggal Hari Ini</p>
                    <p class="text-lg font-black text-teal-100">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 lg:gap-6">

            <!-- Total Bimbingan -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-start gap-4">
                <div
                    class="w-12 h-12 rounded-xl bg-slate-50 text-slate-600 flex items-center justify-center border border-slate-100 shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <span class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider block">Total
                        Bimbingan</span>
                    <span class="text-3xl font-black text-slate-900">{{ $totalBimbingan }} <span
                            class="text-xs font-semibold text-teal-600">Peserta</span></span>
                </div>
            </div>

            <!-- Logbook Pending -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-start gap-4 hover:border-amber-200 cursor-pointer transition-all"
                @click="activeFilter = 'pending'">
                <div
                    class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100 shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <span class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider block">Logbook
                        Pending</span>
                    <span class="text-3xl font-black {{ $totalPendingLogbooks > 0 ? 'text-amber-600' : 'text-slate-900' }}">
                        {{ $totalPendingLogbooks }}
                        <span
                            class="text-xs font-semibold {{ $totalPendingLogbooks > 0 ? 'text-amber-700' : 'text-slate-400' }}">Berkas</span>
                    </span>
                </div>
            </div>

            <!-- Hadir Hari Ini -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-start gap-4 hover:border-emerald-200 cursor-pointer transition-all"
                @click="activeFilter = 'hadir'">
                <div
                    class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <span class="text-[11px] font-extrabold text-slate-500 uppercase tracking-wider block">Hadir Hari
                        Ini</span>
                    <span class="text-3xl font-black text-slate-900">
                        {{ $totalHadirHariIni }} <span class="text-xl text-slate-300">/</span> <span
                            class="text-xl text-slate-400">{{ $totalBimbingan }}</span>
                    </span>
                </div>
            </div>

        </div>

        <!-- FILTER & SEARCH BAR (RESPONSIVE) -->
        <div
            class="bg-white p-2 sm:p-3 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center gap-3 sticky top-[72px] z-30">

            <!-- Search Input -->
            <div class="relative w-full sm:flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" x-model="searchQuery" placeholder="Cari nama peserta atau institusi..."
                    class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-colors">
            </div>

            <!-- Filter Desktop (Pills) -->
            <div class="hidden lg:flex items-center gap-1.5 p-1 bg-slate-50 rounded-xl border border-slate-100">
                <button @click="activeFilter = 'all'"
                    :class="activeFilter === 'all' ? 'bg-teal-600 text-white font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                    class="text-xs px-3 py-2 rounded-xl transition-all cursor-pointer whitespace-nowrap">
                    Semua ({{ $totalBimbingan }})
                </button>
                <button @click="activeFilter = 'pending'"
                    :class="activeFilter === 'pending' ? 'bg-amber-500 text-white font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                    class="text-xs px-3 py-2 rounded-xl transition-all cursor-pointer whitespace-nowrap flex items-center gap-1">
                    Logbook Pending
                    @if ($totalPendingLogbooks > 0)
                        <span class="w-1.5 aspect-square rounded-full bg-rose-800 animate-pulse"></span>
                    @endif
                </button>
                <button @click="activeFilter = 'hadir'"
                    :class="activeFilter === 'hadir' ? 'bg-emerald-600 text-white font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                    class="text-xs px-3 py-2 rounded-xl transition-all cursor-pointer whitespace-nowrap">
                    Hadir Hari Ini
                </button>
                <button @click="activeFilter = 'tidak_hadir'"
                    :class="activeFilter === 'tidak_hadir' ? 'bg-rose-500 text-white font-bold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 font-medium'"
                    class="text-xs px-3 py-2 rounded-xl transition-all cursor-pointer whitespace-nowrap">
                    Tidak Hadir
                </button>
            </div>

            <!-- Filter Mobile (Dropdown Native HTML) -->
            <div class="w-full lg:hidden">
                <select x-model="activeFilter"
                    class="w-full py-2.5 px-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500">
                    <option value="all">Tampilkan Semua</option>
                    <option value="pending">Logbook Pending</option>
                    <option value="hadir">Hadir Hari Ini</option>
                    <option value="tidak_hadir">Tidak Hadir (Alfa/Izin/Sakit)</option>
                </select>
            </div>
        </div>

        <!-- LIST PESERTA (HYBRID ALPINE + BLADE) -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 pb-10">

            @foreach($dataIntern as $intern)
                @php
                    $statusAsli = $intern->attendanceToday ? $intern->attendanceToday->status : '';
                @endphp

                <div x-data="{
                                name: '{{ addslashes(strtolower($intern->user->name)) }}',
                                institusi: '{{ addslashes(strtolower($intern->applications->institusi)) }}',
                                pendingCount: {{ $intern->pending_logbooks_count }},
                                statusAbsen: '{{ $statusAsli }}'
                            }"
                    x-show="(activeFilter === 'all' ||
                            (activeFilter === 'pending' && pendingCount > 0) ||
                            (activeFilter === 'hadir' && statusAbsen === 'hadir') ||
                            (activeFilter === 'tidak_hadir' && statusAbsen !== 'hadir'))
                            &&
                            (searchQuery === '' || name.includes(searchQuery.toLowerCase()) || institusi.includes(searchQuery.toLowerCase()))"
                    class="bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-lg hover:border-teal-300 transition-all flex flex-col justify-between relative overflow-hidden group">

                    <!-- Glow Effect Logbook -->
                    @if($intern->pending_logbooks_count > 0)
                        <div
                            class="absolute -top-6 -right-6 w-16 h-16 bg-amber-400 opacity-10 blur-xl rounded-full pointer-events-none">
                        </div>
                    @endif

                    <div>
                        <!-- Header Card -->
                        <div class="flex items-start justify-between gap-3 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full overflow-hidden border-2 border-slate-100 shrink-0">
                                    <img src="{{ $intern->user->foto_profil ? Storage::url($intern->user->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($intern->user->name) . '&background=0D8B94&color=fff' }}"
                                        alt="Avatar" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="text-sm font-extrabold text-slate-900 leading-tight line-clamp-1">
                                        {{ $intern->user->name }}
                                    </h3>
                                    <p class="text-[11px] font-mono font-semibold text-slate-500 mt-0.5">{{ $intern->nim_nisn }}
                                    </p>
                                </div>
                            </div>

                            <!-- Badge Presensi Dinamis -->
                            <div class="shrink-0">
                                @if($statusAsli === 'hadir')
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Hadir
                                    </span>
                                @elseif($statusAsli === 'izin' || $statusAsli === 'sakit')
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-sky-50 text-sky-700 text-[10px] font-bold border border-sky-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span> {{ ucfirst($statusAsli) }}
                                    </span>
                                @elseif($statusAsli === 'alfa')
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-rose-50 text-rose-700 text-[10px] font-bold border border-rose-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Alfa
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-slate-50 text-slate-600 text-[10px] font-bold border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Belum Absen
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-2 gap-3 mb-5">
                            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-[9px] font-bold text-slate-400 uppercase block mb-0.5">Institusi</span>
                                <span
                                    class="text-[11px] font-semibold text-slate-800 line-clamp-1">{{ $intern->applications->institusi }}</span>
                            </div>
                            <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-[9px] font-bold text-slate-400 uppercase block mb-0.5">Divisi</span>
                                <span
                                    class="text-[11px] font-semibold text-teal-700 line-clamp-1">{{ $intern->department ?? 'N/A' }}</span>
                            </div>
                            <div
                                class="col-span-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100 flex items-center gap-2">
                                <div class="text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase block mb-0.5">Periode
                                        Magang</span>
                                    <span class="text-[11px] font-semibold text-slate-800">
                                        {{ \Carbon\Carbon::parse($intern->applications->start_date)->translatedFormat('d M Y') }}
                                        <span class="text-slate-400 mx-1">-</span>
                                        {{ \Carbon\Carbon::parse($intern->applications->end_date)->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Card -->
                    <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                        <div class="flex items-center gap-1.5">
                            @if($intern->pending_logbooks_count > 0)
                                <div class="flex items-center gap-1.5 text-amber-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-[11px] font-bold">{{ $intern->pending_logbooks_count }} Menunggu</span>
                                </div>
                            @else
                                <div class="flex items-center gap-1.5 text-slate-400">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span class="text-[11px] font-bold">Logbook Aman</span>
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('mentor.internship.details', $intern->id) }}"
                            class="text-[11px] font-extrabold text-teal-600 hover:text-teal-800 transition-colors flex items-center gap-1">
                            Detail <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach

            <!-- EMPTY STATE KEREN (Muncul Otomatis Kalau Filter Kosong) -->
            <div x-show="filteredInterns.length === 0" class="col-span-full py-12 text-center" style="display: none;"
                x-cloak>
                <div
                    class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-400">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Tidak ada peserta magang ditemukan</h3>
                <p class="text-xs text-slate-500 mt-1">Coba sesuaikan kata kunci pencarian atau ubah filter status.</p>
                <button @click="searchQuery = ''; activeFilter = 'all'"
                    class="mt-4 text-xs font-bold text-teal-600 hover:text-teal-800 hover:underline cursor-pointer transition-colors">
                    Reset Pencarian & Filter
                </button>
            </div>

        </div>
    </div>
@endsection

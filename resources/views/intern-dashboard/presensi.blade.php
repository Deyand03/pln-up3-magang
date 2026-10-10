@extends('layouts.base')

@section('title', 'Presensi Kehadiran - PLN UP3 Jambi')

@push('styles')
    <!-- Leaflet.js Maps CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #leaflet-map {
            height: 200px;
            width: 100%;
            border-radius: 1rem;
            z-index: 10;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-6 pb-16 space-y-6">
        {{-- Toast Notifikasi --}}
        @if (session('success'))
            <div id="toast-success"
                class="fixed top-20 sm:right-20 z-50 max-w-sm w-full bg-white/95 text-white p-4 rounded-2xl shadow-2xl border border-teal-500/30 flex items-start gap-3 transform transition-all duration-300 animate-slide-in">
                <div
                    class="w-8 h-8 rounded-full bg-teal-500/20 border border-teal-500/40 text-teal-400 flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="flex-1 pr-2">
                    <h4 class="text-xs font-bold text-teal-800">Berhasil!</h4>
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
        @if (session('error'))
            <div
                class="p-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-800 text-xs font-bold flex items-center gap-2">
                <span>⚠️</span> {{ session('error') }}
            </div>
        @endif
        <div class="breadcrumbs text-xs font-semibold text-slate-500 pl-3">
            <ul>
                <li><a href="{{ route('dashboard-intern') }}">Dashboard</a></li>
                <li><a class="no-underline cursor-text">Presensi Magang</a></li>
            </ul>
        </div>
        <div
            class="bg-linear-to-br from-teal-800 via-teal-700 to-teal-900 rounded-3xl p-6 sm:p-7 text-white shadow-xl shadow-teal-900/10 border border-teal-600/30 relative overflow-hidden">
            <div
                class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] bg-size-[18px_18px]">
            </div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex flex-wrap items-center gap-2">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 text-[11px] font-bold text-teal-100 backdrop-blur-xs border border-white/10">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Presensi Harian Online
                        </span>
                        <span class="text-xs text-teal-200/90 font-medium">Jam Kerja: <strong class="text-white">08:00 -
                                16:30 WIB</strong></span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                        Presensi Kehadiran Magang
                    </h1>

                    <p class="text-xs sm:text-sm text-teal-100/90 max-w-xl leading-relaxed">
                        Pastikan Anda berada di area lokasi instansi PT PLN (Persero) UP3 Jambi sebelum melakukan presensi
                        masuk atau pulang.
                    </p>
                </div>

                <!-- Live Digital Clock Widget -->
                <div
                    class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 sm:p-5 text-center shrink-0 min-w-50">
                    <span class="text-[10px] uppercase font-extrabold text-teal-200 tracking-wider block mb-0.5"
                        id="current-date">
                        {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }}
                    </span>
                    <div class="text-3xl sm:text-4xl font-mono font-black text-white tracking-wider my-1" id="live-clock">
                        00:00:00
                    </div>
                    <span class="inline-block text-[10px] font-bold text-amber-900 bg-amber-300 px-2.5 py-0.5 rounded-full">
                        Waktu Indonesia Barat (WIB)
                    </span>
                </div>
            </div>
        </div>

        <!-- 2. METRIC STATS RINGKASAN PRESENSI BULAN INI -->
        <div class="grid grid-cols-3 gap-3 sm:gap-4">
            <div
                class="flex flex-col justify-between bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs hover:border-teal-500/50 transition-all">
                <span class="text-[11px] font-extrabold text-slate-500 block uppercase tracking-wider">Total
                    Kehadiran</span>
                <div class="my-1 flex items-baseline gap-1">
                    <span
                        class="text-2xl sm:text-3xl font-black text-teal-700">{{ $statPresensi['totalHadir'] ?? 0 }}</span>
                    <span class="text-xs text-slate-400 font-semibold">Hari</span>
                </div>
                <span
                    class="w-fit inline-block text-[10px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100">
                    Tercatat
                </span>
            </div>

            <div
                class="flex flex-col justify-between bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs hover:border-blue-500/50 transition-all">
                <span class="text-[11px] font-extrabold text-slate-500 block uppercase tracking-wider">Izin / Sakit</span>
                <div class="my-1 flex items-baseline gap-1">
                    <span
                        class="text-2xl sm:text-3xl font-black text-sky-600">{{ $statPresensi['totalIzinSakit'] ?? 0 }}</span>
                    <span class="text-xs text-slate-400 font-semibold">Hari</span>
                </div>
                <span
                    class="w-fit inline-block text-[10px] font-bold text-sky-800 bg-sky-50 px-2 py-0.5 rounded-md border border-sky-100">
                    Terganti / Tercatat
                </span>
            </div>

            <div
                class="flex flex-col justify-between bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs hover:border-emerald-500/50 transition-all">
                <span class="text-[11px] font-extrabold text-slate-500 block uppercase tracking-wider">Tingkat
                    Kehadiran</span>
                <div class="my-1 flex items-baseline gap-1">
                    <span
                        class="text-2xl sm:text-3xl font-black text-emerald-700">{{ $statPresensi['tingkatKehadiran'] ?? '100%' }}</span>
                </div>
                <span
                    class="w-fit inline-block text-[10px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100">
                    Performa Baik
                </span>
            </div>
        </div>

        <!-- 3. MAIN PRESENSI ACTION & FORM SECTION -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- LEFT COLUMN: GPS MAP & PRESENSI ACTION CARD (Col 7) -->
            <div class="lg:col-span-7 space-y-6">

                <div class="bg-white rounded-3xl p-5 sm:p-7 border border-slate-200/80 shadow-xs space-y-5">

                    <!-- Tab Switcher -->
                    <div class="flex items-center bg-slate-100 p-1 rounded-2xl text-xs font-bold text-slate-600">
                        <button type="button" onclick="switchPresensiTab('absen')" id="btn-tab-absen"
                            class="flex-1 py-2.5 px-4 rounded-xl transition-all text-teal-900 bg-white shadow-xs font-extrabold cursor-pointer">
                            📍 Absensi GPS
                        </button>
                        <button type="button" onclick="switchPresensiTab('izin')" id="btn-tab-izin"
                            class="flex-1 py-2.5 px-4 rounded-xl transition-all hover:text-slate-900 cursor-pointer">
                            📝 Pengajuan Izin / Sakit
                        </button>
                    </div>

                    <!-- TAB 1: FORM ABSENSI HARIAN -->
                    <div id="tab-content-absen" class="space-y-4">

                        <!-- PETA LEAFLET INTERAKTIF -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs font-bold text-slate-700">
                                <span>🗺️ Peta Lokasi Anda & Kantor PLN UP3 Jambi</span>
                                <span id="radius-status-badge"
                                    class="text-[10px] px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600">Mendeteksi...</span>
                            </div>
                            <div id="leaflet-map"></div>
                        </div>

                        <!-- Geofencing & GPS Interactive Details -->
                        <div class="p-4 bg-slate-50/90 border border-slate-200/90 rounded-2xl space-y-3">
                            <div class="grid grid-cols-2 gap-2 text-[11px]">
                                <div class="bg-white p-2.5 rounded-xl border border-slate-200/60">
                                    <span class="text-slate-400 block text-[10px] font-bold uppercase">Koordinat GPS
                                        Anda</span>
                                    <span class="font-mono font-bold text-slate-800" id="gps-coords">Mencari
                                        lokasi...</span>
                                </div>
                                <div class="bg-white p-2.5 rounded-xl border border-slate-200/60">
                                    <span class="text-slate-400 block text-[10px] font-bold uppercase">Jarak dari
                                        Kantor</span>
                                    <span class="font-bold text-teal-700" id="gps-distance">- Meter</span>
                                </div>
                            </div>

                            <button type="button" onclick="refreshGPS()"
                                class="w-full text-center text-[11px] font-bold text-teal-700 hover:text-teal-900 bg-teal-50 hover:bg-teal-100/80 py-2 rounded-xl transition-colors cursor-pointer flex items-center justify-center gap-1.5 border border-teal-200/60">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                <span>Perbarui Lokasi GPS</span>
                            </button>
                        </div>

                        <!-- Form Action Presensi -->
                        <form action="{{ route('presensi-intern.store') }}" method="POST"
                            class="pt-2 border-t border-slate-100 space-y-3">
                            @csrf
                            <input type="hidden" id="latitude" name="latitude" value="-1.608300">
                            <input type="hidden" id="longitude" name="longitude" value="103.607200">

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                <!-- Tombol Absen Masuk (Set disabled secara default) -->
                                <button type="submit" name="type" value="masuk" id="btn-checkin" disabled
                                    class="w-full bg-teal-700 hover:bg-teal-800 active:scale-95 text-white font-extrabold text-xs py-3.5 px-4 rounded-xl shadow-md shadow-teal-700/20 transition-all flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Absen Masuk (08:00)</span>
                                </button>

                                <!-- Tombol Absen Pulang -->
                                <button type="submit" name="type" value="pulang" id="check_out"
                                    class="w-full bg-slate-100 text-black/50 font-extrabold text-xs py-3.5 px-4 rounded-xl shadow-md transition-all flex items-center justify-center gap-2 cursor-not-allowed disabled:opacity-50">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Absen Pulang (16:30)</span>
                                </button>
                            </div>
                        </form>

                    </div>

                    <!-- TAB 2: FORM PENGAJUAN IZIN / SAKIT -->
                    <div id="tab-content-izin" class="space-y-4 hidden">
                        @if ($hasCheckedIn)
                            <div
                                class="p-4 bg-amber-50 border border-amber-200/90 rounded-2xl text-amber-900 text-xs font-semibold flex items-center gap-2.5">
                                <span class="text-base shrink-0">⚠️</span>
                                <span>Anda sudah melakukan <strong>Absen Masuk</strong> hari ini, sehingga pengajuan
                                    izin/sakit untuk hari ini tidak dapat dilakukan.</span>
                            </div>
                        @elseif($isIzinSakitAlfaToday)
                            <div
                                class="p-4  text-xs font-semibold flex items-center gap-2.5
                                    {{ $todayAttendance->status !== 'alfa' ? 'bg-sky-50 border border-sky-200/90 rounded-2xl text-sky-900' : 'bg-rose-50 border border-rose-200/90 rounded-2xl text-rose-900' }}
                                ">
                                @if ($todayAttendance->status == 'alfa')
                                    <span class="text-base shrink-0">⚠️</span>
                                    <span>Anda tidak menghadiri magang untuk hari ini (Tercatat Alfa).</span>
                                @else
                                    <span class="text-base shrink-0">ℹ️</span>
                                    <span>Anda telah mengajukan <strong>Izin / Sakit</strong> untuk hari ini.</span>
                                @endif
                            </div>
                        @else
                            <form action="{{ route('presensi-intern.izin') }}" method="POST"
                                enctype="multipart/form-data" class="space-y-3.5">
                                @csrf
                                <div>
                                    <label for="kategori_izin"
                                        class="block text-xs font-bold text-slate-700 mb-1.5">Kategori Halangan <span
                                            class="text-rose-500">*</span></label>
                                    <select id="kategori_izin" name="kategori_izin"
                                        class="w-full text-xs px-3.5 py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 font-medium"
                                        required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="izin_kampus">Izin Kampus / Sekolah (Ujian / Bimbingan)</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Lampiran Surat Keterangan
                                        / Dokter <span class="text-slate-400 font-normal">(opsional)</span></label>
                                    <input type="file" name="surat_izin" accept=".pdf,.jpg,.jpeg,.png"
                                        class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 font-medium" />
                                    <span class="text-[10px] text-slate-400 mt-1 block">PDF/JPG/PNG max 2 MB (Bisa
                                        disusulkan)</span>
                                </div>

                                <div>
                                    <label for="alasan" class="block text-xs font-bold text-slate-700 mb-1.5">Alasan /
                                        Keterangan Lengkap <span class="text-rose-500">*</span></label>
                                    <textarea id="alasan" name="alasan" rows="3" placeholder="Jelaskan alasan izin Anda secara singkat..."
                                        class="w-full text-xs p-3.5 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-800 placeholder:text-slate-400 font-medium"
                                        required></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full bg-amber-600 hover:bg-amber-700 text-white font-extrabold text-xs py-3.5 px-4 rounded-xl shadow-md transition-all cursor-pointer">
                                    Kirim Pengajuan Izin
                                </button>
                            </form>
                        @endif
                    </div>

                </div>

            </div>

            <!-- RIGHT COLUMN: STATUS HARI INI & ATURAN ABSENSI (Col 5) -->
            <div class="lg:col-span-5 space-y-6">

                <!-- Card Status Presensi Hari Ini -->
                <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <h2 class="text-sm font-extrabold text-slate-900">Status Presensi Hari Ini</h2>
                        <span
                            class="text-[10px] font-extrabold text-teal-800 bg-teal-50 px-2.5 py-1 rounded-lg border border-teal-100">
                            {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    <div class="space-y-3">
                        <!-- Item Check-In -->
                        <div
                            class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200/70 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center text-xs shrink-0">
                                    📥
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Absen
                                        Masuk</span>
                                    <span class="text-xs font-black text-slate-800">
                                        {{ $todayAttendance && $todayAttendance->check_in ? $todayAttendance->check_in . ' WIB' : 'Belum Absen' }}
                                    </span>
                                </div>
                            </div>
                            <span
                                class="text-[10px] font-bold px-2.5 py-1 rounded-lg {{ $hasCheckedIn ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' }}">
                                {{ $hasCheckedIn ? 'Tercatat' : 'Belum' }}
                            </span>
                        </div>

                        <!-- Item Check-Out -->
                        <div
                            class="p-3.5 bg-slate-50 rounded-2xl border border-slate-200/70 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-slate-200 text-slate-500 font-bold flex items-center justify-center text-xs shrink-0">
                                    📤
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Absen
                                        Pulang</span>
                                    <span class="text-xs font-black text-slate-800">
                                        {{ $todayAttendance && $todayAttendance->check_out ? $todayAttendance->check_out . ' WIB' : 'Belum Absen' }}
                                    </span>
                                </div>
                            </div>
                            <span
                                class="text-[10px] font-bold px-2.5 py-1 rounded-lg {{ $hasCheckedOut ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' }}">
                                {{ $hasCheckedOut ? 'Tercatat' : 'Menunggu 16:30' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card Petunjuk & Ketentuan -->
                <div class="bg-amber-50/70 border border-amber-200/80 rounded-3xl p-5 space-y-2.5">
                    <h3 class="text-xs font-extrabold text-amber-900 flex items-center gap-1.5">
                        <span>💡</span> Ketentuan Presensi PLN UP3 Jambi
                    </h3>
                    <ul class="space-y-1.5 text-[11px] text-amber-900/90 leading-relaxed">
                        <li class="flex items-start gap-1.5">
                            <span class="font-bold">•</span>
                            <span>Jam masuk resmi pukul <strong>08:00 WIB</strong> & jam pulang pukul <strong>16:30
                                    WIB</strong>.</span>
                        </li>
                        <li class="flex items-start gap-1.5">
                            <span class="font-bold">•</span>
                            <span>Absen pulang baru aktif setelah pukul <strong>16:30 WIB</strong>.</span>
                        </li>
                        <li class="flex items-start gap-1.5">
                            <span class="font-bold">•</span>
                            <span>Sistem otomatis memverifikasi koordinat GPS & radius area kantor (Maks 100 Meter).</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-5 sm:p-7 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
                <div id="riwayat-presensi">
                    <h2 class="text-base font-extrabold text-slate-900">Riwayat Presensi Bulan Ini</h2>
                    <p class="text-xs text-slate-500">Daftar rekapan absensi harian dan status verifikasi mentor</p>
                </div>
            </div>

            {{-- Wrapper Riwayat Presensi --}}
            <div>
                <div id="loading-spinner"
                    class="hidden bg-white/60 backdrop-blur-sm z-50 justify-center items-center rounded-3xl transition-all">
                    <span class="loading loading-spinner text-teal-600 loading-lg"></span>
                </div>

                <div id="presensi-data">
                    @include('intern-dashboard.partials.list-presensi')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        const hasCheckedIn = {{ $hasCheckedIn ? 'true' : 'false' }};
        const hasCheckedOut = {{ $hasCheckedOut ? 'true' : 'false' }};
        const isIzinSakitAlfaToday = {{ $isIzinSakitAlfaToday ?? false ? 'true' : 'false' }};

        // Koordinat Kantor PLN UP3 Jambi
        const OFFICE_LAT = -1.607712;
        const OFFICE_LNG = 103.591788;
        const MAX_RADIUS_METERS = 80;

        let map, userMarker, officeMarker, radiusCircle;

        function initMap() {
            map = L.map('leaflet-map').setView([OFFICE_LAT, OFFICE_LNG], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Marker Kantor PLN
            officeMarker = L.marker([OFFICE_LAT, OFFICE_LNG]).addTo(map)
                .bindPopup('<b>PT PLN (Persero) UP3 Jambi</b><br>Area Presensi').openPopup();

            // Lingkaran Radius Kantor (100 Meter)
            radiusCircle = L.circle([OFFICE_LAT, OFFICE_LNG], {
                color: '#0F766E',
                fillColor: '#14B8A6',
                fillOpacity: 0.15,
                radius: MAX_RADIUS_METERS
            }).addTo(map);

            refreshGPS();
        }

        function refreshGPS() {
            const badge = document.getElementById('radius-status-badge');
            const btnCheckin = document.getElementById('btn-checkin');

            // 1. Kunci tombol dan ubah status badge saat proses mencari lokasi
            if (badge) {
                badge.className =
                    "text-[10px] px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 font-bold border border-slate-200";
                badge.textContent = "Mendeteksi Lokasi...";
            }
            if (btnCheckin) {
                btnCheckin.disabled = true;
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    document.getElementById('gps-coords').textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;

                    // Hitung Jarak Leaflet
                    const userLatLng = L.latLng(lat, lng);
                    const officeLatLng = L.latLng(OFFICE_LAT, OFFICE_LNG);
                    const distanceMeters = Math.round(userLatLng.distanceTo(officeLatLng));

                    document.getElementById('gps-distance').textContent = `${distanceMeters} Meter`;

                    // Update User Marker
                    if (userMarker) map.removeLayer(userMarker);
                    userMarker = L.marker([lat, lng]).addTo(map).bindPopup('Lokasi Anda Saat Ini');

                    // Adjust map view bounds to show both (Safe Leaflet bounds)
                    try {
                        const bounds = L.latLngBounds([
                            [OFFICE_LAT, OFFICE_LNG],
                            [lat, lng]
                        ]);
                        map.fitBounds(bounds, {
                            padding: [30, 30]
                        });
                    } catch (e) {
                        console.warn("Bounds adjust error:", e);
                    }

                    // Check Validity
                    if (isIzinSakitAlfaToday) {
                        badge.className =
                            "text-[10px] px-2.5 py-0.5 rounded-full bg-sky-100 text-sky-800 font-bold border border-sky-20 ";
                        badge.textContent = 'Tercatat Izin/Sakit Hari Ini';
                        btnCheckin.disabled = true;
                    } else if (distanceMeters <= MAX_RADIUS_METERS) {
                        badge.className =
                            "text-[10px] px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-bold border border-emerald-200";
                        badge.textContent = `Valid dalam Radius (${distanceMeters}m)`;
                        if (!hasCheckedIn) {
                            btnCheckin.disabled = false;
                        }
                    } else {
                        badge.className =
                            "text-[10px] px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-800 font-bold border border-rose-200";
                        badge.textContent = `Di Luar Radius (${distanceMeters}m)`;
                        btnCheckin.disabled = true;
                    }

                }, function(error) {
                    console.warn("GPS error: " + error.message);
                    // 2. Kunci tombol jika GPS mati / izin lokasi ditolak
                    if (badge) {
                        badge.className =
                            "text-[10px] px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-800 font-bold border border-rose-200";
                        badge.textContent = "Gagal Deteksi / GPS Mati";
                    }
                    if (btnCheckin) {
                        btnCheckin.disabled = true;
                    }
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000
                });
            } else {
                if (badge) {
                    badge.className =
                        "text-[10px] px-2.5 py-0.5 rounded-full bg-rose-100 text-rose-800 font-bold border border-rose-200";
                    badge.textContent = "Browser Tidak Mendukung GPS";
                }
                if (btnCheckin) {
                    btnCheckin.disabled = true;
                }
            }
        }

        function checkCheckoutTime() {
            const now = new Date();
            const currentMinutes = now.getHours() * 60 + now.getMinutes();
            const checkoutTimeMinutes = 16 * 60 + 30; // 16:30 WIB = 990 Menit

            const isPassCheckoutTime = currentMinutes >= checkoutTimeMinutes;
            const btnCheckout = document.getElementById('check_out');
            const btnCheckin = document.getElementById('btn-checkin');

            // Set state check-in button
            if (hasCheckedIn) {
                btnCheckin.disabled = true;
                btnCheckin.classList.add('opacity-50', 'cursor-not-allowed');
            }

            // Set state check-out button
            if (hasCheckedIn && !hasCheckedOut && isPassCheckoutTime) {
                btnCheckout.disabled = false;
                btnCheckout.classList.remove('bg-slate-100', 'text-black/50', 'cursor-not-allowed');
                btnCheckout.classList.add('bg-slate-800', 'hover:bg-slate-900', 'active:scale-95', 'text-white',
                    'cursor-pointer');
            } else {
                btnCheckout.disabled = true;
                btnCheckout.classList.remove('bg-slate-800', 'hover:bg-slate-900', 'active:scale-95', 'text-white',
                    'cursor-pointer');
                btnCheckout.classList.add('bg-slate-100', 'text-black/50', 'cursor-not-allowed');
            }
        }

        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const clockEl = document.getElementById('live-clock');
            if (clockEl) {
                clockEl.textContent = `${hours}:${minutes}:${seconds}`;
            }
            checkCheckoutTime();
        }

        function switchPresensiTab(tab) {
            const contentAbsen = document.getElementById('tab-content-absen');
            const contentIzin = document.getElementById('tab-content-izin');
            const btnAbsen = document.getElementById('btn-tab-absen');
            const btnIzin = document.getElementById('btn-tab-izin');

            if (tab === 'absen') {
                contentAbsen.classList.remove('hidden');
                contentIzin.classList.add('hidden');
                btnAbsen.classList.add('text-teal-900', 'bg-white', 'shadow-xs', 'font-extrabold');
                btnIzin.classList.remove('text-teal-900', 'bg-white', 'shadow-xs', 'font-extrabold');
            } else {
                contentIzin.classList.remove('hidden');
                contentAbsen.classList.add('hidden');
                btnIzin.classList.add('text-teal-900', 'bg-white', 'shadow-xs', 'font-extrabold');
                btnAbsen.classList.remove('text-teal-900', 'bg-white', 'shadow-xs', 'font-extrabold');
            }
        }

        function dismissToast() {
            const toast = document.getElementById('toast-success');
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-10px)';
                setTimeout(() => toast.remove(), 300);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.addEventListener('click', function(e) {
                const paginationLink = e.target.closest('.pagination-links a');
                if (paginationLink) {
                    e.preventDefault();
                    const targetUrl = paginationLink.href;
                    fetchData(targetUrl);
                }
            });

            function fetchData(url, updateUrl = true) {
                const wrapper = document.getElementById('presensi-data');
                const spinner = document.getElementById('loading-spinner');

                spinner.classList.remove('hidden');
                wrapper.classList.add('hidden')
                document.getElementById('riwayat-presensi').scrollIntoView({
                    behavior: 'smooth'
                });

                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal mengambil data!');
                        return response.text();
                    })
                    .then(html => {
                        wrapper.innerHTML = html;
                        if (updateUrl) {
                            window.history.pushState(null, '', url);
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

            window.addEventListener('popstate', function() {
                fetchData(window.location.href, false);
            });
            
            initMap();
            setInterval(updateClock, 1000);
            updateClock();
            setTimeout(() => {
                dismissToast();
            }, 5000);
        });
    </script>
@endpush

@extends('layouts.base')
@section('title', 'Detail Peserta Magang')

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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6"
        x-data="{ activeTab: '{{ request()->has('presensi_page') ? 'presensi' : 'logbook' }}' }">

        <!-- Tombol Kembali -->
        <div class="breadcrumbs text-xs font-semibold text-slate-500 pl-3">
            <ul>
                <li><button onclick="history.back()">Dashboard</button></li>
                <li><a class="no-underline cursor-text">Detail Peserta ({{ $intern->user->name }})</a></li>
            </ul>
        </div>

        <!-- HEADER PROFIL PESERTA -->
        <div
            class="bg-white border border-slate-200 rounded-3xl p-6 sm:p-8 shadow-sm flex flex-col md:flex-row items-start md:items-center gap-6 relative overflow-hidden">

            <!-- Avatar -->
            <div
                class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden border-4 border-slate-50 shrink-0 shadow-sm relative z-10">
                <img src="{{ $intern->user->foto_profil ? Storage::url($intern->user->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode($intern->user->name) . '&background=0D8B94&color=fff' }}"
                    alt="Avatar" class="w-full h-full object-cover">
            </div>

            <!-- Info Detail -->
            <div class="flex-1 relative z-10">
                <div class="flex items-center gap-2 mb-1">
                    <h1 class="text-2xl font-black text-slate-900">{{ $intern->user->name }}</h1>
                    <span
                        class="px-2.5 py-0.5 rounded-full bg-teal-50 text-teal-700 text-[10px] font-extrabold uppercase tracking-wider border border-teal-100">
                        {{ $intern->status == 'active' ? 'Aktif Magang' : ($intern->status == 'terminated' ? 'Dikeluarkan' : ($intern->status == 'completed' ? 'Selesai' : '')) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-y-2 gap-x-6 mt-3">
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase">NIM/NISN</span>
                        <span class="text-sm font-semibold text-slate-700 uppercase">{{ $intern->nim_nisn }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase">Institusi</span>
                        <span class="text-sm font-semibold text-slate-700">{{ $intern->applications->institusi }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase">Divisi</span>
                        <span class="text-sm font-semibold text-slate-700">{{ $intern->department ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase">Kontak</span>
                        <span
                            class="text-sm font-semibold text-slate-700">{{ $intern->user->phone ?? 'Tidak ada nomor' }}</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase">Periode</span>
                        <span class="text-sm font-semibold text-slate-700">
                            {{ \Carbon\Carbon::parse($intern->applications->start_date)->translatedFormat('d M Y') }} -
                            {{ \Carbon\Carbon::parse($intern->applications->end_date)->translatedFormat('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Deco Pattern -->
            <div class="absolute right-0 top-0 bottom-0 w-64 bg-teal-50/50 rounded-l-full blur-3xl pointer-events-none">
            </div>
        </div>

        <!-- TAB NAVIGATION -->
        <div class="flex items-center gap-2 border-b border-slate-200">
            <button @click="activeTab = 'logbook'"
                :class="activeTab === 'logbook' ? 'text-teal-600 border-teal-600' : 'text-slate-500 border-transparent hover:text-slate-700 hover:border-slate-300'"
                class="px-5 py-3.5 text-sm font-bold border-b-2 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Logbook Harian

                @if($intern->pending_logbooks_count > 0)
                    <span
                        class="bg-amber-100 text-amber-700 py-0.5 px-2 rounded-full text-[10px]">{{ $intern->pending_logbooks_count }}</span>
                @endif
            </button>

            <button @click="activeTab = 'presensi'"
                :class="activeTab === 'presensi' ? 'text-teal-600 border-teal-600' : 'text-slate-500 border-transparent hover:text-slate-700 hover:border-slate-300'"
                class="px-5 py-3.5 text-sm font-bold border-b-2 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Histori Presensi
            </button>
        </div>

        <!-- TAB CONTENT AREA -->
        <div class="pb-10">

            <!-- Konten Logbook (Tampil jika activeTab === 'logbook') -->
            <div x-show="activeTab === 'logbook'" x-transition.opacity.duration.300ms class="-mt-20">
                @include('mentor.partials.logbook-detail')
            </div>

            <!-- Konten Presensi (Tampil jika activeTab === 'presensi') -->
            <div x-show="activeTab === 'presensi'" x-cloak x-transition.opacity.duration.300ms style="display: none;"
                class="-mt-20">
                @include('mentor.partials.presensi-detail')
            </div>

        </div>

    </div>
@endsection

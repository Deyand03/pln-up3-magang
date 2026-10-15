@extends('layouts.base')
@section('title', 'Tinjau Pendaftaran')

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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" id="section-pendaftaran" x-data="{
            isLoading: false,

            loadPage(url) {
                if (!url) return;
                this.isLoading = true;

                document.getElementById('section-pendaftaran').scrollIntoView({ behavior: 'smooth', block: 'start' });

                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(res => res.text())
                .then(html => {
                    $refs.contentArea.innerHTML = html;
                    this.isLoading = false;
                });
            }
         }"
        @click="if ($event.target.closest('nav a')) { $event.preventDefault(); loadPage($event.target.closest('nav a').href); }">

        <div class="mb-8 relative z-10">
            <div class="breadcrumbs text-xs font-semibold text-slate-500 mb-3">
                <ul>
                    <li><a href="{{ route('dashboard-hrd') }}">Dashboard</a></li>
                    <li><a class="no-underline cursor-text">Tinjau Pendaftaran</a></li>
                </ul>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Tinjau Pendaftaran</h1>
                    <p class="text-sm font-semibold text-slate-500 mt-2">Kelola dan evaluasi antrean pengajuan magang dari
                        institusi pendidikan.</p>
                </div>
                <div class="flex w-fit bg-slate-100/70 px-3 py-1.5 rounded-lg border border-slate-200">
                    <span class="text-sm font-bold text-slate-600">
                        Total:
                        <span class="text-amber-600">{{ $applications->total() }}</span>
                        Laporan
                    </span>
                </div>
            </div>
        </div>

        <!-- AREA KONTEN DINAMIS -->
        <div class="relative min-h-100">

            <!-- Loading Spinner -->
            <div x-show="isLoading" x-transition.opacity
                class="absolute inset-0 z-20 flex items-start justify-center pt-20 bg-slate-50/60 backdrop-blur-sm rounded-3xl"
                style="display: none;">
                <div class="flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-full shadow-2xl">
                    <svg class="w-4 h-4 animate-spin text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="text-xs font-bold tracking-wider uppercase">Memuat Data...</span>
                </div>
            </div>

            <!-- Wadah Injeksi List Card -->
            <div x-ref="contentArea">
                @include('hrd.partials.pendaftar-list')
            </div>

        </div>

    </div>
@endsection

<div id="section-presensi" class="space-y-4 pt-20" x-data="{
        isLoading: false,

        loadPage(url) {
            if (!url) return;
            this.isLoading = true;

            document.getElementById('section-presensi').scrollIntoView({ behavior: 'smooth', block: 'start' });

            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.text())
            .then(html => {
                $refs.contentArea.innerHTML = html;
                this.isLoading = false;
            });
        }
    }"
    @click="if ($event.target.closest('nav a')) { $event.preventDefault(); loadPage($event.target.closest('nav a').href); }">

    <!-- HEADER PRESENSI -->
    <div class="flex items-center justify-between mb-6 px-1">
        <div>
            <h2 class="text-lg font-black text-slate-900">Histori Presensi</h2>
            <p class="text-xs text-slate-500 font-semibold mt-0.5">Pantau rekam jejak kehadiran peserta setiap harinya.
            </p>
        </div>

        <div class="bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
            <span class="text-xs font-bold text-slate-600">Total: {{ $intern->attendances_count }} Presensi</span>
        </div>
    </div>

    <!-- AREA KONTEN DINAMIS -->
    <div class="relative min-h-75">

        <!-- Loading Spinner -->
        <div x-show="isLoading" x-transition.opacity
            class="absolute inset-0 z-10 flex items-start justify-center pt-20 bg-white/60 backdrop-blur-[2px] rounded-2xl"
            style="display: none;">
            <div class="flex items-center gap-2 bg-slate-900 text-white px-4 py-2 rounded-full shadow-lg">
                <svg class="w-4 h-4 animate-spin text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span class="text-xs font-bold tracking-wider">Memuat...</span>
            </div>
        </div>

        <!-- Wadah Injeksi File List Presensi -->
        <div x-ref="contentArea">
            @include('mentor.partials.presensi-list')
        </div>

    </div>
</div>

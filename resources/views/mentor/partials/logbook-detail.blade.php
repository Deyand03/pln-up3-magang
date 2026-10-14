<!-- Wrapper Alpine dengan Event Delegation untuk menangkap klik paginasi -->
<div id="section-logbook" class="space-y-4 pt-20" x-data="{
        isLoading: false,
        filterPending: false,

        loadPage(url) {
            if (!url) return;
            this.isLoading = true;

            document.getElementById('section-logbook').scrollIntoView({ behavior: 'smooth', block: 'start' });

            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.text())
            .then(html => {
                $refs.contentArea.innerHTML = html;
                this.isLoading = false;
            });
        },

        toggleFilter() {
            this.filterPending = !this.filterPending;

            // Bikin URL baru berdasarkan URL saat ini
            let url = new URL(window.location.href);
            url.searchParams.set('filter_pending', this.filterPending);
            url.searchParams.set('logbook_page', 1); // Kembalikan ke halaman 1 saat filter diubah

            this.loadPage(url.toString());
        }
    }"
    @click="if ($event.target.closest('nav a')) { $event.preventDefault(); loadPage($event.target.closest('nav a').href + '&filter_pending=' + filterPending); }">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6 px-1">
        <div>
            <h2 class="text-lg font-black text-slate-900">Catatan Logbook Harian</h2>
            <p class="text-xs text-slate-500 font-semibold mt-0.5">Evaluasi dan setujui laporan aktivitas peserta.</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Tombol Toggle Filter Pending -->
            <button @click="toggleFilter()"
                :class="filterPending ? 'bg-amber-100 text-amber-700 border-amber-200' : 'bg-white text-slate-500 border-slate-200 hover:bg-slate-50'"
                class="px-3 py-1.5 rounded-lg border text-xs font-bold transition-colors flex items-center gap-1.5 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                <span x-text="filterPending ? 'Hanya Pending' : 'Semua Laporan'"></span>
            </button>

            <!-- Total Counter -->
            <div class="bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                <span class="text-xs font-bold text-slate-600">Total: {{ $intern->logbooks_count }} Laporan</span>
            </div>
        </div>
    </div>

    <!-- AREA KONTEN DINAMIS -->
    <div class="relative min-h-[300px]">

        <!-- Loading Spinner (Muncul numpuk di atas konten saat Fetch) -->
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

        <!-- Wadah Injeksi File List -->
        <div x-ref="contentArea">
            @include('mentor.partials.logbook-list')
        </div>

    </div>
</div>

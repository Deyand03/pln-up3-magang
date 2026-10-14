@forelse($logbooks as $logbook)
    <div
        class="bg-white border {{ $logbook->status === 'pending' ? 'border-amber-200 shadow-amber-900/5' : 'border-slate-200' }} rounded-2xl p-5 shadow-sm transition-all hover:shadow-md relative overflow-hidden group mb-2.5">

        <!-- Glow effect kalau pending -->
        @if($logbook->status === 'pending')
            <div class="absolute top-0 left-0 bottom-0 w-1 bg-amber-400"></div>
        @else
            <div class="absolute top-0 left-0 bottom-0 w-1 bg-emerald-400"></div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-4">

            <!-- Info Waktu -->
            <div class="flex items-start gap-3">
                <div
                    class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 text-slate-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900">
                        {{ \Carbon\Carbon::parse($logbook->date)->translatedFormat('l, d F Y') }}
                    </h3>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-[11px] font-bold text-slate-500">
                            {{ \Carbon\Carbon::parse($logbook->jam_mulai)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($logbook->jam_selesai)->format('H:i') }} WIB
                        </span>
                    </div>
                </div>
            </div>

            <!-- Status & Action Button -->
            <div class="flex flex-wrap items-center gap-2 sm:gap-3 shrink-0">
                @if($logbook->status === 'pending')
                    <span
                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 text-[11px] font-bold border border-amber-200">
                        Menunggu Evaluasi
                    </span>

                    <form action="{{ route('mentor.internship.toggleStatus', $logbook->id) }}" method="POST" class="m-0">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="px-4 py-1.5 bg-teal-600 hover:bg-teal-700 text-white text-[11px] font-extrabold rounded-lg transition-colors shadow-sm flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Setujui
                        </button>
                    </form>
                @else
                    <span
                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 text-[11px] font-bold border border-emerald-200">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Telah Disetujui
                    </span>
                @endif
            </div>

        </div>

        <!-- Konten Laporan -->
        <div class="bg-slate-50/80 rounded-xl p-4 border border-slate-100">
            <h4 class="text-sm font-bold text-slate-800 mb-1.5">{{ $logbook->nama_kegiatan }}</h4>
            <p class="text-xs text-slate-600 leading-relaxed whitespace-pre-wrap">{{ $logbook->deskripsi_kegiatan }}</p>
        </div>

    </div>
@empty
    <!-- Empty State Khusus Logbook -->
    <div class="py-16 text-center bg-white border border-slate-200 rounded-3xl border-dashed">
        <div
            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400 border border-slate-100">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <h3 class="text-sm font-bold text-slate-800">Belum ada Logbook</h3>
        <p class="text-xs text-slate-500 mt-1">Peserta ini belum mengirimkan laporan harian apapun.</p>
    </div>
@endforelse
@if($logbooks->hasPages())
    <div class="mt-6">
        {{ $logbooks->appends(request()->query())->links() }}
    </div>
@endif

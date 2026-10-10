@forelse ($dataLogbook as $logbook)
    <div
        class="p-4 bg-slate-50/80 hover:bg-teal-50/40 rounded-2xl border border-slate-200/70 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 mb-2">
        <div class="space-y-1">
            <div class="flex items-center gap-2">
                <h4 class="text-xs font-extrabold text-slate-800">
                    {{ $logbook->nama_kegiatan }}</h4>
                <span
                    class="text-[9px] font-bold px-2 py-0.5 rounded-md {{ $logbook->status == 'approved' ? 'bg-emerald-100 text-emerald-800' : '' }}">{{ $logbook->status == 'approved' ? 'Disetujui' : '' }}</span>
            </div>
            <p class="text-xs text-slate-600 leading-relaxed">
                {{ $logbook->deskripsi_kegiatan }}</p>
        </div>
        <span
            class="text-[10px] text-slate-400 font-mono font-medium shrink-0">{{ \Carbon\Carbon::parse($logbook->jam_mulai)->format('H.i') }}
            - {{ \Carbon\Carbon::parse($logbook->jam_selesai)->format('H.i') }}</span>
    </div>
@empty
    <div class="flex justify-center ">
        <span class="bg-rose-50 text-rose-800 text-xs font-semibold rounded-xl px-4 py-2 border border-rose-100">
            Data Kosong
        </span>
    </div>
@endforelse
{{-- Pagination --}}
<div class="mt-4 pagination-links">
    {{ $dataLogbook->links() }}
</div>

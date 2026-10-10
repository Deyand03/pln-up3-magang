@forelse ($dataLogbook as $logbook)
    <div class="mb-2">
        <div
            class="flex items-start justify-between bg-slate-50 hover:bg-slate-50/50 border border-slate-200/70 p-4 sm:p-5 rounded-2xl transition-all group {{ $logbook->status == 'pending' ? 'hover:border-amber-300' : '' }}">
            <div class="flex flex-col flex-1 justify-between gap-3">
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900 group-hover:text-teal-700 transition-colors">
                        {{ $logbook->nama_kegiatan }}</h3>
                    <div class="flex items-center gap-2 mt-1 text-[11px] font-bold text-slate-500">
                        <span>📅
                            {{ \Carbon\Carbon::parse($logbook->date)->translatedFormat('d F Y') }}</span>
                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                        <span
                            class="font-mono text-slate-600">{{ \Carbon\Carbon::parse($logbook->jam_mulai)->format('H:i') . ' - ' . \Carbon\Carbon::parse($logbook->jam_selesai)->format('H:i') }}
                            WIB</span>
                    </div>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed">
                    {{ $logbook->deskripsi_kegiatan }}
                </p>
                <span
                    class="w-fit inline-flex items-center gap-1 text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider shrink-0
                                        {{ $logbook->status == 'approved' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200 ' : 'bg-amber-100 text-amber-800 border border-amber-200 ' }}">

                    @if ($logbook->status == 'approved')
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M5 13l4 4L19 7" />
                        @else
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                    @endif
                    </svg>
                    {{ $logbook->status == 'approved' ? 'Disetujui' : 'Pending' }}
                </span>
            </div>
            <div>
                <button
                    class="flex bg-teal-600 shadow-md hover:shadow-teal-500/30 active:scale-95 sm:flex sm:items-center sm:gap-2 text-white text-xs font-semibold px-2 py-1.5 rounded-lg hover:bg-teal-700 transition-all duration-300 btn-detail"
                    popovertarget="my-modal-2" data-date="{{ $logbook->date }}"
                    data-jam-mulai="{{ \Carbon\Carbon::parse($logbook->jam_mulai)->format('H:i') }}"
                    data-jam-selesai="{{ \Carbon\Carbon::parse($logbook->jam_selesai)->format('H:i') }}"
                    data-nama-kegiatan="{{ $logbook->nama_kegiatan }}"
                    data-deskripsi-kegiatan="{{ $logbook->deskripsi_kegiatan }}"
                    data-action-url="{{ route('logbook-intern.update', $logbook->id) }}">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>
                    <span class="hidden sm:block">Edit</span>
                </button>
            </div>
        </div>
    </div>
@empty
    <div class="flex justify-center">
        <span class="bg-rose-50 text-rose-800 text-xs font-semibold rounded-xl px-4 py-2 border border-rose-100">
            Data Logbook Tidak ada
        </span>
    </div>
@endforelse

<div class="mt-6 pt-4 border-t border-slate-100 pagination-links">
    {{ $dataLogbook->links() }}
</div>

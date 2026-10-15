<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($applications as $app)
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">

            <!-- Dekorasi Status -->
            <div class="absolute top-0 left-0 w-full h-1
                {{ $app->status === 'pending' ? 'bg-amber-400' : ($app->status === 'revision' ? 'bg-sky-400' : 'bg-rose-400') }}">
            </div>

            <div>
                <!-- Header Card: Reg & Status -->
                <div class="flex items-start justify-between gap-2 mb-4 mt-1">
                    <span class="text-[10px] font-mono font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-md border border-slate-100">
                        {{ $app->registration_number }}
                    </span>

                    @if($app->status === 'pending')
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md bg-amber-50 text-amber-700 text-[9px] font-extrabold border border-amber-200 uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Menunggu
                        </span>
                    @elseif($app->status === 'revision')
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md bg-sky-50 text-sky-700 text-[9px] font-extrabold border border-sky-200 uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span> Revisi
                        </span>
                    @elseif($app->status === 'rejected')
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md bg-rose-50 text-rose-700 text-[9px] font-extrabold border border-rose-200 uppercase tracking-wider">
                            Ditolak
                        </span>
                    @endif
                </div>

                <!-- Info Utama: Institusi & Pengaju -->
                <div class="mb-5">
                    <h3 class="text-base font-black text-slate-900 leading-tight mb-1">{{ $app->institusi }}</h3>
                    <p class="text-xs font-bold text-teal-600 mb-3">{{ $app->jurusan }}</p>

                    <div class="flex items-center gap-2.5 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center shrink-0 text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-bold text-slate-800 truncate" title="{{ $app->name }}">{{ $app->name }}</p>
                            <p class="text-[10px] font-semibold text-slate-500">{{ $app->total_interns }} Anggota Tim</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Card: Periode & Tombol Aksi -->
            <div class="pt-4 border-t border-slate-100 mt-auto flex items-center justify-between">
                <div>
                    <span class="block text-[9px] font-bold text-slate-400 uppercase mb-0.5">Periode Magang</span>
                    <span class="text-[11px] font-extrabold text-slate-700">
                        {{ \Carbon\Carbon::parse($app->start_date)->translatedFormat('d M y') }} <span class="text-slate-400 mx-0.5">-</span> {{ \Carbon\Carbon::parse($app->end_date)->translatedFormat('d M y') }}
                    </span>
                </div>

                <a href="{{ route('dashboard-hrd.pendaftar.detail', $app->id) }}" class="shrink-0 w-8 h-8 bg-slate-900 hover:bg-teal-600 text-white rounded-lg flex items-center justify-center transition-colors shadow-sm group-hover:bg-teal-600">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>

        </div>
    @empty
        <div class="col-span-full py-20 text-center bg-white border border-slate-200 rounded-3xl border-dashed">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300 border border-slate-100">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
            <h3 class="text-base font-black text-slate-800">Antrean Kosong</h3>
            <p class="text-sm text-slate-500 mt-1">Belum ada pengajuan magang baru yang perlu ditinjau.</p>
        </div>
    @endforelse
</div>

<!-- Paginasi -->
@if($applications->hasPages())
    <div class="mt-8">
        {{ $applications->appends(request()->query())->links() }}
    </div>
@endif

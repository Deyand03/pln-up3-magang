    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-[10px] uppercase tracking-wider font-extrabold">
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4 text-center">Waktu Masuk</th>
                        <th class="px-6 py-4 text-center">Waktu Keluar</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4">Keterangan / Izin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">

                    @forelse($attendances as $absen)
                        <tr class="hover:bg-slate-50/50 transition-colors">

                            <!-- Kolom Tanggal -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 border border-slate-200 text-slate-500 flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-extrabold text-slate-900">{{ \Carbon\Carbon::parse($absen->date)->translatedFormat('l') }}</p>
                                        <p class="text-[11px] font-semibold text-slate-500">{{ \Carbon\Carbon::parse($absen->date)->translatedFormat('d M Y') }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Kolom Waktu Masuk -->
                            <td class="px-6 py-4 text-center">
                                @if($absen->check_in)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100">
                                        {{ \Carbon\Carbon::parse($absen->check_in)->format('H:i') }} WIB
                                    </span>
                                @else
                                    <span class="text-slate-400 text-xs font-bold">-</span>
                                @endif
                            </td>

                            <!-- Kolom Waktu Keluar -->
                            <td class="px-6 py-4 text-center">
                                @if($absen->check_out)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 text-xs font-bold border border-amber-100">
                                        {{ \Carbon\Carbon::parse($absen->check_out)->format('H:i') }} WIB
                                    </span>
                                @else
                                    <span class="text-slate-400 text-xs font-bold">-</span>
                                @endif
                            </td>

                            <!-- Kolom Status Presensi -->
                            <td class="px-6 py-4 text-center">
                                @if($absen->status === 'hadir')
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Hadir
                                    </span>
                                @elseif($absen->status === 'izin' || $absen->status === 'sakit')
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-sky-50 text-sky-700 text-[10px] font-bold border border-sky-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span> {{ ucfirst($absen->status) }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-md bg-rose-50 text-rose-700 text-[10px] font-bold border border-rose-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Alfa
                                    </span>
                                @endif
                            </td>

                            <!-- Kolom Keterangan / Izin -->
                            <td class="px-6 py-4 max-w-37.5">
                                @if($absen->surat_izin)
                                    <!-- Jika ada file surat izin, kasih link download/lihat -->
                                    <a href="{{ Storage::url($absen->surat_izin) }}" target="_blank" class="text-[11px] font-extrabold text-teal-600 hover:text-teal-800 flex items-center gap-1 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                        </svg>
                                        Lihat Surat
                                    </a>
                                    @if($absen->notes)
                                        <p class="text-[10px] text-slate-500 mt-1 text-wrap" title="{{ $absen->notes }}">{{ $absen->notes }}</p>
                                    @endif
                                @else
                                    <p class="text-[11px] text-slate-600 font-medium text-wrap" title="{{ $absen->notes ?? 'Tidak ada catatan' }}">
                                        {{ $absen->notes ?? '-' }}
                                    </p>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <!-- Empty State Khusus Tabel Presensi -->
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-400 border border-slate-100">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-800">Belum ada histori presensi</h3>
                                <p class="text-xs text-slate-500 mt-1">Peserta magang belum melakukan presensi sama sekali.</p>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginasi Bawaan Laravel (Tetap menyertakan query string agar tab tidak pindah) -->
    @if($attendances->hasPages())
        <div class="mt-6">
            {{ $attendances->appends(request()->query())->links() }}
        </div>
    @endif

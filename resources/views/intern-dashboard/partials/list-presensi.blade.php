<div class="overflow-x-auto">
    <table class="w-full text-left border-collapse">
        @if ($presensi && !$presensi->isEmpty())
            <thead>
                <tr
                    class="border-b border-slate-200/80 text-[11px] font-extrabold text-slate-400 uppercase tracking-wider">
                    <th class="py-3 px-3">Tanggal</th>
                    <th class="py-3 px-3">Jam Masuk</th>
                    <th class="py-3 px-3">Jam Pulang</th>
                    <th class="py-3 px-3">Status</th>
                    <th class="py-3 px-3 text-center">Keterangan</th>
                    <th class="py-3 px-3 text-center">Lampiran</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs text-slate-700">
                @foreach ($presensi as $dataPresensi)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-3.5 px-3 font-bold text-slate-800">
                            {{ \Carbon\Carbon::parse($dataPresensi->date)->translatedFormat('l, d M Y') }}
                        </td>
                        <td
                            class="py-3.5 px-3 font-mono {{ $dataPresensi->check_in ? 'font-semibold text-emerald-700' : 'text-slate-400' }}">
                            {{ $dataPresensi->check_in ? \Carbon\Carbon::parse($dataPresensi->check_in)->format('H:i') . ' WIB' : '-' }}
                        </td>
                        <td
                            class="py-3.5 px-3 font-mono {{ $dataPresensi->check_out ? 'font-semibold text-emerald-700' : 'text-slate-400' }}">
                            {{ $dataPresensi->check_out ? \Carbon\Carbon::parse($dataPresensi->check_out)->format('H:i') . ' WIB' : '-' }}
                        </td>
                        <td class="py-3.5 px-3">
                            <span
                                class="inline-block text-[10px] font-bold px-2.5 py-0.5 rounded-md uppercase
                                            @if ($dataPresensi->status == 'hadir') bg-emerald-100 text-emerald-800
                                            @elseif($dataPresensi->status == 'alfa')
                                            bg-rose-100 text-rose-800
                                            @else
                                            bg-sky-100 text-sky-800 @endif">
                                {{ $dataPresensi->status }}
                            </span>
                        </td>
                        <td class="py-3.5 px-3">
                            <span class="text-xs text-muted font-bold text-center flex justify-center">
                                {{ $dataPresensi->notes ? $dataPresensi->notes : '-' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-3 text-center">
                            @if ($dataPresensi->surat_izin)
                                <a href="{{ \Illuminate\Support\Facades\Storage::disk('s3')->url($dataPresensi->surat_izin) }}"
                                    target="_blank" class="text-teal-700 font-bold hover:underline text-[11px]">Lihat
                                    Surat</a>
                            @else
                                <span class="text-slate-400 font-mono">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        @else
            <div class="py-6 text-center">
                <span
                    class="bg-rose-50 text-rose-800 text-xs font-semibold rounded-xl px-4 py-2 border border-rose-100">
                    Belum Ada Data Presensi Bulan Ini
                </span>
            </div>
        @endif
    </table>
</div>
@if ($presensi && $presensi->hasPages())
    <div class="mt-5 border-t border-slate-100 pt-4 pagination-links">
        {{ $presensi->links() }}
    </div>
@endif

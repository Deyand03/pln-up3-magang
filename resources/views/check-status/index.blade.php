@extends('layouts.base')
@section('title', 'Cek Status Pengajuan Magang')

@section('content')
    {{-- Notifikasi Toaster --}}
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


    <div class="min-h-[85vh] flex justify-center items-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50/50">
        <div
            class="w-full md:max-w-3xl max-w-md bg-white rounded-2xl p-6 sm:p-8 shadow-xl shadow-slate-200/60 border border-slate-200/80 text-center relative overflow-hidden transition-all">

            <div class="absolute -top-12 -left-12 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl pointer-events-none"></div>
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl pointer-events-none">
            </div>

            <div
                class="w-14 h-14 rounded-2xl bg-linear-to-br from-teal-500 to-teal-700 text-white flex items-center justify-center mx-auto mb-4 shadow-lg shadow-teal-600/20 shrink-0">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>

            <h2 class="text-xl sm:text-2xl font-black text-slate-800 leading-snug tracking-tight">
                Pengecekan Status<br />
                <span class="text-teal-700">Pengajuan Magang PLN UP3 Jambi</span>
            </h2>
            <p class="text-xs text-slate-500 mt-1.5 max-w-xs mx-auto leading-relaxed">
                Masukkan nomor pendaftaran Anda untuk memantau progress verifikasi berkas secara real-time.
            </p>


            {{-- Notifikasi jika no reg tidak ditemukan --}}
            @if (session('notFound'))
                <div
                    class="my-4 p-3.5 bg-rose-50 border border-rose-200/90 rounded-xl text-left flex items-start gap-3 animate-fade-in">
                    <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-xs font-medium text-rose-700 leading-snug">
                        {{ session('notFound') }}
                    </p>
                </div>
            @endif

            {{-- Form Pencarian Status --}}
            <form action="{{ route('check-status.check') }}" method="GET" class="mt-6 space-y-3">
                <div class="text-left">
                    @if (session('registration_number'))
                        <div
                            class="mb-3 p-3 bg-teal-50/90 border border-teal-200 rounded-xl flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2 pr-2 overflow-hidden">
                                <span
                                    class="inline-flex items-center justify-center w-6 h-6 rounded-lg bg-teal-600 text-white font-bold text-[10px] shrink-0">📋</span>
                                <div class="truncate">
                                    <span class="text-[10px] text-teal-800 font-bold block leading-tight">Nomor Pendaftaran
                                        Anda:</span>
                                    <span
                                        class="font-mono font-extrabold text-teal-950 text-xs sm:text-sm tracking-wider select-all truncate block">
                                        {{ session('registration_number') }}
                                    </span>
                                </div>
                            </div>
                            <button type="button" onclick="copyRegNumber('{{ session('registration_number') }}', this)"
                                class="px-3 py-1.5 bg-teal-600 hover:bg-teal-700 active:scale-95 text-white font-bold rounded-lg text-[11px] transition-all flex items-center gap-1 shrink-0 cursor-pointer shadow-xs">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 012-2v-8a2 2 0 01-2-2h-8a2 2 0 01-2 2v8a2 2 0 012 2z" />
                                </svg>
                                <span>Salin</span>
                            </button>
                        </div>
                    @endif

                    <label for="registration_number"
                        class="block text-[11px] font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nomor Pendaftaran
                    </label>
                    <div class="relative">
                        <input type="text" name="registration_number" id="registration_number"
                            value="{{ request('registration_number') }}" placeholder="Contoh: PLN-MG-20260921-A1B2" required
                            class="w-full text-xs font-mono uppercase tracking-wider px-4 py-3 rounded-xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all placeholder:text-slate-400 placeholder:normal-case placeholder:tracking-normal font-semibold text-slate-800" />

                        @if (request('registration_number'))
                            <a href="{{ route('check-status') }}"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs font-semibold">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 active:scale-98 text-white font-bold text-xs py-3 px-4 rounded-xl shadow-sm shadow-teal-700/20 transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cek Status Pengajuan
                </button>
            </form>

            {{-- Menampilkan Status Dokumen --}}
            @if ($application ?? null)
                <div class="mt-6 pt-5 border-t border-slate-100">
                    <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block mb-2">Status Saat
                        Ini</span>

                    @if ($application->status === 'pending')
                        <div
                            class="bg-amber-50 border border-amber-200/80 rounded-xl py-2.5 px-4 text-amber-800 text-xs font-bold inline-flex items-center justify-center gap-2 shadow-xs w-full">
                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                            Dokumen Dalam Proses Verifikasi HRD
                        </div>
                    @elseif($application->status === 'approved')
                        <div
                            class="bg-emerald-50 border border-emerald-200/80 rounded-xl py-3 px-4 text-emerald-800 text-xs font-bold shadow-xs w-full text-left space-y-2">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Pengajuan Magang Disetujui!</span>
                            </div>

                            @if ($application->registration_token)
                                <div class="pt-2 border-t border-emerald-200/60 text-[11px] font-normal text-emerald-950">
                                    <p>Gunakan Token Pendaftaran berikut untuk membuat akun mahasiswa:</p>
                                    <div
                                        class="bg-white border border-emerald-300 font-mono font-extrabold text-sm text-center py-1.5 rounded-lg my-1.5 select-all text-emerald-900">
                                        {{ $application->registration_token }}
                                    </div>
                                    <p class="text-[10px] text-emerald-700">Kuota: {{ $application->token_used }} /
                                        {{ $application->token_quota }} Akun Terdaftar
                                    </p>
                                </div>
                            @endif
                        </div>
                    @elseif($application->status === 'rejected')
                        <div
                            class="bg-rose-50 border border-rose-200/80 rounded-xl py-3 px-4 text-rose-800 text-xs font-bold shadow-xs w-full text-left">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Pengajuan Ditolak</span>
                            </div>
                            @if ($application->notes)
                                <p class="text-[11px] font-normal text-rose-700 mt-1 pl-6">
                                    Catatan: {{ $application->notes }}
                                </p>
                            @endif
                        </div>
                    @elseif($application->status === 'revision')
                        <div
                            class="bg-yellow-50 border border-yellow-200/80 rounded-xl py-3 px-4 text-yellow-800 text-xs font-bold shadow-xs w-full text-left">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-yellow-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Pengajuan Belum Dapat Disetujui</span>
                            </div>
                            @if ($application->notes)
                                <p class="text-[11px] font-normal text-yellow-700 mt-1 pl-6">
                                    Catatan: {{ $application->notes }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Menampikan Timeline Status Dokumen --}}
                <div
                    class="mt-6 text-left space-y-4 relative before:absolute before:left-3.5 before:top-3 before:bottom-3 before:w-0.5 before:bg-slate-200">
                    {{-- Dokumen Diajukan --}}
                    <div class="relative flex items-start gap-3">
                        <div
                            class="w-7 h-7 rounded-full bg-teal-600 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs">
                            ✓
                        </div>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/80 w-full">
                            <div class="flex items-center justify-between">
                                <p class="text-xs font-bold text-slate-800">Dokumen Diajukan</p>
                                <span
                                    class="text-[10px] text-slate-400 font-mono">{{ $application->created_at->format('d/m/Y') }}</span>
                            </div>
                            <p class="text-[11px] text-slate-500 mt-0.5">Dokumen pengajuan Anda berhasil terkirim dan
                                tercatat di sistem.</p>
                        </div>
                    </div>

                    {{-- Verifikasi Dokumen --}}
                    <div class="relative flex items-start gap-3">
                        @if ($application->status === 'pending')
                            <div
                                class="w-7 h-7 rounded-full bg-amber-500 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs animate-pulse">
                                2
                            </div>
                            <div class="bg-amber-50/50 p-3 rounded-xl border border-amber-200/80 w-full">
                                <p class="text-xs font-bold text-amber-900">Verifikasi Berkas</p>
                                <p class="text-[11px] text-amber-700 mt-0.5">Tim HRD PLN UP3 Jambi sedang meninjau berkas &
                                    kuota divisi.</p>
                            </div>
                        @else
                            <div
                                class="w-7 h-7 rounded-full bg-teal-600 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs">
                                ✓
                            </div>
                            <div class="bg-slate-50 p-3 rounded-xl border border-slate-200/80 w-full">
                                <p class="text-xs font-bold text-slate-800">Verifikasi Berkas Selesai</p>
                                <p class="text-[11px] text-slate-500 mt-0.5">Pemeriksaan berkas dan kuota unit kerja telah
                                    selesai.</p>
                            </div>
                        @endif
                    </div>

                    {{-- Hasil Keputusan --}}
                    <div class="relative flex items-start gap-3">
                        @if ($application->status === 'pending')
                            <div
                                class="w-7 h-7 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white">
                                3
                            </div>
                            <div class="bg-slate-50/50 p-3 rounded-xl border border-slate-200/50 w-full opacity-60">
                                <p class="text-xs font-bold text-slate-700">Hasil Keputusan</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Surat penerimaan & token registrasi akun
                                    magang.</p>
                            </div>
                        @elseif($application->status === 'approved')
                            <div
                                class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs">
                                ✓
                            </div>
                            <div class="bg-emerald-50/50 p-3 rounded-xl border border-emerald-200/80 w-full">
                                <p class="text-xs font-bold text-emerald-900">Diterima Magang</p>
                                <p class="text-[11px] text-emerald-700 mt-0.5">Silakan gunakan token di atas untuk
                                    mendaftarkan akun magang kelompok Anda.</p>
                            </div>
                        @elseif($application->status === 'revision')
                            <div
                                class="w-7 h-7 rounded-full bg-rose-600 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs">
                                ✕
                            </div>
                            <div class="bg-rose-50/50 p-3 rounded-xl border border-rose-200/80 w-full">
                                <p class="text-xs font-bold text-rose-900">Data Anda Bermasalah</p>
                                <p class="text-[11px] text-rose-700 mt-0.5">Mohon maaf, Silahkan Perbaiki data anda</p>
                            </div>
                        @elseif($application->status === 'rejected')
                            <div
                                class="w-7 h-7 rounded-full bg-rose-600 text-white flex items-center justify-center shrink-0 z-10 text-xs font-bold ring-4 ring-white shadow-xs">
                                ✕
                            </div>
                            <div class="bg-rose-50/50 p-3 rounded-xl border border-rose-200/80 w-full">
                                <p class="text-xs font-bold text-rose-900">Pengajuan Ditolak</p>
                                <p class="text-[11px] text-rose-700 mt-0.5">{{ $application->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($application->status === 'approved')
                    <div class="flex justify-center pt-3">
                        <a href="{{ route('register') }}"
                            class="bg-teal-600 py-3 text-xs tracking- text-white font-bold rounded-xl w-full shadow hover:shadow-lg shadow-teal-500/30 hover:bg-teal-700 active:scale-95 duration-300 transition-all transform-gpu">
                            Buat Akun
                        </a>
                    </div>
                @elseif($application->status === 'revision')
                    <form action="{{ route('check-status.update-dokumen', $application->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="flex flex-col gap-3 mt-3">
                            <div class="flex">
                                <div class="bg-white w-full rounded-2xl p-4 shadow-soft border border-slate-200/80 mb-5">
                                    <div class="flex items-center gap-2 pb-2 mb-3 border-b border-slate-100">
                                        <span class="text-xs font-bold text-slate-800">Unggah Berkas Dokumen</span>
                                    </div>
                                    <div class="flex gap-5">
                                        <!-- Upload Box 1: Surat Rekomendasi -->
                                        <div class="mb-2 w-1/2">
                                            <div class="flex items-center justify-between mb-1">
                                                <label class="text-[11px] font-semibold text-slate-700">Surat Rekomendasi <span
                                                        class="text-rose-500 font-bold">(wajib)</span></label>
                                            </div>

                                            <!-- Area Dropzone Default -->
                                            <label for="recommendation_letter" id="dropzone_rec"
                                                class="border-2 border-dashed border-teal-200/90 hover:border-teal-500 bg-teal-50/30 hover:bg-teal-50/60 rounded-xl p-4 text-center cursor-pointer transition-all {{ !empty($application->recommendation_letter) ? 'hidden' : 'block' }}">
                                                <input type="file" name="recommendation_letter" id="recommendation_letter"
                                                    accept=".pdf" class="hidden" {{ empty($application->recommendation_letter) ? 'required' : '' }}
                                                    onchange="handleFileSelect(this, 'preview_rec', 'dropzone_rec')" />
                                                <div
                                                    class="w-8 h-8 rounded-full bg-teal-100/80 text-teal-700 flex items-center justify-center mx-auto mb-1.5">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                </div>
                                                <p class="text-xs font-semibold text-slate-700">Klik untuk pilih file atau <span
                                                        class="text-teal-700 underline">browse</span></p>
                                                <p class="text-[10px] text-slate-400 mt-0.5">Maksimal file 2 MB | Format PDF</p>
                                            </label>

                                            <!-- Card Preview File (Muncul Saat File Dipilih) -->
                                            <div id="preview_rec"
                                                class="{{ !empty($application->recommendation_letter) ? 'flex' : 'hidden' }} items-center justify-between pr-3 bg-teal-50/40 border border-teal-200 hover:border-teal-500 rounded-xl transition-all">
                                                <a href="{{ Storage::url($application->recommendation_letter) }}" target="_blank"
                                                    class="cursor-pointer p-3 flex items-center gap-3 overflow-hidden">
                                                    <div
                                                        class="w-9 h-9 rounded-lg bg-rose-50 border border-rose-100 text-rose-600 flex flex-col items-center justify-center shrink-0 shadow-xs">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM14 9V3.5L18.5 8H14z" />
                                                        </svg>
                                                        <span class="text-[7px] font-bold -mt-0.5">PDF</span>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p id="filename_rec" class="text-xs font-bold text-slate-800 truncate">
                                                            {{ !empty($application->recommendation_letter) ? 'Surat_Rekomendasi_Lama.pdf' : 'nama_file.pdf' }}
                                                        </p>
                                                        <p id="filesize_rec"
                                                            class="text-[10px] text-slate-400 font-semibold mt-0.5">
                                                            {{ !empty($application->recommendation_letter) ? 'Dokumen tersimpan' : '0 MB • Berhasil dipilih' }}
                                                        </p>
                                                    </div>
                                                </a>
                                                <button type="button"
                                                    onclick="removeFile('recommendation_letter', 'preview_rec', 'dropzone_rec')"
                                                    class="text-slate-400 hover:text-rose-500 p-1.5 rounded-lg hover:bg-rose-50 transition-colors shrink-0"
                                                    title="Hapus berkas">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Upload Box 2: Proposal Magang/CV -->
                                        <div class="mb-2 w-1/2">
                                            <div class="flex items-center justify-between mb-1">
                                                <label class="text-[11px] font-semibold text-slate-700">Proposal Magang / CV <span
                                                        class="text-slate-400 font-normal">(opsional)</span></label>
                                            </div>

                                            <!-- Area Dropzone Default -->
                                            <label for="proposal" id="dropzone_prop"
                                                class="border-2 border-dashed border-teal-200/90 hover:border-teal-500 bg-teal-50/30 hover:bg-teal-50/60 rounded-xl p-4 text-center cursor-pointer transition-all {{ !empty($application->proposal) ? 'hidden' : 'block' }}">
                                                <input type="file" name="proposal" id="proposal" accept=".pdf" class="hidden"
                                                    onchange="handleFileSelect(this, 'preview_prop', 'dropzone_prop')" />
                                                <div
                                                    class="w-8 h-8 rounded-full bg-teal-100/80 text-teal-700 flex items-center justify-center mx-auto mb-1.5">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                    </svg>
                                                </div>
                                                <p class="text-xs font-semibold text-slate-700">Klik untuk pilih file atau <span
                                                        class="text-teal-700 underline">browse</span></p>
                                                <p class="text-[10px] text-slate-400 mt-0.5">Maksimal file 2 MB | Format PDF</p>
                                            </label>

                                            <!-- Card Preview File (Muncul Saat File Dipilih) -->
                                            <div id="preview_prop"
                                                class="{{ !empty($application->proposal) ? 'flex' : 'hidden' }} items-center justify-between bg-teal-50/40 border border-teal-200 rounded-xl p-3 transition-all">
                                                <a href="{{ $application->proposal ? Storage::url($application->proposal) : '#' }}"
                                                    class="flex items-center gap-3 overflow-hidden">
                                                    <div
                                                        class="w-9 h-9 rounded-lg bg-rose-50 border border-rose-100 text-rose-600 flex flex-col items-center justify-center shrink-0 shadow-xs">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                            <path
                                                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM14 9V3.5L18.5 8H14z" />
                                                        </svg>
                                                        <span class="text-[7px] font-bold -mt-0.5">PDF</span>
                                                    </div>
                                                    <div class="min-w-0">
                                                        <p id="filename_prop" class="text-xs font-bold text-slate-800 truncate">
                                                            {{ !empty($application->proposal) ? 'Surat_Rekomendasi_Lama.pdf' : 'nama_file.pdf' }}
                                                        </p>
                                                        <p id="filesize_prop"
                                                            class="text-[10px] text-slate-400 font-semibold mt-0.5">
                                                            {{ !empty($application->proposal) ? 'Dokumen tersimpan' : '0 MB • Berhasil dipilih' }}
                                                        </p>
                                                    </div>
                                                </a>
                                                <button type="button"
                                                    onclick="removeFile('proposal', 'preview_prop', 'dropzone_prop')"
                                                    class="text-slate-400 hover:text-rose-500 p-1.5 rounded-lg hover:bg-rose-50 transition-colors shrink-0"
                                                    title="Hapus berkas">
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div>
                                <button type="submit"
                                    class="w-full bg-teal-600 hover:bg-teal-600 active:scale-95 text-white font-bold text-xs py-3.5 px-4 rounded-xl shadow-lg shadow-teal-700/20 transition-all flex items-center justify-center gap-2">
                                    <span>Submit Perubahan</span>
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            @else
                {{-- Default State --}}
                <div class="mt-8 pt-4 border-t border-slate-100 text-slate-400 text-[11px]">
                    <p class="flex items-center justify-center gap-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pastikan format nomor pendaftaran benar (contoh: <code
                            class="font-mono text-slate-600">PLN-MG-...</code>)
                    </p>
                </div>
            @endif
        </div>
    </div>
    @push('scripts')
        <script>
            function copyRegNumber(text, btn) {
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(text);
                } else {
                    let textArea = document.createElement("textarea");
                    textArea.value = text;
                    textArea.style.position = "fixed";
                    textArea.style.left = "-999999px";
                    document.body.appendChild(textArea);
                    textArea.focus();
                    textArea.select();
                    document.execCommand('copy');
                    textArea.remove();
                }

                // Visual feedback pada tombol salin
                const originalHTML = btn.innerHTML;
                btn.innerHTML = `
                                                                                                            <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                                                                                            </svg>
                                                                                                            <span>Tersalin!</span>`;
                btn.classList.remove('bg-teal-600', 'hover:bg-teal-700');
                btn.classList.add('bg-emerald-700');

                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                    btn.classList.remove('bg-emerald-700');
                    btn.classList.add('bg-teal-600', 'hover:bg-teal-700');
                }, 2500);
            }

            function handleFileSelect(input, previewId, dropzoneId) {
                if (input.files && input.files[0]) {
                    const file = input.files[0];

                    // Format ukuran file (KB / MB)
                    let sizeFormatted = '';
                    if (file.size < 1024 * 1024) {
                        sizeFormatted = (file.size / 1024).toFixed(1) + ' KB';
                    } else {
                        sizeFormatted = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                    }

                    // Dapatkan identifier key (rec / prop)
                    const key = previewId.replace('preview_', '');

                    // Set nama file dan ukuran
                    document.getElementById('filename_' + key).innerText = file.name;

                    const fileSizeEl = document.getElementById('filesize_' + key);
                    fileSizeEl.innerText = sizeFormatted + ' • Berhasil dipilih';

                    fileSizeEl.classList.remove('text-slate-400');
                    fileSizeEl.classList.add('text-teal-700');

                    // Sembunyikan dropzone & tampilkan card preview
                    const dropzone = document.getElementById(dropzoneId);
                    if (dropzone) {
                        dropzone.classList.add('hidden');
                        dropzone.classList.remove('block');
                    }

                    const preview = document.getElementById(previewId);
                    if (preview) {
                        preview.classList.remove('hidden');
                        preview.classList.add('flex');
                    }
                }
            }

            function removeFile(inputId, previewId, dropzoneId) {
                const input = document.getElementById(inputId);
                if (input) input.value = '';

                const key = previewId.replace('preview_', '');

                const preview = document.getElementById(previewId);
                if (preview) {
                    preview.classList.add('hidden');
                    preview.classList.remove('flex');
                }

                const dropzone = document.getElementById(dropzoneId);
                if (dropzone) {
                    dropzone.classList.remove('hidden');
                    dropzone.classList.add('block');
                }

                const fileSizeEl = document.getElementById('filesize_' + key);
                if (fileSizeEl) {
                    fileSizeEl.innerText = "0 KB • Belum dipilih";
                    fileSizeEl.classList.remove('text-teal-700');
                    fileSizeEl.classList.add('text-slate-400');
                }
            }
        </script>
    @endpush
@endsection

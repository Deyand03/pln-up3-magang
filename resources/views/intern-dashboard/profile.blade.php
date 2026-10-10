@extends('layouts.base')
@section('title', 'Profile')
@section('content')
    <div class="font-sans antialiased text-slate-800 bg-slate-50/80 min-h-screen flex flex-col selection:bg-teal-500 selection:text-white pb-16"
        x-data="{ foto_profil: {{ Auth::user()->internship->foto_profil ?? null }} }">
        {{-- Main Profil Container --}}
        <main class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-6 sm:pt-8">
            {{-- Notifikasi --}}
            @if(session('success'))
                <div
                    class="toast-notif mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-800 text-xs font-bold flex items-center gap-3 shadow-sm animate-fade-in-down">
                    <span class="flex items-center justify-center bg-emerald-100 text-emerald-600">✅</span>
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div
                    class="toast-notif mb-6 p-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-800 text-xs font-bold flex items-center gap-3 shadow-sm animate-fade-in-down">
                    <span class="flex items-center justify-center bg-rose-100 text-rose-600 toast-notif">⚠️</span>
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex flex-col lg:grid lg:grid-cols-12 gap-6 items-start">
                {{-- Kolom Kiri foto dan informasi singkat --}}
                <div class="w-full lg:col-span-4 space-y-6">
                    {{-- ID Card --}}
                    <div
                        class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs relative overflow-hidden text-center group">
                        <div class="absolute top-0 inset-x-0 h-32 bg-linear-to-br from-teal-700 via-teal-800 to-slate-900">
                        </div>
                        <div
                            class="absolute top-0 inset-x-0 h-32 opacity-10 pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] bg-size-[12px_12px]">
                        </div>
                        {{-- Logo PLN --}}
                        <div class="absolute top-4 right-4">
                            <img src="{{ asset('img/logo_pln.png') }}" alt="" class="w-16 aspect-auto">
                        </div>
                        {{-- Foto Profil --}}
                        <div class="relative w-28 h-28 mx-auto mt-10 mb-4 z-10">
                            <div
                                class="w-full h-full rounded-2xl bg-slate-100 border-4 border-white shadow-lg overflow-hidden flex items-center justify-center">
                                @if(Auth::user()->foto_profil ?? false)
                                    <img src="{{ asset(Auth::user()->foto_profil) }}" alt="Foto"
                                        class="w-full h-full object-cover">
                                @else
                                    <span
                                        class="text-4xl font-black text-slate-300">{{ strtoupper(substr(Auth::user()->name ?? 'N/A', 0, 2)) }}</span>
                                @endif
                            </div>

                            <button
                                class="absolute -bottom-2 -right-2 w-10 h-10 bg-amber-400 hover:bg-amber-500 text-amber-900 rounded-full border-4 border-white shadow-md flex items-center justify-center transition-transform active:scale-95"
                                title="Ubah Foto Profil">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pen-fill" viewBox="0 0 16 16">
                                    <path
                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                                </svg>
                            </button>
                        </div>

                        <h2 class="text-xl font-black text-slate-900 tracking-tight">{{ Auth::user()->name ?? 'N/A' }}
                        </h2>
                        <p class="text-xs text-teal-700 font-bold mt-1 mb-4">Divisi
                            {{ Auth::user()->internship->department ?? 'N/A' }}
                        </p>

                        <div class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-bold
                                            {{ Auth::user()->internship->status == 'active' ? 'bg-emerald-50 border border-emerald-100 text-emerald-700' : 'bg-rose-50 border border-rose-100 text-rose-700' }}
                                        ">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Status Magang: {{ Auth::user()->internship->status == 'active' ? 'Aktif' : 'Selesai' }}
                        </div>
                    </div>

                    {{-- Info Magang --}}
                    <div
                        class="bg-linear-to-br from-slate-900 via-slate-800 to-teal-950 rounded-3xl p-6 border border-slate-700/80 text-white shadow-xl relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-teal-500/20 blur-2xl rounded-full"></div>

                        <h3 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-4">Informasi Magang
                        </h3>

                        <div class="space-y-4 relative z-10">
                            <div>
                                <span class="text-[10px] text-slate-400 block mb-0.5">Asal Instansi</span>
                                <span
                                    class="text-sm font-bold text-white leading-tight block">{{ $application->institusi ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-400 block mb-0.5">Jurusan / Program Studi</span>
                                <span
                                    class="text-sm font-bold text-teal-300 leading-tight block">{{ $application->program_studi ?? 'N/A' }}</span>
                            </div>
                            <div class="pt-4 border-t border-slate-700/80">
                                <span class="text-[10px] text-slate-400 block mb-1">Periode Pelaksanaan</span>
                                <div class="flex items-center gap-2">
                                    <span
                                        class="bg-white/10 px-2.5 py-1 rounded-md text-[11px] font-bold font-mono">{{ \Carbon\Carbon::parse($application->start_date)->translatedFormat('d F Y') }}</span>
                                    <span class="text-slate-500">→</span>
                                    <span
                                        class="bg-white/10 px-2.5 py-1 rounded-md text-[11px] font-bold font-mono">{{ \Carbon\Carbon::parse($application->end_date)->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Data Pribadi dan Setting --}}
                <div class="w-full lg:col-span-8 space-y-6">
                    {{-- Data Pribadi --}}
                    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs relative">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900">Data Pribadi</h3>
                                <p class="text-[11px] text-slate-500">Informasi kontak dan identitas akun Anda</p>
                            </div>
                            <span class="p-2 bg-teal-50 text-teal-700 rounded-xl">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                </svg>
                            </span>
                        </div>

                        <form action="{{ route('profile-intern.editBio') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('patch')

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {{-- Input Nama --}}
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                        class="w-full text-xs px-3.5 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-semibold text-slate-800"
                                        readonly>
                                    <span class="text-[9px] text-slate-400 mt-1 block">*Nama tidak dapat diubah (sesuai
                                        pengajuan)</span>
                                </div>

                                {{-- Input NIM/NISN --}}
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-700 mb-1.5">NIM / NISN</label>
                                    <input type="text" name="nim_nisn" value="{{ Auth::user()->internship->nim_nisn }}"
                                        class="w-full text-xs px-3.5 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-mono font-bold text-slate-800"
                                        readonly>
                                </div>

                                {{-- Input Email --}}
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Alamat E-mail</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="w-full text-xs px-3.5 py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-semibold text-slate-800">
                                </div>

                                {{-- Input No HP --}}
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-700 mb-1.5">Nomor Handphone
                                        (WA)</label>
                                    <input type="tel" name="phone" value="{{ Auth::user()->phone }}"
                                        class="w-full text-xs px-3.5 py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-semibold text-slate-800">
                                </div>
                            </div>

                            <div class="pt-4 flex justify-end border-t border-slate-100 mt-2">
                                <button type="submit"
                                    class="bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs py-2.5 px-6 rounded-xl shadow-md shadow-teal-700/20 active:scale-95 transition-all">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Mentor --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div
                            class="flex flex-col justify-between bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs space-y-4 w-full">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-teal-100 border border-teal-200 text-teal-800 font-black flex items-center justify-center text-base shrink-0 shadow-xs">
                                    👨‍💼
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-teal-700 uppercase tracking-wider block">Mentor
                                        Pembimbing</span>
                                    <h3 class="text-sm font-extrabold text-slate-900">
                                        {{ $dataMentor->name ?? 'Belum ada Mentor' }}
                                    </h3>
                                    <span class="text-[11px] text-slate-500">Supervisor Divisi
                                        {{ Auth::user()->internship->department ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <p
                                class="text-xs text-slate-600 leading-relaxed bg-slate-50 p-3 rounded-2xl border border-slate-100">
                                Memiliki kendala atau ingin konsultasi terkait laporan kegiatan harian? Hubungi mentor Anda.
                            </p>
                            @php
                                $waLink = '#';
                                if ($dataMentor && !empty($dataMentor->phone)) {
                                    $formattedPhone = preg_replace(
                                        '/^0/',
                                        '62',
                                        preg_replace('/[^0-9]/', '', $dataMentor->phone),
                                    );
                                    $waLink = 'https://wa.me/' . $formattedPhone;
                                }
                            @endphp
                            <a href="{{ $waLink }}" target="_blank" @if (!$dataMentor || empty($dataMentor->phone))
                            onclick="alert('Nomor WhatsApp mentor belum tersedia!'); return false;" @endif
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs py-3 px-4 rounded-xl shadow-md shadow-emerald-600/20 transition-all inline-flex items-center justify-center gap-2 active:scale-98 @if (!$dataMentor || empty($dataMentor->phone)) opacity-50 cursor-not-allowed @endif">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z" />
                                </svg>
                                <span>Hubungi Mentor via WhatsApp</span>
                            </a>
                        </div>

                        <!-- Ganti Password Card -->
                        <div class="bg-white border border-slate-200/80 rounded-3xl p-6 shadow-xs relative">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <h3 class="text-sm font-extrabold text-slate-900">Keamanan Akun</h3>
                            </div>

                            <form action="{{ route('password.update') }}" method="POST" class="space-y-3">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block text-[10px] font-bold text-slate-700 mb-1" for="password">Password Baru</label>
                                    <input type="password" id="password" name="password" placeholder="Minimal 8 karakter"
                                        class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-medium">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-700 mb-1" for="password_confirmation">Konfirmasi Password
                                        Baru</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password"
                                        class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-medium">
                                </div>

                                <button type="submit"
                                    class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold text-[11px] py-2.5 px-4 rounded-xl transition-all active:scale-95 mt-1">
                                    Perbarui Password
                                </button>
                            </form>
                        </div>

                    </div>

                    <!-- Danger Zone / Keluar -->
                    <div
                        class="bg-white border border-rose-100 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">Sesi Akun</h4>
                            <p class="text-[10px] text-slate-500">Keluar dari perangkat ini untuk mengakhiri sesi magang
                                Anda.</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-[11px] py-2 px-5 rounded-lg border border-rose-200 transition-colors whitespace-nowrap">
                                Keluar Akun
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <dialog id="modal_ubah_foto" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box bg-white border border-slate-200">
            <h3 class="font-extrabold text-lg text-slate-900">Ubah Foto Profil</h3>
            <p class="py-2 text-xs text-slate-500">Pilih foto terbaikmu untuk ditampilkan di ID Card & sistem.</p>

            <!-- Preview Area -->
            <div class="flex justify-center my-6">
                <div
                    class="relative w-36 h-36 rounded-2xl bg-slate-50 border-4 border-slate-200 overflow-hidden shadow-inner flex items-center justify-center">
                    <img id="avatar-preview"
                        src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : 'https://placehold.co/150x150/e2e8f0/64748b?text=Preview' }}"
                        alt="Preview" class="w-full h-full object-cover transition-all duration-300">
                </div>
            </div>

            <!-- Form Input (Nanti JS handle action-nya) -->
            <form id="form-update-avatar" class="space-y-4">
                <div>
                    <!-- Menggunakan komponen file-input bawaan DaisyUI -->
                    <input type="file" id="input-file-avatar" name="avatar" accept="image/png, image/jpeg, image/jpg"
                        class="file-input file-input-bordered file-input-info w-full text-xs text-slate-700 bg-slate-50 focus:outline-none" />
                    <span class="text-[10px] text-slate-400 block mt-1.5">*Format didukung: JPG, JPEG, PNG (Maks 2MB)</span>
                </div>
            </form>

            <div class="modal-action">
                <!-- Tombol Batal akan menutup modal bawaan DaisyUI -->
                <form method="dialog">
                    <button
                        class="btn btn-sm sm:btn-md btn-ghost text-slate-600 hover:bg-slate-100 font-bold">Batal</button>
                </form>
                <!-- Tombol Simpan (Id untuk nanti dikaitkan dengan AJAX) -->
                <button type="button" id="btn-save-avatar"
                    class="btn btn-sm sm:btn-md bg-teal-600 hover:bg-teal-700 text-white border-none shadow-md font-bold">
                    Simpan Foto
                </button>
            </div>
        </div>

        <!-- Backdrop klik luar untuk menutup modal -->
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
    @push('scripts')
        <script>
            const $ = (e) => {
                return document.querySelector(e);
            }

            const dismissToast = () => {
                const notifToast = document.querySelectorAll('.toast-notif');
                if (notifToast) {
                    notifToast.forEach(e => {
                        e.classList.add('transition-all', 'duration-400')
                        e.classList.add('-translate-y-10', 'opacity-0')
                        setTimeout(() => {
                            e.remove()
                        }, 300);
                    });
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                if ("{{ session('success') }}") {
                    setTimeout(() => {
                        dismissToast();
                    }, 5000);
                }
            })

        </script>
    @endpush
@endsection

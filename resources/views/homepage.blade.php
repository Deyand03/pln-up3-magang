@extends('layouts.base')
@section('title', 'Homepage')
@section('content')
    {{-- ========== HERO SECTION ========== --}}
    <section
        class="relative bg-linear-to-b from-[#54B79A] to-[#2F698B] pt-16 overflow-hidden min-h-screen flex flex-col justify-between">

        {{-- Background Decorative Image (Desktop Overlay) --}}
        <img src="{{ asset('img/footer_hero.png') }}" alt=""
            class="absolute inset-0 w-full h-full object-cover opacity-25 pointer-events-none hidden md:block select-none" />

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full my-auto pt-8 pb-12">
            <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">

                {{-- Hero Illustration --}}
                <div class="flex-1 flex justify-center fade-up w-full order-1 lg:order-2">
                    <div class="relative w-full max-w-md lg:max-w-lg">
                        <img src="{{ asset('img/hero_image.png') }}" alt="Hero Illustration"
                            class="relative z-10 w-full h-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500">
                    </div>
                </div>

                {{-- Hero Text & Actions --}}
                <div class="flex-1 text-center lg:text-left fade-up order-2 lg:order-1" style="transition-delay: 0.2s">
                    <span
                        class="inline-block text-white/90 text-xs sm:text-sm font-semibold tracking-wider uppercase mb-3 bg-white/10 px-4 py-1.5 rounded-full border border-white/20 backdrop-blur-md shadow-sm">
                        Selamat Datang di
                    </span>

                    <h1
                        class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white mb-5 leading-tight tracking-tight">
                        Sistem <span class="text-teal-200 drop-shadow-md">Magang</span>
                    </h1>

                    <p
                        class="text-teal-50 font-medium text-base md:text-lg mb-8 max-w-lg mx-auto lg:mx-0 leading-relaxed opacity-90">
                        Silahkan ajukan proposal dan surat magang anda.
                    </p>

                    {{-- Action Buttons --}}
                    <div
                        class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start w-full sm:w-auto">
                        <a href="{{ route('form-pengajuan') }}"
                            class="w-full sm:w-auto px-8 py-3.5 bg-white text-teal-900 font-bold rounded-xl text-sm md:text-base text-center transition-all duration-300 shadow-xl hover:bg-teal-50 hover:-translate-y-1 active:scale-95 text-nowrap">
                            Ajukan Magang
                        </a>

                        <a href="{{ route('check-status') }}"
                            class="w-full sm:w-auto px-8 py-3.5 bg-white/10 border border-white/40 text-white font-bold rounded-xl text-sm md:text-base text-center transition-all duration-300 backdrop-blur-md shadow-lg hover:bg-white/20 hover:border-white hover:-translate-y-1 active:scale-95">
                            Cek Status
                        </a>
                    </div>
                </div>

            </div>
        </div>

        {{-- Footer Decorative Image (Mobile Bottom Background) --}}
        <div class="relative w-full md:hidden pointer-events-none opacity-40 mt-auto">
            <img src="{{ asset('img/footer_hero.png') }}" alt="" class="w-full h-auto object-cover">
        </div>

    </section>

    {{-- ========== INFORMASI MAGANG ========== --}}
    <section class="py-16 md:py-24 bg-white" id="informasi">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Title --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#2F698B] mb-4 tracking-tight">Informasi Magang</h2>
                <div class="w-20 h-1.5 bg-linear-to-r from-sky-400 to-blue-600 mx-auto rounded-full"></div>
            </div>

            {{-- Stats Cards (Diubah menjadi Row rata untuk Mobile & Desktop) --}}
            <div class="flex flex-row justify-center items-start gap-3 sm:gap-6 md:gap-12 pb-16 max-w-4xl mx-auto">

                {{-- Stat 1 --}}
                <div class="flex-1 flex flex-col items-center gap-2 sm:gap-4 group">
                    <span
                        class="text-[#2F698B] text-center text-[10px] sm:text-xs md:text-sm font-bold uppercase tracking-tight sm:tracking-wide h-8 flex items-center justify-center leading-tight">Jumlah
                        Pemagang Saat Ini</span>
                    <div
                        class="bg-linear-to-br from-[#2F698B] to-[#1F4961] w-full max-w-[120px] sm:max-w-[140px] aspect-square rounded-xl sm:rounded-2xl shadow-lg flex flex-col justify-center items-center group-hover:-translate-y-2 group-hover:shadow-xl transition-all duration-300">
                        <span class="font-extrabold text-3xl sm:text-4xl md:text-5xl text-white">10</span>
                        <p class="font-medium text-[10px] sm:text-xs md:text-sm text-white/80 mt-1">Orang</p>
                    </div>
                </div>

                {{-- Stat 2 --}}
                <div class="flex-1 flex flex-col items-center gap-2 sm:gap-4 group">
                    <span
                        class="text-[#2F698B] text-center text-[10px] sm:text-xs md:text-sm font-bold uppercase tracking-tight sm:tracking-wide h-8 flex items-center justify-center leading-tight">Rata-rata
                        Durasi Magang</span>
                    <div
                        class="bg-linear-to-br from-[#2F698B] to-[#1F4961] w-full max-w-[120px] sm:max-w-[140px] aspect-square rounded-xl sm:rounded-2xl shadow-lg flex flex-col justify-center items-center group-hover:-translate-y-2 group-hover:shadow-xl transition-all duration-300">
                        <span class="font-extrabold text-3xl sm:text-4xl md:text-5xl text-white">3.4</span>
                        <p class="font-medium text-[10px] sm:text-xs md:text-sm text-white/80 mt-1">Bulan</p>
                    </div>
                </div>

                {{-- Stat 3 --}}
                <div class="flex-1 flex flex-col items-center gap-2 sm:gap-4 group">
                    <span
                        class="text-[#2F698B] text-center text-[10px] sm:text-xs md:text-sm font-bold uppercase tracking-tight sm:tracking-wide h-8 flex items-center justify-center leading-tight">Posisi
                        Yang Tersedia</span>
                    <div
                        class="bg-linear-to-br from-[#2F698B] to-[#1F4961] w-full max-w-[120px] sm:max-w-[140px] aspect-square rounded-xl sm:rounded-2xl shadow-lg flex flex-col justify-center items-center group-hover:-translate-y-2 group-hover:shadow-xl transition-all duration-300">
                        <span class="font-extrabold text-3xl sm:text-4xl md:text-5xl text-white">0</span>
                        <p class="font-medium text-[10px] sm:text-xs md:text-sm text-white/80 mt-1">Posisi</p>
                    </div>
                </div>

            </div>

            {{-- Description --}}
            <div class="max-w-4xl mx-auto hover:shadow-lg transition-shadow duration-300 rounded-3xl"
                style="transition-delay: 0.3s">
                <div
                    class="bg-linear-to-br from-gray-50 to-white rounded-3xl p-6 sm:p-8 md:p-10 border border-gray-100 shadow-sm relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-32 h-32 bg-blue-50 rounded-full blur-3xl -ml-10 -mb-10 pointer-events-none">
                    </div>

                    <div class="relative z-10">
                        <p
                            class="text-base md:text-lg text-[#2F698B] mb-5 leading-relaxed font-bold text-center sm:text-left">
                            Informasi mengenai magang <strong class="text-[#54B79A] uppercase">PLN UP3 JAMBI</strong> hanya
                            ada di website ini nantikan untuk program lainnya.
                        </p>
                        <p class="text-sm md:text-base text-[#2F698B]/80 mb-5 leading-relaxed text-justify">
                            Kami percaya bahwa magang adalah proses belajar terbaik sebelum memasuki dunia kerja
                            sesungguhnya. Oleh karena itu, lowongan ini terbuka bagi siswa/mahasiswa dari berbagai latar
                            belakang yang memiliki semangat belajar tinggi.
                        </p>
                        <p class="text-sm md:text-base text-[#2F698B]/80 leading-relaxed text-justify">
                            Fokus utama kami adalah membantu anda mengasah <em class="font-medium">soft skills</em>, menguji
                            kemampuan
                            <em class="font-medium">problem solving</em>, dan menemukan kekuatan profesional anda melalui
                            proyek interaktif.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========== IMAGE SECTION ========== --}}
    <div class="w-full flex justify-center pb-16 md:pb-24 bg-white">
        <div class="grid grid-cols-2 max-w-4xl w-full px-4 sm:px-6 lg:px-8 gap-3 sm:gap-6 md:gap-8">
            <div
                class="group overflow-hidden rounded-xl sm:rounded-2xl md:rounded-3xl shadow-md hover:shadow-xl transition-all duration-300">
                <img src="{{ asset('img/image_footer_1.png') }}" alt=""
                    class="h-40 sm:h-64 md:h-80 w-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div
                class="group overflow-hidden rounded-xl sm:rounded-2xl md:rounded-3xl shadow-md hover:shadow-xl transition-all duration-300">
                <img src="{{ asset('img/image_footer_2.png') }}" alt=""
                    class="h-40 sm:h-64 md:h-80 w-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
        </div>
    </div>

    {{-- ========== CARA PENDAFTARAN ========== --}}
    <section class="py-16 md:py-24 bg-slate-50" id="pendaftaran">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Title --}}
            <div class="text-center mb-14 fade-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-[#2F698B] mb-4 tracking-tight">Cara Pendaftaran</h2>
                <div class="w-20 h-1.5 bg-linear-to-r from-sky-400 to-blue-600 mx-auto rounded-full"></div>
            </div>

            {{-- Accordion --}}
            <div class="space-y-4">

                <!-- A. Pakaian dan Penampilan -->
                <div
                    class="collapse collapse-arrow rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-[#54B79A]/50 transition-all duration-300">
                    <input type="radio" name="my-accordion-2" checked="checked" />
                    <div class="collapse-title font-bold text-[#2F698B] text-base md:text-lg flex items-center gap-3 py-4">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#54B79A]/10 text-[#54B79A]">A</span>
                        Pakaian dan Penampilan
                    </div>
                    <div class="collapse-content text-slate-600 text-sm space-y-4">
                        <!-- Grid Card Jadwal Pakaian -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div
                                class="p-4 bg-slate-50 rounded-xl border border-slate-100 hover:border-slate-200 transition-colors">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-bold text-teal-800 bg-teal-100 rounded-lg mb-2">Senin</span>
                                <p class="text-sm text-slate-600 leading-relaxed">Kemeja putih dengan celana panjang/rok
                                    kain berwarna hitam.</p>
                            </div>

                            <div
                                class="p-4 bg-slate-50 rounded-xl border border-slate-100 hover:border-slate-200 transition-colors">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-bold text-teal-800 bg-teal-100 rounded-lg mb-2">Selasa</span>
                                <p class="text-sm text-slate-600 leading-relaxed">Pakaian kemeja atau blus bernuansa warna
                                    biru.</p>
                            </div>

                            <div
                                class="p-4 bg-slate-50 rounded-xl border border-slate-100 hover:border-slate-200 transition-colors">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-bold text-teal-800 bg-teal-100 rounded-lg mb-2">Rabu
                                    & Kamis</span>
                                <p class="text-sm text-slate-600 leading-relaxed">Pakaian bebas, rapi, dan sopan
                                    (diperbolehkan menggunakan kemeja atau kaos berkerah/polo shirt). Tidak diperkenankan
                                    menggunakan kaos oblong atau celana jeans yang robek.</p>
                            </div>

                            <div
                                class="p-4 bg-slate-50 rounded-xl border border-slate-100 hover:border-slate-200 transition-colors">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-bold text-teal-800 bg-teal-100 rounded-lg mb-2">Jum'at</span>
                                <p class="text-sm text-slate-600 leading-relaxed">Pakaian olahraga (apabila terdapat
                                    kegiatan senam/jalan santai pada pagi hari) atau pakaian formal/batik (apabila tidak ada
                                    jadwal kegiatan olahraga).</p>
                            </div>
                        </div>

                        <!-- Tanda Pengenal -->
                        <div
                            class="p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-900 flex flex-col sm:flex-row items-start gap-3 mt-2">
                            <div class="p-2 bg-amber-100 rounded-lg text-amber-700 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 6a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0V6a.5.5 0 00-.5-.5h-7a.5.5 0 00-.5.5v2a.5.5 0 00.5.5h7a.5.5 0 00.5-.5V6z"
                                        clip-rule="evenodd" />
                                    <path d="M10 13a1 1 0 100-2 1 1 0 000 2zM9 16a1 1 0 112 0 1 1 0 01-2 0z" />
                                </svg>
                            </div>
                            <div>
                                <span class="font-bold block mb-1">Tanda Pengenal:</span>
                                <span>Wajib mengenakan ID Card / Tanda Pengenal Magang selama berada di area
                                    instansi.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- B. Kehadiran dan Waktu Kerja -->
                <div
                    class="collapse collapse-arrow rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-[#54B79A]/50 transition-all duration-300">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title font-bold text-[#2F698B] text-base md:text-lg flex items-center gap-3 py-4">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#54B79A]/10 text-[#54B79A]">B</span>
                        Kehadiran dan Waktu Kerja
                    </div>
                    <div class="collapse-content">
                        <ul class="space-y-3 text-sm text-slate-600 leading-relaxed">
                            <li
                                class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-slate-200 transition-colors">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Peserta magang wajib mematuhi jam kerja instansi (misal: Senin - Jumat, pukul 07.30
                                    s.d. 16.30 WIB).</span>
                            </li>
                            <li
                                class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-slate-200 transition-colors">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Wajib melakukan presensi (absen masuk dan absen pulang) setiap hari kerja melalui
                                    sistem aplikasi yang telah disediakan.</span>
                            </li>
                            <li
                                class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-slate-200 transition-colors">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Apabila berhalangan hadir (sakit atau izin), peserta wajib menginformasikan kepada
                                    Mentor/Pembimbing lapangan dan mengunggah surat keterangan yang sah melalui
                                    sistem.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- C. Tugas dan Evaluasi -->
                <div
                    class="collapse collapse-arrow rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-[#54B79A]/50 transition-all duration-300">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title font-bold text-[#2F698B] text-base md:text-lg flex items-center gap-3 py-4">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#54B79A]/10 text-[#54B79A]">C</span>
                        Tugas dan Evaluasi
                    </div>
                    <div class="collapse-content">
                        <ul class="space-y-3 text-sm text-slate-600 leading-relaxed">
                            <li
                                class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-slate-200 transition-colors">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Peserta wajib mengisi Logbook atau catatan kegiatan harian di sistem secara rutin
                                    sebagai bukti pelaksanaan tugas.</span>
                            </li>
                            <li
                                class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-slate-200 transition-colors">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Menjalankan setiap tugas yang diberikan oleh Mentor dengan penuh tanggung jawab,
                                    jujur, dan disiplin.</span>
                            </li>
                            <li
                                class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-slate-200 transition-colors">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Wajib berkonsultasi dan melapor kepada Mentor terkait perkembangan project atau
                                    kendala yang dihadapi di lapangan.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- D. Perilaku dan Etika -->
                <div
                    class="collapse collapse-arrow rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-[#54B79A]/50 transition-all duration-300">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title font-bold text-[#2F698B] text-base md:text-lg flex items-center gap-3 py-4">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#54B79A]/10 text-[#54B79A]">D</span>
                        Perilaku dan Etika
                    </div>
                    <div class="collapse-content">
                        <ul class="space-y-3 text-sm text-slate-600 leading-relaxed">
                            <li
                                class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-slate-200 transition-colors">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Menjaga nama baik almamater (sekolah/kampus) dan instansi tempat magang.</span>
                            </li>
                            <li
                                class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-slate-200 transition-colors">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Menerapkan budaya kerja yang ramah dan sopan (Senyum, Sapa, Salam) kepada seluruh
                                    pegawai instansi dan sesama peserta magang.</span>
                            </li>
                            <li
                                class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100 hover:border-slate-200 transition-colors">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Menjaga kebersihan, kerapian, dan keamanan fasilitas peralatan kantor yang
                                    digunakan.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- E. Kerahasiaan Informasi -->
                <div
                    class="collapse collapse-arrow rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-rose-500/50 transition-all duration-300">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title font-bold text-[#2F698B] text-base md:text-lg flex items-center gap-3 py-4">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-rose-100 text-rose-600">E</span>
                        Kerahasiaan Informasi
                    </div>
                    <div class="collapse-content">
                        <div
                            class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-sm text-rose-900 flex items-start gap-3">
                            <div class="mt-0.5 shrink-0 text-rose-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <span class="font-bold block mb-1">Perhatian:</span>
                                <span class="leading-relaxed">Peserta dilarang keras menyebarluaskan dokumen, data
                                    internal, atau informasi yang bersifat rahasia milik instansi ke pihak luar tanpa izin
                                    tertulis dari Mentor atau pimpinan instansi.</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

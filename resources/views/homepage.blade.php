@extends('layouts.base')
@section('title', 'Homepage')
@section('content')
    {{-- ========== HERO SECTION ========== --}}
    <section
        class="relative bg-linear-to-b from-[#54B79A] to-[#2F698B] overflow-hidden min-h-screen flex flex-col justify-between">

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
                        class="bg-linear-to-br from-[#2F698B] to-[#1F4961] w-full max-w-30 sm:max-w-35 aspect-square rounded-xl sm:rounded-2xl shadow-lg flex flex-col justify-center items-center group-hover:-translate-y-2 group-hover:shadow-xl transition-all duration-300">
                        <span class="font-extrabold text-3xl sm:text-4xl md:text-5xl text-white">{{ $totalPemagang }}</span>
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

                <!-- A. Persiapan Berkas Administrasi -->
                <div
                    class="collapse collapse-arrow rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-[#54B79A]/50 transition-all duration-300">
                    <input type="radio" name="my-accordion-2" checked="checked" />
                    <div class="collapse-title font-bold text-[#2F698B] text-base md:text-lg flex items-center gap-3 py-4">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#54B79A]/10 text-[#54B79A]">A</span>
                        Persiapan Berkas Administrasi
                    </div>
                    <div class="collapse-content text-slate-600 text-sm">
                        <ul class="space-y-3 leading-relaxed">
                            <li class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Surat Pengantar / Izin Magang resmi dari Sekolah/Kampus.</span>
                            </li>
                            <li class="flex items-start gap-3 p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Proposal Pengajuan Magang (berisi latar belakang, program studi, dan periode magang yang
                                    diajukan).</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- B. Pengisian Formulir Pengajuan -->
                <div
                    class="collapse collapse-arrow rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-[#54B79A]/50 transition-all duration-300">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title font-bold text-[#2F698B] text-base md:text-lg flex items-center gap-3 py-4">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#54B79A]/10 text-[#54B79A]">B</span>
                        Pengisian Formulir Pengajuan
                    </div>
                    <div class="collapse-content text-slate-600 text-sm">
                        <ul class="space-y-3 leading-relaxed">
                            <li class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Buka halaman utama portal pendaftaran magang.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Klik tombol <strong>"Ajukan Magang" / "Daftar Sekarang"</strong>.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <div class="w-full">
                                    <span class="block mb-2">Isi data diri secara lengkap:</span>
                                    <div class="bg-slate-50 border border-slate-100 p-3.5 rounded-xl space-y-1.5 w-full">
                                        <p>1. Nama Lengkap, NIM/NISN.</p>
                                        <p>2. Asal Instansi/Universitas/Sekolah dan program studi.</p>
                                        <p>3. Rencana Periode Magang (Tanggal Mulai s.d. Tanggal Selesai).</p>
                                    </div>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Unggah seluruh dokumen persyaratan yang diminta pada kolom yang tersedia.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Periksa kembali data Anda, lalu klik <strong>"Kirim Pengajuan"</strong>.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- C. Simpan Nomor Pengajuan -->
                <div
                    class="collapse collapse-arrow rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-[#54B79A]/50 transition-all duration-300">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title font-bold text-[#2F698B] text-base md:text-lg flex items-center gap-3 py-4">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#54B79A]/10 text-[#54B79A]">C</span>
                        Simpan Nomor Pengajuan
                    </div>
                    <div class="collapse-content text-slate-600 text-sm">
                        <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl flex items-start gap-3 mb-3">
                            <div class="mt-0.5 shrink-0 text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="leading-relaxed">
                                Setelah berhasil mengirim formulir, sistem akan menampilkan <strong>Nomor Pengajuan
                                    Unik</strong> (contoh: <span
                                    class="font-mono text-amber-700 bg-amber-100/50 px-1.5 py-0.5 rounded">PLN-REG-2026-0812</span>).
                                Wajib simpan atau catat nomor tersebut untuk memantau status seleksi berkas Anda.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- D. Seleksi & Pengecekan Status -->
                <div
                    class="collapse collapse-arrow rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-[#54B79A]/50 transition-all duration-300">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title font-bold text-[#2F698B] text-base md:text-lg flex items-center gap-3 py-4">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#54B79A]/10 text-[#54B79A]">D</span>
                        Seleksi & Pengecekan Status
                    </div>
                    <div class="collapse-content text-slate-600 text-sm">
                        <ul class="space-y-3 leading-relaxed">
                            <li class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Proses verifikasi dan peninjauan berkas oleh tim SDM/Admin membutuhkan waktu 3-7 hari
                                    kerja.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <div class="w-full">
                                    <span class="block mb-2">Calon peserta dapat memantau hasil seleksi secara berkala
                                        dengan cara:</span>
                                    <div class="bg-slate-50 border border-slate-100 p-3.5 rounded-xl space-y-1.5 w-full">
                                        <p>1. Buka menu <strong>"Cek Status Pendaftaran"</strong>.</p>
                                        <p>2. Masukkan Nomor Pengajuan Anda, lalu klik <strong>"Cek Status"</strong>.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- E. Token & Registrasi Akun -->
                <div
                    class="collapse collapse-arrow rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-[#54B79A]/50 transition-all duration-300">
                    <input type="radio" name="my-accordion-2" />
                    <div class="collapse-title font-bold text-[#2F698B] text-base md:text-lg flex items-center gap-3 py-4">
                        <span
                            class="flex items-center justify-center w-8 h-8 rounded-lg bg-[#54B79A]/10 text-[#54B79A]">E</span>
                        Token & Registrasi Akun
                    </div>
                    <div class="collapse-content text-slate-600 text-sm">
                        <ul class="space-y-3 leading-relaxed">
                            <li class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Jika status pengajuan dinyatakan <strong>"Diterima"</strong>, sistem akan menampilkan
                                    ucapan selamat beserta Token Aktivasi Khusus.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <span>Klik tombol <strong>"Registrasi Akun"</strong> yang muncul di layar.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#54B79A] mt-1.5 shrink-0 shadow-sm"></span>
                                <div class="w-full">
                                    <span class="block mb-2">Lakukan pembuatan akun magang dengan mengisi:</span>
                                    <div class="bg-slate-50 border border-slate-100 p-3.5 rounded-xl space-y-1.5 w-full">
                                        <p>1. Email aktif.</p>
                                        <p>2. Password baru.</p>
                                        <p>3. Token Aktivasi yang telah didapatkan sebelumnya.</p>
                                    </div>
                                </div>
                            </li>
                            <li
                                class="flex items-start gap-3 p-3.5 rounded-xl bg-teal-50 border border-teal-100 text-teal-900 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-teal-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Setelah akun berhasil dibuat, silakan Login untuk mengakses Dashboard peserta,
                                    melakukan presensi harian, dan mengisi logbook kegiatan.</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

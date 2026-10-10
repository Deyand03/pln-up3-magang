@extends('layouts.base')
@section('title', 'Logbook Kegiatan')

@section('content')
    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-6 pb-16 space-y-6">
        <div class="breadcrumbs text-xs font-semibold text-slate-500 pl-3">
            <ul>
                <li><a href="{{ route('dashboard-intern') }}">Dashboard</a></li>
                <li><a class="no-underline cursor-text">Logbook Kegiatan</a></li>
            </ul>
        </div>
        <div class="bg-linear-to-br from-teal-800 via-teal-700 to-teal-900 rounded-3xl p-6 sm:p-7 text-white shadow-xl shadow-teal-900/10 border border-teal-600/30 relative overflow-hidden"
            id="riwayat-logbook">
            <div
                class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#fff_1px,transparent_1px)] bg-size-[18px_18px]">
            </div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 text-[11px] font-bold text-teal-100 backdrop-blur-sm border border-white/10">Jurnal
                            Harian
                        </span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight">
                        Logbook Kegiatan Magang
                    </h1>
                    <p class="text-xs sm:text-sm text-teal-100/90 max-w-xl leading-relaxed">
                        Catat aktivitas dan tugas harian kamu di sini. Pastikan mengisi rentang waktu yang sesuai dengan jam
                        kerja.
                    </p>
                </div>

                <div
                    class="flex items-center justify-around gap-3 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 shrink-0">
                    <div class="text-center px-3">
                        <span class="block text-2xl font-black text-white">{{ $totalLogbook }}</span>
                        <span class="block text-[10px] font-bold text-teal-200 uppercase tracking-wider">Total</span>
                    </div>
                    <div class="h-10 w-px bg-white/20"></div>
                    <div class="text-center px-3">
                        <span class="block text-2xl font-black text-amber-300">{{ $totalLogbookPending }}</span>
                        <span class="block text-[10px] font-bold text-teal-200 uppercase tracking-wider">Pending</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. MAIN LAYOUT (GRID KIRI FORM, KANAN TIMELINE) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- LEFT COLUMN: FORM PENGISIAN (Col 4) -->
            <div class="lg:col-span-4 lg:sticky lg:top-20 space-y-6">
                <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-sm">
                    <h2 class="text-sm font-extrabold text-slate-900 mb-1">Tambah Kegiatan</h2>
                    <p class="text-xs text-slate-500 mb-5">Tulis logbook baru untuk hari ini.</p>

                    <form action="{{ route('logbook-intern.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <!-- Tanggal Kegiatan -->
                        <div>
                            <label for="date"
                                class="block text-[11px] font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Tanggal
                                <span class="text-rose-500">*</span></label>
                            <input type="date" id="date" name="date"
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required
                                class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-medium text-slate-700" />
                        </div>

                        <!-- Jam Mulai & Jam Selesai -->
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="jam_mulai"
                                    class="block text-[11px] font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Jam
                                    Mulai <span class="text-rose-500">*</span></label>
                                <input type="time" id="jam_mulai" name="jam_mulai" required
                                    class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-mono font-medium text-slate-700" />
                            </div>
                            <div>
                                <label for="jam_selesai"
                                    class="block text-[11px] font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Jam
                                    Selesai <span class="text-rose-500">*</span></label>
                                <input type="time" id="jam_selesai" name="jam_selesai" required
                                    class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-mono font-medium text-slate-700" />
                            </div>
                        </div>

                        <!-- Nama Kegiatan -->
                        <div>
                            <label for="nama_kegiatan"
                                class="block text-[11px] font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Nama
                                Kegiatan <span class="text-rose-500">*</span></label>
                            <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                                placeholder="Cth: Membuat UI Presensi" required
                                class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-medium text-slate-700" />
                        </div>

                        <!-- Deskripsi Kegiatan -->
                        <div>
                            <label for="deskripsi_kegiatan"
                                class="block text-[11px] font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Deskripsi
                                Kegiatan <span class="text-rose-500">*</span></label>
                            <textarea id="deskripsi_kegiatan" name="deskripsi_kegiatan" rows="4"
                                placeholder="Jelaskan detail apa saja yang kamu kerjakan..." required
                                class="w-full text-xs p-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-medium text-slate-700 placeholder:text-slate-400"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-teal-700 hover:bg-teal-800 active:scale-95 text-white font-extrabold text-xs py-3.5 px-4 rounded-xl shadow-md shadow-teal-700/20 transition-all cursor-pointer">
                            Simpan Logbook
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-4">
                <div class="bg-white rounded-3xl p-5 sm:p-7 border border-slate-200/80 shadow-sm">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-slate-100">
                        <h2 class="text-base font-extrabold text-slate-900">Riwayat Kegiatan</h2>
                    </div>
                    <div class="">
                        @if (session('success'))
                            <div class="bg-teal-100 w-full rounded-lg mb-3 py-3 status-notif">
                                <span class="text-sm text-teal-800 font-semibold px-3">
                                    {{ session('success') }}
                                </span>
                            </div>
                        @elseif (session('error'))
                            <div class="bg-rose-100 w-full rounded-lg mb-3 py-3 status-notif">
                                <span class="text-sm text-rose-800 font-semibold px-3">
                                    {{ session('error') }}
                                </span>
                            </div>
                        @endif
                        <div id="logbook-wrapper" class="">
                            <div id="loading-spinner"
                                class="hidden bg-white/60 backdrop-blur-sm z-50 justify-center items-center rounded-3xl transition-all">
                                <span class="loading loading-spinner text-teal-600 loading-lg"></span>
                            </div>

                            <div id="logbook-data">
                                @include('intern-dashboard.partials.list-logbook')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('modals')
    <div class="modal" id="my-modal-2" popover>
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-sm w-100">
            <div class="flex items-start justify-between">
                <div class="flex flex-col">
                    <h2 class="text-sm font-extrabold text-slate-900 mb-1">Edit Logbook</h2>
                    <p class="text-xs text-slate-500 mb-5">Edit logbook untuk keperluan revisi.</p>
                </div>
                <button popovertarget="my-modal-2" popovertargetaction="hide"
                    class="hover:bg-gray-200 will-change-transform transform-gpu rounded-full px-3 py-1 aspect-square font-semibold transition-all duration-300">✕</button>
            </div>

            <form action="" id="modal-action-form" method="POST" class="space-y-4">
                @csrf
                @method('patch')
                <!-- Tanggal Kegiatan -->
                <div>
                    <label for="date"
                        class="block text-[11px] font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Tanggal
                        <span class="text-rose-500">*</span></label>
                    <input type="date" id="modal-date" name="date"
                        class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-medium text-slate-700" />
                </div>

                <!-- Jam Mulai & Jam Selesai -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="jam_mulai"
                            class="block text-[11px] font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Jam
                            Mulai <span class="text-rose-500">*</span></label>
                        <input type="time" id="modal-jam-mulai" name="jam_mulai"
                            class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-mono font-medium text-slate-700" />
                    </div>
                    <div>
                        <label for="jam_selesai"
                            class="block text-[11px] font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Jam
                            Selesai <span class="text-rose-500">*</span></label>
                        <input type="time" id="modal-jam-selesai" name="jam_selesai"
                            class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-mono font-medium text-slate-700" />
                    </div>
                </div>

                <!-- Nama Kegiatan -->
                <div>
                    <label for="nama_kegiatan"
                        class="block text-[11px] font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Nama
                        Kegiatan <span class="text-rose-500">*</span></label>
                    <input type="text" id="modal-nama-kegiatan" name="nama_kegiatan"
                        placeholder="Cth: Membuat UI Presensi"
                        class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-medium text-slate-700" />
                </div>

                <!-- Deskripsi Kegiatan -->
                <div>
                    <label for="deskripsi_kegiatan"
                        class="block text-[11px] font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Deskripsi
                        Kegiatan <span class="text-rose-500">*</span></label>
                    <textarea id="modal-deskripsi-kegiatan" name="deskripsi_kegiatan" rows="4"
                        placeholder="Jelaskan detail apa saja yang kamu kerjakan..."
                        class="w-full text-xs p-3.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all font-medium text-slate-700 placeholder:text-slate-400"></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-teal-700 hover:bg-teal-800 active:scale-95 text-white font-extrabold text-xs py-3.5 px-4 rounded-xl shadow-md shadow-teal-700/20 transition-all cursor-pointer">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const $ = (selector) => {
                return document.querySelector(selector)
            }

            const detailButtons = document.querySelectorAll('.btn-detail');
            const modalForm = $('#modal-action-form');

            const modalDate = $('#modal-date');
            const modalJamMulai = $('#modal-jam-mulai');
            const modalJamSelesai = $('#modal-jam-selesai');
            const namaKegiatan = $('#modal-nama-kegiatan');
            const deskripsiKegiatan = $('#modal-deskripsi-kegiatan');
            const actionForm = $('#modal-action-form');

            const closeNotif = () => {
                const notification = document.querySelectorAll('.status-notif');
                console.log(notification);
                if (notification) {
                    notification.forEach(notification => {
                        notification.classList.add('transition-all', 'duration-400')
                        notification.classList.add('opacity-0');
                        notification.style.transform = 'translateY(-10px)';
                        setTimeout(() => notification.remove(), 300);
                    })
                }
            }

            document.addEventListener('click', function(e) {
                const editButton = e.target.closest('.btn-detail');

                // 2. Kalau beneran tombol Edit yang diklik, baru kita jalankan sihirnya!
                if (editButton) {
                    const data = editButton.dataset;

                    // Bantuan console (boleh dihapus nanti)
                    console.log('Modal dibuka untuk data:', data.namaKegiatan);

                    // 3. Masukkan data ke form modal (ingat camelCase j kecil ya! 😆)
                    modalDate.value = data.date;
                    modalJamMulai.value = data.jamMulai;
                    modalJamSelesai.value = data.jamSelesai;
                    namaKegiatan.value = data.namaKegiatan;
                    deskripsiKegiatan.value = data.deskripsiKegiatan;
                    actionForm.action = data.actionUrl;
                }
                // Cek apakah elemen yang diklik itu ada di dalam area class "pagination-links" dan berupa tag <a>
                const paginationLink = e.target.closest('.pagination-links a');

                if (paginationLink) {
                    e.preventDefault(); // Cegah browser untuk reload pindah halaman

                    const targetUrl = paginationLink
                        .href; // Ambil URL halamannya (misal: ?page=2)
                    fetchData(targetUrl); // Jalankan fungsi fetch data
                }
            });

            function fetchData(url, updateUrl = true) {
                const wrapper = document.getElementById('logbook-data');
                const spinner = document.getElementById('loading-spinner');
                // 1. Tampilkan Spinner!
                spinner.classList.remove('hidden');
                wrapper.classList.add('hidden')
                document.getElementById('riwayat-logbook').scrollIntoView({
                    behavior: 'smooth'
                });

                // 2. Minta data ke server (Controller)
                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest' // KUNCI! Biar Laravel tau ini AJAX
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Waduh gagal ngambil data!');
                        return response.text(); // Ubah respon menjadi teks HTML
                    })
                    .then(html => {
                        // 3. Timpa isi container dengan HTML baru dari halaman selanjutnya
                        wrapper.innerHTML = html;
                        if (updateUrl) {
                            window.history.pushState(null, '', url);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        alert(
                            'Gagal memuat data halaman selanjutnya. Coba cek koneksi internetmu!');
                    })
                    .finally(() => {
                        // 4. Hilangkan spinner lagi kalau udah sukses ditarik
                        spinner.classList.add('hidden');
                        wrapper.classList.remove('hidden');

                        // Opsional: Scroll otomatis ke atas logbook biar user enak lihatnya
                    });
            }

            window.addEventListener('popstate', function() {
                fetchData(window.location.href, false);
            });

            if ("{{ session('success') }}") {
                console.log('masuk')
                setTimeout(() => {
                    closeNotif();
                }, 5000)
            }
        })
    </script>
@endpush
@endsection

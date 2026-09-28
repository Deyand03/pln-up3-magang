@extends('layouts.base')
@section('title', 'Form Pengajuan')
@section('content')
    <!-- Scrollable Form Container -->
    <div class="flex-1 overflow-y-auto bg-slate-50/60 p-4 pb-20 lg:px-80">
        <!-- Form Header -->
        <div class="text-center my-3">
            <h2 class="text-2xl md:text-4xl font-extrabold text-[#2F698B] leading-tight">
                Form Pengajuan Magang<br />PLN UP3 JAMBI
            </h2>
            <p class="text-xs text-slate-500 mt-1 max-w-xs mx-auto py-2">
                Silahkan upload file pengajuan magang<br /> (surat rekomendasi & proposal)
            </p>
        </div>

        @if (session('success') || session('error') || session('registration_number') || $errors->any())
            <div class="mb-4 space-y-2">
                @if (session('success'))
                    <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('registration_number'))
                    <div class="rounded-xl border border-teal-200 bg-teal-50 px-4 py-3 text-sm font-medium text-teal-700">
                        Nomor pendaftaran Anda: <span class="font-bold">{{ session('registration_number') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                        <p class="font-semibold mb-1">Periksa kembali data berikut:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        <form action="{{ route('form-pengajuan.store') }}" onsubmit="this.querySelector('[type=submit]').disabled = true" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Group 1: Informasi Pribadi & Akademik -->
            <div class="bg-white rounded-2xl p-4 shadow-soft border border-slate-200/80 mb-4">
                <div class="flex items-center gap-2 pb-2 mb-3 border-b border-slate-100">
                    <span
                        class="w-6 h-6 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center text-xs font-bold">1</span>
                    <span class="text-xs font-bold text-slate-800">Identitas Calon Pemagang</span>
                </div>

                <div class="space-y-3">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Nama Lengkap Ketua Calon
                            Pemagang</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Inputkan nama"
                            required
                            class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all placeholder:text-slate-400" />
                    </div>

                    <div class="grid grid-cols-2 gap-2.5">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">E-mail</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Inputkan e-mail"
                                required
                                class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all placeholder:text-slate-400" />
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">Nomor Handphone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx"
                                required
                                class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all placeholder:text-slate-400" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">NIM/NISN</label>
                            <input type="text" name="nim_nisn" value="{{ old('nim_nisn') }}"
                                placeholder="Inputkan NIM/NISN" required
                                class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all placeholder:text-slate-400" />
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-700 mb-1">Instansi</label>
                            <input type="text" name="institution" value="{{ old('institution') }}"
                                placeholder="Masukkan asal instansi" required
                                class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all placeholder:text-slate-400" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Jumlah Pemagang</label>
                        <input type="number" name="total_interns" value="{{ old('total_interns') }}"
                            placeholder="Masukkan jumlah pemagang" required
                            class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all placeholder:text-slate-400" />
                    </div>
                </div>
            </div>

            <!-- Group 2: Periode Pelaksanaan -->
            <div class="bg-white rounded-2xl p-4 shadow-soft border border-slate-200/80 mb-4">
                <div class="flex items-center gap-2 pb-2 mb-3 border-b border-slate-100">
                    <span
                        class="w-6 h-6 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center text-xs font-bold">2</span>
                    <span class="text-xs font-bold text-slate-800">Rencana Periode Magang</span>
                </div>

                <div class="grid grid-cols-2 gap-2.5">
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Tanggal Mulai</label>
                        <div class="relative">
                            <input type="date" name="start_date" value="{{ old('start_date') }}" required
                                class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-700 bg-white" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-[11px] font-semibold text-slate-700 mb-1">Tanggal Selesai</label>
                        <div class="relative">
                            <input type="date" name="end_date" value="{{ old('end_date') }}" required
                                class="w-full text-xs px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-teal-600/20 focus:border-teal-600 transition-all text-slate-700 bg-white" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Group 3: Upload Berkas -->
            <div class="bg-white rounded-2xl p-4 shadow-soft border border-slate-200/80 mb-5">
                <div class="flex items-center gap-2 pb-2 mb-3 border-b border-slate-100">
                    <span
                        class="w-6 h-6 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center text-xs font-bold">3</span>
                    <span class="text-xs font-bold text-slate-800">Unggah Berkas Dokumen</span>
                </div>

                <!-- Upload Box 1: Surat Rekomendasi -->
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-1">
                        <label class="text-[11px] font-semibold text-slate-700">Surat Rekomendasi <span
                                class="text-rose-500 font-bold">(wajib)</span></label>
                    </div>

                    <!-- Area Dropzone Default -->
                    <label for="recommendation_letter" id="dropzone_rec"
                        class="border-2 border-dashed border-teal-200/90 hover:border-teal-500 bg-teal-50/30 hover:bg-teal-50/60 rounded-xl p-4 text-center cursor-pointer transition-all block">
                        <input type="file" name="recommendation_letter" id="recommendation_letter" accept=".pdf"
                            class="hidden" required onchange="handleFileSelect(this, 'preview_rec', 'dropzone_rec')" />
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
                        class="hidden items-center justify-between bg-teal-50/40 border border-teal-200 rounded-xl p-3 transition-all">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <div
                                class="w-9 h-9 rounded-lg bg-rose-50 border border-rose-100 text-rose-600 flex flex-col items-center justify-center shrink-0 shadow-xs">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM14 9V3.5L18.5 8H14z" />
                                </svg>
                                <span class="text-[7px] font-bold -mt-0.5">PDF</span>
                            </div>
                            <div class="min-w-0">
                                <p id="filename_rec" class="text-xs font-bold text-slate-800 truncate">nama_file.pdf</p>
                                <p id="filesize_rec" class="text-[10px] text-teal-700 font-semibold mt-0.5">0 MB •
                                    Berhasil dipilih</p>
                            </div>
                        </div>
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
                <div class="mb-2">
                    <div class="flex items-center justify-between mb-1">
                        <label class="text-[11px] font-semibold text-slate-700">Proposal Magang / CV <span
                                class="text-slate-400 font-normal">(opsional)</span></label>
                    </div>

                    <!-- Area Dropzone Default -->
                    <label for="proposal" id="dropzone_prop"
                        class="border-2 border-dashed border-teal-200/90 hover:border-teal-500 bg-teal-50/30 hover:bg-teal-50/60 rounded-xl p-4 text-center cursor-pointer transition-all block">
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
                        class="hidden items-center justify-between bg-teal-50/40 border border-teal-200 rounded-xl p-3 transition-all">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <div
                                class="w-9 h-9 rounded-lg bg-rose-50 border border-rose-100 text-rose-600 flex flex-col items-center justify-center shrink-0 shadow-xs">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM14 9V3.5L18.5 8H14z" />
                                </svg>
                                <span class="text-[7px] font-bold -mt-0.5">PDF</span>
                            </div>
                            <div class="min-w-0">
                                <p id="filename_prop" class="text-xs font-bold text-slate-800 truncate">nama_file.pdf</p>
                                <p id="filesize_prop" class="text-[10px] text-teal-700 font-semibold mt-0.5">0 MB •
                                    Berhasil dipilih</p>
                            </div>
                        </div>
                        <button type="button" onclick="removeFile('proposal', 'preview_prop', 'dropzone_prop')"
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

            <!-- Action Button -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-600 active:scale-95 text-white font-bold text-xs py-3.5 px-4 rounded-xl shadow-lg shadow-teal-700/20 transition-all flex items-center justify-center gap-2">
                    <span>Submit Pengajuan</span>
                </button>
                <p class="text-[10px] text-center text-slate-400 mt-2">Pastikan seluruh data yang diisi telah valid sebelum
                    menekan submit.</p>
            </div>
        </form>
    </div>
    <script>
        /**
         * Memproses file yang dipilih dan menampilkan card preview
         */
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
                document.getElementById('filesize_' + key).innerText = sizeFormatted + ' • Berhasil dipilih';

                // Sembunyikan dropzone & tampilkan card preview
                document.getElementById(dropzoneId).classList.add('hidden');
                document.getElementById(previewId).classList.remove('hidden');
                document.getElementById(previewId).classList.add('flex');
            }
        }

        /**
         * Menghapus file yang sudah dipilih & mengembalikan kotak upload dropzone
         */
        function removeFile(inputId, previewId, dropzoneId) {
            const input = document.getElementById(inputId);
            input.value = ''; // Reset nilai input file

            // Sembunyikan card preview & tampilkan kembali dropzone
            document.getElementById(previewId).classList.add('hidden');
            document.getElementById(previewId).classList.remove('flex');
            document.getElementById(dropzoneId).classList.remove('hidden');
        }
    </script>
@endsection

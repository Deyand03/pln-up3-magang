<footer class="footer-gradient border-t border-gray-200 bg-linear-to-b from-[#6BCE90] to-[#2F698B]">
    {{-- PLN Info --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Col 1: PLN Branding --}}
            <div class="space-y-4">
                {{-- PLN Logo --}}
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col items-start">
                        <img src="{{ asset('img/logo_pln.png') }}" alt="" class="h-10">
                        <p class="text-xs text-white leading-relaxed max-w-sm py-2">
                            <strong>PT PLN (Persero) UP3 Jambi</strong> berkomitmen memberikan pelayanan kelistrikan
                            handal untuk Jambi yang lebih terang.
                        </p>
                    </div>
                    <div class="flex flex-row items-center gap-2">
                        <div class="flex flex-row gap-4">
                            <img src="{{ asset('img/pln_mobile.png') }}" alt="" class="w-14 h-14 aspect-square">
                            <img src="{{ asset('img/qr_app.png') }}" alt="" class="w-14 h-14 aspect-square">
                        </div>
                    </div>
                </div>


                {{-- App badges --}}
                <div class="flex items-center gap-3">
                    <a
                        class="flex items-center gap-2 bg-white border border-gray-300 cursor-pointer rounded-lg px-3 py-2 transition-all duration-200 will-transform-gpu hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ asset('img/playstore.png') }}" alt="" class="w-6 h-6 aspect-square">
                        <div>
                            <p class="text-[8px] leading-none opacity-80">GET IT ON</p>
                            <p class="text-xs font-semibold leading-tight">Google Play</p>
                        </div>
                    </a>
                    <a
                        class="flex items-center gap-2 bg-white border border-gray-300 cursor-pointer rounded-lg px-3 py-2 transition-all duration-200 will-transform-gpu hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ asset('img/appstore.png') }}" alt="" class="w-6 h-6 aspect-square">
                        <div>
                            <p class="text-[8px] leading-none opacity-80">Download on the</p>
                            <p class="text-xs font-semibold leading-tight">App Store</p>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Col 2: Hubungi Kami --}}
            <div class="space-y-3">
                <h3 class="font-bold text-white text-sm">Hubungi Kami</h3>
                <div class="space-y-2.5">
                    <div class="flex items-start gap-2.5 text-xs text-white">
                        <svg class="w-4 h-4 text-white mt-0.5 shrink-0" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Jl. Jenderal Urip Sumoharjo No.02, Jambi</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-xs text-white">
                        <svg class="w-4 h-4 text-white shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        <span>Call Center: 123</span>
                    </div>
                </div>
            </div>

            {{-- Col 3: Ikuti Kami --}}
            <div class="space-y-3">
                <h3 class="font-bold text-white text-sm">Ikuti Kami</h3>
                <div class="space-y-2">
                    <a href="#" class="social-link flex items-center gap-2.5 text-xs text-white hover:text-blue-600">
                        {{-- Instagram --}}
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                        </svg>
                        <span>plnjambi</span>
                    </a>
                    <a href="#" class="social-link flex items-center gap-2.5 text-xs text-white hover:text-blue-600">
                        {{-- Facebook --}}
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                        <span>plnjambi</span>
                    </a>
                    <a href="#" class="social-link flex items-center gap-2.5 text-xs text-white hover:text-blue-600">
                        {{-- Twitter/X --}}
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                        <span>plnjambi</span>
                    </a>
                    <a href="#" class="social-link flex items-center gap-2.5 text-xs text-white hover:text-blue-600">
                        {{-- TikTok --}}
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                        </svg>
                        <span>pln.up3.jambi</span>
                    </a>
                    <a href="#" class="social-link flex items-center gap-2.5 text-xs text-white hover:text-blue-600">
                        {{-- YouTube --}}
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                        <span>PLN UP3 JAMBI Official</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <p class="text-center text-xs text-white">
                &copy; {{ date('Y') }} PT PLN (Persero) UP3 Jambi. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>
</footer>

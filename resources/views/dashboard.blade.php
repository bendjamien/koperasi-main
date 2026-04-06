<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <!-- WELCOME HEADER -->
        <div class="relative overflow-hidden bg-slate-900 rounded-[2.5rem] p-8 mb-10 shadow-2xl shadow-slate-200">
            <div class="absolute right-0 top-0 w-64 h-64 bg-sky-500/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            <div class="absolute left-0 bottom-0 w-64 h-64 bg-indigo-500/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight">
                        Dashboard <span class="text-sky-400 font-medium">Overview</span>
                    </h1>
                    <p class="mt-2 text-slate-400 font-medium italic">
                        Selamat datang kembali, <span class="text-white font-bold">{{ Auth::user()->name }}</span>. Pantau aktivitas bisnis Anda hari ini.
                    </p>
                </div>
                <div class="px-6 py-3 bg-white/5 border border-white/10 rounded-2xl backdrop-blur-md">
                    <p class="text-[10px] font-black text-sky-400 uppercase tracking-[0.2em] mb-1">HAK AKSES SISTEM</p>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-sm font-bold text-white uppercase tracking-widest">{{ Auth::user()->role }} MODE</span>
                    </div>
                </div>
            </div>
        </div>

        @if(Auth::user()->role == 'kasir')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Attendance Widget -->
            <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/20 relative overflow-hidden group">
                <div class="absolute -right-4 -top-4 w-32 h-32 bg-emerald-50 rounded-full opacity-50"></div>
                
                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-emerald-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h2 class="text-2xl font-black text-slate-800 tracking-tight">Presensi Kehadiran</h2>
                            <p class="text-slate-500 font-medium italic text-sm mt-1">Silakan lakukan absensi masuk/pulang tepat waktu.</p>
                        </div>

                        <div class="flex flex-col items-center md:items-end gap-2">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">STATUS HARI INI</p>
                            @if(!$absensiHariIni)
                                <span class="px-4 py-2 bg-rose-50 text-rose-600 rounded-full text-xs font-black uppercase tracking-widest border border-rose-100">Belum Absen</span>
                            @elseif(!$absensiHariIni->jam_pulang)
                                <span class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-full text-xs font-black uppercase tracking-widest border border-emerald-100">Sudah Masuk</span>
                            @else
                                <span class="px-4 py-2 bg-slate-100 text-slate-600 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200">Selesai Kerja</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Scan QR Section -->
                        <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100 flex flex-col items-center justify-center text-center">
                            <button onclick="openScanner()" class="w-20 h-20 bg-white rounded-3xl shadow-sm border border-slate-200 flex items-center justify-center text-sky-600 hover:scale-105 transition-transform mb-4">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            </button>
                            <p class="text-sm font-black text-slate-800 uppercase tracking-widest">Scan QR Code</p>
                            <p class="text-[10px] text-slate-400 font-bold mt-1">Gunakan kamera untuk scan barcode absensi</p>
                        </div>

                        <!-- Manual Code Section -->
                        <div class="p-6 bg-slate-50 rounded-[2rem] border border-slate-100">
                            <form action="{{ route('absensi.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Input Kode Manual</label>
                                    <div class="flex gap-2">
                                        <input type="text" name="kode_absen" placeholder="KODE UNIK" class="flex-grow px-4 py-3 bg-white border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 font-black text-slate-700 placeholder:text-slate-300">
                                        <button type="submit" class="px-6 py-3 bg-slate-900 text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-800 transition-all">Submit</button>
                                    </div>
                                </div>
                                <p class="text-[10px] text-slate-400 font-bold leading-tight">Gunakan fitur ini jika kamera bermasalah atau tidak tersedia.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Stats -->
            <div class="bg-slate-900 p-8 rounded-[2.5rem] shadow-2xl shadow-sky-900/20 flex flex-col justify-between">
                <div>
                    <p class="text-[10px] font-black text-sky-400 uppercase tracking-[0.2em] mb-4 text-center">LOG WAKTU HARI INI</p>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-white/5 rounded-2xl border border-white/10">
                            <span class="text-xs font-bold text-slate-400">Jam Masuk</span>
                            <span class="text-sm font-black text-white">{{ $absensiHariIni->jam_masuk ?? '--:--' }}</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-white/5 rounded-2xl border border-white/10">
                            <span class="text-xs font-bold text-slate-400">Jam Pulang</span>
                            <span class="text-sm font-black text-white">{{ $absensiHariIni->jam_pulang ?? '--:--' }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-sky-500/10 rounded-2xl border border-sky-500/20 text-center">
                    <p class="text-[9px] font-black text-sky-400 uppercase tracking-widest mb-1">JAM KERJA BERLAKU</p>
                    <p class="text-xs font-bold text-white">{{ \App\Models\Setting::where('key', 'jam_masuk')->first()?->value ?? '08:00' }} - {{ \App\Models\Setting::where('key', 'jam_pulang')->first()?->value ?? '17:00' }}</p>
                </div>
            </div>
        </div>

        <!-- Scanner Modal -->
        <div id="scannerModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm">
            <div class="bg-white w-full max-w-lg rounded-[2.5rem] overflow-hidden shadow-2xl">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-xl font-black text-slate-800">Scan Absensi</h3>
                    <button onclick="closeScanner()" class="p-2 text-slate-400 hover:text-rose-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="p-8">
                    <div id="reader" class="rounded-2xl overflow-hidden border-4 border-slate-100 bg-slate-50"></div>
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/html5-qrcode"></script>
        <script>
            let html5QrcodeScanner = null;

            function openScanner() {
                document.getElementById('scannerModal').classList.remove('hidden');
                html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
                html5QrcodeScanner.render(onScanSuccess);
            }

            function closeScanner() {
                document.getElementById('scannerModal').classList.add('hidden');
                if (html5QrcodeScanner) {
                    html5QrcodeScanner.clear();
                }
            }

            function onScanSuccess(decodedText, decodedResult) {
                html5QrcodeScanner.clear();
                
                // Submit via Form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('absensi.scan') }}";
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = "{{ csrf_token() }}";
                
                const kodeInput = document.createElement('input');
                kodeInput.type = 'hidden';
                kodeInput.name = 'kode_absen';
                kodeInput.value = decodedText;
                
                form.appendChild(csrfToken);
                form.appendChild(kodeInput);
                document.body.appendChild(form);
                form.submit();
            }
        </script>
        @endif

        <!-- MAIN STATS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            
            <!-- Pendapatan Card -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/20 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-emerald-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Pendapatan Hari Ini</p>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter">Rp{{ number_format($totalPendapatanHariIni, 0, ',', '.') }}</h3>
                    <div class="mt-4 flex items-center gap-1.5">
                        <span class="flex h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        <p class="text-[9px] font-bold text-emerald-600 uppercase tracking-widest">Live Updates</p>
                    </div>
                </div>
            </div>

            <!-- Transaksi Card -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/20 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-sky-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-sky-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-sky-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Transaksi Hari Ini</p>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter">{{ $jumlahTransaksiHariIni }} <span class="text-sm font-medium text-slate-400">Order</span></h3>
                    <div class="mt-4 flex items-center gap-1.5">
                        <span class="flex h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                        <p class="text-[9px] font-bold text-sky-600 uppercase tracking-widest">Completed</p>
                    </div>
                </div>
            </div>

            <!-- Pelanggan Card -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/20 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-indigo-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-indigo-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.124-1.282-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.124-1.282.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Pelanggan</p>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter">{{ $jumlahPelanggan }} <span class="text-sm font-medium text-slate-400">Orang</span></h3>
                    <div class="mt-4 flex items-center gap-1.5">
                        <span class="flex h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                        <p class="text-[9px] font-bold text-indigo-600 uppercase tracking-widest">Registered</p>
                    </div>
                </div>
            </div>

            <!-- Produk Card -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/20 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-amber-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4M4 7l8 4M4 7v10l8 4m0-14L4 7"></path></svg>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Jenis Produk</p>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter">{{ $jumlahProduk }} <span class="text-sm font-medium text-slate-400">Items</span></h3>
                    <div class="mt-4 flex items-center gap-1.5">
                        <span class="flex h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                        <p class="text-[9px] font-bold text-amber-600 uppercase tracking-widest">Active Stock</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
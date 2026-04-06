<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- HEADER & ACTIONS -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Manajemen & Laporan Stok</h1>
                <p class="mt-2 text-slate-500 font-medium italic">Kelola persediaan barang dan pantau mutasi stok secara akurat.</p>
            </div>
            @if(Auth::user()->role == 'admin')
                <div class="flex gap-3">
                    <a href="{{ route('stok_log.create') }}" 
                       class="flex items-center gap-2 px-6 py-4 bg-emerald-600 text-white rounded-2xl text-sm font-black uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-xl shadow-emerald-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Catat Stok Masuk
                    </a>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- CHECK STOCK SECTION -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/20 relative overflow-hidden group">
                    <div class="absolute -right-4 -top-4 w-32 h-32 bg-sky-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                    
                    <div class="relative z-10">
                        <div class="w-12 h-12 bg-sky-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-sky-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight mb-4">Cek Stok Produk</h2>
                        
                        <form action="{{ route('stok_log.index') }}" method="GET" class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Pilih Produk</label>
                                <select name="produk_search_id" id="produk_search_id"
                                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all appearance-none"
                                        onchange="this.form.submit()">
                                    <option value="">-- Cari Produk --</option>
                                    @foreach ($produksForSearch as $produk)
                                        <option value="{{ $produk->id }}" {{ $produk->id == $selectedProdukId ? 'selected' : '' }}>
                                            {{ $produk->nama_produk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        @if ($selectedProduk)
                            <div class="mt-8 p-6 bg-slate-900 rounded-[2rem] text-white shadow-2xl shadow-slate-900/20">
                                <p class="text-[10px] font-black text-sky-400 uppercase tracking-[0.2em] mb-1 text-center">STOK SAAT INI</p>
                                <h3 class="text-lg font-bold text-center mb-4 line-clamp-1">{{ $selectedProduk->nama_produk }}</h3>
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-5xl font-black tracking-tighter">{{ $selectedProduk->stok }}</span>
                                    <span class="text-sm font-bold text-sky-400 uppercase tracking-widest">{{ $selectedProduk->satuan }}</span>
                                </div>
                            </div>
                        @else
                            <div class="mt-8 p-8 border-2 border-dashed border-slate-100 rounded-[2rem] text-center">
                                <p class="text-sm font-medium text-slate-400">Pilih produk untuk melihat sisa stok secara detail.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- HISTORY TABLE SECTION -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/30 overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                        <h2 class="text-xl font-black text-slate-800 tracking-tight">Riwayat Mutasi Stok</h2>
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Waktu & Produk</th>
                                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Tipe</th>
                                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Jumlah</th>
                                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Keterangan</th>
                                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-right">Saldo Stok</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($logs as $log)
                                    <tr class="hover:bg-slate-50/50 transition-all group">
                                        <td class="px-8 py-6">
                                            <p class="text-sm font-black text-slate-800">{{ $log->produk->nama_produk ?? 'N/A' }}</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">
                                                {{ \Carbon\Carbon::parse($log->tanggal)->isoFormat('D MMM Y, HH:mm') }} WIB
                                            </p>
                                        </td>
                                        <td class="px-8 py-6 text-center">
                                            @if($log->tipe == 'masuk')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                                    Masuk
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 text-rose-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-rose-100">
                                                    <span class="w-1.5 h-1.5 bg-rose-500 rounded-full animate-pulse"></span>
                                                    Keluar
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-8 py-6 text-center">
                                            <p class="text-sm font-black {{ $log->tipe == 'masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                                                {{ $log->tipe == 'masuk' ? '+' : '-' }} {{ number_format($log->jumlah, 0, ',', '.') }}
                                            </p>
                                        </td>
                                        <td class="px-8 py-6">
                                            <p class="text-[11px] font-bold text-slate-700 leading-relaxed">{{ $log->sumber }}</p>
                                            <p class="text-[10px] text-slate-400 italic">{{ $log->keterangan ?: 'Tidak ada keterangan tambahan' }}</p>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <p class="text-sm font-black text-slate-900">{{ number_format($log->produk->stok ?? 0, 0, ',', '.') }}</p>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase">{{ $log->produk->satuan ?? '' }}</p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-8 py-20 text-center opacity-30">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8 4-8-4"></path></svg>
                                                <p class="text-xl font-black italic tracking-widest uppercase">Belum ada mutasi stok</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($logs->hasPages())
                        <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                            {{ $logs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
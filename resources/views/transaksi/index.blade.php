<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight flex items-center gap-4">
                    <div class="w-12 h-12 bg-sky-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-sky-100">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    Riwayat Transaksi
                </h1>
                <p class="mt-2 text-slate-500 font-medium italic">Manajemen seluruh data invoice dan riwayat pembayaran pelanggan.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('pos.index') }}" class="flex items-center gap-2 px-6 py-3 bg-sky-600 text-white rounded-2xl text-sm font-black uppercase tracking-widest hover:bg-sky-700 transition-all shadow-xl shadow-sky-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Transaksi Baru
                </a>
            </div>
        </div>

        <!-- FILTERS & SEARCH -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/20">
            <form action="{{ route('transaksi.index') }}" method="GET" class="m-0 space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <!-- Search Input -->
                    <div class="lg:col-span-2 relative group">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Cari ID, Kasir, atau Pelanggan</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ $search }}" 
                                   placeholder="Ketik kata kunci..." 
                                   class="w-full pl-12 pr-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all shadow-inner">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center text-sky-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Date From -->
                    <div class="relative group">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" 
                               class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all shadow-inner">
                    </div>

                    <!-- Date To -->
                    <div class="relative group">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" 
                               class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all shadow-inner">
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('transaksi.index') }}" class="px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-200 transition-all">
                        Reset Filter
                    </a>
                    <button type="submit" class="px-12 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-200">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- TRANSACTIONS TABLE -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/30 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h2 class="text-xl font-black text-slate-800 tracking-tight italic uppercase">Invoice List</h2>
                <span class="px-4 py-1.5 bg-slate-100 text-slate-400 text-[10px] font-black rounded-full uppercase tracking-widest">Total: {{ $transaksis->total() }} Records</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">ID Transaksi</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Detail Waktu</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Kasir & Pelanggan</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-right">Nilai Transaksi</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($transaksis as $trx)
                            <tr class="hover:bg-sky-50/30 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-slate-800">#{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</span>
                                        <span class="text-[9px] font-bold text-sky-500 uppercase tracking-tighter">INV-POS-{{ $trx->id }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($trx->tanggal)->isoFormat('D MMMM Y') }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">{{ \Carbon\Carbon::parse($trx->tanggal)->format('H:i') }} WIB</p>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-5 h-5 bg-slate-100 rounded-full flex items-center justify-center text-[8px] font-black text-slate-400 uppercase">K</div>
                                            <p class="text-xs font-bold text-slate-600">{{ $trx->kasir->name ?? 'N/A' }}</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-5 h-5 bg-sky-100 rounded-full flex items-center justify-center text-[8px] font-black text-sky-500 uppercase">P</div>
                                            <p class="text-xs font-black text-sky-700 uppercase">{{ $trx->pelanggan->nama ?? 'Pelanggan Umum' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <p class="text-lg font-black text-slate-900 tracking-tighter">Rp{{ number_format($trx->total, 0, ',', '.') }}</p>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase">{{ $trx->metode_bayar ?? 'Tunai' }}</p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100">
                                        {{ $trx->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('transaksi.show', $trx) }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-sky-600 hover:border-sky-500 hover:shadow-lg hover:shadow-sky-100 transition-all group/btn" title="Lihat Detail & Cetak">
                                            <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-32 text-center opacity-30">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        <p class="text-2xl font-black italic tracking-[0.2em] uppercase">No Transaction Data</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transaksis->hasPages())
                <div class="px-8 py-8 bg-slate-50 border-t border-slate-100 shadow-inner">
                    {{ $transaksis->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

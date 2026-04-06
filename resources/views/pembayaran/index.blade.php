<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- HEADER & ACTIONS -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Laporan Log Pembayaran</h1>
                <p class="mt-2 text-slate-500 font-medium italic">Pantau seluruh riwayat transaksi masuk dan metode pembayaran yang digunakan.</p>
            </div>
            <div class="flex gap-3">
                <div class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
            </div>
        </div>

        <!-- TABLE SECTION -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/30 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h2 class="text-xl font-black text-slate-800 tracking-tight">Riwayat Pembayaran Terverifikasi</h2>
                <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                    Live Data
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">ID Bayar</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Transaksi</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Pelanggan</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Metode</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Referensi</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-right">Jumlah Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($pembayarans as $bayar)
                            <tr class="hover:bg-sky-50/30 transition-all group">
                                <td class="px-8 py-6">
                                    <span class="text-sm font-black text-slate-700 bg-slate-100 px-3 py-1 rounded-full group-hover:bg-white group-hover:shadow-sm transition-all border border-transparent group-hover:border-slate-100">#{{ str_pad($bayar->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <a href="{{ route('transaksi.show', $bayar->transaksi_id) }}" class="group/link flex items-center gap-2">
                                        <span class="text-sm font-bold text-slate-800 group-hover/link:text-sky-600 transition-colors">TRX-{{ str_pad($bayar->transaksi_id, 5, '0', STR_PAD_LEFT) }}</span>
                                        <svg class="w-4 h-4 text-slate-300 group-hover/link:text-sky-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 font-black text-[10px]">
                                            {{ substr($bayar->transaksi->pelanggan->nama ?? 'U', 0, 1) }}
                                        </div>
                                        <p class="text-sm font-bold text-slate-700">{{ $bayar->transaksi->pelanggan->nama ?? 'Pelanggan Umum' }}</p>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $bayar->metode == 'Tunai' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-indigo-50 text-indigo-600 border-indigo-100' }}">
                                        {{ $bayar->metode }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-xs font-bold text-slate-500 font-mono tracking-tighter">{{ $bayar->referensi ?: '-' }}</p>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <p class="text-base font-black text-slate-900 tracking-tight">Rp{{ number_format($bayar->jumlah, 0, ',', '.') }}</p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center opacity-30">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        <p class="text-xl font-black italic tracking-widest uppercase">Belum ada data pembayaran</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($pembayarans->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                    {{ $pembayarans->links() }}
                </div>
            @endif
        </div>

        <!-- SUMMARY MINI CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-indigo-600 p-8 rounded-[2.5rem] shadow-xl shadow-indigo-100 relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <p class="text-xs font-black text-indigo-200 uppercase tracking-widest mb-1">Total Pembayaran Non-Tunai</p>
                    <h3 class="text-3xl font-black text-white tracking-tighter">
                        Rp{{ number_format($pembayarans->where('metode', '!=', 'Tunai')->sum('jumlah'), 0, ',', '.') }}
                    </h3>
                </div>
            </div>
            <div class="bg-emerald-600 p-8 rounded-[2.5rem] shadow-xl shadow-emerald-100 relative overflow-hidden group">
                <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <p class="text-xs font-black text-emerald-200 uppercase tracking-widest mb-1">Total Pembayaran Tunai</p>
                    <h3 class="text-3xl font-black text-white tracking-tighter">
                        Rp{{ number_format($pembayarans->where('metode', 'Tunai')->sum('jumlah'), 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
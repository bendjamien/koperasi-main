<x-app-layout>
    <style>
        /* UI RESET & GLOBAL STYLES */
        main { padding: 0 !important; background-color: #f8fafc; overflow: hidden; }
        header.sticky { display: none !important; }
        .pb-24 { padding-bottom: 0 !important; }
        
        .custom-scroll::-webkit-scrollbar { width: 5px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 20px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }

        [x-cloak] { display: none !important; }
    </style>

    <div class="h-screen flex flex-col bg-[#f8fafc] font-sans antialiased text-slate-900" x-data="posSystem()">
        
        <!-- ========================================== -->
        <!-- TOP NAVIGATION                             -->
        <!-- ========================================== -->
        <nav class="h-20 bg-white/80 backdrop-blur-xl border-b border-slate-200/50 px-8 flex items-center justify-between z-50">
            <div class="flex items-center gap-8">
                <!-- Clock Widget -->
                <div class="flex items-center gap-4 py-2 pr-6 border-r border-slate-200">
                    <div class="w-11 h-11 bg-sky-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-sky-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest" x-text="currentDate"></p>
                        <p class="text-xl font-black text-sky-600 font-mono" x-text="currentTime"></p>
                    </div>
                </div>

                <!-- Barcode Engine -->
                <div class="w-[400px]">
                    <form id="barcode-form" action="{{ route('pos.add_item') }}" method="POST" class="m-0">
                        @csrf
                        <input type="hidden" name="transaksi_id" value="{{ $activeDraft->id }}">
                        <div class="relative">
                            <input type="text" name="kode_barcode" id="barcode-input" autofocus
                                   placeholder="Scan Barcode Produk..." 
                                   class="w-full pl-12 pr-4 py-3 bg-slate-100 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-sky-500 focus:bg-white transition-all shadow-inner outline-none">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-sky-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 00-1 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="w-8 h-8 bg-sky-500 rounded-full flex items-center justify-center text-white font-black text-xs uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <p class="text-sm font-black text-slate-700 uppercase tracking-tight">{{ Auth::user()->name }}</p>
                </div>
            </div>
        </nav>

        <!-- ========================================== -->
        <!-- MAIN APP INTERFACE                         -->
        <!-- ========================================== -->
        <div class="flex-grow flex p-6 gap-6 overflow-hidden">
            
            <!-- LEFT SIDE: PRODUCT CATALOG -->
            <div class="flex-[3] flex flex-col min-w-0">
                <div class="mb-6 flex items-center justify-between gap-4">
                    <form action="{{ route('pos.index', ['transaksi' => $activeDraft->id]) }}" method="GET" class="flex-grow m-0">
                        <div class="relative">
                            <input type="text" name="search" value="{{ $search ?? '' }}" 
                                   placeholder="Cari menu atau barang..." 
                                   class="w-full pl-12 pr-6 py-4 bg-white border border-slate-200 rounded-3xl focus:ring-4 focus:ring-sky-50 focus:border-sky-500 transition-all outline-none shadow-sm font-medium text-lg">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                        </div>
                    </form>
                    <!-- Tombol Reset Filter -->
                    <div class="flex gap-2">
                         <a href="{{ route('pos.index', ['transaksi' => $activeDraft->id]) }}" 
                            class="p-4 bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-sky-600 hover:bg-sky-50 transition-all shadow-sm group"
                            title="Reset Pencarian">
                            <svg class="w-6 h-6 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                         </a>
                    </div>
                </div>

                <div class="flex-grow overflow-y-auto custom-scroll pr-2 pb-10">
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-6">
                        @forelse ($produks as $produk)
                            <form action="{{ route('pos.add_item') }}" method="POST" class="m-0 group">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <input type="hidden" name="transaksi_id" value="{{ $activeDraft->id }}">
                                <button type="submit" 
                                        class="w-full text-left bg-white rounded-[2.5rem] p-3 border border-slate-100 hover:border-sky-500 hover:shadow-2xl hover:shadow-sky-100 transition-all duration-500 group relative flex flex-col active:scale-95">
                                    <div class="w-full aspect-square bg-slate-50 rounded-[2rem] flex items-center justify-center mb-4 overflow-hidden relative border border-slate-50">
                                        @if($produk->gambar_url)
                                            <img src="{{ asset('storage/' . $produk->gambar_url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                        @else
                                            <svg class="w-12 h-12 text-slate-200 group-hover:text-sky-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                        <div class="absolute bottom-3 right-3 px-3 py-1.5 bg-white/90 backdrop-blur rounded-2xl text-[10px] font-black text-slate-700 shadow-sm border border-white">
                                            {{ $produk->stok }} <span class="text-[8px] opacity-40 uppercase tracking-tighter">Stok</span>
                                        </div>
                                    </div>
                                    <div class="px-3 pb-3 flex-grow flex flex-col">
                                        <span class="block text-[10px] font-black text-sky-500 uppercase tracking-[0.2em] mb-1.5">{{ $produk->kategori->nama ?? 'General' }}</span>
                                        <h3 class="text-sm font-bold text-slate-800 line-clamp-2 h-10 leading-snug group-hover:text-sky-600 transition-colors">{{ $produk->nama_produk }}</h3>
                                        <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                                            <span class="text-base font-black text-slate-900 tracking-tighter">Rp{{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                                            <div class="w-10 h-10 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center group-hover:bg-sky-500 group-hover:text-white transition-all shadow-sm">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        @empty
                             <div class="col-span-full py-20 flex flex-col items-center justify-center opacity-20">
                                <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                <p class="text-xl font-black italic uppercase tracking-widest text-center">Produk Tidak Ditemukan</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: THE PROFESSIONAL CART -->
            <div class="flex-[1.5] flex flex-col h-full gap-6">
                
                <!-- CUSTOMER CARD -->
                <div class="bg-white rounded-[2.5rem] border border-slate-200/60 p-6 shadow-xl shadow-slate-200/20">
                    <div class="flex items-center justify-between mb-4 px-2">
                        <h2 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Data Pelanggan</h2>
                        <span class="px-3 py-1 bg-sky-50 text-sky-600 text-[10px] font-black rounded-full border border-sky-100">INV-{{ $activeDraft->id }}</span>
                    </div>
                    
                    <form action="{{ route('pos.save_customer') }}" method="POST" class="m-0">
                        @csrf
                        <input type="hidden" name="transaksi_id" value="{{ $activeDraft->id }}">
                        <div class="relative group">
                            <select name="pelanggan_id" onchange="this.form.submit()"
                                    class="w-full pl-6 pr-12 py-4 bg-slate-50 border-2 border-transparent focus:border-sky-500 rounded-2xl text-sm font-bold text-slate-700 outline-none appearance-none cursor-pointer shadow-inner transition-all">
                                <option value="">PELANGGAN UMUM (CASH)</option>
                                @foreach ($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}" @if($activeDraft->pelanggan_id == $pelanggan->id) selected @endif>
                                        {{ strtoupper($pelanggan->nama) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 p-2 text-sky-500 pointer-events-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        </div>
                    </form>

                    @if($activeDraft->pelanggan)
                        <div class="mt-4 grid grid-cols-2 gap-3" x-transition>
                            <div class="bg-sky-50/50 p-3 rounded-2xl border border-sky-100/50 flex flex-col items-center justify-center text-center">
                                <span class="text-[8px] font-black text-sky-400 uppercase mb-1 tracking-tighter">Member Level</span>
                                <span class="text-xs font-black text-sky-700 uppercase">{{ $activeDraft->pelanggan->member_level ?? 'BRONZE' }}</span>
                            </div>
                            <div class="bg-slate-50/50 p-3 rounded-2xl border border-slate-100 flex flex-col items-center justify-center text-center">
                                <span class="text-[8px] font-black text-slate-400 uppercase mb-1 tracking-tighter">Loyalty Points</span>
                                <span class="text-xs font-black text-slate-700">{{ number_format($activeDraft->pelanggan->poin, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- CART ITEMS -->
                <div class="flex-grow bg-white rounded-[2.5rem] border border-slate-200/60 shadow-xl shadow-slate-200/20 overflow-hidden flex flex-col">
                    <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-white sticky top-0 z-10">
                        <h2 class="text-lg font-black text-slate-800">Ringkasan Order</h2>
                        <span class="text-[10px] font-black bg-slate-100 px-3 py-1 rounded-full text-slate-400 uppercase tracking-widest">{{ $activeDraft->details->sum('jumlah') }} Barang</span>
                    </div>

                    <div class="flex-grow overflow-y-auto px-6 py-4 custom-scroll space-y-4">
                        @forelse ($activeDraft->details as $item)
                            <div class="group bg-slate-50/50 hover:bg-sky-50/50 p-4 rounded-[2rem] border border-slate-100 hover:border-sky-100 transition-all duration-300 flex items-center gap-4">
                                <div class="w-16 h-16 bg-white rounded-2xl flex-shrink-0 flex items-center justify-center border border-slate-100 overflow-hidden shadow-sm">
                                    @if($item->produk->gambar_url)
                                        <img src="{{ asset('storage/' . $item->produk->gambar_url) }}" class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-6 h-6 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="text-sm font-black text-slate-800 truncate mb-1">{{ $item->produk->nama_produk }}</h4>
                                    <p class="text-xs font-bold text-sky-600">Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                </div>
                                <div class="flex flex-col items-end gap-2">
                                    <div class="flex items-center bg-white rounded-xl border border-slate-200 shadow-sm p-1">
                                        <form action="{{ route('pos.update_item') }}" method="POST" class="m-0">
                                            @csrf
                                            <input type="hidden" name="transaksi_detail_id" value="{{ $item->id }}">
                                            <input type="number" name="qty" value="{{ $item->jumlah }}" min="1"
                                                   class="w-12 h-9 bg-transparent border-none text-center text-xs font-black text-slate-800 focus:ring-0"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </div>
                                    <form action="{{ route('pos.remove_item') }}" method="POST" class="m-0">
                                        @csrf
                                        <input type="hidden" name="transaksi_detail_id" value="{{ $item->id }}">
                                        <button type="submit" class="text-slate-300 hover:text-rose-500 transition-colors p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="h-full flex flex-col items-center justify-center py-20 opacity-10">
                                <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                <p class="font-black uppercase tracking-[0.3em] text-[10px]">Empty Cart</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- BILLING & ACTIONS -->
                    <div class="px-8 py-8 bg-slate-50 border-t border-slate-100">
                        <div class="space-y-4 mb-8 px-2">
                            <div class="flex justify-between items-center text-slate-400 font-bold text-[10px] uppercase tracking-widest">
                                <span>Subtotal Belanja</span>
                                <span class="text-slate-900">Rp{{ number_format($activeDraft->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="pt-6 border-t border-slate-200 flex justify-between items-center">
                                <p class="text-[9px] font-black text-sky-500 uppercase tracking-widest">Grand Total</p>
                                <p class="text-4xl font-black text-slate-900 tracking-tighter leading-none">
                                    <span class="text-base font-bold mr-1 text-slate-300">Rp</span>{{ number_format($activeDraft->total, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-6 gap-3">
                            <!-- Tombol Batal -->
                            <button x-on:click.prevent="$dispatch('open-modal', 'confirm-draft-cancel-{{ $activeDraft->id }}')"
                                    class="col-span-1 h-16 flex items-center justify-center bg-white border border-slate-200 text-rose-500 rounded-3xl hover:bg-rose-50 hover:border-rose-100 transition-all shadow-sm active:scale-95 group" title="Batal Transaksi">
                                <svg class="w-7 h-7 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                            
                            <!-- Tombol Detail Pesanan -->
                            <button x-on:click.prevent="$dispatch('open-modal', 'view-order-detail')"
                                    class="col-span-2 h-16 flex items-center justify-center bg-white border border-slate-200 text-slate-600 rounded-3xl hover:bg-slate-50 hover:text-sky-600 hover:border-sky-200 transition-all shadow-sm active:scale-95 flex flex-col items-center justify-center leading-none">
                                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <span class="text-[9px] font-black uppercase tracking-widest">Detail</span>
                            </button>

                            <!-- Tombol Checkout -->
                            <a href="{{ route('pos.checkout.show', $activeDraft) }}"
                               class="col-span-3 h-16 relative overflow-hidden group bg-sky-600 hover:bg-sky-700 text-white rounded-3xl shadow-xl shadow-sky-200 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center @if($activeDraft->details->isEmpty()) opacity-30 pointer-events-none grayscale @endif">
                                <div class="absolute inset-0 bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                <div class="flex items-center justify-center gap-3 w-full px-2">
                                    <span class="text-sm font-black uppercase tracking-widest whitespace-nowrap">Bayar Sekarang</span>
                                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL DETAIL PESANAN -->
        <x-modal :name="'view-order-detail'" focusable>
            <div class="p-8 bg-white rounded-[3rem]">
                <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight flex items-center gap-3">
                    <svg class="w-8 h-8 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Detail Belanja
                </h2>
                <div class="max-h-[60vh] overflow-y-auto custom-scroll mb-6 pr-2">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b">
                                <th class="pb-3">Produk</th>
                                <th class="pb-3 text-center">Qty</th>
                                <th class="pb-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($activeDraft->details as $item)
                                <tr>
                                    <td class="py-4">
                                        <p class="text-sm font-bold text-slate-800">{{ $item->produk->nama_produk }}</p>
                                        <p class="text-[10px] text-sky-500">Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                    </td>
                                    <td class="py-4 text-center font-bold text-sm">{{ $item->jumlah }}</td>
                                    <td class="py-4 text-right font-black text-sm text-slate-900">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="bg-slate-50 p-6 rounded-[2rem] flex justify-between items-center mb-8">
                    <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Total Bayar</span>
                    <span class="text-3xl font-black text-sky-600">Rp{{ number_format($activeDraft->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex gap-4">
                    <button type="button" x-on:click="$dispatch('close')" class="flex-grow py-5 bg-slate-100 hover:bg-slate-200 rounded-2xl font-black text-slate-600 transition-all uppercase tracking-widest text-xs">Tutup</button>
                    <a href="{{ route('pos.checkout.show', $activeDraft) }}" class="flex-grow py-5 bg-sky-600 hover:bg-sky-700 rounded-2xl font-black text-white shadow-lg shadow-sky-200 transition-all uppercase tracking-widest text-xs text-center">Lanjut Bayar</a>
                </div>
            </div>
        </x-modal>

        <!-- MODAL CONFIRM DELETE -->
        <x-modal :name="'confirm-draft-cancel-'.$activeDraft->id" focusable>
            <div class="p-12 text-center bg-white rounded-[3rem]">
                <div class="w-24 h-24 bg-rose-50 text-rose-500 rounded-3xl flex items-center justify-center mx-auto mb-8 transform rotate-12 shadow-inner border border-rose-100">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>
                <h2 class="text-3xl font-black text-slate-800 mb-2 uppercase tracking-tight">Hapus Draft?</h2>
                <p class="text-slate-500 mb-10 font-medium">Data transaksi yang sedang berlangsung akan hilang secara permanen.</p>
                <div class="flex gap-4">
                    <button type="button" x-on:click="$dispatch('close')" class="flex-grow py-5 bg-slate-100 hover:bg-slate-200 rounded-2xl font-black text-slate-600 transition-all uppercase tracking-widest text-xs">Simpan Draft</button>
                    <form method="post" action="{{ route('pos.cancel_draft') }}" class="flex-grow">
                        @csrf
                        <input type="hidden" name="transaksi_id" value="{{ $activeDraft->id }}">
                        <button type="submit" class="w-full py-5 bg-rose-500 hover:bg-rose-600 rounded-2xl font-black text-white shadow-lg shadow-rose-200 transition-all uppercase tracking-widest text-xs">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </x-modal>

    </div>

    <script>
        function posSystem() {
            return {
                currentTime: '',
                currentDate: '',

                init() {
                    this.updateTime();
                    setInterval(() => this.updateTime(), 1000);

                    const barcodeInput = document.getElementById('barcode-input');
                    const form = document.getElementById('barcode-form');

                    barcodeInput.focus();
                    document.addEventListener('click', (e) => {
                        if (['INPUT', 'SELECT', 'TEXTAREA', 'BUTTON', 'A'].indexOf(e.target.tagName) === -1) {
                            barcodeInput.focus();
                        }
                    });

                    barcodeInput.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter') {
                            if (barcodeInput.value.length > 0) {
                                form.submit();
                            }
                        }
                    });
                },

                updateTime() {
                    const now = new Date();
                    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    this.currentDate = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
                    this.currentTime = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/\./g, ':');
                }
            }
        }
    </script>
</x-app-layout>
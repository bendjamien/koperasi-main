<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <!-- HEADER -->
        <div class="flex items-center gap-6 mb-10">
            <a href="{{ route('stok_log.index') }}" class="group flex items-center justify-center w-12 h-12 bg-white border border-slate-200 rounded-2xl text-slate-400 hover:text-sky-600 hover:border-sky-500 transition-all shadow-sm">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Catat Stok Masuk</h1>
                <p class="text-slate-500 font-medium italic text-sm">Input data persediaan baru ke dalam sistem gudang.</p>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/30 overflow-hidden">
            <div class="p-8 sm:p-12">
                <form action="{{ route('stok_log.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Produk Selection -->
                        <div class="space-y-2">
                            <label for="produk_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Pilih Produk</label>
                            <div class="relative">
                                <select id="produk_id" name="produk_id"
                                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all appearance-none"
                                        required>
                                    <option value="">-- Pilih Produk --</option>
                                    @foreach ($produks as $produk)
                                        <option value="{{ $produk->id }}" {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
                                            {{ $produk->nama_produk }} (Stok: {{ $produk->stok }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Masuk -->
                        <div class="space-y-2">
                            <label for="jumlah" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Jumlah Masuk</label>
                            <div class="relative">
                                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" min="1"
                                       class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-black text-slate-700 transition-all placeholder:text-slate-300 placeholder:font-bold" 
                                       placeholder="0" required>
                                <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 font-bold text-xs uppercase tracking-widest">
                                    Unit
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sumber Stok -->
                    <div class="space-y-2">
                        <label for="sumber" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Sumber / Supplier</label>
                        <div class="relative">
                            <input type="text" name="sumber" id="sumber" value="{{ old('sumber') }}"
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all placeholder:text-slate-300" 
                                   placeholder="Misal: PT. Sembako Makmur atau Restock Bulanan" required>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="space-y-2">
                        <label for="keterangan" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Keterangan Tambahan (Opsional)</label>
                        <textarea name="keterangan" id="keterangan" rows="4" 
                                  class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-medium text-slate-700 transition-all placeholder:text-slate-300"
                                  placeholder="Catatan kecil mengenai pengiriman atau kondisi barang...">{{ old('keterangan') }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" 
                                class="flex-grow px-8 py-5 bg-emerald-600 text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] hover:bg-emerald-700 transition-all shadow-xl shadow-emerald-100 flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Data Stok
                        </button>
                        <a href="{{ route('stok_log.index') }}" 
                           class="px-8 py-5 bg-slate-100 text-slate-500 rounded-2xl font-black text-sm uppercase tracking-[0.2em] hover:bg-slate-200 transition-all text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- INFO CARD -->
        <div class="mt-8 p-6 bg-sky-50 rounded-[2rem] border border-sky-100 flex items-start gap-4">
            <div class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-sky-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h4 class="text-sm font-black text-sky-900 uppercase tracking-widest mb-1">Informasi Penting</h4>
                <p class="text-xs font-bold text-sky-700/70 leading-relaxed">
                    Setiap data stok masuk yang Anda simpan akan secara otomatis menambah saldo stok produk terkait dan tercatat dalam sistem audit riwayat mutasi barang (Log Stok).
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
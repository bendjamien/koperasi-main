<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8" x-data="imageViewer()">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tambah Produk Baru</h1>
                <p class="mt-2 text-sm text-gray-600">Lengkapi detail produk di bawah ini untuk menambah stok barang.</p>
            </div>
            <a href="{{ route('produk.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-colors">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
                <div class="grid grid-cols-1 lg:grid-cols-3">
                    
                    <!-- Sisi Kiri: Upload Gambar & Preview -->
                    <div class="p-8 bg-gray-50 border-r border-gray-100 lg:col-span-1">
                        <label class="block text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider">Foto Produk</label>
                        
                        <div class="relative group">
                            <!-- Preview Area -->
                            <div class="w-full aspect-square rounded-2xl border-2 border-dashed border-gray-300 bg-white flex flex-col items-center justify-center overflow-hidden transition-all group-hover:border-sky-400 relative">
                                
                                <template x-if="!imageUrl">
                                    <div class="text-center p-6">
                                        <svg class="mx-auto h-16 w-16 text-gray-300 group-hover:text-sky-400 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p class="mt-4 text-sm text-gray-500 font-medium">Klik atau drag gambar ke sini</p>
                                    </div>
                                </template>

                                <template x-if="imageUrl">
                                    <img :src="imageUrl" class="w-full h-full object-cover shadow-inner">
                                </template>

                                <!-- Hidden File Input -->
                                <input type="file" name="gambar" id="gambar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" @change="fileChosen">
                            </div>

                            <!-- Reset Button -->
                            <template x-if="imageUrl">
                                <button type="button" @click="resetImage" class="absolute -top-2 -right-2 bg-red-500 text-white p-1.5 rounded-full shadow-lg hover:bg-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </template>
                        </div>
                        
                        <div class="mt-4 text-xs text-gray-400 space-y-1">
                            <p>• Rekomendasi ukuran 1:1 (Square)</p>
                            <p>• Maksimal ukuran file 2MB</p>
                            <p>• Format: JPG, PNG, WEBP</p>
                        </div>
                    </div>

                    <!-- Sisi Kanan: Form Detail -->
                    <div class="p-8 lg:col-span-2 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div class="md:col-span-2">
                                <label for="nama_produk" class="block text-sm font-bold text-gray-700 mb-1">Nama Produk</label>
                                <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk') }}" 
                                       placeholder="Contoh: Kopi Gula Aren"
                                       class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm" required>
                                @error('nama_produk') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="kategori_id" class="block text-sm font-bold text-gray-700 mb-1">Kategori</label>
                                <select name="kategori_id" id="kategori_id" required
                                        class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="kode_barcode" class="block text-sm font-bold text-gray-700 mb-1">Kode Barcode</label>
                                <div class="flex gap-2">
                                    <div class="relative flex-grow">
                                        <span class="absolute left-3 top-3.5 text-gray-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                        </span>
                                        <input type="text" name="kode_barcode" id="kode_barcode" value="{{ old('kode_barcode', $generatedBarcode) }}"
                                               placeholder="Scan atau ketik barcode"
                                               class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm">
                                    </div>
                                    <button type="button" onclick="generateNewBarcode()" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 rounded-xl border border-gray-300 transition-colors" title="Generate Barcode Baru">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                    </button>
                                </div>
                                <p class="mt-1 text-[10px] text-gray-400">Kode dibuat otomatis, Anda bisa mengubahnya jika perlu.</p>
                            </div>

                            <div class="bg-sky-50 p-4 rounded-2xl border border-sky-100">
                                <label for="harga_beli" class="block text-sm font-bold text-sky-800 mb-1">Harga Beli</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-sky-600 font-bold">Rp</span>
                                    <input type="number" name="harga_beli" id="harga_beli" value="{{ old('harga_beli', 0) }}"
                                           class="w-full pl-10 pr-4 py-2 bg-white border-sky-200 rounded-lg focus:ring-sky-500 focus:border-sky-500 font-bold text-sky-900 shadow-inner">
                                </div>
                            </div>

                            <div class="bg-emerald-50 p-4 rounded-2xl border border-emerald-100">
                                <label for="harga_jual" class="block text-sm font-bold text-emerald-800 mb-1">Harga Jual</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-emerald-600 font-bold">Rp</span>
                                    <input type="number" name="harga_jual" id="harga_jual" value="{{ old('harga_jual', 0) }}"
                                           class="w-full pl-10 pr-4 py-2 bg-white border-emerald-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 font-bold text-emerald-900 shadow-inner">
                                </div>
                            </div>

                            <div>
                                <label for="stok" class="block text-sm font-bold text-gray-700 mb-1">Stok Awal</label>
                                <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}"
                                       class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm">
                            </div>
                            
                            <div>
                                <label for="satuan" class="block text-sm font-bold text-gray-700 mb-1">Satuan</label>
                                <input type="text" name="satuan" id="satuan" value="{{ old('satuan', 'PCS') }}"
                                       placeholder="PCS, BOX, KG..."
                                       class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm">
                            </div>

                            <div class="md:col-span-2">
                                <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-1">Keterangan / Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" 
                                          placeholder="Tambahkan informasi detail produk..."
                                          class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 px-8 py-5 border-t border-gray-100 flex justify-end items-center gap-4">
                    <button type="reset" class="text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">Reset Form</button>
                    <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 px-10 rounded-xl shadow-lg shadow-sky-100 transition-all transform hover:-translate-y-0.5 active:scale-95">
                        Simpan Produk
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function generateNewBarcode() {
            const randomBarcode = Math.floor(1000000000 + Math.random() * 9000000000);
            document.getElementById('kode_barcode').value = randomBarcode;
        }

        function imageViewer() {
            return {
                imageUrl: '',

                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                },

                fileToDataUrl(event, callback) {
                    if (! event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },

                resetImage() {
                    this.imageUrl = '';
                    document.getElementById('gambar').value = '';
                }
            }
        }
    </script>
</x-app-layout>

<x-app-layout>
    <div class="max-w-3xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Kategori</h1>
                <p class="mt-2 text-sm text-gray-600">Perbarui informasi kategori <strong>{{ $kategori->nama }}</strong>.</p>
            </div>
            <a href="{{ route('kategori.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <form action="{{ route('kategori.update', $kategori) }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label for="nama" class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $kategori->nama) }}" 
                           class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm" required>
                    @error('nama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" 
                              class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                    @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-10 rounded-xl shadow-lg shadow-yellow-100 transition-all transform hover:-translate-y-0.5 active:scale-95">
                        Update Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

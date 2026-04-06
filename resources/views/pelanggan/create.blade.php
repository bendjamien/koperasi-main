<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Pendaftaran Pelanggan</h1>
                <p class="mt-2 text-sm text-gray-600">Daftarkan pelanggan baru untuk mulai mengumpulkan poin dan memberikan penawaran khusus.</p>
            </div>
            <a href="{{ route('pelanggan.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <form action="{{ route('pelanggan.store') }}" method="POST" class="p-8 space-y-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" 
                               placeholder="Contoh: Budi Santoso"
                               class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm" required>
                        @error('nama') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="no_hp" class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">No. Telepon / WhatsApp</label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" 
                               placeholder="08123xxxxxxx"
                               class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm" required>
                        @error('no_hp') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Email (Opsional)</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                               placeholder="budi@example.com"
                               class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm">
                        @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-bold text-gray-700 mb-1 uppercase tracking-wider">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" rows="3" 
                                  placeholder="Nama Jalan, Kelurahan, Kecamatan..."
                                  class="w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all shadow-sm">{{ old('alamat') }}</textarea>
                        @error('alamat') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="bg-orange-50 p-6 rounded-2xl border border-orange-100">
                        <label for="member_level" class="block text-sm font-bold text-orange-800 mb-2 uppercase tracking-wider">Level Member Awal</label>
                        <select name="member_level" id="member_level"
                                class="w-full px-4 py-2 bg-white border-orange-200 rounded-lg focus:ring-orange-500 focus:border-orange-500 font-bold text-orange-900 shadow-inner">
                            <option value="Bronze" {{ old('member_level') == 'Bronze' ? 'selected' : '' }}>Bronze (Default)</option>
                            <option value="Silver" {{ old('member_level') == 'Silver' ? 'selected' : '' }}>Silver</option>
                            <option value="Gold" {{ old('member_level') == 'Gold' ? 'selected' : '' }}>Gold</option>
                        </select>
                    </div>

                    <div class="bg-sky-50 p-6 rounded-2xl border border-sky-100">
                        <label for="poin" class="block text-sm font-bold text-sky-800 mb-2 uppercase tracking-wider">Saldo Poin Awal</label>
                        <div class="relative">
                            <input type="number" name="poin" id="poin" value="{{ old('poin', 0) }}"
                                   class="w-full pr-12 pl-4 py-2 bg-white border-sky-200 rounded-lg focus:ring-sky-500 focus:border-sky-500 font-bold text-sky-900 shadow-inner">
                            <span class="absolute right-3 top-2.5 text-sky-600 font-bold text-xs uppercase">Pts</span>
                        </div>
                    </div>

                </div>

                <div class="pt-6 border-t flex justify-end">
                    <button type="submit" 
                            class="bg-sky-600 hover:bg-sky-700 text-white font-bold py-4 px-12 rounded-xl shadow-lg shadow-sky-100 transition-all transform hover:-translate-y-0.5 active:scale-95">
                        Daftarkan Pelanggan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

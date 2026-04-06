<x-app-layout>
    <div class="space-y-8">
        <h1 class="text-2xl font-bold text-gray-800">Pengaturan Aplikasi</h1>

        <form action="{{ route('pengaturan.update') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md h-full">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Pajak (PPN)</h2>
                    <div>
                        <label for="ppn_tax_rate" class="block text-sm font-medium text-gray-700">Tarif PPN (%)</label>
                        <div class="mt-1 flex items-center gap-2">
                            <input type="number" name="ppn_tax_rate" id="ppn_tax_rate" 
                                   value="{{ old('ppn_tax_rate', $settings['ppn_tax_rate']) }}" step="0.01"
                                   class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            <span class="text-gray-600 font-medium">%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md h-full border-t-4 border-sky-500">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                        Loyalitas Pelanggan
                    </h2>
                    <div class="space-y-4">
                        <div>
                            <label for="loyalty_points_per_nominal" class="block text-xs font-bold text-gray-500 uppercase">Poin per Belanja (Nominal)</label>
                            <div class="mt-1 relative">
                                <span class="absolute left-3 top-2.5 text-gray-400 text-sm font-bold border-r pr-2">Rp</span>
                                <input type="number" name="loyalty_points_per_nominal" id="loyalty_points_per_nominal" 
                                       value="{{ old('loyalty_points_per_nominal', $settings['loyalty_points_per_nominal']) }}" 
                                       class="block w-full pl-12 border-gray-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500" required>
                            </div>
                            <p class="mt-1 text-[10px] text-gray-500 italic">Contoh: Isi 10.000 untuk memberi 1 poin setiap belanja 10rb.</p>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 pt-2 border-t">
                            <div>
                                <label for="member_silver_threshold" class="block text-xs font-bold text-gray-500 uppercase italic text-slate-500">Threshold SILVER</label>
                                <input type="number" name="member_silver_threshold" id="member_silver_threshold" 
                                       value="{{ old('member_silver_threshold', $settings['member_silver_threshold']) }}" 
                                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-slate-500 focus:border-slate-500" required>
                                <p class="text-[9px] text-gray-400 mt-1">Minimal poin untuk jadi Silver.</p>
                            </div>
                            <div>
                                <label for="member_gold_threshold" class="block text-xs font-bold text-gray-500 uppercase italic text-amber-600">Threshold GOLD</label>
                                <input type="number" name="member_gold_threshold" id="member_gold_threshold" 
                                       value="{{ old('member_gold_threshold', $settings['member_gold_threshold']) }}" 
                                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500" required>
                                <p class="text-[9px] text-gray-400 mt-1">Minimal poin untuk jadi Gold.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Info Toko</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Nama Bisnis</label>
                            <input type="text" name="company_name" value="{{ $settings['company_name'] }}" class="mt-1 block w-full border-gray-300 rounded-md text-sm shadow-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500">Alamat</label>
                            <input type="text" name="company_address" value="{{ $settings['company_address'] }}" class="mt-1 block w-full border-gray-300 rounded-md text-sm shadow-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-500">Telepon</label>
                                <input type="text" name="company_phone" value="{{ $settings['company_phone'] }}" class="mt-1 block w-full border-gray-300 rounded-md text-sm shadow-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500">Email</label>
                                <input type="text" name="company_email" value="{{ $settings['company_email'] }}" class="mt-1 block w-full border-gray-300 rounded-md text-sm shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-emerald-500">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Jam Kerja & Absensi
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="jam_masuk" class="block text-xs font-bold text-gray-500 uppercase">Jam Masuk</label>
                            <input type="time" name="jam_masuk" id="jam_masuk" 
                                   value="{{ old('jam_masuk', $settings['jam_masuk']) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                        <div>
                            <label for="jam_pulang" class="block text-xs font-bold text-gray-500 uppercase">Jam Pulang</label>
                            <input type="time" name="jam_pulang" id="jam_pulang" 
                                   value="{{ old('jam_pulang', $settings['jam_pulang']) }}" 
                                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500" required>
                        </div>
                    </div>
                    <p class="mt-3 text-[10px] text-gray-500 italic leading-relaxed">
                        * Jam masuk digunakan untuk menentukan status "Terlambat".<br>
                        * Jam pulang adalah acuan waktu kerja berakhir.
                    </p>
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition">
                    Simpan Pengaturan Umum
                </button>
            </div>
        </form>

        <hr class="border-gray-300">

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Manajemen Voucher Diskon</h2>

            <form action="{{ route('vouchers.store') }}" method="POST" class="mb-8 bg-gray-50 p-4 rounded-lg border border-gray-200">
                @csrf
                <div class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="w-full md:w-1/4">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Kode Voucher</label>
                        <input type="text" name="kode" placeholder="CONTOH: HEMAT10" class="block w-full rounded-md border-gray-300 shadow-sm uppercase focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    <div class="w-full md:w-1/4">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Tipe</label>
                        <select name="tipe" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                            <option value="nominal">Potongan Harga (Rp)</option>
                            <option value="persen">Potongan Persen (%)</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/4">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nilai</label>
                        <input type="number" name="nilai" placeholder="Cth: 10000 atau 10" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>
                    <div class="w-full md:w-auto">
                        <button type="submit" class="w-full bg-sky-500 text-white px-6 py-2 rounded-md hover:bg-sky-700 font-semibold shadow-sm">
                            + Tambah Voucher
                        </button>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Kode</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Diskon</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($vouchers as $voucher)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap font-mono font-bold text-sky-600 text-lg">{{ $voucher->kode }}</td>
                            <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-800">
                                {{ $voucher->tipe == 'nominal' ? 'Rp '.number_format($voucher->nilai, 0, ',', '.') : $voucher->nilai . '%' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <form action="{{ route('vouchers.toggle', $voucher->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="px-3 py-1 text-xs font-semibold rounded-full transition-colors {{ $voucher->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                        {{ $voucher->is_active ? 'AKTIF' : 'NON-AKTIF' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right">
                                <button type="button" 
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-voucher-deletion-{{ $voucher->id }}')"
                                        class="text-red-500 hover:text-red-700 font-medium text-sm">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500 italic">Belum ada voucher yang dibuat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($vouchers as $voucher)
        <x-modal :name="'confirm-voucher-deletion-'.$voucher->id" focusable>
            <form method="post" action="{{ route('vouchers.destroy', $voucher->id) }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    Apakah Anda yakin ingin menghapus voucher ini?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Voucher <strong>{{ $voucher->kode }}</strong> akan dihapus permanen dan tidak dapat digunakan lagi oleh kasir.
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Ya, Hapus Voucher') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endforeach
</x-app-layout>
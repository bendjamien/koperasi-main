<x-app-layout>
    <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Akun Baru</h1>
            <a href="{{ route('users.index') }}" class="text-sm text-gray-600 hover:text-sky-500">&larr; Kembali ke Daftar</a>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-sky-500 focus:border-sky-500" 
                           required>
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}" 
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-sky-500 focus:border-sky-500" 
                           required>
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-sky-500 focus:border-sky-500"
                       required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Role (Hak Akses)</label>
                    <select id="role" name="role" class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-sky-500 focus:border-sky-500" onchange="toggleKodeAbsen()">
                        <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status Akun</label>
                    <div class="mt-2 space-y-1">
                        <label class="inline-flex items-center">
                            <input type="radio" name="status" value="1" class="form-radio text-sky-600" checked>
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                        <label class="inline-flex items-center ml-4">
                            <input type="radio" name="status" value="0" class="form-radio text-red-600">
                            <span class="ml-2 text-sm text-gray-700">Non-Aktif</span>
                        </label>
                    </div>
                </div>
            </div>

            <div id="kode_absen_container">
                <label for="kode_absen" class="block text-sm font-medium text-gray-700">Kode Absen (Opsional)</label>
                <div class="mt-1 flex gap-2">
                    <input type="text" name="kode_absen" id="kode_absen" value="{{ old('kode_absen') }}"
                           placeholder="Generate otomatis jika kosong"
                           class="flex-grow border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-sky-500 focus:border-sky-500 font-mono font-bold">
                    <button type="button" onclick="generateCode()" class="bg-slate-800 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-slate-700 transition">
                        Generate
                    </button>
                </div>
                <p class="text-[10px] text-gray-500 italic mt-1">* Jika dikosongkan, sistem akan membuatkan kode unik saat disimpan.</p>
            </div>

            <script>
                function toggleKodeAbsen() {
                    const role = document.getElementById('role').value;
                    const container = document.getElementById('kode_absen_container');
                    if (role === 'kasir') {
                        container.style.display = 'block';
                    } else {
                        container.style.display = 'none';
                        document.getElementById('kode_absen').value = '';
                    }
                }

                function generateCode() {
                    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    let result = '';
                    for (let i = 0; i < 8; i++) {
                        result += chars.charAt(Math.floor(Math.random() * chars.length));
                    }
                    document.getElementById('kode_absen').value = result;
                }

                // Initial check
                document.addEventListener('DOMContentLoaded', toggleKodeAbsen);
            </script>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" 
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-sky-500 focus:border-sky-500" 
                           required>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm py-2 px-3 focus:outline-none focus:ring-sky-500 focus:border-sky-500" 
                           required>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" 
                        class="bg-sky-500 hover:bg-sky-600 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200">
                    Simpan Akun
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
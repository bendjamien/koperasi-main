<x-app-layout>
    <div class="p-4 sm:p-6 lg:p-8 bg-gray-50 min-h-screen">
        
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl p-6 mb-8 shadow-lg">
            <h1 class="text-2xl sm:text-3xl font-bold text-white">
                Pengaturan Profil
            </h1>
            <p class="mt-2 text-blue-100 max-w-2xl">
                Kelola informasi profil, keamanan akun, dan preferensi Anda
            </p>
        </div>
        <div x-data="{ activeTab: 'info' }" class="lg:grid lg:grid-cols-12 lg:gap-8">
            <div class="lg:col-span-3 mb-6 lg:mb-0">
                <div class="hidden lg:block bg-white rounded-xl shadow-sm p-2">
                    <button @click="activeTab = 'info'"
                            :class="{ 
                                'bg-blue-50 text-blue-700 border-r-2 border-blue-700': activeTab === 'info', 
                                'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeTab !== 'info' 
                            }"
                            class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 focus:outline-none">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">Informasi Profil</span>
                    </button>
                    <button @click="activeTab = 'password'"
                            :class="{ 
                                'bg-blue-50 text-blue-700 border-r-2 border-blue-700': activeTab === 'password', 
                                'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeTab !== 'password' 
                            }"
                            class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 focus:outline-none">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">Ubah Password</span>
                    </button>

                    @if(Auth::user()->role == 'kasir')
                    <button @click="activeTab = 'qrcode'"
                            :class="{ 
                                'bg-blue-50 text-blue-700 border-r-2 border-blue-700': activeTab === 'qrcode', 
                                'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeTab !== 'qrcode' 
                            }"
                            class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        <span class="font-medium">QR Code Absensi</span>
                    </button>
                    @endif
                    <button @click="activeTab = 'delete'"
                            :class="{ 
                                'bg-red-50 text-red-700 border-r-2 border-red-700': activeTab === 'delete', 
                                'text-gray-600 hover:bg-gray-50 hover:text-gray-900': activeTab !== 'delete' 
                            }"
                            class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200 focus:outline-none">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">Hapus Akun</span>
                    </button>
                </div>

                <div class="lg:hidden flex space-x-2 overflow-x-auto pb-2 -mx-4 px-4">
                    <button @click="activeTab = 'info'"
                            :class="{ 
                                'bg-blue-600 text-white': activeTab === 'info', 
                                'bg-white text-gray-600 border border-gray-200': activeTab !== 'info' 
                            }"
                            class="flex items-center space-x-2 px-4 py-2.5 rounded-lg transition-colors duration-200 focus:outline-none whitespace-nowrap">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" />
                        </svg>
                        <span>Profil</span>
                    </button>

                    <button @click="activeTab = 'password'"
                            :class="{ 
                                'bg-blue-600 text-white': activeTab === 'password', 
                                'bg-white text-gray-600 border border-gray-200': activeTab !== 'password' 
                            }"
                            class="flex items-center space-x-2 px-4 py-2.5 rounded-lg transition-colors duration-200 focus:outline-none whitespace-nowrap">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                        </svg>
                        <span>Password</span>
                    </button>

                    @if(Auth::user()->role == 'kasir')
                    <button @click="activeTab = 'qrcode'"
                            :class="{ 
                                'bg-blue-600 text-white': activeTab === 'qrcode', 
                                'bg-white text-gray-600 border border-gray-200': activeTab !== 'qrcode' 
                            }"
                            class="flex items-center space-x-2 px-4 py-2.5 rounded-lg transition-colors duration-200 focus:outline-none whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        <span>QR Code</span>
                    </button>
                    @endif

                    <button @click="activeTab = 'delete'"
                            :class="{ 
                                'bg-red-600 text-white': activeTab === 'delete', 
                                'bg-white text-gray-600 border border-gray-200': activeTab !== 'delete' 
                            }"
                            class="flex items-center space-x-2 px-4 py-2.5 rounded-lg transition-colors duration-200 focus:outline-none whitespace-nowrap">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <span>Hapus</span>
                    </button>
                </div>
            </div>

            <div class="lg:col-span-9">
                <div x-show="activeTab === 'info'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="bg-white rounded-xl shadow-sm overflow-hidden">
                    
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b border-blue-100">
                        <div class="flex items-center">
                            <div class="bg-blue-100 rounded-full p-3 mr-4">
                                <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Informasi Profil</h2>
                                <p class="mt-1 text-sm text-gray-600">Perbarui informasi profil dan alamat email Anda</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 sm:p-8">
                        <div class="max-w-2xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'password'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="bg-white rounded-xl shadow-sm overflow-hidden" 
                     style="display: none;">

                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 border-b border-blue-100">
                        <div class="flex items-center">
                            <div class="bg-blue-100 rounded-full p-3 mr-4">
                                <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Ubah Password</h2>
                                <p class="mt-1 text-sm text-gray-600">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="max-w-2xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                @if(Auth::user()->role == 'kasir')
                <div x-show="activeTab === 'qrcode'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="bg-white rounded-xl shadow-sm overflow-hidden" 
                     style="display: none;">

                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 p-6 border-b border-emerald-100">
                        <div class="flex items-center">
                            <div class="bg-emerald-100 rounded-full p-3 mr-4">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">QR Code Absensi</h2>
                                <p class="mt-1 text-sm text-gray-600">Gunakan QR Code ini untuk melakukan absensi harian</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-12 flex flex-col items-center">
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-2xl shadow-emerald-100 border-8 border-slate-50 flex flex-col items-center">
                            @if(Auth::user()->kode_absen)
                                <div class="p-4 bg-white rounded-2xl border-2 border-slate-100">
                                    {!! (new Milon\Barcode\DNS2D)->getBarcodeHTML(Auth::user()->kode_absen, 'QRCODE', 10, 10) !!}
                                </div>
                                <div class="mt-8 text-center">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2">PERSONAL ID CODE</p>
                                    <div class="bg-slate-900 text-white px-6 py-2 rounded-xl">
                                        <p class="text-2xl font-black tracking-[0.2em] font-mono">{{ Auth::user()->kode_absen }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-10">
                                    <div class="w-20 h-20 bg-rose-50 rounded-full flex items-center justify-center text-rose-500 mx-auto mb-4">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    </div>
                                    <p class="text-slate-800 font-black uppercase tracking-widest text-sm">Kode Belum Diatur</p>
                                    <p class="text-slate-400 text-xs mt-2">Silakan hubungi Admin untuk mengaktifkan fitur absensi Anda.</p>
                                </div>
                            @endif
                        </div>
                        
                        <div class="mt-12 max-w-sm text-center">
                            <div class="flex items-center gap-2 justify-center mb-3">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Active Attendance System</span>
                            </div>
                            <p class="text-xs text-slate-400 font-medium leading-relaxed italic">
                                "Gunakan QR Code di atas pada scanner di meja kasir saat mulai bertugas dan saat selesai bertugas."
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <div x-show="activeTab === 'delete'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="bg-white rounded-xl shadow-sm overflow-hidden" 
                     style="display: none;">

                    <div class="bg-gradient-to-r from-red-50 to-pink-50 p-6 border-b border-red-100">
                        <div class="flex items-center">
                            <div class="bg-red-100 rounded-full p-3 mr-4">
                                <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Hapus Akun</h2>
                                <p class="mt-1 text-sm text-gray-600">Setelah akun Anda dihapus, semua data akan dihapus permanen. Harap berhati-hati.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="max-w-2xl">
                            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-700">
                                            Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
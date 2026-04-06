<x-app-layout>
    <!-- Midtrans Snap JS -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8" x-data="checkoutSystem()">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Checkout Pembayaran</h1>
                <p class="mt-2 text-sm text-gray-600">Selesaikan transaksi untuk invoice <strong>#{{ $transaksi->id }}</strong></p>
            </div>
            <a href="{{ route('pos.index', $transaksi) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Kasir
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- SISI KIRI: METODE PEMBAYARAN -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white shadow-xl rounded-[2.5rem] border border-gray-100 overflow-hidden">
                    <div class="p-8 border-b border-gray-50">
                        <h2 class="text-xl font-black text-gray-800">Pilih Metode Pembayaran</h2>
                    </div>
                    
                    <div class="p-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- TUNAI -->
                        <button type="button" @click="paymentMethod = 'Tunai'"
                                :class="paymentMethod === 'Tunai' ? 'ring-4 ring-sky-500/20 border-sky-500 bg-sky-50' : 'border-gray-100 bg-white hover:border-sky-200'"
                                class="p-6 border-2 rounded-[2rem] text-left transition-all group relative overflow-hidden">
                            <div class="flex items-center gap-4 relative z-10">
                                <div :class="paymentMethod === 'Tunai' ? 'bg-sky-500 text-white' : 'bg-gray-100 text-gray-400'" class="w-12 h-12 rounded-2xl flex items-center justify-center transition-colors">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-black text-gray-800 uppercase tracking-wider text-sm">Tunai / Cash</p>
                                    <p class="text-xs text-gray-500 mt-1">Pembayaran langsung di kasir</p>
                                </div>
                            </div>
                            <div x-show="paymentMethod === 'Tunai'" class="absolute -right-2 -bottom-2 opacity-10">
                                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </div>
                        </button>

                        <!-- NON-TUNAI (MIDTRANS) -->
                        <button type="button" @click="paymentMethod = 'Midtrans'"
                                :class="paymentMethod === 'Midtrans' ? 'ring-4 ring-sky-500/20 border-sky-500 bg-sky-50' : 'border-gray-100 bg-white hover:border-sky-200'"
                                class="p-6 border-2 rounded-[2rem] text-left transition-all group relative overflow-hidden">
                            <div class="flex items-center gap-4 relative z-10">
                                <div :class="paymentMethod === 'Midtrans' ? 'bg-sky-500 text-white' : 'bg-gray-100 text-gray-400'" class="w-12 h-12 rounded-2xl flex items-center justify-center transition-colors">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-black text-gray-800 uppercase tracking-wider text-sm">QRIS / VA / E-Wallet</p>
                                    <p class="text-xs text-gray-500 mt-1">Otomatis via Midtrans</p>
                                </div>
                            </div>
                            <div x-show="paymentMethod === 'Midtrans'" class="absolute -right-2 -bottom-2 opacity-10">
                                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </div>
                        </button>
                    </div>

                    <!-- Input Tunai -->
                    <div x-show="paymentMethod === 'Tunai'" class="p-8 bg-gray-50 border-t border-gray-100" x-transition>
                        <label class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-4">Uang Diterima (Cash)</label>
                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-2xl font-black text-gray-400">Rp</span>
                            <input type="number" x-model.number="cashAmount" 
                                   class="w-full pl-20 pr-8 py-6 bg-white border-none rounded-3xl text-4xl font-black focus:ring-4 focus:ring-sky-500/20 transition-all shadow-inner text-sky-600"
                                   placeholder="0">
                        </div>
                        <div class="mt-6 grid grid-cols-3 gap-3">
                            <button @click="cashAmount = grandTotal" class="py-3 bg-white border border-gray-200 rounded-xl text-xs font-bold hover:bg-sky-50 transition-colors">Uang Pas</button>
                            <button @click="cashAmount = 50000" class="py-3 bg-white border border-gray-200 rounded-xl text-xs font-bold hover:bg-sky-50 transition-colors">Rp 50.000</button>
                            <button @click="cashAmount = 100000" class="py-3 bg-white border border-gray-200 rounded-xl text-xs font-bold hover:bg-sky-50 transition-colors">Rp 100.000</button>
                        </div>
                    </div>

                    <!-- Info Midtrans -->
                    <div x-show="paymentMethod === 'Midtrans'" class="p-8 bg-sky-50 border-t border-sky-100 text-center" x-transition>
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                            <svg class="w-8 h-8 text-sky-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <p class="text-sky-800 font-bold">Jendela pembayaran Midtrans akan muncul saat Anda klik "Proses Bayar"</p>
                        <p class="text-sky-600 text-xs mt-1 italic">Mendukung GoPay, ShopeePay, Dana, dan Virtual Account Bank Utama</p>
                    </div>
                </div>
            </div>

            <!-- SISI KANAN: RINGKASAN & TOTAL -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-2xl rounded-[2.5rem] border border-gray-100 overflow-hidden sticky top-8">
                    <div class="p-8 bg-gray-900 text-white">
                        <h2 class="text-xs font-black text-sky-400 uppercase tracking-[0.3em] mb-4">Total Tagihan</h2>
                        <p class="text-5xl font-black tracking-tighter">
                            <span class="text-xl font-bold opacity-50 mr-1">Rp</span>{{ number_format($subtotal + ($subtotal * $taxRate), 0, ',', '.') }}
                        </p>
                    </div>

                    <div class="p-8 space-y-6">
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm font-bold text-gray-500 uppercase tracking-widest">
                                <span>Subtotal</span>
                                <span class="text-gray-800">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm font-bold text-gray-500 uppercase tracking-widest">
                                <span>PPN ({{ $taxRate * 100 }}%)</span>
                                <span class="text-gray-800">Rp{{ number_format($subtotal * $taxRate, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-dashed border-gray-200">
                            <div x-show="paymentMethod === 'Tunai'" class="flex justify-between items-center bg-emerald-50 p-4 rounded-2xl border border-emerald-100">
                                <span class="text-xs font-black text-emerald-600 uppercase tracking-widest">Kembalian</span>
                                <span class="text-xl font-black text-emerald-700" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(changeAmount)"></span>
                            </div>
                        </div>

                        <form id="final-checkout-form" action="{{ route('pos.checkout.store', $transaksi) }}" method="POST">
                            @csrf
                            <input type="hidden" name="metode_bayar" x-model="paymentMethod">
                            <input type="hidden" name="nominal_bayar" x-model="cashAmount">
                            <input type="hidden" name="diskon_amount" value="0">

                            <button type="button" @click="processPayment"
                                    class="w-full py-6 bg-sky-600 hover:bg-sky-700 text-white rounded-[1.5rem] shadow-xl shadow-sky-200 transition-all transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3 group"
                                    :disabled="paymentMethod === 'Tunai' && cashAmount < grandTotal">
                                <span class="text-lg font-black uppercase tracking-[0.2em]">Proses Bayar</span>
                                <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function checkoutSystem() {
            return {
                paymentMethod: 'Tunai',
                cashAmount: 0,
                grandTotal: {{ $subtotal + ($subtotal * $taxRate) }},
                snapToken: '{{ $snapToken }}',

                get changeAmount() {
                    if (this.cashAmount <= this.grandTotal) return 0;
                    return this.cashAmount - this.grandTotal;
                },

                processPayment() {
                    if (this.paymentMethod === 'Midtrans') {
                        window.snap.pay(this.snapToken, {
                            onSuccess: (result) => {
                                // Update form field sebelum submit
                                this.cashAmount = this.grandTotal;
                                document.getElementById('final-checkout-form').submit();
                            },
                            onPending: (result) => {
                                alert("Menunggu pembayaran...");
                            },
                            onError: (result) => {
                                alert("Pembayaran gagal!");
                            }
                        });
                    } else {
                        // Bayar Tunai
                        if (this.cashAmount < this.grandTotal) {
                            alert('Uang tunai kurang!');
                            return;
                        }
                        document.getElementById('final-checkout-form').submit();
                    }
                }
            }
        }
    </script>
</x-app-layout>

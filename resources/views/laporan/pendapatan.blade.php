<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- HEADER & ACTIONS -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Laporan Pendapatan</h1>
                <p class="mt-2 text-slate-500 font-medium italic">Pantau performa penjualan dan arus kas bisnis Anda secara real-time.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('laporan.pendapatan.pdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="flex items-center gap-2 px-5 py-3 bg-white border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export PDF
                </a>
                <a href="{{ route('laporan.pendapatan.excel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="flex items-center gap-2 px-5 py-3 bg-emerald-600 text-white rounded-2xl text-sm font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export Excel
                </a>
            </div>
        </div>

        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Omzet -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/20 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                <div class="absolute -right-4 -top-4 w-32 h-32 bg-sky-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-sky-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-sky-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Akumulasi</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tighter">Rp{{ number_format($totalSemua, 0, ',', '.') }}</h3>
                    <p class="mt-4 text-[10px] font-bold text-sky-600 bg-sky-50 inline-block px-3 py-1 rounded-full">ALL TIME SALES</p>
                </div>
            </div>

            <!-- Omzet Bulan Ini -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/20 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300 border-t-4 border-t-indigo-500">
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-indigo-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-indigo-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                    </div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Penjualan Bulan Ini</p>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tighter">Rp{{ number_format($totalBulanIni, 0, ',', '.') }}</h3>
                    <p class="mt-4 text-[10px] font-bold text-indigo-600 bg-indigo-50 inline-block px-3 py-1 rounded-full">MONTHLY REVENUE</p>
                </div>
            </div>

            <!-- Omzet Hari Ini -->
            <div class="bg-slate-900 p-8 rounded-[2.5rem] shadow-2xl shadow-sky-900/20 relative overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                <div class="absolute right-0 bottom-0 opacity-10">
                    <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                </div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-sky-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-sky-500/50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <p class="text-xs font-black text-sky-400 uppercase tracking-[0.2em] mb-1">Pemasukan Hari Ini</p>
                    <h3 class="text-3xl font-black text-white tracking-tighter">Rp{{ number_format($totalHariIni, 0, ',', '.') }}</h3>
                    <p class="mt-4 text-[10px] font-black text-white bg-sky-500/20 border border-sky-500/30 inline-block px-3 py-1 rounded-full">DAILY SUCCESS</p>
                </div>
            </div>
        </div>

        <!-- TREND CHART SECTION -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/20">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <h2 class="text-xl font-black text-slate-800 tracking-tight">Tren Pendapatan 30 Hari Terakhir</h2>
                <div class="flex items-center gap-2 bg-slate-50 p-1.5 rounded-2xl border border-slate-100">
                    <button onclick="updateChartType('line')" id="btn-line" class="chart-type-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-white shadow-sm text-sky-600">
                        Line
                    </button>
                    <button onclick="updateChartType('bar')" id="btn-bar" class="chart-type-btn px-4 py-2 rounded-xl text-xs font-bold transition-all text-slate-500 hover:text-slate-700">
                        Bar
                    </button>
                    <button onclick="updateChartType('area')" id="btn-area" class="chart-type-btn px-4 py-2 rounded-xl text-xs font-bold transition-all text-slate-500 hover:text-slate-700">
                        Area
                    </button>
                    <button onclick="updateChartType('stepped')" id="btn-stepped" class="chart-type-btn px-4 py-2 rounded-xl text-xs font-bold transition-all text-slate-500 hover:text-slate-700">
                        Stepped
                    </button>
                    <button onclick="updateChartType('trading')" id="btn-trading" class="chart-type-btn px-4 py-2 rounded-xl text-xs font-bold transition-all text-slate-500 hover:text-slate-700">
                        Trading
                    </button>
                </div>
            </div>
            <div class="h-80">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <script>
            let revenueChart = null;

            function updateChartType(type) {
                const chartData = @json($chartData);
                const ctx = document.getElementById('revenueChart').getContext('2d');
                
                const labels = chartData.map(item => {
                    const date = new Date(item.date);
                    return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                });
                const totals = chartData.map(item => item.total);

                if (revenueChart) {
                    revenueChart.destroy();
                }

                // Update UI buttons
                document.querySelectorAll('.chart-type-btn').forEach(btn => {
                    btn.classList.remove('bg-white', 'shadow-sm', 'text-sky-600');
                    btn.classList.add('text-slate-500');
                });
                const activeBtn = document.getElementById('btn-' + type);
                if (activeBtn) {
                    activeBtn.classList.remove('text-slate-500');
                    activeBtn.classList.add('bg-white', 'shadow-sm', 'text-sky-600');
                }

                let backgroundColor = '#0ea5e9';
                let borderColor = '#0ea5e9';
                let fill = true;
                let tension = 0.4;
                let stepped = false;
                let borderRadius = 0;
                let borderWidth = 4;
                let pointRadius = 4;

                if (type === 'bar') {
                    borderWidth = 0;
                    pointRadius = 0;
                    borderRadius = 8;
                    fill = false;
                } else if (type === 'area') {
                    backgroundColor = 'rgba(14, 165, 233, 0.1)';
                } else if (type === 'stepped') {
                    stepped = true;
                    tension = 0;
                    backgroundColor = 'rgba(14, 165, 233, 0.1)';
                } else if (type === 'trading') {
                    // Trading style: Bar chart with colors based on trend
                    backgroundColor = totals.map((val, i) => {
                        if (i === 0) return '#10b981'; // Green for first
                        return val >= totals[i-1] ? '#10b981' : '#ef4444'; // Green if up, Red if down
                    });
                    borderColor = backgroundColor;
                    type = 'bar';
                    borderWidth = 0;
                    pointRadius = 0;
                    borderRadius = 4;
                    fill = false;
                } else {
                    backgroundColor = 'rgba(14, 165, 233, 0.1)';
                }

                let chartConfig = {
                    type: type === 'stepped' || type === 'area' ? 'line' : type,
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: totals,
                            borderColor: borderColor,
                            backgroundColor: backgroundColor,
                            fill: fill,
                            tension: tension,
                            stepped: stepped,
                            borderWidth: borderWidth,
                            pointRadius: pointRadius,
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#0ea5e9',
                            pointBorderWidth: 2,
                            borderRadius: borderRadius,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#0f172a',
                                titleFont: { size: 14, weight: 'bold' },
                                bodyFont: { size: 13 },
                                padding: 12,
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: '#f1f5f9' },
                                ticks: {
                                    font: { size: 11, weight: 'bold' },
                                    color: '#94a3b8',
                                    callback: function(value) {
                                        if (value >= 1000000) return (value / 1000000) + ' Jt';
                                        if (value >= 1000) return (value / 1000) + ' Rb';
                                        return value;
                                    }
                                }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 11, weight: 'bold' }, color: '#94a3b8' }
                            }
                        }
                    }
                };

                revenueChart = new Chart(ctx, chartConfig);
            }

            document.addEventListener('DOMContentLoaded', function () {
                updateChartType('line');
            });
        </script>

        <!-- FILTERS -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <form action="{{ route('laporan.pendapatan') }}" method="GET" class="m-0">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                        <div class="relative group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Mulai Tanggal</label>
                            <input type="date" name="start_date" value="{{ $startDate }}" 
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all">
                        </div>
                        <div class="relative group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Sampai Tanggal</label>
                            <input type="date" name="end_date" value="{{ $endDate }}" 
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all">
                        </div>
                    </div>
                    <div class="flex items-end gap-3 w-full md:w-auto">
                        <button type="submit" class="flex-grow md:flex-none px-10 py-4 bg-slate-900 text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-200">
                            Tampilkan
                        </button>
                        <a href="{{ route('laporan.pendapatan') }}" class="p-4 bg-slate-100 text-slate-400 rounded-2xl hover:bg-slate-200 transition-all" title="Reset Filter">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- TABLE SECTION -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/30 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h2 class="text-xl font-black text-slate-800 tracking-tight">Riwayat Transaksi Terperinci</h2>
                <div class="text-right">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Filtered</p>
                    <p class="text-lg font-black text-sky-600">Rp{{ number_format($totalFiltered, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">ID Transaksi</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Waktu & Tanggal</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Pelanggan</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Metode</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-right">Total Bayar</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($transaksis as $trx)
                            <tr class="hover:bg-sky-50/30 transition-all group">
                                <td class="px-8 py-6">
                                    <span class="text-sm font-black text-slate-700 bg-slate-100 px-3 py-1 rounded-full group-hover:bg-white group-hover:shadow-sm transition-all border border-transparent group-hover:border-slate-100">#{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($trx->tanggal)->isoFormat('D MMMM Y') }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">{{ \Carbon\Carbon::parse($trx->tanggal)->format('H:i') }} WIB</p>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-sky-100 rounded-full flex items-center justify-center text-sky-600 font-black text-[10px]">
                                            {{ substr($trx->pelanggan->nama ?? 'U', 0, 1) }}
                                        </div>
                                        <p class="text-sm font-bold text-slate-700">{{ $trx->pelanggan->nama ?? 'Pelanggan Umum' }}</p>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $trx->metode_bayar == 'Tunai' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-indigo-50 text-indigo-600 border-indigo-100' }}">
                                        {{ $trx->metode_bayar ?? 'Tunai' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <p class="text-base font-black text-slate-900 tracking-tight">Rp{{ number_format($trx->total, 0, ',', '.') }}</p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <a href="{{ route('transaksi.show', $trx) }}" class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-sky-600 hover:border-sky-500 hover:shadow-lg hover:shadow-sky-100 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center opacity-30">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        <p class="text-xl font-black italic tracking-widest uppercase">Belum ada data transaksi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transaksis->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                    {{ $transaksis->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

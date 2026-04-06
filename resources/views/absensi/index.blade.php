<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- HEADER -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight">Laporan Absensi Kasir</h1>
                <p class="mt-2 text-slate-500 font-medium italic">Monitor kedisiplinan dan waktu kerja tim kasir Anda secara real-time.</p>
            </div>
            <div class="flex gap-3">
                <div class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>
        </div>

        <!-- FILTERS -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <form action="{{ route('absensi.index') }}" method="GET" class="m-0">
                <div class="flex flex-col md:flex-row items-end gap-6">
                    <div class="flex-grow grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                        <div class="relative group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Pilih Kasir</label>
                            <select name="user_id" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all appearance-none">
                                <option value="">Semua Kasir</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="relative group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Mulai Tanggal</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" 
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all">
                        </div>
                        <div class="relative group">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-2">Sampai Tanggal</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" 
                                   class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-sky-500 font-bold text-slate-700 transition-all">
                        </div>
                    </div>
                    <div class="flex items-end gap-3 w-full md:w-auto">
                        <button type="submit" class="flex-grow md:flex-none px-10 py-4 bg-slate-900 text-white rounded-2xl font-black text-sm uppercase tracking-[0.2em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-200">
                            Filter
                        </button>
                        <a href="{{ route('absensi.index') }}" class="p-4 bg-slate-100 text-slate-400 rounded-2xl hover:bg-slate-200 transition-all" title="Reset Filter">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- TABLE SECTION -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/30 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                <h2 class="text-xl font-black text-slate-800 tracking-tight">Riwayat Kehadiran</h2>
                <div class="flex gap-2">
                     <span class="px-4 py-1.5 bg-sky-50 text-sky-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-sky-100">
                        Total Record: {{ $absensis->total() }}
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">Kasir</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Tanggal</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Jam Masuk</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Jam Pulang</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Keterlambatan</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($absensis as $absen)
                            <tr class="hover:bg-slate-50/50 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 font-black text-xs shadow-sm group-hover:bg-sky-100 group-hover:text-sky-600 transition-colors">
                                            {{ substr($absen->user->name ?? '?', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-800">{{ $absen->user->name ?? 'User Terhapus' }}</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">{{ $absen->user->role ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <p class="text-sm font-bold text-slate-700">{{ \Carbon\Carbon::parse($absen->tanggal)->isoFormat('D MMM Y') }}</p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="text-sm font-black text-slate-900 bg-slate-100 px-3 py-1 rounded-lg">{{ $absen->jam_masuk ?: '--:--' }}</span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="text-sm font-black text-slate-900 bg-slate-100 px-3 py-1 rounded-lg">{{ $absen->jam_pulang ?: '--:--' }}</span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($absen->late_minutes > 0)
                                        <div class="flex flex-col items-center">
                                            <span class="text-sm font-black text-rose-600">{{ $absen->late_minutes }} Menit</span>
                                            <span class="text-[9px] font-bold text-rose-400 uppercase tracking-tighter">Terlambat</span>
                                        </div>
                                    @else
                                        <span class="text-xs font-bold text-emerald-500 uppercase tracking-widest">Tepat Waktu</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($absen->status == 'hadir')
                                        <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100">Hadir</span>
                                    @elseif($absen->status == 'terlambat')
                                        <span class="px-4 py-1.5 bg-amber-50 text-amber-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-amber-100">Terlambat</span>
                                    @else
                                        <span class="px-4 py-1.5 bg-rose-50 text-rose-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-rose-100">{{ $absen->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center opacity-30">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <p class="text-xl font-black italic tracking-widest uppercase">Belum ada data absensi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($absensis->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                    {{ $absensis->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendapatanExport;

class LaporanPendapatanController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today('Asia/Jakarta');
        $startOfMonth = Carbon::now('Asia/Jakarta')->startOfMonth();

        $totalSemua = Transaksi::where('status', 'selesai')->sum('total');
        
        $totalBulanIni = Transaksi::where('status', 'selesai')
                                  ->where('tanggal', '>=', $startOfMonth)
                                  ->sum('total');
        
        $totalHariIni = Transaksi::where('status', 'selesai')
                                 ->whereDate('tanggal', $today)
                                 ->sum('total');


        
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Transaksi::with(['kasir', 'pelanggan'])
                          ->where('status', 'selesai');

        if ($startDate && $endDate) {
            try {
                $start = Carbon::parse($startDate)->startOfDay();
                $end = Carbon::parse($endDate)->endOfDay();
                $query->whereBetween('tanggal', [$start, $end]);
            } catch (\Exception $e) {
            }
        }
        $totalFiltered = (clone $query)->sum('total');
        $jumlahFiltered = (clone $query)->count();

        $transaksis = $query->orderBy('id', 'asc')
                            ->paginate(15)
                            ->withQueryString(); 
        
        // Data untuk Chart (30 hari terakhir)
        $chartData = Transaksi::where('status', 'selesai')
            ->where('tanggal', '>=', now()->subDays(30))
            ->select(
                DB::raw('DATE(tanggal) as date'),
                DB::raw('SUM(total) as total')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        return view('laporan.pendapatan', compact(
            'totalSemua',
            'totalBulanIni',
            'totalHariIni',
            'transaksis',
            'totalFiltered',  
            'jumlahFiltered',
            'startDate', 
            'endDate',
            'chartData'
        ));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Transaksi::with(['pelanggan'])
            ->where('status', 'selesai');

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        $transaksis = $query->orderBy('tanggal', 'desc')->get();
        $totalFiltered = $transaksis->sum('total');

        $pdf = Pdf::loadView('laporan.pendapatan_pdf', compact('transaksis', 'totalFiltered', 'startDate', 'endDate'));
        return $pdf->download('laporan-pendapatan-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        return Excel::download(new PendapatanExport($startDate, $endDate), 'laporan-pendapatan-' . now()->format('Y-m-d') . '.xlsx');
    }
}
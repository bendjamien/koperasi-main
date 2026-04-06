<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PendapatanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithColumnFormatting
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Transaksi::with(['pelanggan', 'kasir'])
            ->where('status', 'selesai');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('tanggal', [$this->startDate, $this->endDate]);
        }

        return $query->orderBy('tanggal', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            ['LAPORAN PENDAPATAN'],
            ['Periode:', ($this->startDate ?: 'Semua') . ' s/d ' . ($this->endDate ?: 'Semua')],
            [],
            [
                'ID Transaksi',
                'Tanggal',
                'Pelanggan',
                'Kasir',
                'Metode Bayar',
                'Total (Rp)'
            ]
        ];
    }

    public function map($trx): array
    {
        return [
            'TRX-' . str_pad($trx->id, 5, '0', STR_PAD_LEFT),
            \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y H:i'),
            $trx->pelanggan->nama ?? 'Pelanggan Umum',
            $trx->kasir->name ?? 'N/A',
            $trx->metode_bayar,
            $trx->total
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 16]],
            2 => ['font' => ['italic' => true]],
            4 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '0EA5E9']
                ]
            ],
        ];
    }
}

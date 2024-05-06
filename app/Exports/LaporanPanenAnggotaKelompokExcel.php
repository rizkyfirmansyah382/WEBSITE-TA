<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LaporanPanenAnggotaKelompokExcel implements FromCollection, WithHeadings, WithTitle, WithStyles, WithEvents
{
    protected $data;
    protected $title;

    public function __construct(array $data, $title)
    {
        $this->data = $data;
        $this->title = $title;
    }

    public function collection()
    {
        return new Collection($this->data);
    }

    public function headings(): array
    {
        return [
            'Nama Anggota',
            'No Anggota',
            'Luas Lahan',
            'Pendapatan TBS Petani',
        ];
    }

    public function title(): string
    {
        return $this->title;
    }

    public function styles(Worksheet $sheet)
    {
        // Apply bold style to the header row
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }

    // Event untuk menangani styling baris terakhir
    public static function afterSheet(AfterSheet $event)
    {
        // Tentukan baris terakhir
        $lastRow = $event->sheet->getHighestRow();

        // Apply bold style untuk baris terakhir
        $event->sheet->getStyle('A' . $lastRow . ':D' . $lastRow)->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }

    // Metode untuk mendaftarkan event
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => [self::class, 'afterSheet'],
        ];
    }
}

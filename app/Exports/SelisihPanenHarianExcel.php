<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SelisihPanenHarianExcel implements FromCollection, WithHeadings, WithTitle, WithStyles
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
            'Tonase Anggota',
        ];
    }

    public function title(): string
    {
        return $this->title;
    }

    public function styles(Worksheet $sheet)
    {
        // Apply bold style to the header row
        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        // Find the row index of 'Total Tonase Anggota'
        $totalTonaseRowIndex = array_search('Total Keseluruhan Lapangan', array_column($this->data, 'Nama Anggota'));

        // Find the row index of 'Total Netto Bersih PKS'
        $totalNettoBersihRowIndex = array_search('Total Keseluruhan PKS', array_column($this->data, 'Nama Anggota'));

        // Find the row index of 'Selisih'
        $selisihRowIndex = array_search('Selisih', array_column($this->data, 'Nama Anggota'));

        // Apply bold style to the specific rows
        if ($totalTonaseRowIndex !== false) {
            $sheet->getStyle('A' . ($totalTonaseRowIndex + 2) . ':C' . ($totalTonaseRowIndex + 2))->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
            ]);
        }

        if ($totalNettoBersihRowIndex !== false) {
            $sheet->getStyle('A' . ($totalNettoBersihRowIndex + 2) . ':C' . ($totalNettoBersihRowIndex + 2))->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
            ]);
        }

        if ($selisihRowIndex !== false) {
            $sheet->getStyle('A' . ($selisihRowIndex + 2) . ':C' . ($selisihRowIndex + 2))->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
            ]);
        }
    }


}

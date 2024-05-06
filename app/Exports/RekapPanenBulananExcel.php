<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapPanenBulananExcel implements FromCollection, WithHeadings, WithTitle, WithStyles
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
            'Rotasi 1',
            'Rotasi 2',
            'Rotasi 3',
            'Rotasi 4',
            'Total Keseluruhan Tonase'
        ];
    }

    public function title(): string
    {
        return $this->title;
    }

    public function styles(Worksheet $sheet)
    {
        // Apply bold style to the header row
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}


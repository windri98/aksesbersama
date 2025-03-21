<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Facades\Log;
class KeluhanKamar implements WithEvents, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // ** Header Form **
                $sheet->mergeCells('A1:D1');
                $sheet->setCellValue('A1', 'FORM KELUHAN');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4CAF50'],
                    ],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);

                // ** Data Dinamis **
                $sheet->setCellValue('A2', 'No. Kamar:');
                $sheet->setCellValue('B2', $this->data['room_number'] ?? '');

                $sheet->setCellValue('A3', 'Username:');
                $sheet->setCellValue('B3', $this->data['username'] ?? '');

                $sheet->setCellValue('A4', 'Kategori:');
                $sheet->setCellValue('B4', $this->data['kategori'] ?? '');

                $sheet->setCellValue('A5', 'Tanggal Pengaduan:');
                $sheet->setCellValue('B5', isset($this->data['created_at']) 
                    ? \Carbon\Carbon::parse($this->data['created_at'])->format('d/m/Y') 
                    : '');

                $sheet->setCellValue('C5', 'Waktu:');
                $sheet->setCellValue('D5', isset($this->data['created_at']) 
                    ? \Carbon\Carbon::parse($this->data['created_at'])->format('h:i A') 
                    : '');

                $sheet->setCellValue('A6', 'Keterangan:');
                $sheet->mergeCells('B6:D7');
                $sheet->setCellValue('B6', $this->data['keterangan'] ?? '');

                $sheet->setCellValue('A8', 'Foto:');
                $sheet->getStyle('A8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); 
                $sheet->getStyle('A8')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $sheet->getColumnDimension('A')->setAutoSize(true); 

                $row = 8;
                $startRow = $row; 
                $hasImage = false; 
                if (isset($this->data['report_images']) && is_array($this->data['report_images'])) {
                    foreach ($this->data['report_images'] as $image) {
                        $imagePath = storage_path('app/public/img/' . $image['image']); 
                      
                        if (file_exists($imagePath)) {
                            Log::info('Gambar ditemukan123:', ['path' => $imagePath]);
                            $drawing = new Drawing();
                            $drawing->setName('Report Image');
                            $drawing->setDescription('Image from report');
                            $drawing->setPath($imagePath); 
                            $drawing->setHeight(300); 
                            $drawing->setWidth(350); 
                            $drawing->setCoordinates("B{$row}"); 
                            $drawing->setWorksheet($sheet);

                        $rowHeight = $drawing->getHeight() * 0.75; 
                        $sheet->getRowDimension($row)->setRowHeight($rowHeight);
                        $hasImage = true;
                        } else {
                            Log::warning('Gambar tidak ditemukan:', ['path' => $imagePath]);
                            $sheet->setCellValue("B{$row}", 'Gambar tidak ditemukan');
                        }

                        $row++; 
                    }

                    if ($hasImage && $row > $startRow) {
                        $sheet->mergeCells("A{$startRow}:A" . ($row - 1));
                    }
                } 
                if (!$hasImage) {
                    $sheet->setCellValue("B{$row}", 'Tidak ada gambar');
                    $sheet->getRowDimension($row)->setRowHeight(20); 
                }
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ];
                $sheet->getStyle("A{$startRow}:D" . ($row - 1))->applyFromArray($styleArray);
     
                $sheet->getColumnDimension('A')->setWidth(15); 
                $sheet->getColumnDimension('B')->setWidth(50);
                $sheet->getColumnDimension('C')->setWidth(10);
                $sheet->getColumnDimension('D')->setWidth(15);

                $sheet->getStyle('A1:D8')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $sheet->getStyle('A2:A8')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT],
                ]);
            },
        ];
    }
}

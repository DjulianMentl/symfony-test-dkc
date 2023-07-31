<?php

namespace App\Service;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelService
{
    public function exportUsers(array $users, string $filePath): void
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', '№');
        $sheet->setCellValue('B1', 'Имя');
        $sheet->setCellValue('C1', 'Город');

        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->getId());
            $sheet->setCellValue('B' . $row, $user->getName());
            $sheet->setCellValue('C' . $row, $user->getCity());
            $row++;
        }

        $writer = new Xlsx($spreadsheet);


        $writer->save($filePath);
    }

}
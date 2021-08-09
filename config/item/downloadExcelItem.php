<?php

include date_default_timezone_set('Asia/Jakarta');
require_once "../../PHPExcel-1.8/Classes/PHPExcel.php";

$myArray = unserialize($_POST['myArray']);

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'Master Item')

    ->setCellValue('A3', 'NO')
    ->setCellValue('B3', 'Nama Kategori')
    ->setCellValue('C3', 'Deskripsi')
    ->setCellValue('D3', 'Kategori')
    ->setCellValue('E3', 'Harga')
    ->getStyle('A3:E3')->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );

$i = 3;
$grandtotal = 0;
$grandqty = 0;
foreach ($myArray as $data) {

    $itemName = $data['itemName'];
    $itemDescription = $data['itemDescription'];
    $categoryName = $data['categoryName'];
    $price = $data['price'];

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . ($i + 1), ($i - 2))
        ->setCellValue('B' . ($i + 1), $itemName)
        ->setCellValue('C' . ($i + 1), $itemDescription)
        ->setCellValue('D' . ($i + 1), $categoryName)
        ->setCellValue('E' . ($i + 1), rupiah($price));
    $i++;
}

for ($col = 'A'; $col !== 'E'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}

// $objPHPExcel->getActiveSheet()
//     ->getStyle('F5:O'.($i+1))
//     ->getAlignment()
//     ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

$objPHPExcel->getActiveSheet()->getStyle('A3:E' . ($i + 1))->applyFromArray($styleArray);
unset($styleArray);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$filename = "Pragulo_Master_Item" . date("Y-m-d h:i:sa") . " .xlsx";
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

header('Cache-Control: max-age=1');

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
unset($objPHPExcel);

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

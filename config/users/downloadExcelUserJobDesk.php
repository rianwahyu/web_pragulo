<?php

include date_default_timezone_set('Asia/Jakarta');
require_once "../../PHPExcel-1.8/Classes/PHPExcel.php";

$usernameID = $_POST['usernameID'];
$fullname = $_POST['fullname'];

$myArray = unserialize($_POST['myArray']);

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'Detail Job Desk Karyawan / Tukang')
    ->setCellValue('A3', 'Nama Tukang : ')


    ->setCellValue('B3', $fullname)


    ->setCellValue('A5', 'NO')
    ->setCellValue('B5', 'Tanggal')
    ->setCellValue('C5', 'Id Produksi')
    ->setCellValue('D5', 'Nama Barang')
    ->setCellValue('E5', 'Keterangan')
    ->getStyle('A5:E5')->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );

$i = 5;
$grandtotal = 0;
$grandqty = 0;
foreach ($myArray as $data) {

    $productionID = $data['productionID'];
    $date = $data['date'];
    $itemName = $data['itemName'];
    $note = $data['note'];

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . ($i + 1), ($i - 4))
        ->setCellValue('B' . ($i + 1), $date)
        ->setCellValue('C' . ($i + 1), $productionID)
        ->setCellValue('D' . ($i + 1), $itemName)
        ->setCellValue('E' . ($i + 1), $note);
    $i++;
}

//$j = $i;


for ($col = 'A'; $col !== 'F'; $col++) {
    $objPHPExcel->getActiveSheet()
        ->getColumnDimension($col)
        ->setAutoSize(true);
}

$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);



$objPHPExcel->getActiveSheet()->getStyle('A5:E' . ($i + 1))->applyFromArray($styleArray);
unset($styleArray);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$filename = "Pragulo_user_job_desk  " . date("Y-m-d h:i:sa") . " .xlsx";
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

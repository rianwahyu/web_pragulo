<?php

include date_default_timezone_set('Asia/Jakarta');
require_once "../../PHPExcel-1.8/Classes/PHPExcel.php";

$productionID = $_POST['productionID'];
$orderID = $_POST['orderID'];
$customerName = $_POST['customerName'];
$itemName = $_POST['itemName'];
$jenisMebel = $_POST['jenisMebel'];
$dateIn = $_POST['dateIn'];
$dateFinish = $_POST['dateFinish'];

$myArray = unserialize($_POST['myArray']);
//print_r($myArray);
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'Detail Data Order Cicilan')
    ->setCellValue('A3', 'ID Produksi : ')
    ->setCellValue('A4', 'ID Order : ')
    ->setCellValue('A5', 'Nama Customer : ')
    ->setCellValue('A6', 'Nama Barang : ')
    ->setCellValue('A7', 'Jenis Mebel : ')
    ->setCellValue('A8', 'Tanggal Masuk : ')
    ->setCellValue('A9', 'Tanggal Selesai: ')

    ->setCellValue('B3', $productionID)
    ->setCellValue('B4', $orderID)
    ->setCellValue('B5', $customerName)
    ->setCellValue('B6', $itemName)
    ->setCellValue('B7', $jenisMebel)
    ->setCellValue('B8', $dateIn)
    ->setCellValue('B9', $dateFinish)

    ->setCellValue('A11', 'NO')
    ->setCellValue('B11', 'Pegawai')
    ->setCellValue('C11', 'Tanggal')
    ->setCellValue('D11', 'Keterangan')
    ->getStyle('A11:D11')->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );

$i = 11;
$grandtotal = 0;
$grandqty = 0;
foreach ($myArray as $data) {

    $username = $data['username'];
    $date = $data['date'];
    $note = $data['note'];

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . ($i + 1), ($i - 10))
        ->setCellValue('B' . ($i + 1), $username)
        ->setCellValue('C' . ($i + 1), $date)
        ->setCellValue('D' . ($i + 1), $note);
    $i++;
}

//$j = $i;


for ($col = 'A'; $col !== 'E'; $col++) {
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



$objPHPExcel->getActiveSheet()->getStyle('A11:D' . ($i + 1))->applyFromArray($styleArray);
unset($styleArray);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$filename = "Pragulo_Data_Produksi_Timeline  " . date("Y-m-d h:i:sa") . " .xlsx";
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

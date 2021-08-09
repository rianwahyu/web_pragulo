<?php

include date_default_timezone_set('Asia/Jakarta');
require_once "../../PHPExcel-1.8/Classes/PHPExcel.php";

$myArray = unserialize($_POST['myArray']);

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'Data Order')
    //->setCellValue('B1', 'Data Order')

    ->setCellValue('A3', 'NO')
    ->setCellValue('B3', 'Order ID')    
    ->setCellValue('C3', 'Nama Customer')
    ->setCellValue('D3', 'Alamat')
    ->setCellValue('E3', 'No HP')
    ->setCellValue('F3', 'Tanggal Order')
    ->setCellValue('G3', 'Tanggal Selesai')
    ->getStyle('A3:G3')->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );

$i = 3;
$grandtotal = 0;
$grandqty = 0;
foreach ($myArray as $data) {

    $orderID = $data['orderID'];
    $customerName = $data['customerName'];
    $customerAddress = $data['customerAddress'];
    $customerPhone = $data['customerPhone'];
    $dateOrder = $data['dateOrder'];
    $dateFinish = $data['dateFinish'];
    

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . ($i + 1), ($i - 2))
        ->setCellValue('B' . ($i + 1), $orderID)
        ->setCellValue('C' . ($i + 1), $customerName)
        ->setCellValue('D' . ($i + 1), $customerAddress)
        ->setCellValue('E' . ($i + 1), $customerPhone)
        ->setCellValue('F' . ($i + 1), $dateOrder)
        ->setCellValue('G' . ($i + 1), $dateFinish);
    $i++;
}

for ($col = 'A'; $col !== 'H'; $col++) {
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

$objPHPExcel->getActiveSheet()->getStyle('A3:G' . ($i + 1))->applyFromArray($styleArray);
unset($styleArray);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$filename = "Pragulo_Data_Order_List" . date("Y-m-d h:i:sa") . " .xlsx";
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

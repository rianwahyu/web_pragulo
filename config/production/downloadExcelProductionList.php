<?php

include date_default_timezone_set('Asia/Jakarta');
require_once "../../PHPExcel-1.8/Classes/PHPExcel.php";

$myArray = unserialize($_POST['myArray']);

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'Data Produksi Mebel')
    //->setCellValue('B1', 'Data Order')

    ->setCellValue('A3', 'ID Produksi')
    ->setCellValue('B3', 'ID Order')    
    ->setCellValue('C3', 'Nama Customer')
    ->setCellValue('D3', 'Nama Barang')
    ->setCellValue('E3', 'Jenis')
    ->setCellValue('F3', 'Tgl Masuk')
    ->setCellValue('G3', 'Tanggal Selesai')
    ->setCellValue('H3', 'Status')
    ->getStyle('A3:H3')->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );

$i = 3;
$grandtotal = 0;
$grandqty = 0;
$jenisMebel="";
foreach ($myArray as $data) {

    if($data['type']=="local")  {$jenisMebel="Kayu Local";}else  {$jenisMebel="Kayu Jati";} 

    $productionID = $data['productionID'];
    $orderID = $data['orderID'];
    $customerName = $data['customerName'];
    $itemName = $data['itemName'];
    $customerPhone = $data['customerPhone'];
    $dateIn = $data['dateIn'];
    $dateFinish = $data['dateFinish'];
    $status = $data['status'];
    

    $objPHPExcel->setActiveSheetIndex(0)        
        ->setCellValue('A' . ($i + 1), $productionID)
        ->setCellValue('B' . ($i + 1), $orderID)
        ->setCellValue('C' . ($i + 1), $customerName)
        ->setCellValue('D' . ($i + 1), $itemName)
        ->setCellValue('E' . ($i + 1), $jenisMebel)
        ->setCellValue('F' . ($i + 1), $dateIn)
        ->setCellValue('G' . ($i + 1), $dateFinish)
        ->setCellValue('H' . ($i + 1), $status);
    $i++;
}

for ($col = 'A'; $col !== 'I'; $col++) {
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

$objPHPExcel->getActiveSheet()->getStyle('A3:H' . ($i + 1))->applyFromArray($styleArray);
unset($styleArray);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$filename = "Pragulo_Production_List " . date("Y-m-d h:i:sa") . " .xlsx";
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

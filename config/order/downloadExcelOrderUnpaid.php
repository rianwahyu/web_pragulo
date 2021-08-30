<?php

date_default_timezone_set('Asia/Jakarta');

require_once "../../PHPExcel-1.8/Classes/PHPExcel.php";

$start = $_POST['start'];
$end = $_POST['end'];
$myArray = unserialize($_POST['myArray']);

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'Data Pembayaran Order BELUM Lunas')
    ->setCellValue('A2', 'Periode :' . $start . ' hingga ' . $end)


    ->setCellValue('A4', 'NO')
    ->setCellValue('B4', 'Order ID')
    ->setCellValue('C4', 'Nama Customer')
    ->setCellValue('D4', 'Alamat')
    ->setCellValue('E4', 'No HP')
    ->setCellValue('F4', 'Tanggal Order')
    ->setCellValue('G4', 'Status')
    ->setCellValue('H4', 'Total')
    ->getStyle('A3:H4')->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );

$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');



$i = 4;
$grandtotal = 0;
$grandqty = 0;
foreach ($myArray as $data) {

    $orderID = $data['orderID'];
    $customerName = $data['customerName'];
    $customerAddress = $data['customerAddress'];
    $customerPhone = $data['customerPhone'];
    $dateOrder = $data['dateOrder'];

    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . ($i + 1), ($i - 3))
        ->setCellValue('B' . ($i + 1), $orderID)
        ->setCellValue('C' . ($i + 1), $customerName)
        ->setCellValue('D' . ($i + 1), $customerAddress)
        ->setCellValue('E' . ($i + 1), $customerPhone)
        ->setCellValue('F' . ($i + 1), $dateOrder)
        ->setCellValue('G' . ($i + 1), $data['statusPembayaran'])
        ->setCellValue('H' . ($i + 1), rupiah(round($data['total'])));

        $grandtotal = $grandtotal + $data['total'];

    $i++;
}

$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A'.($i+1), 'Grand Total')	
	->setCellValue('H'.($i+1), rupiah(round($grandtotal)))
	->mergeCells('A'.($i+1).":G".($i+1));

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

$objPHPExcel->getActiveSheet()->getStyle('A3:H' . ($i + 1))->applyFromArray($styleArray);
unset($styleArray);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$filename = "Pragulo_Data_Order_Belum_Lunas_" . date("Y-m-d h:i:sa") . " .xlsx";
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

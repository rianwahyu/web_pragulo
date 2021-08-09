<?php

include date_default_timezone_set('Asia/Jakarta');
require_once "../../PHPExcel-1.8/Classes/PHPExcel.php";

$orderID = $_POST['orderID'];
$customerName = $_POST['customerName'];
$customerPhone = $_POST['customerPhone'];
$customerAddress = $_POST['customerAddress'];
$dateOrder = $_POST['dateOrder'];
$dateFinish = $_POST['dateFinish'];
$statusPembayaran = $_POST['statusPembayaran'];
$installment = $_POST['installment'];

$myArray = unserialize($_POST['myArray']);

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0)

    ->setCellValue('A1', 'Detail Data Order')
    ->setCellValue('A3', 'Order ID : ')
    ->setCellValue('A4', 'Nama Customer : ')
    ->setCellValue('A5', 'Alamat : ')
    ->setCellValue('A6', 'NO HP : ')
    ->setCellValue('A7', 'Tanggal Order : ')
    ->setCellValue('A8', 'Tanggal Selesai : ')
    ->setCellValue('A9', 'Status Pembayaran : ')
    ->setCellValue('A10', 'Periode Cicilan : ')

    ->setCellValue('B3', $orderID)
    ->setCellValue('B4', $customerName)
    ->setCellValue('B5', $customerPhone)
    ->setCellValue('B6', $customerAddress)
    ->setCellValue('B7', $dateOrder)
    ->setCellValue('B8', $dateFinish)
    ->setCellValue('B9', $statusPembayaran)
    ->setCellValue('B10', $installment . ' Bulan')

    ->setCellValue('A11', 'NO')
    ->setCellValue('B11', 'Order ID')
    ->setCellValue('C11', 'Nama Barang')
    ->setCellValue('D11', 'Tipe Order')
    ->setCellValue('E11', 'Keterangan')
    ->setCellValue('F11', 'Jumlah')
    ->setCellValue('G11', 'Harga')
    ->setCellValue('H11', 'Total')
    ->getStyle('A11:H11')->getAlignment()->applyFromArray(
        array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,)
    );

$i = 11;
$grandtotal = 0;
$grandqty = 0;
foreach ($myArray as $data) {

    $orderID = $data['orderID'];
    $itemName = $data['itemName'];
    $itemtype = $data['itemtype'];
    $keterangan = $data['keterangan'];
    $quantity = round($data['quantity']);
    $price = round($data['price']);

    $total = $quantity * $price;


    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A' . ($i + 1), ($i - 10))
        ->setCellValue('B' . ($i + 1), $orderID)
        ->setCellValue('C' . ($i + 1), $itemName)
        ->setCellValue('D' . ($i + 1), $itemtype)
        ->setCellValue('E' . ($i + 1), $keterangan)
        ->setCellValue('F' . ($i + 1), $quantity)
        ->setCellValue('G' . ($i + 1), $price)
        ->setCellValue('H' . ($i + 1), rupiah(round($total)));
    $i++;
}

$j=$i;


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



$objPHPExcel->getActiveSheet()->getStyle('A11:H' . ($i + 1))->applyFromArray($styleArray);
unset($styleArray);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$filename = "Pragulo_Data_Order_Detail " . date("Y-m-d h:i:sa") . " .xlsx";
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

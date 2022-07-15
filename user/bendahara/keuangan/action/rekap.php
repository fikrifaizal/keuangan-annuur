<?php
require_once('../../../../vendor/autoload.php');
require_once('../../../config.php');
require_once('../../../helper.php');
require_once('../../akses.php');

define('K_PATH_IMAGES', '../../../../assets/image/');

// set data
$dateText = "";
if(!empty($_GET['start']) && !empty($_GET['end'])) {
  $getStartDate = $_GET['start'];
  $getEndDate = $_GET['end'];

  $startDate = customDateFormat($getStartDate);
  $endDate = customDateFormat($getEndDate);

  $dateText = "$startDate hingga $endDate";
  $kategori = "semua";

  if(!empty($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
  }

  switch($kategori) {
    case "semua":
      $query = "SELECT * FROM `keuangan_masjid` WHERE (`tanggal` BETWEEN '$getStartDate' AND '$getEndDate') ORDER BY `tanggal`";
      break;
    case "masuk":
      $query = "SELECT * FROM `keuangan_masjid` WHERE `keluar` LIKE '0' AND (`tanggal` BETWEEN '$getStartDate' AND '$getEndDate') ORDER BY `tanggal`";
      break;
    case "keluar":
      $query = "SELECT * FROM `keuangan_masjid` WHERE `masuk` LIKE '0' AND (`tanggal` BETWEEN '$getStartDate' AND '$getEndDate') ORDER BY `tanggal`";
      break;
  }
}
else {
  $kategori = "semua";

  if(!empty($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
  }
  
  $queryTanggal = "SELECT MIN(DISTINCT tanggal) as mintgl, MAX(DISTINCT tanggal) as maxtgl FROM `keuangan_masjid`";
  $resultTanggal = mysqli_query($conn, $queryTanggal);
  $dataTanggal = mysqli_fetch_array($resultTanggal, MYSQLI_ASSOC);

  $startDate = customDateFormat($dataTanggal['mintgl']);
  $endDate = customDateFormat($dataTanggal['maxtgl']);

  $dateText = "$startDate hingga $endDate";

  switch($kategori) {
    case "semua":
      $query = "SELECT * FROM `keuangan_masjid` ORDER BY `tanggal`";
      break;
    case "masuk":
      $query = "SELECT * FROM `keuangan_masjid` WHERE `keluar` LIKE '0' ORDER BY `tanggal`";
      break;
    case "keluar":
      $query = "SELECT * FROM `keuangan_masjid` WHERE `masuk` LIKE '0' ORDER BY `tanggal`";
      break;
  }
}

// connect & query database
$result = mysqli_query($conn, $query);

// get saldo
$querySaldo = "SELECT (SUM(masuk)-SUM(keluar)) as saldo FROM `keuangan_masjid`";
$resultSaldo = mysqli_query($conn, $querySaldo);
$dataSaldo = mysqli_fetch_array($resultSaldo, MYSQLI_ASSOC);

// create new PDF
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document info
$pdf->setCreator('Tim Annuur');
$pdf->setTitle('Informasi Keuangan');
$pdf->setSubject('Informasi Keuangan Masjid');

// header & footer data
$pdf->setHeaderData('logo-annur-bulat-tanpa-alpha.jpg', 16, "Rekap Keuangan Masjid [$kategori]", "$dateText", array(8,138,68), array(0,0,0));
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', 16));

$pdf->setFooterData(array(0,0,0),array(0,0,0));
$pdf->setFooterFont(array(PDF_FONT_NAME_MAIN, '', 12));

$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margin
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, null);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set page break
$pdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set imgae scalling
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font subsetting
$pdf->setFontSubsetting(true);
$pdf->setFont(PDF_FONT_NAME_MAIN, '', 12, '', true);

$pdf->AddPage();

// opening the table
$setData = '
<html>
  <head>
    <style>
      table {
        font-family: arial, sans-serif;
        width: 100%;
      }
      th {
        border: 1px solid #CBCCCE;
        text-align: center;
        font-weight: bold;
        background-color: #E2E3E5;
      }
      td {
        border: 1px solid #DEE2E6;
        text-align: center;
      }
    </style>
  </head>

  <body>
    <table>
      <thead>
        <tr>
          <th width="5%">#</th>
          <th width="20%">Tanggal</th>
          <th width="35%">Keterangan</th>
          <th width="20%">Kas Masuk</th>
          <th width="20%">Kas Keluar</th>
        </tr>
      </thead>';

// add data to the table
$count = 1;
$uangMasuk = 0;
$uangKeluar = 0;
while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  $uangMasuk = $uangMasuk+intval($data['masuk']);
  $uangKeluar = $uangKeluar+intval($data['keluar']);
  
  $setData .= '
  <tbody>
    <tr>
      <td width="5%">'.$count++.'</td>
      <td width="20%">'.customDateFormat($data['tanggal']).'</td>
      <td width="35%" style="text-align: left">'.$data['keterangan'].'</td>
      <td width="20%">'.setIDRFormat($data['masuk']).'</td>
      <td width="20%">'.setIDRFormat($data['keluar']).'</td>
    </tr>
  </tbody>';
}

$setData .= '
<tfoot>
  <tr>
    <td colspan="3" style="text-align: left">Jumlah</td>
    <td>'.setIDRFormat($uangMasuk).'</td>
    <td>'.setIDRFormat($uangKeluar).'</td>
  </tr>
</tfoot>
';

// closing the table
$setData .= '
    </table>
    <h4 style="margin-start: 1px">Saldo saat ini: '.setIDRFormat($dataSaldo['saldo']).'</h4>
  </body>
</html>
';

$pdf->writeHTMLCell(0, 0, '', '', $setData, 0, 1, 0, true, '', true);

$pdf->Output('spp.pdf', 'I');
?>
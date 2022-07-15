<?php
// menentukan tanggal pada akhir bulan
function lastOfMonth($month, $year) {
  return date("Y-m-d", strtotime('-1 second', strtotime('+1 month',strtotime($month . '/01/' . $year. ' 00:00:00'))));
}

// convert bulan (text) ke int
function monthConverter($month) {
  $bulan = ["JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER"];
  for($i=0; $i < count($bulan); $i++) {
    if(array_search($month, $bulan) == $i) {
      $i = $i+1;
      if($i < 10) {
        return "0".$i;
        break;
      } else {
        return $i;
        break;
      }
    }
  }
}

// convert bulan (int) ke text
function monthConverter2($month) {
  $bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
  $convert = intval($month)-1;
  return $bulan[$convert];
}

// mengganti bulan (inggris) ke bahasa indonesia
function monthLocalization($month) {
  $english = ["January","February","March","April","May","June","July","August","September","October","November","December"];
  $indonesia = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

  for($i=0; $i < count($english); $i++) {
    if(array_search($month, $english) == $i) {
      return $indonesia[$i];
      break;
    }
  }
}

// mengganti hari (inggris) ke bahasa indonesia
function dayLocalization($day) {
  $english = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
  $indonesia = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];

  for($i=0; $i < count($english); $i++) {
    if(array_search($day, $english) == $i) {
      return $indonesia[$i];
      break;
    }
  }
}

// mendapatkan hari pada tanggal tertentu (format yyyy-mm-dd)
function getDay($date) {
  return dayLocalization(date('l', strtotime($date)));
}

// from text type (DD, dd MM yyyy) to date type (yyyy-mm-dd)
function defaultDateFormat($date) {
  $explode = explode(" ", $date);
  return $explode[3]."-".monthConverter(strtoupper($explode[2]))."-".$explode[1];
}

// from date type (yyyy-mm-dd) to text type (DD, dd MM yyyy)
function customDateFormat($date) {
  $day = getDay($date);
  $bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
  $explode = explode("-", $date);
  return $day.", ".$explode[2]." ".$bulan[intval($explode[1])-1]." ".$explode[0];
}

function ifToday($month, $year) {
  if($month == date('m') && $year == date('Y')) {
    $today = dayLocalization(date('l')).", ".date('d')." ".monthLocalization(date('M'))." ".date('Y');
    return ["isToday"=>true, "date"=>"$today"];
  } else {
    return ["isToday"=>false, "date"=>""];
  }
}

// IDR format
function setIDRFormat(int $number) {
  return "Rp ".number_format($number,0,'.','.');
}
?>
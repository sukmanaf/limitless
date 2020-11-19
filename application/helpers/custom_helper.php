<?php 
function rupiah($angka) {
	$jadi = 'Rp. ' . number_format($angka, 0, ',', '.');

	return $jadi;
}

function format_number($angka) {
	$jadi = number_format($angka, 0, ',', '.');

	return $jadi;
}

function tanggal_indonesia($tanggal) {

	$date = date('Y-m-d', strtotime($tanggal)); // ubah sesuai format penanggalan standart

	$bulan = array('01' => 'Januari', // array bulan konversi
		'02'                => 'Februari',
		'03'                => 'Maret',
		'04'                => 'April',
		'05'                => 'Mei',
		'06'                => 'Juni',
		'07'                => 'Juli',
		'08'                => 'Agustus',
		'09'                => 'September',
		'10'                => 'Oktober',
		'11'                => 'November',
		'12'                => 'Desember',
	);
	$date = explode('-', $date); // ubah string menjadi array dengan paramere '-'

	return $date[2] . ' ' . $bulan[$date[1]] . ' ' . $date[0]; // hasil yang di kembalikan
}

function tanggal_indonesia_jam($tanggal) {

	$date = date('Y-m-d H:i:s', strtotime($tanggal)); // ubah sesuai format penanggalan standart

	$jam = explode(' ', $date);
	$bulan = array('01' => 'Januari', // array bulan konversi
		'02'                => 'Februari',
		'03'                => 'Maret',
		'04'                => 'April',
		'05'                => 'Mei',
		'06'                => 'Juni',
		'07'                => 'Juli',
		'08'                => 'Agustus',
		'09'                => 'September',
		'10'                => 'Oktober',
		'11'                => 'November',
		'12'                => 'Desember',
	);
	$date = explode('-', $date); // ubah string menjadi array dengan paramere '-'
	$tgl = explode(' ', $date[2]);
	return $tgl[0] . ' ' . $bulan[$date[1]] . ' ' . $date[0].' pukul '.$jam[1]; // hasil yang di kembalikan
}

function tanggal_indonesia_gede($tanggal) {

	$date = date('Y-m-d', strtotime($tanggal)); // ubah sesuai format penanggalan standart

	$bulan = array('01' => 'JANUARI', // array bulan konversi
		'02'                => 'FEBRUARI',
		'03'                => 'MARET',
		'04'                => 'APRIL',
		'05'                => 'MEI',
		'06'                => 'JUNI',
		'07'                => 'JULI',
		'08'                => 'AGUSTUS',
		'09'                => 'SEPTEMBER',
		'10'                => 'OKTOBER',
		'11'                => 'NOVEMBER',
		'12'                => 'DESEMBER',
	);
	$date = explode('-', $date); // ubah string menjadi array dengan paramere '-'

	return $date[2] . ' ' . $bulan[$date[1]] . ' ' . $date[0]; // hasil yang di kembalikan
}

function bulan_indonesia_now() {

	$date = date('Y-m-d'); // ubah sesuai format penanggalan standart

	$bulan = array('01' => 'Januari', // array bulan konversi
		'02'                => 'Februari',
		'03'                => 'Maret',
		'04'                => 'April',
		'05'                => 'Mei',
		'06'                => 'Juni',
		'07'                => 'Juli',
		'08'                => 'Agustus',
		'09'                => 'September',
		'10'                => 'Oktober',
		'11'                => 'November',
		'12'                => 'Desember',
	);
	$date = explode('-', $date); // ubah string menjadi array dengan paramere '-'

	return $bulan[$date[1]] . ' ' . $date[0]; // hasil yang di kembalikan
}
function bulan_indonesia() {

	$date = date('m'); // ubah sesuai format penanggalan standart

	$bulan = array('01' => 'Januari', // array bulan konversi
		'02'                => 'Februari',
		'03'                => 'Maret',
		'04'                => 'April',
		'05'                => 'Mei',
		'06'                => 'Juni',
		'07'                => 'Juli',
		'08'                => 'Agustus',
		'09'                => 'September',
		'10'                => 'Oktober',
		'11'                => 'November',
		'12'                => 'Desember',
	);
	$date = explode('-', $date); // ubah string menjadi array dengan paramere '-'

	return $bulan[$date[0]] ; // hasil yang di kembalikan
}

function bulan_indonesia_gede($date) {

	// $date = date('m'); // ubah sesuai format penanggalan standart

	$bulan = array('01' => 'JANUARI', // array bulan konversi
		'02'                => 'FEBRUARI',
		'03'                => 'MARET',
		'04'                => 'APRIL',
		'05'                => 'MEI',
		'06'                => 'JUNI',
		'07'                => 'JULI',
		'08'                => 'AGUSTUS',
		'09'                => 'SEPTEMBER',
		'10'                => 'OKTOBER',
		'11'                => 'NOVEMBER',
		'12'                => 'DESEMBER',
	);
	$date = explode('-', $date); // ubah string menjadi array dengan paramere '-'

	return $bulan[$date[0]] ; // hasil yang di kembalikan
}
	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " Belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " Seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " Seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}

	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil. ' Rupiah';
	}
 ?>
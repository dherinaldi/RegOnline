<?php
include "qrlib.php";
$tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
if (!file_exists($tempdir)){ //Buat folder bername temp
mkdir($tempdir);
}
if($resultData->data[0]->CARABAYAR == 2){
	$cb = 2;
} else {
	$cb = 1;
}
$nomorReg = $resultData->data[0]->ID;
//var_dump($nomorReg);die();
QRcode::png($nomorReg, $tempdir."001.png", QR_ECLEVEL_H);
$html = '
<html>
<head>
<style>
@page { sheet-size: 197.3mm 110mm; }
p {	margin: 0pt; }
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
	<table width="100%" style="border-bottom: 2px solid #000000; vertical-align: bottom; font-family: serif; font-size: 9pt;">
		<tr>
			<td width="100%" style="text-align: center;">
				<span style="font-weight: bold; font-size: 12pt;">BUKTI REGISTRASI PASIEN</span><br/>
				<span style="font-weight: bold; font-size: 14pt;">'.$resultData->data[0]->REFERENSI->PPK->REFERENSI->PPK->NAMA.'</span><br/>
				<span style="font-size: 8pt;"><i>Alamat : '.$resultData->data[0]->REFERENSI->PPK->REFERENSI->PPK->ALAMAT.', '.$resultData->data[0]->REFERENSI->PPK->REFERENSI->PPK->DESWILAYAH.' - '.$resultData->data[0]->REFERENSI->PPK->REFERENSI->PPK->KODEPOS.'</i></span><br/>
				<span style="font-size: 8pt;"><i>Phone. '.$resultData->data[0]->REFERENSI->PPK->REFERENSI->PPK->TELEPON.' - email : '.$resultData->data[0]->REFERENSI->PPK->REFERENSI->PPK->EMAIL.'  - Website : '.$resultData->data[0]->REFERENSI->PPK->REFERENSI->PPK->WEBSITE.'</i></span>
			</td>
		</tr>
	</table>
</htmlpageheader>

<sethtmlpageheader name="myheader" value="on" show-this-page="1"/>
mpdf-->

<table width="100%" style="font-family: serif; font-size:10pt;border-collapse:collapse;" cellpadding="3">
	<tr>
		<td width="35%">Nomor Registrasi</td>
		<td width="35%">: <b>'.$resultData->data[0]->ID.'</b></td>';
$jam = date('H:i',strtotime($resultData->data[0]->JAM_PELAYANAN));
$dateBatas = date('H:i',strtotime('12:00'));
if($jam > $dateBatas){
	$jamPlyn = '12:00';
} else {
	$jamPlyn = $resultData->data[0]->JAM_PELAYANAN;
}
if($resultData->data[0]->POS_ANTRIAN == 'H'){
		$html .='<td width="30%" rowspan="6" align="right"><img width="125px" src="'.$tempdir.'001.png" /></td>';
} else {
	$html .='<td width="30%" rowspan="7" align="right"><img width="125px" src="'.$tempdir.'001.png" /></td>';
}
$tgl = date_create($resultData->data[0]->TANGGALKUNJUNGAN);
$tglFormat = date_format($tgl,'d-m-Y');
$html .='	</tr>
	<tr>
		<td width="35%">Nama</td>
		<td width="35%">: <b>'.$resultData->data[0]->NAMA.'</b></td>
	</tr>';
if($resultData->data[0]->POS_ANTRIAN == 'H'){
	$html .='<tr>
		<td>Pos Antrian</td>
		<td>: '.$resultData->data[0]->POS_ANTRIAN.''.$cb.' ( '.$resultData->data[0]->REFERENSI->POS_ANTRIAN->DESKRIPSI.' )</td>
	</tr>
	<tr>
		<td>Jadwal Kunjungan</td>
		<td>: '.$tglFormat.'</td>
	</tr>
	<tr>
		<td>Vaksin Ke</td>
		<td>: '.$resultData->data[0]->VAKSIN_KE.'</td>
	</tr>';
} else {
	$html .='<tr>
		<td>Nomor Antrian Pendaftaran</td>
		<td>: '.$resultData->data[0]->POS_ANTRIAN.''.$cb.'-'.str_pad($resultData->data[0]->NO, 3, "0", STR_PAD_LEFT).'</td>
	</tr>
	<tr>
		<td>Poli</td>
		<td>:'.$resultData->data[0]->REFERENSI->POLI->DESKRIPSI.'</td>
	</tr>
	<tr>
		<td>Pos Antrian</td>
		<td>: '.$resultData->data[0]->POS_ANTRIAN.''.$cb.' ( '.$resultData->data[0]->REFERENSI->POS_ANTRIAN->DESKRIPSI.' )</td>
	</tr>
	<tr>
		<td>Jadwal Kunjungan</td>
		<td>: '.$tglFormat.'</td>
	</tr>
	<tr>
		<td>Jam Pendaftaran</td>
		<td colspan="2">: Estimasi Pukul '.$jamPlyn.' Waktu Setempat</td>
	</tr>';
}
$html .='
</table>
</body>
</html>
';

$htmlFooter = '
<div height="300px" style="font-size:6px;margin-top:10px">
<p>Keterangan</p>
<p><i>Pastikan Nomor HP / Kontak anda aktif untuk sms</i></p>';
if($resultData->data[0]->POS_ANTRIAN == 'H'){
	$htmlFooter .= '<p><i><b>Registrasi Ini Hanya Berlaku Sesuai Tanggal Di Atas</b></i></p>';
} else {
	$htmlFooter .= '<p><i>Diharapkan datang paling lambat 30 menit sebelum estimasi jam pendaftaran</i></p>';
}
if($resultData->data[0]->POS_ANTRIAN == 'H'){
	$htmlFooter .= '';
} else {
	$htmlFooter .= '<p><i>Silahkan bawa berkas pelengkap lainnya saat datang ke Rumah Sakit</i></p>';
}
$htmlFooter .='
<p><i>Bagi Pendaftar VAKSINASI, wajib membawa KTP dan jika Umur 12 - 17 Thn Wajib membawa Kartu Keluarga (KK)</i></p>';
if($resultData->data[0]->POS_ANTRIAN == 'H'){
	$htmlFooter .= '<p><i><b>Silahkan Melakukan Registrasi Ulang di tempat untuk mengambil antrian vaksin</b> </i></p>';
} else {
	$htmlFooter .= '<p><i><b>Bagi Pasien yang sudah mengambil Antrian namun tidak datang diloket sampai 10 Nomor antrian selanjutnya, maka pasien harus mengambil ulang antrian</b> </i></p>';
}
$htmlFooter .= '</div>
';
$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';
//require_once $path . '/phpqrcode/phpqrcode.php';
//require_once $path . '/phpqrcode/qrlib.php';
$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 20,
	'margin_right' => 15,
	'margin_top' => 30,
	'margin_bottom' => 10,
	'margin_header' => 5
]);
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Bukti Registrasi Online");
$mpdf->WriteHTML($html);
$mpdf->WriteHTML($htmlFooter);

$mpdf->Output();
?>

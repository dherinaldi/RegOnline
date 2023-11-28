<?php
$tglNow = date('2021-01-01');
$tglNowF = date('d-m-Y');

$app->get('/rest/bpjs/getToken', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$getHeader = $request->getHeaders();
	$user = $getHeader['HTTP_X_USERNAME'][0];
	$pass = $getHeader['HTTP_X_PASSWORD'][0];
	$method = "GET";
	$result = getRequestTokenBpjs('GET',$user, $pass);
	$resultJsn = json_decode($result);
	return $response->withJson($result, 200);
});
$app->post('/rest/bpjs/decript/{urlws}', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$getHeader = $request->getHeaders();
	$action = $args['urlws'];
	$method = "POST";
	$token = $getHeader['HTTP_X_TOKEN'][0];
	$record = json_encode($getRecord);
	$result = getRequestDataBpjs($action,$method,$record,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});

$app->get('/api/jenisvaksin/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$getHeader = $request->getHeaders();
	$action = "getJenisVaksinasi";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	$params = '';
	$result = sendRequest($action,$method,$params,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});
$app->get('/api/instansi/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$getHeader = $request->getHeaders();
	$action = "getInstansi";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	$params = '';
	$result = sendRequest($action,$method,$params,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});
$app->get('/api/carabayar/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$getHeader = $request->getHeaders();
	$action = "getCaraBayar";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	$params = '';
	$result = sendRequest($action,$method,$params,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});
$app->get('/api/posantrian/', function($request, $response, $args) {
	$getHeader = $request->getHeaders();
	$getRecord = $request->getParsedBody();
	$action = "getPosAntrian";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	$params = (array) $request->getParams();
	$params['STATUS']=1;
	$query = count($params) > 0 ? "?".http_build_query($params) : "";
	$params = '';
	$result = sendRequest($action.$query,$method,$params,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});
$app->get('/api/kliniktujuan/', function($request, $response, $args) {
	$getHeader = $request->getHeaders();
	$getRecord = $request->getParsedBody();
	$action = "getRuangan";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	$params = '';
	$result = sendRequest($action,$method,$params,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});
$app->get('/api/tujuanrujukan/', function($request, $response, $args) {
	$getHeader = $request->getHeaders();
	$getRecord = $request->getParsedBody();
	$action = "getRuanganRujukan";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	$params = '';
	$result = sendRequest($action,$method,$params,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});
$app->get('/api/kliniktujuan/{nomor}', function($request, $response, $args) {
	$pos = $args['nomor'];
	$method = "GET";
	$data = array(
		"STATUS" => 1,
		"ANTRIAN" => $pos
	);
	$params = '';
	foreach($data as $key=>$value) {
		$params .= $key.'='.$value.'&';
	}
	$params = trim($params, '&');
	
	$action = "getRuangan";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	
	$result = sendRequest($action."?".$params,$method,$params,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});
$app->get('/api/jadwaldokter/', function($request, $response, $args) {
	$getHeader = $request->getHeaders();
	$getRecord = $request->getParsedBody();
	$action = "getJadwalDokterHfis";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	$params = (array) $request->getParams();
	$query = count($params) > 0 ? "?".http_build_query($params) : "";
	$params = '';
	$result = sendRequest($action.$query,$method,$params,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});
$app->get('/api/wilayah/', function($request, $response, $args) {
	$action = "getWilayah";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	
	$params = (array) $request->getParams();
	$params['STATUS']=1;
	$query = count($params) > 0 ? "?".http_build_query($params) : "";
	$params = '';
	$result = sendRequest($action.$query,$method,$params,$token);
	
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});
$app->get('/api/pekerjaan/', function($request, $response, $args) {
	$action = "getPekerjaan";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	$params = '';
	$result = sendRequest($action,$method,$params,$token);
	
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});

$app->post('/api/pasien/', function($request, $response, $args) {
	$getHeader = $request->getHeaders();
	$getRecord = $request->getParsedBody();
	$norm = isset($getRecord['norm']) ? $getRecord['norm'] : '0';
	$tglLahir = isset($getRecord['tglLahir']) ? $getRecord['tglLahir'] : '2000-01-01 00:01:01';
	$token = getApiToken('getToken','POST');
	$action = "getPasien";
	$method = "GET";
	if(strlen($norm) != 16){
		$data = array(
			"NORM" => $norm,
			"TANGGAL_LAHIR" => $tglLahir,
		);
	} else {
		$data = array(
			"NIK" => $norm,
			"TANGGAL_LAHIR" => $tglLahir,
		);
	}
	
	$params = '';
	foreach($data as $key=>$value) {
		$params .= $key.'='.$value.'&';
	}
	$params = trim($params, '&');
	$record = json_encode($data);
	$result = sendRequest($action."?".$params,$method,$record,$token);
	$resultJsn = json_decode($result);
	var_dump($resultJsn);die();
	return $response->withJson($resultJsn, 200);
});
$app->post('/api/verifikasi/', function($request, $response, $args) {
	$getHeader = $request->getHeaders();
	$getRecord = $request->getParsedBody();
	$jenisReg = $getRecord['jenisReg'];
	$nikReg = $getRecord['nikReg'];
	$jenisPasienTmp = $getRecord['jenisPasienTmp'];
	$normReg = $getRecord['normReg'];
	$namaReg = $getRecord['namaReg'];
	$tmpLahirReg = $getRecord['tmpLahirReg'];
	$tglLahirReg = $getRecord['tglLahirReg'];
	$kontakReg = $getRecord['kontakReg'];
	$klinikTujuanReg = isset($getRecord['klinikTujuanReg']) ? $getRecord['klinikTujuanReg'] : '';
	$caraBayarReg = $getRecord['caraBayarReg'];
	$tanggalReg = $getRecord['tanggalReg'];
	$nokartuPsn = $getRecord['nokartuPsn'];
	$noRujukanPsn = $getRecord['noRujukanPsn'];
	$jadwalDokterTujuan = $getRecord['jadwalDokterTujuan'];
	$kdPoliBpjs = $getRecord['kdPoliBpjs'];
	$kdDokter = $getRecord['kdDokter'];
	$nmDokter = $getRecord['nmDokter'];
	$jamPraktek = $getRecord['jamPraktek'];
	if($jenisReg == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Jenis Reservasi Kosong"], 200);
	}
	if($nikReg == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "NIK Kosong"], 200);
	}
	if($jenisPasienTmp == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Jenis Reservasi Kosong"], 200);
	}
	if($normReg == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "No.RM Kosong"], 200);
	}
	if($namaReg == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Nama Pasien Kosong"], 200);
	}
	if($tglLahirReg == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Tanggal Tanggal Lahir Pasien Kosong"], 200);
	}
	if($kontakReg == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Kontak Pasien Kosong"], 200);
	}
	if($klinikTujuanReg == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Poli Tujuan Pasien Kosong"], 200);
	}
	if($caraBayarReg == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Cara Bayar Pasien Kosong"], 200);
	}
	if($tanggalReg == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Tanggal Kunjungan Pasien Kosong"], 200);
	}	
	if($kdPoliBpjs == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Poliklinik Belum Terdaftar BPJS"], 200);
	}	
	if($kdDokter == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Dokter Kosong"], 200);
	}		
	if($jamPraktek == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Jam Dokter Kosong"], 200);
	}	
	return $response->withJson([
		"success" => true,
		"jenisReg" => $jenisReg,
		"nikReg" => $nikReg,
		"jenisPasienTmp" => $jenisPasienTmp,
		"normReg" => $normReg,
		"namaReg" => $namaReg,
		"tmpLahirReg" => $tmpLahirReg,
		"tglLahirReg" => $tglLahirReg,
		"kontakReg" => $kontakReg,
		"klinikTujuanReg" => $klinikTujuanReg,
		"caraBayarReg" => $caraBayarReg,
		"tanggalReg" => $tanggalReg,
		"nokartuPsn" => $nokartuPsn,
		"noRujukanPsn" => $noRujukanPsn,
		"kdPoliBpjs" => $kdPoliBpjs,
		"nmDokter" => $nmDokter,
		"kdDokter" => $kdDokter,
		"jamPraktek" => $jamPraktek,
		"message" => 'Verifikasi Data Berhasil'
		],200);
});

$app->post('/api/reservasi/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$jenis = isset($getRecord['jenisReservasi']) ? $getRecord['jenisReservasi'] : '';
	$norm = isset($getRecord['normReservasi']) ? $getRecord['normReservasi'] : '';
	$nama = isset($getRecord['namaReservasi']) ? $getRecord['namaReservasi'] : '';
	$nik = isset($getRecord['nikReservasi']) ? $getRecord['nikReservasi'] : '';
	$tmpLahir = isset($getRecord['tmpLahirReservasi']) ? $getRecord['tmpLahirReservasi'] : '';
	$tglLahir = isset($getRecord['tglLahirReservasi']) ? $getRecord['tglLahirReservasi'] : '';
	$kontak = isset($getRecord['kontakReservasi']) ? $getRecord['kontakReservasi'] : '';
	$klinikTujuan = isset($getRecord['klinikTujuanReservasi']) ? $getRecord['klinikTujuanReservasi'] : '';
	$caraBayar = isset($getRecord['caraBayarReservasi']) ? $getRecord['caraBayarReservasi'] : '';
	$tanggal = isset($getRecord['tanggalReservasi']) ? $getRecord['tanggalReservasi'] : '';
	$nokartuPsn = isset($getRecord['nokartuPsn']) ? $getRecord['nokartuPsn'] : '';
	$noRujukanPsn = isset($getRecord['noRujukanPsn']) ? $getRecord['noRujukanPsn'] : '';
	$kdPoliBpjs = isset($getRecord['kdPoliBpjs']) ? $getRecord['kdPoliBpjs'] : '';
	$kdDokter = isset($getRecord['kdDokter']) ? $getRecord['kdDokter'] : '';
	$jamPraktek = isset($getRecord['jamPraktek']) ? $getRecord['jamPraktek'] : '';
	if($jenis == ''){
		$metadata = array("message" => "Jenis Reservasi Kosong","code" => 201);
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Jenis Reservasi Kosong", "metadata" => $metadata], 200);
	}
	if($norm == ''){
		$metadata = array("message" => "No.RM Kosong","code" => 201);
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "No.RM Kosong", "metadata" => $metadata], 200);
	}
	if($nama == ''){
		$metadata = array("message" => "Nama Pasien Kosong","code" => 201);
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Nama Pasien Kosong", "metadata" => $metadata], 200);
	}
	if($tglLahir == ''){
		$metadata = array("message" => "Kontak Pasien Kosong","code" => 201);
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Kontak Pasien Kosong", "metadata" => $metadata], 200);
	}
	if($kontak == ''){
		$metadata = array("message" => "Kontak Pasien Kosong","code" => 201);
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Kontak Pasien Kosong", "metadata" => $metadata], 200);
	}
	if($klinikTujuan == ''){
		$metadata = array("message" => "Poli Tujuan Pasien Kosong","code" => 201);
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Poli Tujuan Pasien Kosong", "metadata" => $metadata], 200);
	}
	if($caraBayar == ''){
		$metadata = array("message" => "Cara Bayar Pasien Kosong","code" => 201);
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Cara Bayar Pasien Kosong", "metadata" => $metadata], 200);
	}
	if($tanggal == ''){
		$metadata = array("message" => "Tanggal Kunjungan Pasien Kosong","code" => 201);
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Tanggal Kunjungan Pasien Kosong", "metadata" => $metadata], 200);
	}
	$action = "createAntrian";
	$method = "POST";
	$data = array();
	$data['JENIS'] = $jenis;
	$data['NIK'] = $nik;
	$data['NORM'] = $norm;
	$data['NAMA'] = $nama;
	$data['TANGGAL_LAHIR'] = $tglLahir;
	$data['TEMPAT_LAHIR'] = $tmpLahir;
	$data['CONTACT'] = $kontak;
	$data['POLI'] = $klinikTujuan;
	$data['POLI_BPJS'] = $kdPoliBpjs;
	$data['CARABAYAR'] = $caraBayar;
	$data['NO_KARTU_BPJS'] = $nokartuPsn;
	$data['NO_REF_BPJS'] = $noRujukanPsn;
	$data['TANGGALKUNJUNGAN'] = $tanggal;
	$data['JENIS_APLIKASI'] = 22;
	$data['STATUS'] = 1;
	$data['DOKTER'] = $kdDokter;
	$data['JAM_PRAKTEK'] = $jamPraktek;

	$params = '';
	$token = getApiToken('getToken','POST');
	foreach($data as $key=>$value) {
		$params .= $key.'='.$value.'&';
	}
	$params = trim($params, '&');
	$datax = json_encode($data);
	$result = sendRequest($action,$method,$datax,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});

$app->post('/api/reservasi-vaksin/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$jenis = isset($getRecord['jenisReg']) ? $getRecord['jenisReg'] : '2';
	$posTujuan = isset($getRecord['posTujuan']) ? $getRecord['posTujuan'] : 'G';
	$nik = isset($getRecord['nik']) ? $getRecord['nik'] : '';
	$nama = isset($getRecord['nama']) ? $getRecord['nama'] : '';
	$jk = isset($getRecord['jk']) ? $getRecord['jk'] : '';
	$tmpLahir = isset($getRecord['tmpLahirReg']) ? $getRecord['tmpLahirReg'] : '';
	$tglLahir = isset($getRecord['tglLahir']) ? $getRecord['tglLahir'] : '';
	$alamat = isset($getRecord['alamat']) ? $getRecord['alamat'] : '';
	$wilayah = isset($getRecord['kelurahan']) ? $getRecord['kelurahan'] : '';
	$kontak = isset($getRecord['kontak']) ? $getRecord['kontak'] : '';
	$klinikTujuan = isset($getRecord['unitTujuan']) ? $getRecord['unitTujuan'] : '';
	$caraBayar = isset($getRecord['carabayar']) ? $getRecord['carabayar'] : '';
	$tanggal = isset($getRecord['tglKunjungan']) ? $getRecord['tglKunjungan'] : '';
	$asal = isset($getRecord['asal']) ? $getRecord['asal'] : '';
	$pekerjaan = isset($getRecord['pekerjaan']) ? $getRecord['pekerjaan'] : '';
	$vaksinKe = isset($getRecord['vaksinKe']) ? $getRecord['vaksinKe'] : '0';
	if($nik == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "NIK Kosong"], 200);
	}
	if($nama == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Nama Pasien Kosong"], 200);
	}
	if($jk == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Jenis Kelamin Pasien Kosong"], 200);
	}
	if($tmpLahir == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Tempat Lahir Pasien Kosong"], 200);
	}
	if($tglLahir == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Tanggal Lahir Pasien Kosong"], 200);
	}
	if($alamat == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Alamat Pasien Kosong"], 200);
	}
	if($wilayah == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Wilayah Pasien Kosong"], 200);
	}
	if($kontak == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Kontak Pasien Kosong"], 200);
	}
	if($klinikTujuan == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Poli Tujuan Pasien Kosong"], 200);
	}
	if($caraBayar == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Cara Bayar Pasien Kosong"], 200);
	}
	if($tanggal == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Tanggal Kunjungan Pasien Kosong"], 200);
	}
	if($pekerjaan == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Pekerjaan Pasien Kosong"], 200);
	}
	if($vaksinKe == ''){
		return $response->withJson(["success" => false, "total" => 0, "data" => "[]", "message" => "Silahkan Pilih Vaksin Keberapa"], 200);
	}
	$action = "createAntrianWeb";
	$method = "POST";
	$data = array();
	$data['JENIS'] = $jenis;
	$data['NIK'] = $nik;
	$data['NAMA'] = $nama;
	$data['JK'] = $jk;
	$data['TANGGAL_LAHIR'] = $tglLahir;
	$data['TEMPAT_LAHIR'] = $tmpLahir;
	$data['ALAMAT'] = $alamat;
	$data['PEKERJAAN'] = $pekerjaan;
	$data['INSTANSI_ASAL'] = $asal;
	$data['WILAYAH'] = $wilayah;
	$data['CONTACT'] = $kontak;
	$data['POLI'] = $klinikTujuan;
	$data['CARABAYAR'] = $caraBayar;
	$data['TANGGALKUNJUNGAN'] = $tanggal;
	$data['VAKSIN_KE'] = $vaksinKe;
	$data['JENIS_APLIKASI'] = 0;
	$data['STATUS'] = 1;

	$params = '';
	$token = getApiToken('getToken','POST');
	foreach($data as $key=>$value) {
		$params .= $key.'='.$value.'&';
	}
	$params = trim($params, '&');
	$datax = json_encode($data);
	$result = sendRequest($action,$method,$datax,$token);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});

$app->post('/api/getToken/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$username = isset($getRecord['username']) ? $getRecord['username'] : '';
	$password = isset($getRecord['password']) ? $getRecord['password'] : '';
	$action = "getToken";
	$method = "POST";
	$data = array(
		"X_ID" => $username,
		"X_PASS" => $password
	);
	$params = '';
	foreach($data as $key=>$value) {
		$params .= $key.'='.$value.'&';
	}
	$params = trim($params, '&');
	$datax = json_encode($data);
	$result = sendRequest($action,$method,$datax,1);
	$resultJsn = json_decode($result);
	return $response->withJson($resultJsn, 200);
});
$app->post('/api/bukti-registrasi/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$nomor = isset($getRecord['nomor']) ? $getRecord['nomor'] : '';
	$cetak = isset($getRecord['cetak']) ? 1 : 0;
	$token = getApiToken('getToken','POST');
	$action = "getAntrian";
	$method = "GET";
	$data = array(
		"NOMOR" => $nomor
	);
	$params = '';
	foreach($data as $key=>$value) {
		$params .= $key.'='.$value.'&';
	}
	$params = trim($params, '&');
	$datax = json_encode($data);
	$result = sendRequest($action."?".$params,$method,$params,$token);
	return $result;
});
$app->post('/api/cetak/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$nomor = isset($getRecord['nomor']) ? $getRecord['nomor'] : '';
	$token = getApiToken('getToken','POST');
	$action = "getAntrian";
	$method = "GET";
	$data = array(
		"NOMOR" => $nomor
	);
	$params = '';
	foreach($data as $key=>$value) {
		$params .= $key.'='.$value.'&';
	}
	$params = trim($params, '&');
	$result = sendRequest($action."?".$params,$method,$params,$token);
	$resultData = json_decode($result);
	require __DIR__ . '/../report/cetak.php';
	return $response->withHeader('Content-Type', 'application/pdf');
});

$app->post('/api/carirujukan/', function($request, $response, $args) {
	$getHeader = $request->getHeaders();
	$getRecord = $request->getParsedBody();
	$nik = isset($getRecord['nik']) ? $getRecord['nik'] : '';
	$nomor = isset($getRecord['noKartu']) ? $getRecord['noKartu'] : '';
	$noRujukan = isset($getRecord['noRujukan']) ? $getRecord['noRujukan'] : '';
	$action = "getRujukanKartu";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	$data = array(
		"noKartu" => $noKartu
	);
	$params = '';
	foreach($data as $key=>$value) {
		$params .= $key.'='.$value.'&';
	}
	$params = trim($params, '&');
	$result = sendRequest($action."?noKartu=".$nomor,$method,$params,$token);
	$resultJsn1 = json_decode($result);
	if(isset($resultJsn1->data->metadata->code)){
		if($resultJsn1->data->metadata->code != '200'){
			return $response->withJson(["success" => false,"message" => $resultJsn1->data->metadata->message],201);
		} else {
			$noRujukan = $resultJsn1->data->response->rujukan->noKunjungan;
			$nikPeserta = $resultJsn1->data->response->rujukan->peserta->nik;
			$namaPeserta = $resultJsn1->data->response->rujukan->peserta->nama;
			$tglLhrPeserta = $resultJsn1->data->response->rujukan->peserta->tglLahir;
			$tmptLahir = "-";
			$normPeserta = $resultJsn1->data->response->rujukan->peserta->mr->noMR;
			$tlpPeserta = $resultJsn1->data->response->rujukan->peserta->mr->noTelepon;
			$poliRujukan = $resultJsn1->data->response->rujukan->poliRujukan->kode;
			$nmPoliRujukan = $resultJsn1->data->response->rujukan->poliRujukan->nama;
			if($nik != $nikPeserta){
				return $response->withJson(["success" => false,"message" => "Identitas NIK Tidak Sesuai"],201);
			}
			if($normPeserta > 0){
				$jenis = '1';
				$jenisTmp = 'Pasien Lama';
			} else {
				$jenis = '2';
				$jenisTmp = 'Pasien Baru';
			}
			$data = array(
				"nik" => $nikPeserta,
				"nama" => $namaPeserta,
				"tglLahir" => $tglLhrPeserta,
				"tmptLahir" => $tmptLahir,
				"jenis" => $jenis,
				"jenisTmp" => $jenisTmp,
				"norm" => $normPeserta,
				"noTlp" => $tlpPeserta,
				"noRujukan" => $noRujukan,
				"noKartu" => $nomor,
				"poliRujukan" => $poliRujukan,
				"nmPoliRujukan" => $nmPoliRujukan
			);
			return $response->withJson(["success" => true,"data" => $data,"message" => "Data Rujukan Di Temukan"],202);
		}
	} else {
		return $response->withJson(["success" => false,"message" => "Error Connection"],202);
	}
		
});

$app->get('[/]', function($request, $response) {
	return $this->view->render($response, 'home.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'tglNow' => date('Y-m-d'),
			'tglNowF' => date('d-m-Y'),
			'controller' => 'home'
		)
	);
});
$app->get('/home[/]', function($request, $response) {
	return $this->view->render($response, 'home.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'tglNow' => date('Y-m-d'),
			'tglNowF' => date('d-m-Y'),
			'controller' => 'home'
		)
	);
});
$app->get('/step1/', function($request, $response, $args) {
	return $this->view->render($response, 'home.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'controller' => 'home'
		)
	);
});
$app->get('/step2/{jenis}/{norm}/{nama}/{tmptLahir}/{tglLahir}', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	return $this->view->render($response, 'step2.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'jenis' => $getRecord['jenis'],
			'norm' => $getRecord['norm'],
			'nama' => $getRecord['nama'],
			'tmptLahir' => $getRecord['tmptLahir'],
			'tglLahir' => $getRecord['tglLahir'],
			'controller' => 'step2'
		)
	);
});
$app->post('/step2/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	return $this->view->render($response, 'step2.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'jenis' => $getRecord['jenis'],
			'jenisTemp' => $getRecord['jenisTemp'],
			'norm' => $getRecord['norm'],
			'nama' => $getRecord['nama'],
			'tmptLahir' => $getRecord['tmptLahir'],
			'tglLahir' => $getRecord['tglLahir'],
			'controller' => 'step2'
		)
	);
});
$app->post('/step2-rujukan/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	return $this->view->render($response, 'step2-rujukan.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'jenis' => $getRecord['jenis'],
			'jenisTemp' => $getRecord['jenisTemp'],
			'norm' => $getRecord['norm'],
			'nama' => $getRecord['nama'],
			'noTlp' => $getRecord['noTlp'],
			'tmptLahir' => $getRecord['tmptLahir'],
			'tglLahir' => $getRecord['tglLahir'],
			'noKartu' => $getRecord['noKartu'],
			'nik' => $getRecord['nik'],
			'noRujukan' => $getRecord['noRujukan'],
			'poliRujukan' => $getRecord['poliRujukan'],
			'nmPoliRujukan' => $getRecord['nmPoliRujukan'],
			'controller' => 'step2-rujukan'
		)
	);
});
$app->get('/vaksin/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	return $this->view->render($response, 'vaksin.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'jenis' => $getRecord['jenis'],
			'jenisTemp' => $getRecord['jenisTemp'],
			'norm' => $getRecord['norm'],
			'nama' => $getRecord['nama'],
			'tmptLahir' => $getRecord['tmptLahir'],
			'tglLahir' => $getRecord['tglLahir'],
			'controller' => 'vaksin'
		)
	);
});
$app->post('/step3/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	return $this->view->render($response, 'step3.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'jenis' => $getRecord['jenis'],
			'jenisPasienTmp' => $getRecord['jenisPasienTmp'],
			'nikReg' => $getRecord['nikReg'],
			'norm' => $getRecord['norm'],
			'nama' => $getRecord['nama'],
			'tmptLahir' => $getRecord['tmptLahir'],
			'tglLahir' => $getRecord['tglLahir'],
			'kontakReg' => $getRecord['kontakReg'],
			'caraBayarReg' => $getRecord['caraBayarReg'],
			'klinikTujuanReg' => $getRecord['klinikTujuanReg'],
			'tglKunjungan' => $getRecord['tglKunjungan'],
			'nokartuPsn' => $getRecord['nokartuPsn'],
			'noRujukanPsn' => $getRecord['noRujukanPsn'],
			'kdPoliBpjs' => $getRecord['kdPoliBpjs'],
			'kdDokter' => $getRecord['kdDokter'],
			'nmDokter' => $getRecord['nmDokter'],
			'jamPraktek' => $getRecord['jamPraktek'],
			'controller' => 'step3'
		)
	);
});
$app->post('/verifikasi-rujukan/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	return $this->view->render($response, 'verifikasi-rujukan.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'jenis' => $getRecord['jenis'],
			'jenisPasienTmp' => $getRecord['jenisPasienTmp'],
			'nikReg' => $getRecord['nikReg'],
			'norm' => $getRecord['norm'],
			'nama' => $getRecord['nama'],
			'tmptLahir' => $getRecord['tmptLahir'],
			'tglLahir' => $getRecord['tglLahir'],
			'kontakReg' => $getRecord['kontakReg'],
			'caraBayarReg' => $getRecord['caraBayarReg'],
			'klinikTujuanReg' => $getRecord['klinikTujuanReg'],
			'tglKunjungan' => $getRecord['tglKunjungan'],
			'nokartuPsn' => $getRecord['nokartuPsn'],
			'noRujukanPsn' => $getRecord['noRujukanPsn'],
			'kdPoliBpjs' => $getRecord['kdPoliBpjs'],
			'kdDokter' => $getRecord['kdDokter'],
			'nmDokter' => $getRecord['nmDokter'],
			'jamPraktek' => $getRecord['jamPraktek'],
			'controller' => 'verifikasi-rujukan'
		)
	);
});

$app->get('/antrianruangan/{posantrian}', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	$pos = $args['posantrian'];
	
	$action = "getPosAntrian";
	$method = "GET";
	$token = getApiToken('getToken','POST');
	$params = (array) $request->getParams();
	$params['NOMOR']=$pos;
	$query = count($params) > 0 ? "?".http_build_query($params) : "";
	$params = '';
	$result = sendRequest($action.$query,$method,$params,$token);
	$resultJsn = json_decode($result);
	if($resultJsn->success){
		$nmPos = $resultJsn->data[0]->DESKRIPSI;
	} else {
		$nmPos = '-';
	}
	//var_dump($resultJsn);
	
	return $this->view->render($response, 'antrianruangan.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Informasi Antrian Ruangan / Poli',
			'tglNow' => date('Y-m-d'),
			'tglNowF' => date('d-m-Y'),
			'posAntrian' => $pos,
			'nmPosAntrian' => $nmPos,
			'controller' => 'antrianruangan'
		)
	);
});
$app->get('/step3/{jenis}/{norm}/{nama}/{tmptLahir}/{tglLahir}/{kontakReg}/{caraBayarReg}/{klinikTujuanReg}/{tanggalReg}', function($request, $response, $args) {
	return $this->view->render($response, 'step3.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'jenis' => $args['jenis'],
			'norm' => $args['norm'],
			'nama' => $args['nama'],
			'tmptLahir' => $args['tmptLahir'],
			'tglLahir' => $args['tglLahir'],
			'kontakReg' => $args['kontakReg'],
			'caraBayarReg' => $args['caraBayarReg'],
			'klinikTujuanReg' => $args['klinikTujuanReg'],
			'klinikTujuanReg' => $args['klinikTujuanReg'],
			'controller' => 'step3'
		)
	);
});
$app->post('/bukti-registrasi/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	return $this->view->render($response, 'bukti-registrasi.php', 
		array(
			'title' => 'RSUP.Dr.Wahidin Sudirohusodo Makassar',
			'labelInfo' => 'Daftar',
			'nomor' => $getRecord['nomor'],
			'controller' => 'bukti-registrasi'
		)
	);
});

$app->get('/stepx/', function($request, $response, $args) {
	$getRecord = $request->getParsedBody();
	return $response->withJson(["success" => true, "data" => '', "message" => "Sukses tes"], 200);
});
$app->get('/getTokenX/', function($request, $response, $args) {
	return $response->withJson(["success" => true, "data" =>getApiToken('getToken','POST'), "message" => "Sukses tes"], 200);
});

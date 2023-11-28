'use Home';
var CtrlStep2 = function () {
    return {
        init: function () {
			var jenis = $("#jenisPasien").val(),
				norm = $("#noRm").val(),
				tglLahir = $("#tglLahir").val();
			$("#nikPsn").focus();
			CtrlStep2.loadKomponenNewForm();
			CtrlStep2.initDatetype();
        },
		loadKomponenNewForm: function () {
			$("#btnKembali").click(function(){
				document.location=globalHomePath+'step1/';
			});
			$("#tglKunjungan").change(function(d){
				var tgl = $(this).val(),
					ruanganBpjs = $("#unitTujuan").val(),
					string = "TANGGAL="+tgl+"&POLI="+ruanganBpjs;
				if(tgl != ''){
					ONextLoader.onDialogProses('Loading ...');
					$("#jadwalDokterTujuan").children().remove();
					$.ajax({
						type: "GET",
						url: globalWsPath+"/jadwaldokter/",
						cache: true,
						headers : {
							"KeyApi": '808'
						},
						dataType: 'json',
						data: string,
						success: function(response){
							if(response.success){
								var jmlData = response.data.length;
								$("#jadwalDokterTujuan").append('<option value="">Silahkan Pilih Dokter Sesuai Jadwal</option>');
								for(var i= 0; i<jmlData; i++){
									var tabelData = '<option value="'+response.data[i].ID+'" datadokter="'+response.data[i].KD_DOKTER+'" datanamadokter="'+response.data[i].NM_DOKTER+'" datajam="'+response.data[i].JAM+'">'+response.data[i].NM_DOKTER+' | Pukul : '+response.data[i].JAM+'</option>';
									$("#jadwalDokterTujuan").append(tabelData);
								}
							} else {
								$("#jadwalDokterTujuan").append('<option value="">Jadwal Dokter Tidak Ditemukan</option>');
								alert('Jadwal Dokter Tidak Ditemukan, Silahkan Rescedule Rencana Kunjungan');
							}
							ONextLoader.onDialogProsesClose();
						}
					});
				}
			});
			$("#btnVerifikasi").on('click',(function(e) {
				var jenisPasien = $("#jenisPasien").val(),
					jenisPasienTmp = $("#jenisPasienTmp").val(),
					nikPasien = $("#nikPsn").val(),
					nmPasien = $("#nama").val(),
					tmpLahir = $("#tmpLahir").val(),
					tglLahir = $("#tglLahir").val(),
					kontakPsn = $("#kontakPsn").val(),
					crByr = $("#crByr").val(),
					unitTujuan = $("#unitTujuan").val(),
					tglKunjungan = $("#tglKunjungan").val(),
					jadwal = $("#jadwalDokterTujuan").val(),
					xa = document.getElementById("unitTujuan").selectedIndex,
					xb = document.getElementById("jadwalDokterTujuan").selectedIndex,
					kdPoliBpjs = $("#unitTujuan").val(),
					kdDokter = $("#jadwalDokterTujuan")[0].options[xb].getAttribute('datadokter'),
					nmDokter = $("#jadwalDokterTujuan")[0].options[xb].getAttribute('datanamadokter'),
					jamPraktek = $("#jadwalDokterTujuan")[0].options[xb].getAttribute('datajam');
				if(jenisPasien == ''){
					alert('Jenis Pasien Kosong');
					return false;
				}
				if(jenisPasienTmp == ''){
					alert('Jenis Pasien Kosong');
					return false;
				}
				if(nikPasien == ''){
					alert('NIK Pasien Tidak Boleh Kosong');
					return false;
				}
				if(nmPasien == ''){
					alert('Nama Pasien Tidak Boleh Kosong');
					return false;
				}
				if(tglLahir == ''){
					alert('Tanggal Lahir Pasien Tidak Boleh Kosong');
					return false;
				}
				if(kontakPsn == ''){
					alert('Kontak Pasien Tidak Boleh Kosong');
					return false;
				}
				if(crByr == ''){
					alert('Cara Bayar Pasien Tidak Boleh Kosong');
					return false;
				}
				if(unitTujuan == ''){
					alert('Poliklinik Tujuan Tidak Boleh Kosong');
					return false;
				}
				if(unitTujuan == null){
					alert('Poliklinik Tujuan Tidak Boleh Kosong');
					return false;
				}
				if(tglKunjungan == ''){
					alert('Tanggal Kunjungan Tidak Boleh Kosong');
					return false;
				}
				if(jadwal == ''){
					alert('Silahkan Pilih Dokter');
					return false;
				}
				ONextLoader.onDialogProses('Loading ...');
				var string = $("#formStep2Rujukan").serialize()+"&kdPoliBpjs="+kdPoliBpjs+"&kdDokter="+kdDokter+"&nmDokter="+nmDokter+"&jamPraktek="+jamPraktek;
				$.ajax({
					type: "POST",
					url: globalWsPath+"/verifikasi/",
					data:  string,
					cache: false,
					headers : {
						"KeyApi": '808'
					},
					dataType: 'json',
					success: function(response){
						if(response.success){
							ONextLoader.onDialogProsesClose();
							$.redirect(
								globalHomePath+'verifikasi-rujukan/', 
								{
									'jenis': response.jenisReg,
									'jenisPasienTmp': response.jenisPasienTmp,
									'nikReg': response.nikReg,
									'nama': response.namaReg,
									'norm': response.normReg,
									'tmptLahir': response.tmpLahirReg,
									'tglLahir': response.tglLahirReg,
									'kontakReg': response.kontakReg,
									'caraBayarReg': response.caraBayarReg,
									'klinikTujuanReg': response.klinikTujuanReg,
									'tglKunjungan': response.tanggalReg,
									"nokartuPsn" : response.nokartuPsn,
									"noRujukanPsn" : response.noRujukanPsn,
									"kdPoliBpjs" : response.kdPoliBpjs,
									"nmDokter" : response.nmDokter,
									"kdDokter" : response.kdDokter,
									"jamPraktek" : response.jamPraktek,
								}
							);
						} else {
							alert(response.message);
							ONextLoader.onDialogProsesClose();
						}
					}
				});
			}));
        },
		initDatetype: function () {
			$("#tglKunjungan").dateDropdowns({
			});
			//$('input[type="hidden"]').attr('type', 'text').attr('readonly', 'readonly');
		}
    };
}();
CtrlStep2.init();
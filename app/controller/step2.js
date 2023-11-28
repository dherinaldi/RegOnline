'use Home';
var recordrujukanx = undefined;
var recordkontrolx = undefined;
var CtrlStep2 = function () {
    return {
        init: function () {
			var jenis = $("#jenisPasien").val(),
				norm = $("#noRm").val(),
				tglLahir = $("#tglLahir").val(),
				noTlp = $("#kontakPsn").val();
			$("#kontakPsn").focus();
			CtrlStep2.onLoadCaraBayar();
			//CtrlStep2.onLoadRuangan();
			CtrlStep2.onLoadPosAntrian();
			CtrlStep2.loadKomponenNewForm();
			CtrlStep2.initDatetype();
        },
		onLoadCaraBayar: function () {
			$("#crByr").children().remove();
			$.ajax({
				type: "GET",
				url: globalWsPath+"/carabayar/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				success: function(response){
					if(response.success){
						var jmlData = response.data.length;
						$("#crByr").append('<option value="">Pilih Cara Bayar</option>');
						for(var i= 0; i<jmlData; i++){
							var tabelData = '<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>';
							$("#crByr").append(tabelData);
						}
					}
				}
			});
        },
		onLoadPosAntrian: function () {
			$("#posTujuan").children().remove();
			$.ajax({
				type: "GET",
				url: globalWsPath+"/posantrian/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				success: function(response){
					if(response.success){
						var jmlData = response.data.length;
						$("#posTujuan").append('<option value="">Pilih Pos / Gedung Antrian</option>');
						for(var i= 0; i<jmlData; i++){
							var tabelData = '<option value="'+response.data[i].NOMOR+'">'+response.data[i].DESKRIPSI+'</option>';
							$("#posTujuan").append(tabelData);
						}
					}
					ONextLoader.onDialogProsesClose();
				}
			});
			
        },
		onLoadRuangan: function (record) {
			$("#unitTujuan").children().remove();
			$.ajax({
				type: "GET",
				url: globalWsPath+"/kliniktujuan/"+record,
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				success: function(response){
					if(response.success){
						var jmlData = response.data.length;
						$("#unitTujuan").append('<option value="">Pilih Poliklinik Tujuan</option>');
						for(var i= 0; i<jmlData; i++){
							if(response.data[i].REFERENSI.PENJAMIN != null){
								var tabelData = '<option value="'+response.data[i].ID+'" dataBpjs="'+response.data[i].REFERENSI.PENJAMIN.RUANGAN_PENJAMIN+'">'+response.data[i].DESKRIPSI+'</option>';
								$("#unitTujuan").append(tabelData);
							}
							
						}
					} else {
						alert('Tidak Ada Poliklinik Tersediaan Di POS / Gedung Antrian Tersebut');
					}
					ONextLoader.onDialogProsesClose();
				}
			});
			
        },
		onsetDataRujukan:function(record){
			recordrujukanx = record;
			var jmlrow = record.data.rujukan.length;
			var no = 1;
			$("#recordRujukan").html("");
			for(var a=0;a < jmlrow; a++){
				var tabeldata = '<tr>'
							+'	<td scope="col">'+no+'</td>'
							+'	<td scope="col">'+record.data.rujukan[a].noKunjungan+'</td>'
							+'	<td scope="col">'+record.data.rujukan[a].tglKunjungan+'</td>'
							+'	<td scope="col">'+record.data.rujukan[a].peserta.noKartu+'</td>'
							+'	<td scope="col">'+record.data.rujukan[a].peserta.nama+'</td>'
							+'	<td scope="col">'+record.data.rujukan[a].poliRujukan.kode+'</td>'
							+'	<td scope="col">'+record.data.rujukan[a].poliRujukan.nama+'</td>'
							+'	<td scope="col">'+record.data.rujukan[a].provPerujuk.kode+'</td>'
							+'	<td scope="col">'+record.data.rujukan[a].provPerujuk.nama+'</td>'
							+'	<td scope="col"><button type="button" class="btn btn-info" onclick="CtrlStep2.onSetFormDataRujukan('+a+')">Pilih</button></td>'
							+'</tr>';
				$("#recordRujukan").append(tabeldata);
				no++;
			}
			ONextLoader.onDialogProsesClose();
		},
		onsetDataKontrol:function(record){
			recordkontrolx = record;
			var jmlrow = record.data.length;
			var no = 1;
			$("#recordKontrol").html("");
			for(var a=0;a < jmlrow; a++){
				var tabeldata = '<tr>'
							+'	<td scope="col">'+no+'</td>'
							+'	<td scope="col">'+record.data[a].noSuratKontrol+'</td>'
							+'	<td scope="col">'+record.data[a].tglTerbitKontrol+'</td>'
							+'	<td scope="col">'+record.data[a].noKartu+'</td>'
							+'	<td scope="col">'+record.data[a].nama+'</td>'
							+'	<td scope="col">'+record.data[a].poliTujuan+'</td>'
							+'	<td scope="col">'+record.data[a].tglRencanaKontrol+'</td>'
							+'	<td scope="col">'+record.data[a].kodeDokter+'</td>'
							+'	<td scope="col">'+record.data[a].namaDokter+'</td>'
							+'	<td scope="col"><button type="button" class="btn btn-info" onclick="CtrlStep2.onSetFormDataKontrol('+a+')">Pilih</button></td>'
							+'</tr>';
				$("#recordKontrol").append(tabeldata);
				no++;
			}
			ONextLoader.onDialogProsesClose();
		},
		onSetFormDataRujukan: function(a){
			$("#posTujuan").val("");
			$("#unitTujuan").val("");
			$("#noRujukanPsn").val("");
			var record = recordrujukanx.data.rujukan[a]
			var string = "penjamin="+record.poliRujukan.kode;
			$.ajax({
				type: "POST",
				url: globalWsPath+"/cariposantrianpenjamin/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				data: string,
				success: function(response){
					if(response.success){
						$("#posTujuan").val(response.data[0].ANTRIAN);
						$("#unitTujuan").val(response.data[0].ANTRIAN);
						$("#noRujukanPsn").val(record.noKunjungan);
						CtrlStep2.onLoadRuangan(response.data[0].ANTRIAN);
						$("#modalListRujukan").modal('hide');
					} else {
						alert(response.message);
					}
					ONextLoader.onDialogProsesClose();
				}
			});
		},
		onSetFormDataKontrol: function(a){
			$("#posTujuan").val("");
			$("#unitTujuan").val("");
			$("#noRujukanPsn").val("");
			var record = recordkontrolx.data[a]
			var string = "penjamin="+record.poliTujuan;
			
			$.ajax({
				type: "POST",
				url: globalWsPath+"/cariposantrianpenjamin/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				data: string,
				success: function(response){
					if(response.success){
						$("#posTujuan").val(response.data[0].ANTRIAN);
						$("#unitTujuan").val(response.data[0].ANTRIAN);
						$("#noRujukanPsn").val(record.noSuratKontrol);
						CtrlStep2.onLoadRuangan(response.data[0].ANTRIAN);
						$("#modalListRujukan").modal('hide');
					} else {
						alert(response.message);
					}
					ONextLoader.onDialogProsesClose();
				}
			});
		},
		onCariRujukan: function(faskes, noKartu, nikPasien){
			var string = "faskes="+faskes+"&noKartu="+noKartu+"&nik="+nikPasien;
			$.ajax({
				type: "POST",
				url: globalWsPath+"/carirujukankartu/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				data: string,
				success: function(response){
					if(response.success){
						return response;
					} else {
						return false;
					}
				}
			});
		},
		onCariKontrol: function(faskes, noKartu, nikPasien){
			var string = "faskes="+faskes+"&nokartu="+noKartu+"&nik="+nikPasien;
			$.ajax({
				type: "POST",
				url: globalWsPath+"/carikontrolkartu/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				data: string,
				success: function(response){
					if(response.success){
						return response;
					} else {
						return false;
					}
				}
			});
		},
		loadKomponenNewForm: function () {
			$("#btnCariRujukan").click(function(){
				recordrujukanx = undefined;
				var nikPasien = $("#nikPsn").val(),
					noKartu = $("#nokartuPsn").val();
				ONextLoader.onDialogProses('Loading ...');
				var string = "faskes=2&noKartu="+noKartu+"&nik="+nikPasien;
				$.ajax({
					type: "POST",
					url: globalWsPath+"/carirujukankartu/",
					cache: true,
					headers : {
						"KeyApi": '808'
					},
					dataType: 'json',
					data: string,
					success: function(response){
						if(response.success){
							$("#modalListRujukan").modal('show');
							CtrlStep2.onsetDataRujukan(response);
						} else {
							var string = "faskes=1&noKartu="+noKartu+"&nik="+nikPasien;
							$.ajax({
								type: "POST",
								url: globalWsPath+"/carirujukankartu/",
								cache: true,
								headers : {
									"KeyApi": '808'
								},
								dataType: 'json',
								data: string,
								success: function(response){
									if(response.success){
										$("#modalListRujukan").modal('show');
										CtrlStep2.onsetDataRujukan(response);
									} else {
										alert(response.message);
										ONextLoader.onDialogProsesClose();
									}
								}
							});
						}
					}
				});
			});
			$("#btnCariKontrol").click(function(){
				recordkontrolx = undefined;
				var nikPasien = $("#nikPsn").val(),
					noKartu = $("#nokartuPsn").val();
				ONextLoader.onDialogProses('Loading ...');
				var string = "nokartu="+noKartu;
				$.ajax({
					type: "POST",
					url: globalWsPath+"/carikontrolkartu/",
					cache: true,
					headers : {
						"KeyApi": '808'
					},
					dataType: 'json',
					data: string,
					success: function(response){
						if(response.success){
							$("#modalListKontrol").modal('show');
							CtrlStep2.onsetDataKontrol(response);
						} else {
							var string = "noKartu="+noKartu;
							$.ajax({
								type: "POST",
								url: globalWsPath+"/carikontrolkartu/",
								cache: true,
								headers : {
									"KeyApi": '808'
								},
								dataType: 'json',
								data: string,
								success: function(response){
									if(response.success){
										$("#modalListKontrol").modal('show');
										CtrlStep2.onsetDataKontrol(response);
									} else {
										alert(response.message);
										ONextLoader.onDialogProsesClose();
									}
								}
							});
						}
					}
				});
			});
			$("#btnKembali").click(function(){
				document.location=globalHomePath+'step1/';
			});
			$("#posTujuan").change(function(){
				var record = $(this).val();
				if(record !=''){
					ONextLoader.onDialogProses('Loading ...');
					CtrlStep2.onLoadRuangan(record);
				}
			});
			$("#crByr").change(function(){
				var record = $(this).val();
				ONextLoader.onDialogProses('Loading ...');
				if(record !='2'){
					document.getElementById("nokartuPsn").disabled = true;
					document.getElementById("noRujukanPsn").disabled = true;
					ONextLoader.onDialogProsesClose();
				} else {
					document.getElementById("nokartuPsn").disabled = false;
					document.getElementById("noRujukanPsn").disabled = false;
					$("#nokartuPsn").focus();
					ONextLoader.onDialogProsesClose();
				}
			});
			$("#unitTujuan").change(function(d){
				var x = document.getElementById("unitTujuan").selectedIndex;
				var ruangan = $(this).val(),
					ruanganBpjs = $(this).context.options[x].getAttribute('dataBpjs'),
					tgl = $("#tglKunjungan").val(),
					string = "TANGGAL="+tgl+"&POLI="+ruanganBpjs;
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
					kdPoliBpjs = $("#unitTujuan")[0].options[xa].getAttribute('dataBpjs'),
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
				var string = $("#formStep2").serialize()+"&kdPoliBpjs="+kdPoliBpjs+"&kdDokter="+kdDokter+"&nmDokter="+nmDokter+"&jamPraktek="+jamPraktek;
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
								globalHomePath+'step3/', 
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
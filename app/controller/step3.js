'use Home';
var CtrlStep3 = function () {
    return {
        init: function () {
			var jenis = $("#jenisReg").val(),
				norm = $("#normReg").val(),
				cb = $("#caraBayarReg").val(),
				poli = $("#klinikTujuanReg").val(),
				tglLahir = $("#tglLahir").val();
			if(jenis == ''){
				$.redirect(globalHomePath+'step1/');
			}
			CtrlStep3.onLoadCaraBayar(cb);
			CtrlStep3.onLoadRuangan(poli);
			CtrlStep3.loadKomponenNewForm();
        },
		onLoadCaraBayar: function (rec) {
			$("#crByr").html('-');
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
						for(var i= 0; i<jmlData; i++){
							if(response.data[i].ID == rec){
								$("#crByrTemp").html(response.data[i].DESKRIPSI);
							}
						}
					}
				}
			});
        },
		onLoadRuangan: function (rec) {
			$("#poliTjuanTemp").html('-');
			$.ajax({
				type: "GET",
				url: globalWsPath+"/kliniktujuan/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				success: function(response){
					if(response.success){
						var jmlData = response.data.length;
						for(var i= 0; i<jmlData; i++){
							if(response.data[i].ID == rec){
								$("#poliTjuanTemp").html(response.data[i].DESKRIPSI);
							}
						}
					}
					ONextLoader.onDialogProsesClose();
				}
			});
			
        },
		loadKomponenNewForm: function () {
			$("#btnBatal").click(function(){
				document.location=globalHomePath+'step1/';
			});
			$("#formStep3").on('submit',(function(e) {
				var jenisPasien = $("#jenisReg").val(),
					nmPasien = $("#namaReg").val(),
					tglLahir = $("#tglLahir").val(),
					kontakPsn = $("#kontakReg").val(),
					crByr = $("#caraBayarReg").val(),
					unitTujuan = $("#klinikTujuanReg").val(),
					tglKunjungan = $("#tglKunjungan").val();
				if(jenisPasien == ''){
					alert('Jenis Pasien Kosong');
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
				if(tglKunjungan == ''){
					alert('Tanggal Kunjungan Tidak Boleh Kosong');
					return false;
				}
			
				ONextLoader.onDialogProses('Loading ...');
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: globalWsPath+"/reservasi/",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					headers : {
						"KeyApi": '808'
					},
					dataType: 'json',
					success: function(response){
						ONextLoader.onDialogProsesClose();
						if(response.success){
							ONextLoader.onDialogProsesClose();
							alert(response.metadata.message);
							$.redirect(
								globalHomePath+'bukti-registrasi/', 
								{
									'nomor': response.response.kodebooking
								}
							);
						} else {
							if(response.metadata.code == 401){
								ONextLoader.onDialogProsesClose();
								alert(response.metadata.message);
								if(response.response != ''){
									$.redirect(
										globalHomePath+'bukti-registrasi/', 
										{
											'nomor': response.response.kodebooking
										}
									);
								}
							} else {
								ONextLoader.onDialogProsesClose();
								alert(response.metadata.message);
							}
						}
					}
				});
			}));
        }
    };
}();
CtrlStep3.init();
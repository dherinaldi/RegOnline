'use Home';
var CtrlStep2 = function () {
    return {
        init: function () {
			var jenis = $("#jenisPasien").val(),
				norm = $("#noRm").val(),
				tglLahir = $("#tglLahir").val();
			$("#nik").focus();
			CtrlStep2.onLoadCaraBayar();
			CtrlStep2.onLoadPekerjaan();
			CtrlStep2.onLoadPosAntrian();
			CtrlStep2.onLoadProvinsi();
			CtrlStep2.loadKomponenNewForm();
			CtrlStep2.initDatetype();
        },
		onLoadCaraBayar: function () {
			$("#carabayar").children().remove();
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
						$("#carabayar").append('<option value="">Pilih Cara Bayar</option>');
						for(var i= 0; i<jmlData; i++){
							var tabelData = '<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>';
							$("#carabayar").append(tabelData);
						}
					}
				}
			});
        },
		onLoadJenisVaksinasi: function (tgl) {
			$("#vaksinKe").children().remove();
			$.ajax({
				type: "GET",
				url: globalWsPath+"/jenisvaksin/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				success: function(response){
					if(response.success){
						var jmlData = response.data.length;
						$("#vaksinKe").append('<option value="" selected>== Pilih ==</option>');
						for(var i= 0; i<jmlData; i++){
							var tabelData = '<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>';
							$("#vaksinKe").append(tabelData);
						}
					}
				}
			});
        },
		onLoadVaksinKe: function (tgl) {
			$("#vaksinKe").children().remove();
			/*
			if(tgl == '2021-09-27'){
				var tabelData = '<option value="" selected>== Pilih ==</option><option value="1">Pertama</option><option value="2">Kedua</option>';
			} else {
				if(tgl == '2021-09-28'){
					var tabelData = '<option value="" selected>== Pilih ==</option><option value="1">Pertama</option><option value="2">Kedua</option>';
				} else {
					var tabelData = '<option value="" selected>== Pilih ==</option><option value="2">Kedua</option>';
				}
			}*/
			var tabelData = '<option value="" selected>== Pilih ==</option><option value="1">1 (Sinovac)</option><option value="2">2 (Sinovac)</option><option value="3">1 (Moderna)</option>';
			//var tabelData = '<option value="" selected>== Pilih ==</option><option value="1">Pertama</option><option value="2">Kedua</option>';
			$("#vaksinKe").append(tabelData);
        },
		onLoadPosAntrian: function () {
			$("#posTujuan").children().remove();
			$.ajax({
				type: "GET",
				url: globalWsPath+"/posantrian/?NOMOR=H",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				success: function(response){
					if(response.success){
						$("#posTujuan").val(response.data[0].NOMOR);
					}
					CtrlStep2.onLoadRuangan(response.data[0].NOMOR);
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
							var tabelData = '<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>';
							$("#unitTujuan").append(tabelData);
						}
					} else {
						alert('Tidak Ada Poliklinik Tersediaan Di POS / Gedung Antrian Tersebut');
					}
					ONextLoader.onDialogProsesClose();
				}
			});
        },
		onLoadPekerjaan: function () {
			$("#pekerjaan").children().remove();
			$.ajax({
				type: "GET",
				url: globalWsPath+"/pekerjaan/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				success: function(response){
					if(response.success){
						var jmlData = response.data.length;
						$("#pekerjaan").append('<option value="">Pilih Pekerjaan</option>');
						for(var i= 0; i<jmlData; i++){
							var tabelData = '<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>';
							$("#pekerjaan").append(tabelData);
						}
					} else {
						$("#pekerjaan").append('<option value="">Pekerjaan Tidak Ditemukan</option>');
					}
					ONextLoader.onDialogProsesClose();
				}
			});
        },
		
		onLoadProvinsi: function (record) {
			$("#provinsi").children().remove();
			var string = "JENIS=1";
			$.ajax({
				type: "GET",
				url: globalWsPath+"/wilayah/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				data: string,
				success: function(response){
					if(response.success){
						var jmlData = response.data.length;
						for(var i= 0; i<jmlData; i++){
							if(response.data[i].ID == '73'){
								var tabelData = '<option value="'+response.data[i].ID+'" selected="selected">'+response.data[i].DESKRIPSI+'</option>';
							} else {
								var tabelData = '<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>';
							}
							$("#provinsi").append(tabelData);
						}
						CtrlStep2.onLoadKabupaten(73);
					} else {
						$("#provinsi").append('<option value="0">Tidak Ditemukan</option>');
					}
					ONextLoader.onDialogProsesClose();
				}
			});
        },
		onLoadKabupaten: function (record) {
			$("#kabupaten").children().remove();
			var string = "JENIS=2&ID="+record
			$.ajax({
				type: "GET",
				url: globalWsPath+"/wilayah/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				data: string,
				dataType: 'json',
				success: function(response){
					if(response.success){
						var jmlData = response.data.length;
						for(var i= 0; i<jmlData; i++){
							var tabelData = '<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>';
							$("#kabupaten").append(tabelData);
						}
						CtrlStep2.onLoadKecamatan(response.data[0].ID);
					} else {
						$("#kabupaten").append('<option value="0">Tidak Ditemukan</option>');
					}
					ONextLoader.onDialogProsesClose();
				}
			});
        },
		onLoadKecamatan: function (record) {
			$("#kecamatan").children().remove();
			var string = "JENIS=3&ID="+record
			$.ajax({
				type: "GET",
				url: globalWsPath+"/wilayah/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				data: string,
				dataType: 'json',
				success: function(response){
					if(response.success){
						var jmlData = response.data.length;
						for(var i= 0; i<jmlData; i++){
							var tabelData = '<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>';
							$("#kecamatan").append(tabelData);
						}
						CtrlStep2.onLoadDesa(response.data[0].ID);
					} else {
						$("#kecamatan").append('<option value="0">Tidak Ditemukan</option>');
					}
					ONextLoader.onDialogProsesClose();
				}
			});
        },
		onLoadDesa: function (record) {
			$("#kelurahan").children().remove();
			var string = "JENIS=4&ID="+record
			$.ajax({
				type: "GET",
				url: globalWsPath+"/wilayah/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				data: string,
				dataType: 'json',
				success: function(response){
					if(response.success){
						var jmlData = response.data.length;
						for(var i= 0; i<jmlData; i++){
							var tabelData = '<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>';
							$("#kelurahan").append(tabelData);
						}
					} else {
						$("#unitTujuan").append('<option value="0">Tidak Ditemukan</option>');
					}
					ONextLoader.onDialogProsesClose();
				}
			});
        },
		
		loadKomponenNewForm: function () {
			$("#btnKembali").click(function(){
				document.location=globalHomePath+'step1/';
			});
			$("#tglKunjungan").change(function(){
				if($(this).val() != ''){
					//CtrlStep2.onLoadVaksinKe($(this).val());
					CtrlStep2.onLoadJenisVaksinasi($(this).val());
				}
			});
			$("#posTujuan").change(function(){
				var record = $(this).val();
				if(record !=''){
					ONextLoader.onDialogProses('Loading ...');
					CtrlStep2.onLoadRuangan(record);
				}
			});
			$("#provinsi").change(function(){
				var record = $(this).val();
				if(record !=''){
					ONextLoader.onDialogProses('Loading ...');
					CtrlStep2.onLoadKabupaten(record);
				}
			});
			$("#kabupaten").change(function(){
				var record = $(this).val();
				if(record !=''){
					ONextLoader.onDialogProses('Loading ...');
					CtrlStep2.onLoadKecamatan(record);
				}
			});
			$("#kecamatan").change(function(){
				var record = $(this).val();
				if(record !=''){
					ONextLoader.onDialogProses('Loading ...');
					CtrlStep2.onLoadDesa(record);
				}
			});
			$("#formVaksin").on('submit',(function(e) {
				var jenisPasien = $("#jenisPasien").val(),
					nik = $("#nik").val(),
					nmPasien = $("#nama").val(),
					jk = $("#jk").val(),
					tmpLahir = $("#tmptLahir").val(),
					tglLahir = $("#tglLahir").val(),
					alamat = $("#alamat").val(),
					kelurahan = $("#kelurahan").val(),
					kontakPsn = $("#kontak").val(),
					crByr = $("#carabayar").val(),
					unitTujuan = $("#unitTujuan").val(),
					tglKunjungan = $("#tglKunjungan").val(),
					vaksinKe = $("#vaksinKe").val();
				if(nik == ''){
					alert('NIK Pasien Tidak Boleh Kosong');
					return false;
				}
				if(nmPasien == ''){
					alert('Nama Pasien Tidak Boleh Kosong');
					return false;
				}
				if(jk == ''){
					alert('Jenis Kelamin Pasien Tidak Boleh Kosong');
					return false;
				}
				if(tmpLahir == ''){
					alert('Tempat Lahir Pasien Tidak Boleh Kosong');
					return false;
				}
				if(tglLahir == ''){
					alert('Tanggal Lahir Pasien Tidak Boleh Kosong');
					return false;
				}
				if(alamat == ''){
					alert('Alamat Pasien Tidak Boleh Kosong');
					return false;
				}
				if(kelurahan == ''){
					alert('Silahkan Lengkapi Wilayah Anda');
					return false;
				}
				if(kelurahan == null){
					alert('Silahkan Lengkapi Wilayah Anda');
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
				if(vaksinKe == ''){
					alert('Silahkan Pilih Vaksin Keberapa');
					return false;
				}
				ONextLoader.onDialogProses('Sedang Proses Simpan Data ...');
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: globalWsPath+"/reservasi-vaksin/",
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
							alert('Pandaftaran Kunjungan Berhasil');
							$.redirect(
								globalHomePath+'bukti-registrasi/', 
								{
									'nomor': response.response.kodebooking
								}
							);
						} else {
							if(response.metadata.code == 201){
								ONextLoader.onDialogProsesClose();
								alert(response.metadata.message);
								$.redirect(
									globalHomePath+'bukti-registrasi/', 
									{
										'nomor': response.response.kodebooking
									}
								);
							} else {
								ONextLoader.onDialogProsesClose();
								alert(response.metadata.message);
							}
						}
					}
				});
			}));
        },
		initDatetype: function () {
			$("#tglKunjungan").dateDropdowns({});
			$("#tglLahir").dateDropdowns({});
		}
    };
}();
CtrlStep2.init();
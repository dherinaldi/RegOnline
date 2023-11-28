'use daftar';
var CtrlDaftar = function () {
    return {
        init: function () {
			ONextLoader.onDialogProsesClose();
			CtrlDaftar.onResetForm();
			CtrlDaftar.onLoadFormasi();
			CtrlDaftar.onLoadProvinsi();
			CtrlDaftar.onLoadAgama();
			CtrlDaftar.onLoadPendidikan();
			CtrlDaftar.onloadAkun();
			CtrlDaftar.onloadComponent();
			$(":input").inputmask();
			$("#PROVINSI").on('change',function(){
				var record = $(this).val();
				CtrlDaftar.onLoadKota(record);
			});
			$("#FORMASI").on('change',function(){
				var record = $(this).val();
				CtrlDaftar.onLoadJabatan(record);
			});
			$("#JABATAN").on('change',function(){
				var record = $(this).val();
				if(record == 'K1'){
					document.getElementById('NOMOR_STR').disabled=true;
					document.getElementById('MASA_BERLAKU_STR').disabled=true;
					return false;
				}
				if(record == 'K2'){
					document.getElementById('NOMOR_STR').disabled=true;
					document.getElementById('MASA_BERLAKU_STR').disabled=true;
					return false;
				}
				if(record == 'K3'){
					document.getElementById('NOMOR_STR').disabled=true;
					document.getElementById('MASA_BERLAKU_STR').disabled=true;
					return false;
				}
				if(record == 'L1'){
					document.getElementById('NOMOR_STR').disabled=true;
					document.getElementById('MASA_BERLAKU_STR').disabled=true;
					return false;
				}
				if(record == 'B2'){
					document.getElementById('NOMOR_STR').disabled=true;
					document.getElementById('MASA_BERLAKU_STR').disabled=true;
					return false;
				}
				if(record == 'F3'){
					document.getElementById('NOMOR_STR').disabled=true;
					document.getElementById('MASA_BERLAKU_STR').disabled=true;
					return false;
				}
				if(record == 'I1'){
					document.getElementById('NOMOR_STR').disabled=true;
					document.getElementById('MASA_BERLAKU_STR').disabled=true;
					return false;
				}
				if(record == 'I2'){
					document.getElementById('NOMOR_STR').disabled=true;
					document.getElementById('MASA_BERLAKU_STR').disabled=true;
					return false;
				}
				document.getElementById('NOMOR_STR').disabled=false;
				document.getElementById('MASA_BERLAKU_STR').disabled=false;
			});
        },
		onLoadPendidikan: function(){
			ONextLoader.onDialogProses('Loading ...');
			$.ajax({
				type: "GET",
				url: globalApiPath+"/referensi/pendidikan/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				success: function(response){
					CtrlDaftar.onSetRecordPendidikan(response);
					ONextLoader.onDialogProsesClose();
				}
			});
		},
		onLoadFormasi: function(){
			$("#FORMASI").children().remove();
			ONextLoader.onDialogProses('Loading ...');
			$.ajax({
				type: "GET",
				url: globalApiPath+"/referensi/formasi/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				success: function(response){
					CtrlDaftar.onSetRecordFormasi(response);
					ONextLoader.onDialogProsesClose();
				}
			});
		},
		onLoadJabatan: function(rec){
			$("#JABATAN").children().remove();
			ONextLoader.onDialogProses('Loading ...');
			$.ajax({
				type: "GET",
				url: globalApiPath+"/referensi/jabatan/"+rec,
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				success: function(response){
					CtrlDaftar.onSetRecordJabatan(response);
					ONextLoader.onDialogProsesClose();
				}
			});
		},
		onLoadProvinsi: function(){
			$("#PROVINSI").children().remove();
			ONextLoader.onDialogProses('Loading ...');
			$.ajax({
				type: "GET",
				url: globalApiPath+"/referensi/provinsi/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				success: function(response){
					CtrlDaftar.onSetRecordPov(response);
					ONextLoader.onDialogProsesClose();
				}
			});
		},
		onLoadKota: function(prov){
			$("#KOTA").children().remove();
			ONextLoader.onDialogProses('Loading ...');
			$.ajax({
				type: "GET",
				url: globalApiPath+"/referensi/kota/"+prov,
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				success: function(response){
					CtrlDaftar.onSetRecordKota(response);
					ONextLoader.onDialogProsesClose();
				}
			});
		},
		onLoadAgama: function(){
			$("#AGAMA").children().remove();
			ONextLoader.onDialogProses('Loading ...');
			$.ajax({
				type: "GET",
				url: globalApiPath+"/referensi/agama/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				success: function(response){
					CtrlDaftar.onSetRecordAgama(response);
					ONextLoader.onDialogProsesClose();
				}
			});
		},
		onSetRecordPendidikan : function(response){
			var count = response.data.length;
			$("#PENDIDIKAN").append('<option value="">[ Pilih Agama ]</option>');
			for(var i = 0; i < count; i++){
				$("#PENDIDIKAN").append('<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>');
			}
			$("#PENDIDIKAN").trigger("chosen:updated");
		},
		onSetRecordAgama : function(response){
			var count = response.data.length;
			$("#AGAMA").append('<option value="">[ Pilih Agama ]</option>');
			for(var i = 0; i < count; i++){
				$("#AGAMA").append('<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>');
			}
			$("#AGAMA").trigger("chosen:updated");
		},
		onSetRecordFormasi : function(response){
			var count = response.data.length;
			$("#FORMASI").append('<option value="">[ Pilih Formasi ]</option>');
			for(var i = 0; i < count; i++){
				$("#FORMASI").append('<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>');
			}
			$("#FORMASI").trigger("chosen:updated");
		},
		onSetRecordJabatan : function(response){
			var count = response.data.length;
			$("#JABATAN").append('<option value="">[ Pilih Jabatan ]</option>');
			for(var i = 0; i < count; i++){
				$("#JABATAN").append('<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>');
			}
			$("#JABATAN").trigger("chosen:updated");
		},
		onSetRecordPov : function(response){
			var count = response.data.length;
			$("#PROVINSI").append('<option value="">[ Pilih Provinsi ]</option>');
			for(var i = 0; i < count; i++){
				$("#PROVINSI").append('<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>');
			}
			$("#PROVINSI").trigger("chosen:updated");
		},
		onSetRecordKota : function(response){
			var count = response.data.length;
			$("#KOTA").append('<option value="">Pilih Kabupaten/Kota</option>');
			for(var i = 0; i < count; i++){
				$("#KOTA").append('<option value="'+response.data[i].ID+'">'+response.data[i].DESKRIPSI+'</option>');
			}
			$("#KOTA").trigger("chosen:updated");
		},
		onloadAkun : function(){
			var url = rswsApp.handleBaseURL()+"/getSession.php";
			ONextLoader.onDialogProses('Loading ...');
			$.get(url,function(data,success){
				var record = JSON.parse(data);
				$.ajax({
					type: "GET",
					url: globalApiPath+"/registrasi/akun/"+record.tokenLogin,
					cache: true,
					headers : {
						"KeyApi": '808'
					},
					success: function(response){
						ONextLoader.onDialogProsesClose();
						CtrlDaftar.onSetForm(response.data);
					},
					error : function(){
						ONextLoader.onDialogProsesClose();
						CtrlConfig.onNotification('error','Gagal, Error Connection');
					}
				});
			});
		},
		onloadComponent : function() {
			$("#recordInfoStatus").html('');
			$('#btnReset').on('click', function(){
				CtrlDaftar.onResetForm();
            });
			
			$("#btnSubmit").on('click',function(t){
				$("#modalKonfirmasi").modal('show');
			});
			
			$("#formRegistrasi").on('submit',(function(e) {
				$("#recordInfoStatus").html('');
				$('.form-group').removeClass('has-error');
				if($("#AKUN").val() == '') {
					CtrlConfig.onNotification('error','Akun Tidak Di Temukan, pastikan koneksi jaringan anda / muat ulang halaman');
					return false;
				}
				if($("#NIK").val() == '') {
					$('#groupNik').addClass('has-error has-feedback');
					return false;
				}
				if($("#NIK").val().length != 16) {
					CtrlConfig.onNotification('error','Jumlah Digit NIK Adalah 16');
					$('#groupNik').addClass('has-error has-feedback');
					return false;
				}
				if($("#NM_KTP").val() == '') {
					CtrlConfig.onNotification('error','Nama Sesuai KTP Masih Kosong');
					$('#groupNama').addClass('has-error has-feedback');
					return false;
				}
				if($("#TMP_LAHIR_IJAZAH").val() == '') {
					CtrlConfig.onNotification('error','Tempat Lahir Sesuai Ijazah Masih Kosong');
					$('#groupTmpLhrIjazah').addClass('has-error has-feedback');
					return false;
				}
				if($("#TGL_LAHIR_IJAZAH").val() == '') {
					CtrlConfig.onNotification('error','Tanggal Lahir Sesuai Ijazah Masih Kosong');
					$('#groupTglLhrIjazah').addClass('has-error has-feedback');
					return false;
				}
				if($("#TMP_LAHIR_KTP").val() == '') {
					CtrlConfig.onNotification('error','Tempat Lahir Sesuai Ijazah Masih Kosong');
					$('#groupTmpLhrKtp').addClass('has-error has-feedback');
					return false;
				}
				if($("#TGL_LAHIR_KTP").val() == '') {
					CtrlConfig.onNotification('error','Tanggal Lahir Sesuai Ijazah Masih Kosong');
					$('#groupTglLhrKtp').addClass('has-error has-feedback');
					return false;
				}
				if($("#ALAMAT_DOMISILI").val() == '') {
					CtrlConfig.onNotification('error','Alamat Domisili Masih Kosong');
					$('#alamatDomisili').addClass('has-error has-feedback');
					return false;
				}
				if($("#ALAMAT_KTP").val() == '') {
					CtrlConfig.onNotification('error','Alamat KTP Masih Kosong');
					$('#alamatKtp').addClass('has-error has-feedback');
					return false;
				}
				
				if($("#PROVINSI").val() == '') {
					CtrlConfig.onNotification('error','Provinsi Masih Kosong');
					$('#groupProfinsi').addClass('has-error has-feedback');
					return false;
				}
				if($("#KOTA").val() == '') {
					CtrlConfig.onNotification('error','Nama Kota/Kabupaten Masih Kosong');
					$('#groupKota').addClass('has-error has-feedback');
					return false;
				}
				if($("#AGAMA").val() == '') {
					CtrlConfig.onNotification('error','Agama Masih Kosong');
					$('#groupAgama').addClass('has-error has-feedback');
					return false;
				}
				if($("#JK").val() == '') {
					CtrlConfig.onNotification('error','Jenis Kelamin Masih Kosong');
					$('#groupJk').addClass('has-error has-feedback');
					return false;
				}
				if($("#TELEPON").val() == '') {
					CtrlConfig.onNotification('error','No Telepon Masih Kosong');
					$('#groupTlp').addClass('has-error has-feedback');
					return false;
				}
				if($("#STATUS_KAWIN").val() == '') {
					CtrlConfig.onNotification('error','Status Perkawinan Masih Kosong');
					$('#groupStatusKwn').addClass('has-error has-feedback');
					return false;
				}
				if($("#FORMASI").val() == '') {
					CtrlConfig.onNotification('error','Jenis Formasi Masih Kosong');
					$('#groupFormasi').addClass('has-error has-feedback');
					return false;
				}
				if($("#JABATAN").val() == '') {
					CtrlConfig.onNotification('error','Jenis Jabatan Masih Kosong');
					$('#groupJabatan').addClass('has-error has-feedback');
					return false;
				}
				if($("#PENDIDIKAN").val() == '') {
					CtrlConfig.onNotification('error','Pendidikan Masih Kosong');
					$('#groupPendidikan').addClass('has-error has-feedback');
					return false;
				}
				if($("#PTA").val() == '') {
					CtrlConfig.onNotification('error','Perguruan Tinggi Asal / Sekolah Masih Kosong');
					$('#groupPta').addClass('has-error has-feedback');
					return false;
				}
				if($("#AKREDITASI_PTA").val() == '') {
					CtrlConfig.onNotification('error','Akrefitasi Perguruan Tinggi Asal / Sekolah Masih Kosong');
					$('#groupAkreditasiPta').addClass('has-error has-feedback');
					return false;
				}
				if($("#PRODI").val() == '') {
					CtrlConfig.onNotification('error','Program Studi / Jurusan Masih Kosong');
					$('#groupProdi').addClass('has-error has-feedback');
					return false;
				}
				if($("#AKREDITASI_PRODI").val() == '') {
					CtrlConfig.onNotification('error','Akrefitasi Program Studi / Jurusan Masih Kosong');
					$('#groupAkreditasiProdi').addClass('has-error has-feedback');
					return false;
				}
				if($("#NOMOR_IJAZAH").val() == '') {
					CtrlConfig.onNotification('error','Nomor Ijazah Masih Kosong');
					$('#groupNoIjazah').addClass('has-error has-feedback');
					return false;
				}
				if($("#TGL_IJAZAH").val() == '') {
					CtrlConfig.onNotification('error','Tanggal Ijazah Masih Kosong');
					$('#groupTglIjazah').addClass('has-error has-feedback');
					return false;
				}
				if($("#TAHUN_LULUS").val() == '') {
					CtrlConfig.onNotification('error','Tahun Lulus Masih Kosong');
					$('#groupThnLulus').addClass('has-error has-feedback');
					return false;
				}
				
				var jabatan = $("#JABATAN").val();
				if($("#NOMOR_STR").val() == '') {
					if(jabatan != 'K1'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'K2'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'K3'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'L1'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'B2'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'F3'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'I1'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'I2'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
				}
				
				if($("#MASA_BERLAKU_STR").val() == '') {
					if(jabatan != 'K1'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'K2'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'K3'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'L1'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'B2'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'F3'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'I1'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
					if(jabatan != 'I2'){
						CtrlConfig.onNotification('error','No STR Masih Kosong');
						return false;
					}
				}
				
				if($("#IPK").val() == '') {
					CtrlConfig.onNotification('error','IPK Masih Kosong');
					$('#groupIpk').addClass('has-error has-feedback');
					return false;
				}
				if($("#EMAIL").val() == '') {
					CtrlConfig.onNotification('error','Email Masih Kosong, Terjadi kesalahan load akun, Silahkan Muat ulang halaman');
					$('#groupEmail').addClass('has-error has-feedback');
					return false;
				}
				if($("#PAS_FOTO").val() == '') {
					CtrlConfig.onNotification('error','Silihkan Pilih File Foto');
					return false;
				}
				ONextLoader.onDialogProses('Sedang Proses Simpan Data ...');
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: globalApiPath+"/registrasi/daftar/",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					headers : {
						"KeyApi": '808'
					},
					success: function(response){
						if(response.success){
							ONextLoader.onDialogProsesClose();
							CtrlConfig.onNotification('success',response.message);
							document.location = rswsApp.handleBaseURL()+'/resume/';
						} else {
							ONextLoader.onDialogProsesClose();
							CtrlConfig.onNotification('success',response.message);
							CtrlDaftar.onSetInformation();
						}
					},
					error : function(){
						ONextLoader.onDialogProsesClose();
						CtrlConfig.onNotification('error','Gagal, Error Connection');
					}
				});
			}));
		},
		onSetForm : function(record){
			$("#AKUN").val(record.ID);
			$("#NIK").val(record.NIK);
			$("#NIK_TEMP").val(record.NIK);
			$("#NM_KTP").val(record.NAMA);
			$("#NM_KTP_TEMP").val(record.NAMA);
			$("#EMAIL").val(record.EMAIL);
			$("#EMAIL_TEMP").val(record.EMAIL);
		},
		
		onResetForm : function(){
			$("#NIK").val('');
			$("#NIK_TEMP").val('');
			$("#NM_IJAZAH").val('');
			$("#NM_KTP").val('');
			$("#TMP_LAHIR_IJAZAH").val('');
			$("#TGL_LAHIR_IJAZAH").val('');
			$("#TMP_LAHIR_KTP").val('');
			$("#TGL_LAHIR_KTP").val('');
			$("#ALAMAT_DOMISILI").val('');
			$("#ALAMAT_KTP").val('');
			$("#PROVINSI").val('');
			$("#KOTA").val('');
			$("#AGAMA").val('');
			$("#JK").val('');
			$("#TELEPON").val('');
			$("#EMAIL").val('');
			$("#MEDSOS").val('');
			$("#STATUS_KAWIN").val('');
			$("#FORMASI").val('');
			$("#JABATAN").val('');
			$("#PENDIDIKAN").val('');
			$("#PTA").val('');
			$("#AKREDITASI_PTA").val('');
			$("#PRODI").val('');
			$("#AKREDITASI_PRODI").val('');
			$("#NOMOR_IJAZAH").val('');
			$("#TGL_IJAZAH").val('');
			$("#TAHUN_LULUS").val('');
			$("#IPK").val('');
			$("#REKAM_JEJAK_1").val(0);
			$("#REKAM_JEJAK_2").val(0);
			$("#REKAM_JEJAK_3").val(0);
		},
		onSetInformation : function(){
			var panelInfo = '<div class="alert alert-success alert-dismissable" style="text-align:center">'
							+'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
							+'	<strong>Sukses!</strong></br> Informasi Akun Telah Terkirim ke email Anda. '
							+'	</br>Silahkan Klik Link Verifikasi yang terkirim ke email'
							+'</div>';
			$("#recordInfoStatus").html(panelInfo);
			document.location = rswsApp.handleBaseURL();
		}
    };

}();
CtrlDaftar.init();
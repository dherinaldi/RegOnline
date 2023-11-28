'use registers';
var CtrlBerkas = function () {
	var noPendaftaran = 0;
    return {
        init: function () {
			ONextLoader.onDialogProsesClose();
			CtrlBerkas.onloadRecord();
        },
		onloadRecord : function(){
			var url = rswsApp.handleBaseURL()+"/getSession.php";
			$.get(url,function(data,success){
				var record = JSON.parse(data);
				$.ajax({
					type: "GET",
					url: globalApiPath+"/registrasi/resume/"+record.idLogin,
					cache: true,
					headers : {
						"KeyApi": '808'
					},
					success: function(response){
						ONextLoader.onDialogProsesClose();
						CtrlConfig.onNotification('success',response.message);
						CtrlBerkas.onSetForm(response.data);
					},
					error : function(){
						ONextLoader.onDialogProsesClose();
						CtrlConfig.onNotification('error','Gagal, Error Connection');
					}
				});
			});
		},
		
		onSetForm : function(record){
			noPendaftaran = record.ID;
			$("#formasiPeserta").html(record.NM_FORMASI);
			$("#jabatanPeserta").html(record.NM_JABATAN);
			$("#pendidikanPeserta").html(record.NM_PENDIDIKAN);
			
			$("#namaIjazahPeserta").html(record.NM_IJAZAH);
			$("#tmpLhrIjazahPeserta").html(record.TMP_LAHIR_IJAZAH);
			$("#tglLhrIjazahPeserta").html(record.TGL_IJAZAH);
			$("#ptAsalPeserta").html(record.PT_ASAL);
			$("#akreditasiPtPeserta").html(record.AKREDITASI_PT);
			$("#prodiPeserta").html(record.PRODI);
			$("#akreditasiProdiPeserta").html(record.AKREDITASI_PRODI);
			$("#noIjazahPeserta").html(record.NOMOR_IJAZAH);
			$("#tglIjazahPeserta").html(record.TGL_IJAZAH);
			$("#thnLulusPeserta").html(record.TAHUN_LULUS);
			$("#ipkPeserta").html(record.IPK);
			
			$("#nikPeserta").html(record.NIK);
			$("#nmKtpPeserta").html(record.NM_KTP);
			$("#tmpLhrKtpPeserta").html(record.TMP_LAHIR_KTP);
			$("#tglLhrKtpPeserta").html(record.TGL_LAHIR_KTP);
			$("#alamatKtpPeserta").html(record.ALAMAT_KTP);
			$("#alamatDomisiliPeserta").html(record.ALAMAT_DOMISILI);
			$("#provinsiPeserta").html(record.NM_PROVINSI);
			$("#kotaPeserta").html(record.NM_KOTA);
			$("#agamaPeserta").html(record.NM_AGAMA);
			$("#jkPeserta").html(record.NM_JK);
			$("#tlpPeserta").html(record.TELEPON);
			$("#emailPeserta").html(record.EMAIL);
			$("#medsosPeserta").html(record.MEDSOS);
			
			$("#FOTO_VIEW").html('<img src="'+globalApiPath+'/registrasi/get-foto/'+record.ID+'" class="img-responsive br-t-3 full-width">');
			//CtrlBerkas.onLoadBerkas(record.ID);
		},
		
		
		onSetInformation : function(){
			var panelInfo = '<div class="alert alert-success alert-dismissable" style="text-align:center">'
							+'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
							+'	<strong>Sukses!</strong></br> Informasi Akun Telah Terkirim ke email Anda. '
							+'	</br>Silahkan Klik Link Verifikasi yang terkirim ke email'
							+'</div>';
			$("#recordInfoStatus").html(panelInfo);
		}
    };

}();
CtrlBerkas.init();
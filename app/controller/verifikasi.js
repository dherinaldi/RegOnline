'use verifikasi';
var CtrlVerifikasi = function () {
    return {
        init: function () {
			ONextLoader.onDialogProsesClose();
			CtrlVerifikasi.onVerifikasi();
        },
		onVerifikasi : function() {
			$("#recordInfoStatus").html('');
			ONextLoader.onDialogProses('Sedang Proses Verifikasi ...');
			var nomor = $("#nomorVer").val(),
				akun = $("#akunVer").val();
			string = 'nomor='+nomor+'&akun='+akun;
			$.ajax({
				type: "POST",
				url: globalApiPath+"/registrasi/verifikasi/",
				cache: true,
				data : string,
				headers : {
					"KeyApi": '808'
				},
				success: function(response){
					ONextLoader.onDialogProsesClose();
					if(response.success){
						CtrlConfig.onNotification('success',response.message);
						CtrlVerifikasi.onSetSuccess();
					} else {
						CtrlConfig.onNotification('error',response.message);
						CtrlVerifikasi.onSetGagal(response.message);
					}
				},
				error : function(){
					ONextLoader.onDialogProsesClose();
					CtrlConfig.onNotification('error','Gagal, Error Connection');
					CtrlVerifikasi.onSetGagal();
				}
			});
		},
		onSetSuccess : function(){
			var panelInfo = '<div class="alert alert-success alert-dismissable" style="text-align:center">'
							+'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
							+'	<strong>Sukses!</strong></br> Akun Anda telah terverifikasi '
							+'	</br>Silahkan Login untuk mengakses menu pendaftaran'
							+'</div>'
							+'<a href="'+rswsApp.handleBaseURL()+'/login/" class="btn btn-info btn-lg btn-block btn-stroke btn-double">Login</a>';
			$("#recordInfoStatus").html(panelInfo);
		},
		onSetGagal : function(message){
			var panelInfo = '<div class="alert alert-danger alert-dismissable" style="text-align:center">'
							+'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
							+'	<strong>Gagal!</strong></br> '+message
							+'</div>';
			$("#recordInfoStatus").html(panelInfo);
		}
    };

}();
CtrlVerifikasi.init();
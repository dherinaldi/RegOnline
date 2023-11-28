'use verifikasi';
var CtrlLogOut = function () {
    return {
        init: function () {
			ONextLoader.onDialogProsesClose();
			CtrlLogOut.onVerifikasi();
        },
		onVerifikasi : function() {
			$("#recordInfoStatus").html('');
			ONextLoader.onDialogProses('Sedang Proses Verifikasi ...');
			$.ajax({
				type: "POST",
				url: globalApiPath+"/auth/logout/",
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				success: function(response){
					ONextLoader.onDialogProsesClose();
					if(response.success){
						CtrlConfig.onNotification('success',response.message);
						document.location=rswsApp.handleBaseURL()+'/login/';
					} else {
						CtrlConfig.onNotification('error',response.message);
						CtrlLogOut.onSetGagal(response.message);
					}
				},
				error : function(){
					ONextLoader.onDialogProsesClose();
					CtrlConfig.onNotification('error','Gagal, Error Connection');
					CtrlLogOut.onSetGagal();
				}
			});
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
CtrlLogOut.init();
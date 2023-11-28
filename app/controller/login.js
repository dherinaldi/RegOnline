'use verifikasi';
var CtrlLogin = function () {
    return {
        init: function () {
			ONextLoader.onDialogProsesClose();
			CtrlLogin.onLoadComponent();
        },
		onLoadComponent : function(){
			$("#formLogin").on('submit',(function(e) {
				if($("#username").val() == ''){
					CtrlConfig.onNotification('error','Username Harus Di Isi');
					$("#username").focus();
					return false;
				}
				if($("#Password").val() == ''){
					CtrlConfig.onNotification('error','Password Harus Di Isi');
					$("#Password").focus();
					return false;
				}
				ONextLoader.onDialogProses('Sedang Proses ...');
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: globalWsPath+"/auth/verifikasi/",
					data:  new FormData(this),
					contentType: false,
					cache: false,
					processData:false,
					headers : {
						"KeyApi": '808'
					},
					success: function(response){
						if(response.success){
							CtrlConfig.onNotification('success',response.message);
							document.location=globalHomePath+'/';
						} else {
							CtrlConfig.onNotification('error',response.message);
						}
						ONextLoader.onDialogProsesClose();
					},
					error: function(jqXHR, textStatus, errorThrown){
						ONextLoader.onDialogProsesClose();
						var response = JSON.parse(jqXHR.responseText);
						CtrlConfig.onNotification('error',textStatus);
					}
				});
			}));
		}
    };

}();
CtrlLogin.init();
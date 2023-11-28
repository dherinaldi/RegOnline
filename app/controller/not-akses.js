'use registers';
var CtrlRegister = function () {
    return {
        init: function () {
			ONextLoader.onDialogProsesClose();
			CtrlRegister.onSetInformation();
        },
		onSetInformation : function(){
			var panelInfo = '<div class="alert alert-danger alert-dismissable" style="text-align:center">'
							+'	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
							+'	<strong>Not Akses!</strong>'
							+'	</br>Anda Tidak Punya Akses Untuk Fitur Ini'
							+'</div>';
			$("#recordInfoStatus").html(panelInfo);
		}
    };

}();
CtrlRegister.init();
'use Home';
var firebaseConfig = {
	apiKey: "AIzaSyBFnYRLmp7M_tR4KLpVlAq4UQYH9RZk32k",
	authDomain: "antrianpoli-9bce8.firebaseapp.com",
	projectId: "antrianpoli-9bce8",
}
firebase.initializeApp(firebaseConfig)
const db = firebase.firestore()
var tglNow = $("#tglNow").val();
var posAntrian = $("#posAntrian").val();
var CtrlAntrianRuangan = function () {
    return {
		loadRuangan: function () {
			ONextLoader.onDialogProses('Loading ...');
			$.ajax({
				type: "GET",
				url: globalWsPath+"/kliniktujuan/"+posAntrian,
				cache: true,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				success: function(response){
					if(response.success){
						ONextLoader.onDialogProsesClose();
						CtrlAntrianRuangan.onSetRuangan(response);
					} else {
						ONextLoader.onDialogProsesClose();
						alert('Ruangan Di Pos Antrian Tersebut Tidak Ditemukan');
					}
				},
				error: function(){
					ONextLoader.onDialogProsesClose();
					alert('Ruangan Di Pos Antrian Tersebut Tidak Ditemukan');
				}
			});
        },
		onSetRuangan: function (response) {
			$("#recordData").html("");
			ONextLoader.onDialogProses('Loading ...');
			var jmlData = response.data.length;
			for(var i= 0; i<jmlData; i++){
				var tabelData = '<div class="col-4" style="padding-left:0px;margin-bottom:20px">'
								+'	<div class="card">'
								+'		<div class="card-footer" style="background:#17a2b8">'
								+'			<h5 class="card-title" style="text-align:center;color:#FFF;font-weight:bold">'+response.data[i].DESKRIPSI+' </h5>'
								+'		</div>'
								+'		<div class="card-body" style="padding:1rem">'
								+'			<h5 class="card-title" style="text-align:center;font-size:xxx-large;font-family:fantasy;margin-bottom:0px" id="Pos-'+response.data[i].ID+'">0</h5>'
								+'		</div>'
								+'	</div>'
								+'</div>';
				$("#recordData").append(tabelData);
			}
			CtrlAntrianRuangan.onSetAntrian(response);
			ONextLoader.onDialogProsesClose();
        },
		onSetAntrian: function (record) {
			var jmlData = record.data.length;
			for(var a= 0; a<jmlData; a++){
				var idPos = record.data[a].ID;
				db.collection("data").doc(idPos).onSnapshot(doc => {
					if (doc.exists) {
						if(doc.data().tanggal == tglNow){
							document.getElementById('Pos-'+doc.data().poli).innerHTML = doc.data().nomor
						} else {
							document.getElementById('Pos-'+doc.data().poli).innerHTML = '0'
						}
					} else {
						document.getElementById('Pos-'+idPos).innerHTML = '0'
					}
				})
			}
        }
		
    };
}();
CtrlAntrianRuangan.loadRuangan();

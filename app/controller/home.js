'use Home';
var CtrlHome = function () {
    return {
        init: function () {
			$("#exampleModalCenteredScrollable").modal('show');
			$("#form-konten").html('');
			ONextLoader.onDialogProsesClose();
			var valDefault = $("input[name='jenisPasien']:checked").val();
			CtrlHome.onSetForm(valDefault);
			$("input[name='jenisPasien']").change(function(){
				var setValue = $("input[name='jenisPasien']:checked").val();
				CtrlHome.onSetForm(setValue);
			});
			
        },
		onSetForm : function(jenis){
			if(jenis == 'R'){
				ONextLoader.onDialogProses('Loading ...');
				CtrlHome.onSetPsnRujukan();
			} else if(jenis == 'L'){
				ONextLoader.onDialogProses('Loading ...');
				CtrlHome.onSetOld();
			} else {
				if(jenis == 'B'){
					ONextLoader.onDialogProses('Loading ...');
					CtrlHome.onSetNew();
				} else {
					$("#form-konten").html('');
				}
			}
		},
		onSetOld : function(){
			$.ajax({
				type: "GET",
				url: globalHomePath+"/app/views/form-old.php",
				cache: true,
				success: function(html){
					$("#form-konten").html(html);
					ONextLoader.onDialogProsesClose();
					CtrlHome.loadKomponenOldForm();
					CtrlHome.initDatetype();
				}
			});
		},
		onSetNew : function(){
			$.ajax({
				type: "GET",
				url: globalHomePath+"/app/views/form-new.php",
				cache: true,
				success: function(html){
					$("#form-konten").html(html);
					ONextLoader.onDialogProsesClose();
					CtrlHome.loadKomponenNewForm();
					CtrlHome.initDatetype();
				}
			});
		},
		onSetPsnRujukan : function(){
			$.ajax({
				type: "GET",
				url: globalHomePath+"/app/views/form-rujukan.php",
				cache: true,
				success: function(html){
					$("#form-konten").html(html);
					ONextLoader.onDialogProsesClose();
					CtrlHome.loadKomponenRujukanForm();
					CtrlHome.initDatetype();
				}
			});
		},
		loadKomponenOldForm: function () {
			$("#btnCariPasien").click(function(){
				var norm = $("#noRm").val(),
					tglLahir = $("#tglLahir").val();
				if(norm == ''){
					alert('No.Rekam Medis / NIK Pasien Masih Kosong');
					return false;
				}
				if(tglLahir == ''){
					alert('Tanggal Lahir Pasien Masih Kosong');
					return false;
				}
				if(norm.length != 16){
					
				} else {
					
				}
				var data = 'norm='+norm+'&tglLahir='+tglLahir;
				ONextLoader.onDialogProses('Loading ...');
				$.ajax({
					type: "POST",
					url: globalWsPath+"/pasien/",
					cache: true,
					data: data,
					headers : {
						"KeyApi": '808'
					},
					dataType: 'json',
					success: function(response){
						if(response.success){
							ONextLoader.onDialogProsesClose();
							$.redirect(
								globalHomePath+'step2/', 
								{
									'jenis': 1,
									'jenisTemp': 'Pasien Lama',
									'nama': response.data[0].NAMA,
									'norm': response.data[0].NORM,
									'tmptLahir': response.data[0].TEMPAT_LAHIR,
									'tglLahir': response.data[0].TANGGAL_LAHIR,
									'noTlp': response.data[0].KONTAK[0].NOMOR,
									'nik': response.data[0].KARTUIDENTITAS[0].NOMOR,
									'noKartu': response.data[0].NO_KARTU_BPJS
									
								}
							);
						} else {
							ONextLoader.onDialogProsesClose();
							alert('Pasien Tidak Di Temukan ..');
						}
					},
					error: function(){
						ONextLoader.onDialogProsesClose();
						alert('Error Connection ..');
					}
				});
			});
        },
		loadKomponenNewForm: function () {
			$("#btnPasienBaru").click(function(){
				var nmPasien = $("#nmPasien").val(),
					tmpLahir = $("#tmpLahir").val(),
					tglLahir = $("#tglLahir").val();
				if(nmPasien == ''){
					alert('Nama Pasien Harus Di Isi');
					return false;
				}
				if(tmpLahir == ''){
					alert('Tempat Lahir Pasien Harus Di Isi');
					return false;
				}
				if(tglLahir == ''){
					alert('Tanggal Lahir Pasien Harus Di Isi');
					return false;
				}
				ONextLoader.onDialogProses('Loading ...');
				$.redirect(
					globalHomePath+'/step2/', 
					{
						'jenis': 2,
						'jenisTemp': 'Pasien Baru',
						'nama': nmPasien,
						'norm': 0,
						'tmptLahir': tmpLahir,
						'tglLahir': tglLahir
					}
				);
			});
        },
		loadKomponenRujukanForm: function () {
			$("#nik").focus();
			$("#btnCariRujukanPasien").click(function(){
				var nik = $("#nik").val(),
					noKartu = $("#noKartu").val(),
					noRujukan = $("#noRujukan").val();
				if(nik == ''){
					alert('NIK Pasien Tidak Valid / Masih Kosong');
					return false;
				}
				if(noKartu == ''){
					alert('No.Kartu Pasien Tidak Valid / Masih Kosong');
					return false;
				}
				if(nik.length != 16){
					alert('NIK Harus 16 Karakter');
					return false;
				}
				if(noKartu.length != 13){
					alert('No.Kartu Harus 13 Karakter');
					return false;
				}
				var data = 'nik='+nik+'&noKartu='+noKartu+'&noRujukan='+noRujukan;
				ONextLoader.onDialogProses('Loading ...');
				$.ajax({
					type: "POST",
					url: globalHomePath+"/api/carirujukan/",
					cache: true,
					data: data,
					headers : {
						"KeyApi": '808'
					},
					dataType: 'json',
					success: function(response){
						if(response.success){
							ONextLoader.onDialogProsesClose();
							CtrlHome.onSetPasienRujukan(response.data);
						} else {
							ONextLoader.onDialogProsesClose();
							alert(response.message);
						}
					},
					error: function(){
						ONextLoader.onDialogProsesClose();
						alert('Error Connection ..');
					}
				});
			});
        },
		onSetPasienRujukan : function(rec){
			$.redirect(
				globalHomePath+'step2-rujukan/', 
				{
					'jenis': rec.jenis,
					'jenisTemp': rec.jenisTmp,
					'nama': rec.nama,
					'norm': rec.norm,
					'tmptLahir': rec.tmptLahir,
					'tglLahir': rec.tglLahir,
					'noTlp': rec.noTlp,
					'noKartu': rec.noKartu,
					'nik': rec.nik,
					'noRujukan': rec.noRujukan,
					'nmPoliRujukan': rec.nmPoliRujukan,
					'poliRujukan': rec.poliRujukan
				}
			);
		},
		initDatetype: function () {
			$("#tglLahir").dateDropdowns({
			});
			//$('input[type="hidden"]').attr('type', 'text').attr('readonly', 'readonly');
		}
    };
}();
CtrlHome.init();
var firebaseConfig = {
	apiKey: "AIzaSyAWz1IY-LtLxK_iT7E8d-T_IjHB5JF5G3o",
	authDomain: "antrianonline-f343e.firebaseapp.com",
	projectId: "antrianonline-f343e",
}
firebase.initializeApp(firebaseConfig)
const db = firebase.firestore()
var tglNow = $("#tglNow").val();
db.collection("data").doc('A').onSnapshot(doc => {
	if (doc.exists) {
		if(doc.data().tanggal == tglNow){
			document.getElementById('Pos-A').innerHTML = doc.data().nomor
		} else {
			document.getElementById('Pos-A').innerHTML = '0'
		}
	} else {
		document.getElementById('Pos-A').innerHTML = '0'
	}
})

db.collection("data").doc('B').onSnapshot(doc => {
	if (doc.exists) {
		if(doc.data().tanggal == tglNow){
			document.getElementById('Pos-B').innerHTML = doc.data().nomor
		} else {
			document.getElementById('Pos-B').innerHTML = '0'
		}
	} else {
		document.getElementById('Pos-B').innerHTML = '0'
	}
})

db.collection("data").doc('C').onSnapshot(doc => {
	if (doc.exists) {
		if(doc.data().tanggal == tglNow){
			document.getElementById('Pos-C').innerHTML = doc.data().nomor
		} else {
			document.getElementById('Pos-C').innerHTML = '0'
		}
	} else {
		document.getElementById('Pos-C').innerHTML = '0'
	}
})

db.collection("data").doc('D').onSnapshot(doc => {
	if (doc.exists) {
		if(doc.data().tanggal == tglNow){
			document.getElementById('Pos-D').innerHTML = doc.data().nomor
		} else {
			document.getElementById('Pos-D').innerHTML = '0'
		}
	} else {
		document.getElementById('Pos-D').innerHTML = '0'
	}
})
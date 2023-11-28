'use Home';
var CtrlBuktiRegistrasi = function () {
    return {
        init: function () {
			var nomor = $("#nomor").val();
			var data = 'nomor='+nomor;
			$.ajax({
				type: "POST",
				url: globalWsPath+"/bukti-registrasi/",
				cache: true,
				data: data,
				headers : {
					"KeyApi": '808'
				},
				dataType: 'json',
				success: function(response){
					if(response.data[0].CARABAYAR == 2){
						var cb = 2;
					} else {
						var cb = 1;
					}
					if(response.data[0].POS_ANTRIAN == 'H'){
						$("#noAntrian").html('Diberikan Saat Datang Di RS');
					} else {
						$("#noAntrian").html(response.data[0].POS_ANTRIAN+''+cb+'-'+response.data[0].NO.padStart(3, '0'));
					}
					
					$("#loketAntrian").html(response.data[0].POS_ANTRIAN+''+cb+' ('+response.data[0].REFERENSI.POS_ANTRIAN.DESKRIPSI+')');
					$("#jnsPsn").html(response.data[0].JENIS == 1 ? 'Pasien Lama' : 'Pasien Baru');
					$("#norm").html(response.data[0].NORM.padStart(8, '0'));
					$("#nama").html(response.data[0].NAMA);
					$("#tmpLhr").html(response.data[0].TEMPAT_LAHIR);
					$("#tglLhr").html(response.data[0].TANGGAL_LAHIR);
					$("#kontak").html(response.data[0].CONTACT);
					$("#crByrTemp").html(response.data[0].REFERENSI.CARABAYAR.DESKRIPSI);
					$("#poliTjuanTemp").html(response.data[0].REFERENSI.POLI.DESKRIPSI);
					$("#tglKunjungan").html(response.data[0].TANGGALKUNJUNGAN);
					if(response.data[0].POS_ANTRIAN == 'H'){
						$("#jamKunjungan").html('-');
					} else {
						if(response.data[0].JAM_PELAYANAN > '12'){
							$("#jamKunjungan").html("12:00 Waktu Setempat");
						} else {
							$("#jamKunjungan").html(response.data[0].JAM_PELAYANAN+" Waktu Setempat");
						}
						
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert('Error Connection');
					//document.location=globalHomePath+'step1/';
				}
			});
			CtrlBuktiRegistrasi.loadKomponenNewForm();
        },
		loadKomponenNewForm: function () {
			$("#btnDownload").on('click',(function(e) {
				var nomor = $("#nomor").val();
				$.redirect(
					globalWsPath+'/cetak/', 
					{
						'nomor': nomor,
						'cetak':1
					},
					'POST','_blank'
				);
			}));
        }
    };
}();
CtrlBuktiRegistrasi.init();
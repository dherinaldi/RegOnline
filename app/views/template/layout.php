<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Registrasi Antrian Online | SIMpel">
        <meta name="keywords" content="Registrasi Online, Registrasi Online  | SIMpel,  SIMpel">
        <meta name="author" content="SIMpel Team">
        <title>{{ labelInfo }} | {{ title }}</title>
		<link href="{{ base_url() }}/favicon.ico" rel="shortcut icon">
		<link href="{{ base_url() }}/public/css/bootstrap.css" rel="stylesheet">
		<link href="{{ base_url() }}/public/css/offcanvas.css" rel="stylesheet">
		<link href="{{ base_url() }}/loader/dialog-mobile.css" rel="stylesheet">
		<link href="{{ base_url() }}/public/css/styles-date.css" rel="stylesheet">
		
		<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-app.js"></script>
		<script src="https://www.gstatic.com/firebasejs/8.7.1/firebase-firestore.js"></script>
	
		<style>
		#progressbar {
			margin-bottom: 30px;
			overflow: hidden;
			counter-reset: step;
			margin-left:0px;
			padding-left:0px;
		}
		#progressbar li {
			list-style-type: none;
			color: white;
			text-transform: uppercase;
			font-size: 9px;
			width: 33.33%;
			float: left;
			position: relative;
		}
		#progressbar li:before {
			content: counter(step);
			counter-increment: step;
			width: 20px;
			line-height: 20px;
			display: block;
			font-size: 10px;
			color: #333;
			background: white;
			border-radius: 3px;
			margin: 0 auto 5px auto;
		}
		#progressbar li:after {
			content: '';
			width: 100%;
			height: 2px;
			background: white;
			position: absolute;
			left: -50%;
			top: 9px;
			z-index: -1;
		}
		#progressbar li:first-child:after {
			content: none;
		}
		#progressbar li.active:before, #progressbar li.active:after {
			background: #27AE60;
			color: white;
		}
		#liStep1{
			text-align:center;
		}
		#liStep2{
			text-align:center;
		}
		#liStep3{
			text-align:center;
		}
	</style>
	</head>
    <body style="background:cadetblue">
		<div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenteredScrollableTitle">INFORMASI......!!!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
			  	<p>Sebelum mendaftar atau mengambil Antrian..</p>	
				<p>Harap Siapkan NIK Untuk Pasien Umum. Nomor kartu BPJS dan Nomor Rujukan Bagi peserta BPJS</p>
				<p>Untuk pasien BPJS antrian WEB digunakan untuk pasien dengan RUJUKAN BARU , pasien KONTROL Silahkan menggunakan Mobile JKN atau meminta perubahan jadwal di INFORMASI</p>
				<a href="#formOld" type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Tutup</a>
				
				

			  </div>
			  
			</div>
		  </div>
		</div>

		
		
		<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
		  <a class="navbar-brand" href="{{ base_url() }}"><img src="{{ base_url() }}/public/img/1.png" width="30px" style="margin-right:5px"><b><span id="nmIstansi">-</span></b></a>
		</nav>

		<main role="main" class="container">
			{% block content %}{% endblock %}
		</main>
		
		<script src="{{ base_url() }}/public/js/jquery/dist/jquery.min.js"></script>
		<script src="{{ base_url() }}/public/js/bootstrap.min.js"></script>
		<script src="{{ base_url() }}/public/js/offcanvas.js"></script>
		<script src="{{ base_url() }}/public/js/jquery.redirect.js"></script>
		<script src="{{ base_url() }}/public/js/jquery.date-dropdowns.js"></script>
		<script src="{{ base_url() }}/loader/mcx-dialog.js"></script>
        <script src="{{ base_url() }}/app/controller/config.js"></script>
		
		<script>
			$.ajax({
				type: "GET",
				url: globalWsPath+"/instansi/",
				cache: true,
				headers : {
					"KeyApi": '808/api'
				},
				dataType: 'json',
				success: function(response){
					if(response.success){
						ONextLoader.onDialogProsesClose();
						$("#nmIstansi").html(response.data[0].REFERENSI.PPK.NAMA);
					} else {
						alert('Istansi Tidak Terdaftar ..');
						return false;
					}
				},
				error: function(){
					alert('Error Connection ..');
					return false;
				}
			});
			var ONextLoader = function () {
				return {
					init: function () {
						ONextLoader.onDialogProses('Loading ...');
					},
					onDialogProses : function(message) {
						mcxDialog.loading({
							src: globalHomePath+"/loader",
							hint: message
						});
					},
					onDialogProsesClose : function() {
						mcxDialog.closeLoading();
					},
					onDialogMessage : function(message) {
						mcxDialog.alert(message);
					}
				};
			}();
			
			
		</script>
		
		<script src="{{ base_url() }}/app/controller/{{ controller }}.js"></script>
    </body>
</html>
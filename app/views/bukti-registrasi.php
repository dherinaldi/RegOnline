{% extends 'template/layout.php' %}
{% block content %}
<div class="my-3 p-3 bg-white rounded box-shadow">
	<h6 class="border-bottom border-gray pb-2 mb-0"><b>Bukti Registrasi Pasien</b></h6>
	
	<div class="alert alert-success" role="alert">
		<b>Sukses !</b>, data pendaftar berhasil terkirim ..</br>
		<i>Silahkan cetak bukti registrasi sebagai bukti registrasi Anda</i>
	</div>
	
	<form id="formbuktiRegistrasi" class="mt-3">
		<input type="hidden" id="nomor" value="{{nomor}}">
		<table class="table table-bordered">
			<tr>
				<td width="30%">Nomor Registrasi</td>
				<td><b>{{nomor}}</b></td>
			</tr>
			<tr>
				<td width="30%">Nomor Antrian</td>
				<td><b><span id="noAntrian">-</span></b></td>
			</tr>
			<tr>
				<td width="30%">Pos / Loket Antrian</td>
				<td><b><span id="loketAntrian">-</span></b></td>
			</tr>
			<tr>
				<td width="30%">Jenis Pasien</td>
				<td><span id="jnsPsn">-</span></td>
			</tr>
			<tr>
				<td>No.Rekam Medis</td>
				<td><span id="norm">-</span></td>
			</tr>
			<tr>
				<td>Nama Pasien</td>
				<td><span id="nama">-</span></td>
			</tr>
			<tr>
				<td>Tempat / Tgl.Lahir</td>
				<td><span id="tmpLhr"></span> / <span id="tglLhr">-</span></td>
			</tr>
			<tr>
				<td>Kontak Pasien</td>
				<td><span id="kontak">-</span></td>
			</tr>
			<tr>
				<td>Cara Bayar</td>
				<td><span id="crByrTemp">-</span></td>
			</tr>
			<tr>
				<td>Poliklinik Tujuan</td>
				<td><span id="poliTjuanTemp">-</span></td>
			</tr>
			<tr>
				<td>Tanggal Kunjungan</td>
				<td><span id="tglKunjungan">-</span></td>
			</tr>
			<tr>
				<td>Estimasi Jam Kunjungan</td>
				<td><span id="jamKunjungan">-</span></td>
			</tr>
		</table>
		<div class="col-md-12 ml-auto mb-3" style="text-align:center">
			<!--<button type="button" id="btnHome" class="btn btn-default" style="border-radius:1px;width:100px">Halaman Utama </button>-->
			<button type="button" id="btnDownload" class="btn btn-success" style="border-radius:1px;width:160px">Cetak & Download</button>
		</div>
	</form>

	
	
	
</div>
{% endblock %}
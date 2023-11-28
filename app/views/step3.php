{% extends 'template/layout.php' %}
{% block content %}
<ul class="my-5" id="progressbar" >
	<li class="active" id="liStep1">Identitas</li>
	<li class="active" id="liStep2">Tujuan</li>
	<li class="active" id="liStep3">Daftar</li>
</ul>

<div class="my-3 p-3 bg-white rounded box-shadow">
	<h6 class="border-bottom border-gray pb-2 mb-0">Data Pendaftaran</h6>
	
	<form id="formStep3" method="POST" class="mt-3">
		<input type="hidden" id="jenisReg" name="jenisReservasi" value="{{jenis}}">
		<input type="hidden" id="nikReg" name="nikReservasi" value="{{nikReg}}">
		<input type="hidden" id="normReg" name="normReservasi" value="{{norm}}">
		<input type="hidden" id="namaReg" name="namaReservasi" value="{{nama}}">
		<input type="hidden" id="tmptLahir" name="tmpLahirReservasi" value="{{tmptLahir}}">
		<input type="hidden" id="tglLahir" name="tglLahirReservasi" value="{{tglLahir}}">
		<input type="hidden" id="kontakReg" name="kontakReservasi" value="{{kontakReg}}">
		<input type="hidden" id="caraBayarReg" name="caraBayarReservasi" value="{{caraBayarReg}}">
		<input type="hidden" id="klinikTujuanReg" name="klinikTujuanReservasi" value="{{klinikTujuanReg}}">
		<input type="hidden" id="tglKunjungan" name="tanggalReservasi" value="{{tglKunjungan}}">
		<input type="hidden" id="nokartuPsn" name="nokartuPsn" value="{{nokartuPsn}}">
		<input type="hidden" id="noRujukanPsn" name="noRujukanPsn" value="{{noRujukanPsn}}">
		<input type="hidden" id="kdPoliBpjs" name="kdPoliBpjs" value="{{kdPoliBpjs}}">
		<input type="hidden" id="kdDokter" name="kdDokter" value="{{kdDokter}}">
		<input type="hidden" id="jamPraktek" name="jamPraktek" value="{{jamPraktek}}">
		<table class="table table-bordered">
			<tr>
				<td width="30%" style="padding:0.55rem">Jenis Pasien</td>
				<td style="padding:0.55rem">{{jenisPasienTmp}}</td>
			</tr>
			<tr>
				<td style="padding:0.55rem">No.Rekam Medis</td>
				<td style="padding:0.55rem">{{norm}}</td>
			</tr>
			<tr>
				<td style="padding:0.55rem">Nama Pasien</td>
				<td style="padding:0.55rem">{{nama}}</td>
			</tr>
			<tr>
				<td style="padding:0.55rem">NIK Pasien</td>
				<td style="padding:0.55rem">{{nikReg}}</td>
			</tr>
			<tr>
				<td style="padding:0.55rem">Tempat / Tgl.Lahir</td>
				<td style="padding:0.55rem">{{tmptLahir}} / {{tglLahir}}</td>
			</tr>
			<tr>
				<td style="padding:0.55rem">Kontak Pasien</td>
				<td style="padding:0.55rem">{{kontakReg}}</td>
			</tr>
			<tr>
				<td style="padding:0.55rem">Cara Bayar</td>
				<td style="padding:0.55rem"><span id="crByrTemp"></span></td>
			</tr>
			<tr>
				<td style="padding:0.55rem">No.Kartu</td>
				<td style="padding:0.55rem"><span id="noKartuTemp">{{nokartuPsn}}</span></td>
			</tr>
			<tr>
				<td style="padding:0.55rem">No.Rujukan</td>
				<td style="padding:0.55rem"><span id="noRujukanTemp">{{noRujukanPsn}}</span></td>
			</tr>
			<tr>
				<td style="padding:0.55rem">Dokter</td>
				<td style="padding:0.55rem"><span id="dokterTemp">{{nmDokter}}</span></td>
			</tr>
			<tr>
				<td style="padding:0.55rem">Poliklinik Tujuan</td>
				<td style="padding:0.55rem"><span id="poliTjuanTemp"></span></td>
			</tr>
			<tr>
				<td style="padding:0.55rem">Tanggal Kunjungan</td>
				<td style="padding:0.55rem">{{tglKunjungan}}  | Pukul :{{jamPraktek}}</td>
			</tr>
		</table>
		<div class="col-md-12 ml-auto mb-3" style="text-align:center">
			<div class="alert alert-warning" style="text-align:center">
				<p><i><b>Bagi Pasien yang sudah mengambil Antrian namun tidak datang diloket sampai 10 Nomor antrian selanjutnya, maka pasien harus mengambil ulang antrian</b> </i></p>
			</div>
		</div>
		<div class="col-md-12 ml-auto mb-3" style="text-align:center">
			<button type="button" id="btnBatal" class="btn btn-danger" style="border-radius:1px;width:100px">< Batal </button>
			<button type="submit" id="btnVerifikasi" class="btn btn-success" style="border-radius:1px;width:100px">Kirim ></button>
		</div>
	</form>

	
	
	
</div>
{% endblock %}
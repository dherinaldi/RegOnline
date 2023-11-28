{% extends 'template/layout.php' %}
{% block content %}
<ul class="my-5" id="progressbar" >
	<li class="active" id="liStep1">Identitas</li>
	<li class="active" id="liStep2">Tujuan</li>
	<li id="liStep3">Daftar</li>
</ul>

<div class="my-3 p-3 bg-white rounded box-shadow">
	<h6 class="border-bottom border-gray pb-2 mb-0">Tujuan Kunjungan</h6>
	<div class="alert alert-primary" role="alert">
		<table class="table table-hover">
			<tr>
				<td width="150px">Jenis Pasien</td>
				<td align="right" width="5px">:</td>
				<td>{{jenisTemp}} | BPJS / JKN</td>
				<td width="20px">&nbsp;</td>
				<td width="150px">NIK</td>
				<td align="right" width="5px">:</td>
				<td>{{nik}}</td>
			</tr>
			<tr>
				<td>No.Rekam Medis</td>
				<td align="right">:</td>
				<td>{{norm}}</td>
				<td>&nbsp;</td>
				<td>No.Kartu</td>
				<td align="right">:</td>
				<td>{{noKartu}}</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td align="right">:</td>
				<td>{{nama}}</td>
				<td>&nbsp;</td>
				<td>No.Rujukan</td>
				<td align="right">:</td>
				<td>{{noRujukan}}</td>
			</tr>
			<tr>
				<td>TTL</td>
				<td align="right">:</td>
				<td>{{tglLahir}}</td>
				<td>&nbsp;</td>
				<td>No.Telepon</td>
				<td align="right">:</td>
				<td>{{noTlp}}</td>
			</tr>
		</table>
	</div>
	<div class="alert alert-warning" role="alert" align="center" style="font-size:20px">
		<b>Poliklinik Rujukan / Tujuan : <label>{{poliRujukan}}</label> | <label>{{nmPoliRujukan}}</label></b>
	</div>
	<form id="formStep2Rujukan" method="POST" class="mt-3">
		<div class="input-group input-group-lg mb-3">
			<input type="hidden" id="jenisPasien" name="jenisReg" value="{{jenis}}"/>
			<input type="hidden" id="jenisPasienTmp" name="jenisPasienTmp" value="{{jenisTemp}}"/>
			<input type="hidden" id="noRm" name="normReg" value="{{norm}}"/>
			<input type="hidden" id="nama" name="namaReg" value="{{nama}}"/>
			<input type="hidden" id="tmptLahir" name="tmpLahirReg" value="{{tmptLahir}}"/>
			<input type="hidden" id="tglLahir" name="tglLahirReg" value="{{tglLahir}}"/>
			<input type="hidden" id="nikPsn" name="nikReg" value="{{nik}}"/>
			<input type="hidden" id="crByr" name="caraBayarReg" value="2"/>
			<input type="hidden" id="nikPsn" name="nikReg" value="{{nik}}"/>
			<input type="hidden" id="nokartuPsn" name="nokartuPsn" value="{{noKartu}}"/>
			<input type="hidden" id="noRujukanPsn" name="noRujukanPsn" value="{{noRujukan}}"/>
			<input type="hidden" id="unitTujuan" name="klinikTujuanReg" value="{{poliRujukan}}"/>
		</div>
		<div class="form-group">
			<label for="posTujuan">Kontak Pasien</label>
			<div class="input-group input-group-lg mb-3">
				<input type="text" class="form-control" placeholder="Kontak Pasien" id="kontakPsn" name="kontakReg" value="{{noTlp}}" style="font-size:15px" autofocus/>
			</div>
		</div>
		<div class="form-group datex">
			<label for="tglKunjungan">Tanggal Kunjungan</label>
			<input type="hidden" id="tglKunjungan"  name="tanggalReg">
		</div>
		<div class="form-group">
			<label for="posTujuan">Dokter</label>
			<div class="input-group input-group-lg mb-3">
				<select class="form-control" id="jadwalDokterTujuan" name="jadwalDokterTujuan" style="font-size:15px;margin-right:10px"></select>
			</div>
		</div>
		
		<div class="col-md-12 ml-auto mb-3" style="text-align:center">
			<button type="button" id="btnKembali" class="btn btn-danger" style="border-radius:1px;width:100px">< Kembali </button>
			<button type="button" id="btnVerifikasi" class="btn btn-success" style="border-radius:1px;width:100px">Lanjut ></button>
		</div>
	</form>

	
	
	
</div>
{% endblock %}
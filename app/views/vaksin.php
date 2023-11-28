{% extends 'template/layout.php' %}
{% block content %}
<ul class="my-5" id="progressbar" >
	<li class="active" id="liStep1">Identitas</li>
	<li class="active" id="liStep2">Tujuan</li>
	<li class="active" id="liStep3">Daftar</li>
</ul>

<div class="my-3 p-3 bg-white rounded box-shadow">
	<h6 class="border-bottom border-gray pb-2 mb-0">Registrasi Antrian Vaksin</h6>
	
	<form id="formVaksin" method="POST" class="mt-3">
		<div class="input-group input-group-lg mb-3">
			<input type="hidden" id="jenisPasien" name="jenisReg" value="2">
			<input type="hidden" id="posTujuan" name="posTujuan">
		</div>
		<div class="form-group ">
			<label for="tmptLahir">NIK</label>
			<input type="text" class="form-control" placeholder="NIK" id="nik" name="nik" value="" style="font-size:15px">
		</div>
		<div class="form-group ">
			<label for="tmptLahir">Nama</label>
			<input type="text" class="form-control" placeholder="Nama Pasien" id="nama" name="nama" style="font-size:15px">
		</div>
		<div class="form-group ">
			<label for="jk">Jenis Kelamin</label>
			<select class="form-control" id="jk" name="jk" style="font-size:15px;line-height:1.1">
				<option value="" selected>Pilih Jenis Kelamin</option>
				<option value="L">Laki - Laki</option>
				<option value="P">Perempuan</option>
			</select>
		</div>
		<div class="form-group ">
			<label for="tmptLahir">Tempat Lahir</label>
			<input type="text" class="form-control" placeholder="Tempat Lahir" id="tmptLahir" name="tmpLahirReg" value="{{tmptLahir}}" style="font-size:15px">
		</div>
		<div class="form-group datex">
			<label for="tglLahir">Tanggal Lahir</label>
			<input type="hidden" id="tglLahir"  name="tglLahir">
		</div>
		<div class="form-group">
			<label for="alamat">Alamat</label>
			<textarea name="alamat" id="alamat" placeholder="Masukkan Alamat" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label for="wilayah">Wilayah</label>
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<select class="form-control" id="provinsi" name="provinsi" style="font-size:15px;line-height:1.1">
						<option value="" selected>Provinsi</option>
					</select>
				</div>
				<div class="col-sm-6 col-md-3">
					<select class="form-control" id="kabupaten" name="kabupaten" style="font-size:15px;line-height:1.1">
						<option value="" selected>Kabupaten / Kota</option>
					</select>
				</div>
				<div class="col-sm-6 col-md-3">
					<select class="form-control" id="kecamatan" name="kecamatan" style="font-size:15px;line-height:1.1">
						<option value="" selected>Kecamatan</option>
					</select>
				</div>
				<div class="col-sm-6 col-md-3">
					<select class="form-control" id="kelurahan" name="kelurahan" style="font-size:15px;line-height:1.1">
						<option value="" selected>Kelurahan / Desa</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group ">
			<label for="tmptLahir">Kontak / Telp <b style="font-size:8px">(Nomor hp yang Diinput/Ditulis harus yg aktif untuk sms)</b></label>
			<input type="text" class="form-control" placeholder="Kontak Pasien" id="kontak" name="kontak" style="font-size:15px">
		</div>
		<div class="form-group ">
			<label for="pekerjaan">Pekerjaan</label>
			<select class="form-control" id="pekerjaan" name="pekerjaan" style="font-size:15px;line-height:1.1">
				<option value="" selected>Pilih Pekerjaan</option>
			</select>
		</div>
		<div class="form-group ">
			<label for="pekerjaan">Instansi Asal (Di isi Jika Ada)</label>
			<input type="text" class="form-control" placeholder="Instansi Asal" id="asal" name="asal" style="font-size:15px">
		</div>
		<div class="form-group ">
			<label for="carabayar">Cara Bayar / Penjamin</label>
			<select class="form-control" id="carabayar" name="carabayar" style="font-size:15px;line-height:1.1">
				<option value="" selected>Pilih Cara Bayar</option>
			</select>
		</div>
		<div class="form-group ">
			<label for="caraBayarReg">Poliklinik Tujuan</label>
			<select class="form-control" id="unitTujuan" name="unitTujuan" style="font-size:15px"></select>
		</div>
		<div class="form-group datex">
			<label for="tglKunjungan">Tanggal Kunjungan / Vaksin</label>
			<input type="hidden" id="tglKunjungan"  name="tglKunjungan">
		</div>
		<div class="form-group ">
			<label for="caraBayarReg">Vaksin Ke</label>
			<select class="form-control" id="vaksinKe" name="vaksinKe" style="font-size:15px"></select>
		</div>
		<div class="col-md-12 ml-auto mb-3" style="text-align:center">
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			  <i><strong>Catatan !!!</strong> Pastikan Nomor HP / Kontak yang Diinput/Ditulis harus yg aktif untuk sms</i>
			</div>
		</div>
		<div class="col-md-12 ml-auto mb-3" style="text-align:center">
			<button type="button" id="btnKembali" class="btn btn-danger" style="border-radius:1px;width:175px"> Batal </button>
			<button type="submit" id="btnVerifikasi" class="btn btn-success" style="border-radius:1px;width:175px">Simpan Dan Daftar </button>
		</div>
	</form>

	
	
	
</div>
{% endblock %}
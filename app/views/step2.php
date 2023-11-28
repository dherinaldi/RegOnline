{% extends 'template/layout.php' %}
{% block content %}

<div class="modal fade" id="modalListRujukan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">List Rujukan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col" rowspan="2">No</th>
					<th scope="col" colspan="2">Kunjungan</th>
					<th scope="col" colspan="2">Peserta</th>
					<th scope="col" colspan="2">Poli Rujukan</th>
					<th scope="col" colspan="2">Asal Rujukan</th>
					<th scope="col" rowspan="2">#</th>
				</tr>
				<tr>
					<td scope="col">Nomor</td>
					<td scope="col">Tanggal</td>
					<td scope="col">No.Kartu</td>
					<td scope="col">Nama</td>
					<td scope="col">Kode</td>
					<td scope="col">Nama</td>
					<td scope="col">Kode</td>
					<td scope="col">Nama</td>
				</tr>
			</thead>
			<tbody id="recordRujukan"></tbody>
			</table>
		</div>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalListKontrol" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">List Kontrol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th scope="col" rowspan="2">No</th>
					<th scope="col" colspan="2">Kunjungan</th>
					<th scope="col" colspan="2">Peserta</th>
					<th scope="col" colspan="2">Rencana Kontrol</th>
					<th scope="col" colspan="2">Nama Dokter</th>
					<th scope="col" rowspan="2">#</th>
				</tr>
				<tr>
					<td scope="col">Nomor</td>
					<td scope="col">Tanggal Terbit</td>
					<td scope="col">No.Kartu</td>
					<td scope="col">Nama</td>
					<td scope="col">Poli Tujuan</td>
					<td scope="col">Tgl. Kunjungan</td>
					<td scope="col">Kode</td>
					<td scope="col">Nama</td>
				</tr>
			</thead>
			<tbody id="recordKontrol"></tbody>
			</table>
		</div>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<ul class="my-5" id="progressbar" >
	<li class="active" id="liStep1">Identitas</li>
	<li class="active" id="liStep2">Tujuan</li>
	<li id="liStep3">Daftar</li>
</ul>

<div class="my-3 p-3 bg-white rounded box-shadow">
	<h6 class="border-bottom border-gray pb-2 mb-0">Tujuan Kunjungan</h6>
	
	<form id="formStep2" method="POST" class="mt-3">
		<div class="input-group input-group-lg mb-3">
			<input type="hidden" id="jenisPasien" name="jenisReg" value="{{jenis}}">
			<input type="text" class="form-control" placeholder="Jenis Pasien" id="jenisPasienTmp" name="jenisPasienTmp" value="{{jenisTemp}}" style="font-size:15px" readonly>
		</div>
		<div class="input-group input-group-lg mb-3">
			<input type="text" class="form-control" placeholder="No.Rekam Medis" id="noRm" name="normReg" value="{{norm}}" style="font-size:15px;margin-right:10px" readonly>
			<input type="text" class="form-control" placeholder="Nama Pasien" id="nama" name="namaReg" value="{{nama}}" style="font-size:15px" readonly>
		</div>
		<div class="input-group input-group-lg mb-3">
			<input type="text" class="form-control" placeholder="Tempat Lahir" id="tmptLahir" name="tmpLahirReg" value="{{tmptLahir}}" style="font-size:15px;margin-right:10px" readonly>
			<input type="text" class="form-control" placeholder="Tgl.Lahir (tgl-bln-thn)" value="{{tglLahir}}" id="tglLahir" name="tglLahirReg" style="font-size:15px" readonly>
		</div>
		<div class="input-group input-group-lg mb-3">
			
		</div>
		<div class="input-group input-group-lg mb-3">
			<input type="text" class="form-control" placeholder="NIK Pasien" id="nikPsn" name="nikReg"  value="{{nik}}" style="font-size:15px;margin-right:10px;" >
			<input type="text" class="form-control" placeholder="Kontak Pasien" id="kontakPsn"  name="kontakReg" value="{{noTlp}}" style="font-size:15px;">
		</div>
		<div class="input-group input-group-lg mb-3">
			<select class="form-control" id="crByr" name="caraBayarReg" style="font-size:15px;line-height:1.1">
				<option value="" selected>Pilih Cara Bayar</option>
			</select>
		</div>
		<div class="input-group input-group-lg mb-3">
			<input type="text" class="form-control" placeholder="No.Kartu JKN/BPJS" id="nokartuPsn" name="nokartuPsn" value="{{noKartu}}" style="font-size:15px;margin-right:10px" disabled="disabled">
			<input type="text" class="form-control" placeholder="No.Rujukan/Kontrol" id="noRujukanPsn" name="noRujukanPsn" style="font-size:15px" disabled="disabled">
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="button" id="btnCariRujukan">Cari Rujukan</button>
				<button class="btn btn-outline-secondary" type="button" id="btnCariKontrol">Cari Kontrol</button>
			</div>
		</div>
		<div class="form-group datex">
			<label for="tglKunjungan">Tanggal Kunjungan</label>
			<input type="hidden" id="tglKunjungan"  name="tanggalReg">
		</div>
		<div class="form-group">
			<label for="posTujuan">Poliklinik Tujuan</label>
			<div class="input-group input-group-lg mb-3">
				<select class="form-control" id="posTujuan" name="posTujuan" style="font-size:15px;margin-right:10px">
					<option value="" selected>Pilih Pos / Gedung Antrian</option>
				</select>
				<select class="form-control" id="unitTujuan" name="klinikTujuanReg" style="font-size:15px"></select>
			</div>
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
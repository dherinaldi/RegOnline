{% extends 'template/layout.php' %}
{% block content %}
<input type="hidden" value="{{tglNow}}" id="tglNow">

<div class="row">
	<div class="col-12" style="padding-left:0px">
		<div class="alert alert-info alert-dismissible fade show" role="alert" style="text-align:center">
			<strong>Antrian Berjalan Tanggal : {{tglNowF}}</strong><i class="bi bi-arrow-down-square-fill"></i>
		</div>
	</div>
    <div class="col" style="padding-left:0px">
		<div class="card">
			<div class="card-footer" style="background:#17a2b8">
				<h5 class="card-title" style="text-align:center">ANTRIAN PENDAFTARAN</h5>
				<h5 class="card-title" style="text-align:center;color:#FFF;font-weight:bold">RAWAT JALAN</h5>
			</div>
		</div>
    </div>
	
	
	
  </div>

<ul class="my-5" id="progressbar" >
	<li class="active" id="liStep1">Identitas</li>
	<li id="liStep2">Tujuan</li>
	<li id="liStep3">Daftar</li>
</ul>
<div class="btn-group btn-group-toggle" data-toggle="buttons" style="width:100%">
	<label class="btn btn-secondary btn-lg btnJenisPsn active" style="width:50%">
		<input type="radio" name="jenisPasien" id="option1" value="L" autocomplete="off" checked> Pasien Lama
	</label>
	<label class="btn btn-secondary btn-lg btnJenisPsn" style="width:50%">
		<input type="radio" name="jenisPasien" id="option2" value="B" autocomplete="off"> Pasien Baru
	</label>
</div>

<div class="my-3 p-3 bg-white rounded box-shadow">
	<h6 class="border-bottom border-gray pb-2 mb-0">Identitas Pasien</h6>
	<div id="form-konten"></div>
</div>

{% endblock %}
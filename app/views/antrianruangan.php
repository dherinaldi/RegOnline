{% extends 'template/layout.php' %}
{% block content %}
<input type="hidden" value="{{tglNow}}" id="tglNow">
<input type="hidden" value="{{posAntrian}}" id="posAntrian">
<div class="row">
	<div class="col-12" style="padding-left:0px">
		<div class="alert alert-info alert-dismissible fade show" role="alert" style="text-align:center">
			<strong>Informasi Antrian Ruangan / Poli Tanggal {{tglNowF}}</strong><i class="bi bi-arrow-down-square-fill"></i>
			<p style="margin-bottom:0px"><strong>Pos Antrian :&nbsp; {{nmPosAntrian}}</strong></p>
		</div>
	</div>	
</div>
<div class="row" id="recordData"></div>
{% endblock %}
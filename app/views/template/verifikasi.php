<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

    <!-- START @HEAD -->
    <head>
        <!-- START @META SECTION -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Rekrutmen Calon Pegawai RSUP Dr.Wahidin Sudirohusodo">
        <meta name="keywords" content="Rekrutmen Calon Pegawai RSUP Dr.Wahidin Sudirohusodo,Rekruitmen RSWS, RSWS, Wahidin">
        <meta name="author" content="Djava UI">
        <title>{{ title }} | Rekrutmen RSUP Dr.Wahidin Sudirohusodo</title>
        <link href="{{ base_url() }}/public/global/plugins/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        
		<link href="{{ base_url() }}/public/global/plugins/bower_components/fontawesome/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="{{ base_url() }}/public/global/plugins/bower_components/simple-line-icons/css/simple-line-icons.css" rel="stylesheet"/>
        <link href="{{ base_url() }}/public/global/plugins/bower_components/spinkit/css/spinners/7-three-bounce.css" rel="stylesheet">
        <link href="{{ base_url() }}/public/global/plugins/bower_components/jquery-snippet/jquery.snippet-customize.min.css" rel="stylesheet"/>
		<link href="{{ base_url() }}/public/global/plugins/bower_components/jasny-bootstrap-fileinput/css/jasny-bootstrap-fileinput.min.css" rel="stylesheet">
        <link href="{{ base_url() }}/public/global/plugins/bower_components/select2/dist/css/select2.min.css" rel="stylesheet"/>
		<link href="{{ base_url() }}/public/global/plugins/bower_components/chosen_v1.2.0/chosen.min.css" rel="stylesheet">
		<link href="{{ base_url() }}/public/global/plugins/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="{{ base_url() }}/public/global/plugins/bower_components/datatables/media/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
        <link href="{{ base_url() }}/public/global/plugins/bower_components/datatables-responsive-helper/files/1.10/css/datatables.responsive.css" rel="stylesheet"/>
        <link href="{{ base_url() }}/loader/dialog-mobile.css" rel="stylesheet">
		<link href="{{ base_url() }}/public/documentation//css/layout.css" rel="stylesheet">
		<link href="{{ base_url() }}/public/documentation//css/reset.css" rel="stylesheet"/>
        <link href="{{ base_url() }}/public/documentation//css/section.css" rel="stylesheet"/>
        <link href="{{ base_url() }}/public/documentation//css/components.css" rel="stylesheet"/>
        <link href="{{ base_url() }}/public/documentation//css/plugin.css" rel="stylesheet"/>
        <link href="{{ base_url() }}/public/documentation//css/themes/theme-html.css" rel="stylesheet"/>
		<link href="{{ base_url() }}/public/documentation//css/custom.css" rel="stylesheet">
		<link href="{{ base_url() }}/public/menus.css" rel="stylesheet">
	</head>
    <body class="page-sidebar-minimize">
		<nav class="navbar navbar-default navbar-fixed-top" id="gradientHeader">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" id="tombolMenu" style="background:transparent;padding:0px;border:0px;width:70px;margin:0px;padding-top:12px;padding-bottom:7px;border-right:1px #CCC solid">
						<i class="fa fa-bars fa-2x"></i>
					</button>
					<a href="{{ base_url() }}" class="navbar-brand" style="color:#FFF">RSUP Dr.Wahidin Sudirohusodo</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="{{ base_url() }}/"><b><span>Home</span></b></a></li>
						<li><a href="{{ base_url() }}/login/"><b><span> Login</span></b></a></li>
					</ul>
				</div>
			</div>
		</nav>
        <div class="container" id="konten-view" style="margin-top:55px;margin-bottom:55px">
			
			{% block content %}{% endblock %}
			
        </div>
        <!--/ END WRAPPER -->
		<nav class="navbar-fixed-bottom" id="gradientFooter">
			<footer class="footer-content" style="color:#DDD">
				2019 © Rekruitmen RSUP Dr.Wahidin Sudirohusodo, Makassar
			</footer>
		</nav>
		
		<div id="menus-left" class="sidebar-circle menus-left">

			<ul class="sidebar-menu">
				<li class="sidebar-category" style="border-bottom:0.1px #DDD solid;padding-top:5px;padding-bottom:5px">
					<span>Menu Navigasi</span>
					<span class="pull-right"><i class="fa fa-list"></i></span>
				</li>
				<li class="{{ menuDashboard }}" style="border-bottom:0.1px #DDD solid;padding-top:5px;padding-bottom:5px">
					<a href="{{ base_url() }}/">
						<span class="icon"><i class="fa fa-home"></i></span>
						<span class="text">Home</span>
						<span class="{{selectDashboard}}"></span>
					</a>
				</li>
				<li class="{{ menuLogin }}" style="border-bottom:0.1px #DDD solid;padding-top:5px;padding-bottom:5px">
					<a href="{{ base_url() }}/login/">
						<span class="icon"><i class="fa fa-registered"></i></span>
						<span class="text">Login</span>
						<span class="{{selectLogin}}"></span>
					</a>
				</li>
			</ul>

		</div>
        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- START @CORE PLUGINS -->
        <script src="{{ base_url() }}/public/global/plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="{{ base_url() }}/public/global/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="{{ base_url() }}/public/global/plugins/bower_components/retina.js/dist/retina.min.js"></script>
        <!--/ END CORE PLUGINS -->

        <!-- START @PAGE LEVEL PLUGINS -->
		<script src="{{ base_url() }}/public/global/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
		<script src="{{ base_url() }}/public/global/plugins/bower_components/jasny-bootstrap-fileinput/js/jasny-bootstrap.fileinput.min.js"></script>
        <script src="{{ base_url() }}/public/global/plugins/bower_components/jquery-smooth-scroll/jquery.smooth-scroll.min.js"></script>
        <script src="{{ base_url() }}/public/global/plugins/bower_components/jquery-snippet/jquery.snippet.min.js"></script>
        <script src="{{ base_url() }}/public/global/plugins/bower_components/select2/dist/js/select2.min.js"></script>
        <script src="{{ base_url() }}/public/global/plugins/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="{{ base_url() }}/public/global/plugins/bower_components/datatables/media/js/dataTables.bootstrap.min.js"></script>
        <script src="{{ base_url() }}/public/global/plugins/bower_components/datatables-responsive-helper/files/1.10/js/datatables.responsive.js"></script>
        <script src="{{ base_url() }}/public/global/plugins/bower_components/bootbox.js/bootbox.js"></script>
		<script src="{{ base_url() }}/public/global/plugins/bower_components/chosen_v1.2.0/chosen.jquery.min.js"></script>
		<script src="{{ base_url() }}/public/global/plugins/bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
        <!--/ END PAGE LEVEL PLUGINS -->

        <!-- START @PAGE LEVEL SCRIPTS -->
        <script src="{{ base_url() }}/public/documentation/js/blankon.documentation.html.js"></script>
		<script src="{{ base_url() }}/loader/mcx-dialog.js"></script>
        <script src="{{ base_url() }}/app/controller/config.js"></script>
        
		<script>
			var colors = new Array(
					  [62,35,255],
					  [60,255,60],
					  [45,175,230],
					  [24,111,139],
					  [45,175,230]
					);

			var step = 0;
			var colorIndices = [0,1,2,3];
			var gradientSpeed = 0.002;

			function updateGradient(){
			  
			  if ( $===undefined ) return;
			  
				var c0_0 = colors[colorIndices[0]];
				var c0_1 = colors[colorIndices[1]];
				var c1_0 = colors[colorIndices[2]];
				var c1_1 = colors[colorIndices[3]];

				var istep = 1 - step;
				var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
				var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
				var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
				var color1 = "rgb("+r1+","+g1+","+b1+")";

				var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
				var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
				var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
				var color2 = "rgb("+r2+","+g2+","+b2+")";

			 $('#gradientHeader').css({
			   background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
				background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});
			  
			  step += gradientSpeed;
			  if ( step >= 1 ){
				step %= 1;
				colorIndices[0] = colorIndices[1];
				colorIndices[2] = colorIndices[3];
				colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
				colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
			  }
			  
			  $('#gradientFooter').css({
			   background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
				background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});
			  
			  step += gradientSpeed;
			  if ( step >= 1 )
			  {
				step %= 1;
				colorIndices[0] = colorIndices[1];
				colorIndices[2] = colorIndices[3];
				colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
				colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
				
			  }
			}

			setInterval(updateGradient,10);
					
			
			$(document).ready(function() {
				$('.navbar-toggle').on('click',function(){
				var el = document.getElementById('menus-left');
					var x = document.getElementById("menus-left");
					var y = document.getElementById("konten-view");
					var tombolMenu = document.getElementById("tombolMenu");
					$(this).find('i').remove();
					if (x.style.display === "block") {
						x.style.display = "none";
						y.style.display = "block";
						$(this).html($('<i/>',{class:'fa fa-bars fa-2x'}));
					} else {
						x.style.display = "block";
						y.style.display = "none";
						$(this).html($('<i/>',{class:'fa fa-angle-double-left fa-2x'}));
					}
				});
			});
			
			
			var ONextLoader = function () {
				return {
					init: function () {
						ONextLoader.onDialogProses('Loading ...');
					},
					onDialogProses : function(message) {
						mcxDialog.loading({
							src: "../loader",
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

<header id="header">
	<div class="header-left">
		<div class="navbar-minimize-mobile left" style="border-right:1px #FFF solid">
			<i class="fa fa-bars"></i>
		</div>
		<div class="navbar-header">
			<a class="navbar-brand" href="dashboard.html">
				<img class="logo" src="iconHeader.png" alt="brand logo"/>
			</a>
		</div>
		<div class="navbar-minimize-mobile right" style="border-left:1px #FFF solid">
			<i class="fa fa-sign-out"></i>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="header-right">
		<div class="navbar navbar-toolbar">
			<ul class="nav navbar-nav navbar-left">
				<li class="navbar-minimize">
					<a href="javascript:void(0);" title="Minimize sidebar">
						<i class="fa fa-bars"></i>
					</a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<li class="dropdown navbar-profile">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<span class="meta">
						<span class="text hidden-xs hidden-sm text-muted">{{userName}}</span>
						<span class="caret"></span>
					</span>
				</a>
				<ul class="dropdown-menu animated flipInX">
					<li><a href="?v=profilku"><i class="fa fa-user"></i>View profile</a></li>
					<li class="dropdown-header">Account</li>
					<li><a href="?v=ganti-password"><i class="fa fa-refresh"></i>Ubah Password</a></li>
				</ul>
			</li>
			<li class="navbar-setting pull-right">
				<a href="javascript:void(0);"><i class="fa fa-sign-out"></i></a>
			</li>
			</ul>
		</div>
	</div>
</header>
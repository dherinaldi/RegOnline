<aside id="sidebar-left" class="sidebar-circle">
	<ul class="sidebar-menu">
		<li class="sidebar-category">
			<span>{{userLevelName}}</span>
			<span class="pull-right"><i class="fa fa-sitemap"></i></span>
		</li>
		{% if userLevel == '1' %}
			{% include 'template/nav-admin.php' %}
		{% endif %}
		{% if userLevel == '2' %}
			{% include 'template/nav-operator.php' %}
		{% endif %}
		{% if userLevel == '3' %}
			{% include 'template/nav-prodi.php' %}
		{% endif %}
		{% if userLevel == '4' %}
			{% include 'template/nav-dosen.php' %}
		{% endif %}
		{% if userLevel == '5' %}
			{% include 'template/nav-mhs.php' %}
		{% endif %}
	</ul>
</aside>
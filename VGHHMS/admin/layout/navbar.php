<header class="navbar">
	<div class="container-fluid">
		<button class="navbar-toggler mobile-toggler hidden-lg-up" type="button" style="color: rgba(0, 0, 0, 0.3)">☰</button>
		<a class="navbar-brand" href="#"></a>
		<ul class="nav navbar-nav hidden-md-down">
			<li class="nav-item">
				<a class="nav-link navbar-toggler layout-toggler" href="#"><? echo $_env['site_title']; ?> 後台管理系統</a>
			</li>
		</ul>
		<ul class="nav navbar-nav pull-right hidden-md-down">
			<li class="nav-item">
				<a class="nav-link navbar-toggler" href="<? echo $_env['site_url'], ($_pageenv['site_url']==''?'':$_pageenv['site_url'].'.php'.($_pageenv['site_url_querystr']==''?'':'?'.$_pageenv['site_url_querystr'])); ?>" target="_blank"><? echo $_env["site_title"]; ?> 網站前台</a>
			</li>
			<li class="nav-item"></li>
			<li class="nav-item"></li>
		</ul>
	</div>
</header>
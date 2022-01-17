<div class="sidebar">
	<nav class="sidebar-nav">
		<ul class="nav">
			<?/*
			<li class="nav-title">
				類別1
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.html"><i class="icon-speedometer"></i> 功能1-1 </a>
				<a class="nav-link" href="index.html"><i class="icon-speedometer"></i> 功能1-2 </a>
			</li>
			<li class="divider"></li>
			<li class="nav-title">
				類別2
			</li>
			<li class="nav-item nav-dropdown">
				<a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i> 類別2-1</a>
				<ul class="nav-dropdown-items">
					<li class="nav-item">
						<a class="nav-link" href="components-buttons.html"><i class="icon-puzzle"></i> 功能2-1-1</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="components-social-buttons.html"><i class="icon-puzzle"></i> 功能2-1-2</a>
					</li>
				</ul>
			</li>
			<li class="nav-item nav-dropdown">
				<a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> 類別2-2</a>
				<ul class="nav-dropdown-items">
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="icon-star"></i> 功能2-2-1</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="icon-star"></i> 功能2-2-2</a>
					</li>
				</ul>
			</li>
			*/?>

			<?
				// 產生左側選單
				$i = 0;
				$_max = count($_sidebar);
				while($i<$_max){
					$row = $_sidebar[$i];
					if($row['c_code']==''){
						echo '<li class="nav-item">';
						echo '<a class="nav-link', ($_pageenv['fn_code']==$row['fn_code']?' active':''), '" href="', $_env['site_admin_url'], $row['fn_code'], '/index.php"><i class="fa ', $row['fn_icon'], ' fa-lg"></i> ', $row['fn_name'], ' </a>';
						echo '</li>';
						$_now_code = $row['fn_code'];
					} else {

						echo '<li class="nav-item nav-dropdown', ($_pageenv['fn_code']==$row['fn_code']?' open':''), '">';
						echo '<a class="nav-link nav-dropdown-toggle" href="#"><i class="fa ', $row['fn_icon'], ' fa-lg"></i> ', $row['fn_name'], '</a>';
						echo '<ul class="nav-dropdown-items">';

						echo '<li class="nav-item">';
						echo '<a class="nav-link', ($_pageenv['fn_c_code']==$row['c_code']?' active':''), '" href="', $_env['site_admin_url'], $row['c_code'], '/index.php"><i class="fa"></i> ', $row['c_name'], '</a>';
						echo '</li>';

						while($_sidebar[$i+1]['fn_code']==$row['fn_code']&&$_sidebar[$i+1]['c_code']!=''){
							$i++;
							$row = $_sidebar[$i];
							echo '<li class="nav-item">';
							echo '<a class="nav-link', ($_pageenv['fn_c_code']==$row['c_code']?' active':''), '" href="', $_env['site_admin_url'], $row['c_code'], '/index.php"><i class="fa"></i> ', $row['c_name'], '</a>';
							echo '</li>';
						}

						echo '</ul>';
						echo '</li>';
						
					}
					$i++;
				}
				unset($i);
				unset($_max);
				unset($_sidebar);
				unset($row);
			?>

			<li class="nav-item">
				<a class="nav-link" href="<? echo $_env['site_admin_url'] ?>logout.php"><i class="fa fa-lg"></i> 登出 </a>
			</li>
			
		</ul>
	</nav>
</div>
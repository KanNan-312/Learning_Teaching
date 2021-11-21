<!-- Vertical bar -->
<nav class="navbar navbar2 navbar-dark flex-column flex-shrink-0 p-3" style="color: white">
	<div class="container-fluid" >
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=home"><i class="fa fa-home" style="margin-right: 10px;"></i>Home</a>
			</li>
			<?php 
				if($_SESSION["role"] == "student") { ?>
					<li class="nav-item">
						<a class="nav-link" href="index.php?page=register"><i class="fa fa-book" style="margin-right: 10px;"></i>Register</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php?page=course"><i class="fa fa-list" style="margin-right: 10px;"></i>Courses</a>
					</li>
				<?php } else if ($_SESSION["role"] == "teacher"){ ?>
					<li class="nav-item">
						<a class="nav-link" href="index.php?page=course"><i class="fa fa-list" style="margin-right: 10px;"></i>Courses</a>
					</li>
				<?php } else if ($_SESSION["role"] == "department"){ ?>
				<?php } else if ($_SESSION["role"] == "office"){ ?>
					<li class="nav-item">
						<a class="nav-link" href="index.php?page=office_department"><i class="fa fa-list" style="margin-right: 10px;"></i>Departments</a>
					</li>
				<?php } ?>
		</ul>
	</div>
</nav>

<!-- Horizontal bar -->
<nav class="navbar navbar-expand-sm navbar-dark">
	<div class="container-fluid">
		<ul class="navbar-nav ms-auto">
			<li class="nav-item">
				<p class="nav-link">Hello <?php echo $_SESSION["user_real_name"] ?></p>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=logout"><i class="fa fa-sign-out" style="margin-right: 10px;"></i>Log out</a>
			</li>
			
		</ul>
	</div>
</nav>
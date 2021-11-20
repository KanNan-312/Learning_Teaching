<nav class="navbar navbar-dark flex-column flex-shrink-0 p-3" >
	<div class="container-fluid" >
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=home">Home</a>
			</li>
			<?php if($_SESSION["role"] == "student") {?>
				<li class="nav-item">
					<a class="nav-link" href="index.php?page=course">Courses</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?page=register">Register</a>
				</li>
			<?php } else { ?>
				<li class="nav-item">
					<a class="nav-link" href="index.php?page=class">Manage Classes</a>
				</li>
			<?php } ?>
			<li class="nav-item">
				<a class="nav-link" href="index.php?page=logout">Log out</a>
			</li>
		</ul>
	</div>
</nav>
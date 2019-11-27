<!-- partial -->
<div class="container-fluid page-body-wrapper">
	<!-- partial:partials/_sidebar.html -->
	<nav class="sidebar sidebar-offcanvas" id="sidebar">
		<ul class="nav">
			<li class="nav-item nav-profile">
				<a href="#" class="nav-link">
					<div class="nav-profile-image">
						<img src="<?php echo base_url('public/assets/images/faces/face1.jpg') ?>" alt="profile">
						<span class="login-status online"></span>
						<!--change to offline or busy as needed-->
					</div>
					<div class="nav-profile-text d-flex flex-column">
						<span class="font-weight-bold mb-2">David Grey. H</span>
						<span class="text-secondary text-small">Project Manager</span>
					</div>
					<i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url(); ?>">
					<span class="menu-title">Dashboard</span>
					<i class="mdi mdi-home menu-icon"></i>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
					<span class="menu-title">Lists</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="ui-basic">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"> <a class="nav-link" href="<?php echo base_url('view_companies')?>">View All Companies</a></li>
						<li class="nav-item"> <a class="nav-link" href="<?php echo base_url('view_persons')?>">View All Persons</a></li>
						<li class="nav-item"> <a class="nav-link" href="<?php echo base_url('view_addresses')?>">View All Addresses</a></li>
					</ul>
				</div>
			</li>
			<li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom"></div>
                <a href="<?php echo base_url('add'); ?>" class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add</a>
              </span>
			</li>
		</ul>
	</nav>
	<!-- partial -->
	<div class="main-panel">
		<div class="content-wrapper">

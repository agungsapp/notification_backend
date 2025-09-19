</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>{{ $title ?? 'Admin' }}</title>
		<!-- plugins:css -->
		<link rel="stylesheet" href="{{ asset('sky') }}/vendors/feather/feather.css">
		<link rel="stylesheet" href="{{ asset('sky') }}/vendors/ti-icons/css/themify-icons.css">
		<link rel="stylesheet" href="{{ asset('sky') }}/vendors/css/vendor.bundle.base.css">
		<link rel="stylesheet" href="{{ asset('sky') }}/vendors/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ asset('sky') }}/vendors/mdi/css/materialdesignicons.min.css">
		<!-- endinject -->
		<!-- Plugin css for this page -->
		<!-- End plugin css for this page -->
		<!-- inject:css -->
		<link rel="stylesheet" href="{{ asset('sky') }}/css/style.css">
		<!-- endinject -->
		<link rel="shortcut icon" href="{{ asset('sky') }}/images/favicon.png" />
</head>

<body>
		<div class="container-scroller">
				<!-- partial:../../partials/_navbar.html -->
				<nav class="navbar col-lg-12 col-12 fixed-top d-flex flex-row p-0">
						<div class="navbar-brand-wrapper d-flex align-items-center justify-content-start text-center">
								<a class="navbar-brand brand-logo me-5" href="../../index.html"><img src="{{ asset('sky') }}/images/logo.svg"
												class="me-2" alt="logo" /></a>
								<a class="navbar-brand brand-logo-mini" href="../../index.html"><img
												src="{{ asset('sky') }}/images/logo-mini.svg" alt="logo" /></a>
						</div>
						<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
								<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
										<span class="icon-menu"></span>
								</button>
								<ul class="navbar-nav mr-lg-2">
										<li class="nav-item nav-search d-none d-lg-block">
												<div class="input-group">
														<div class="input-group-prepend hover-cursor" id="navbar-search-icon">
																<span class="input-group-text" id="search">
																		<i class="icon-search"></i>
																</span>
														</div>
														<input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
																aria-label="search" aria-describedby="search">
												</div>
										</li>
								</ul>
								<ul class="navbar-nav navbar-nav-right">
										<li class="nav-item dropdown">
												<a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
														data-bs-toggle="dropdown">
														<i class="icon-bell mx-0"></i>
														<span class="count"></span>
												</a>
												<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
														aria-labelledby="notificationDropdown">
														<p class="font-weight-normal dropdown-header float-left mb-0">Notifications</p>
														<a class="dropdown-item preview-item">
																<div class="preview-thumbnail">
																		<div class="preview-icon bg-success">
																				<i class="ti-info-alt mx-0"></i>
																		</div>
																</div>
																<div class="preview-item-content">
																		<h6 class="preview-subject font-weight-normal">Application Error</h6>
																		<p class="font-weight-light small-text text-muted mb-0"> Just now </p>
																</div>
														</a>
														<a class="dropdown-item preview-item">
																<div class="preview-thumbnail">
																		<div class="preview-icon bg-warning">
																				<i class="ti-settings mx-0"></i>
																		</div>
																</div>
																<div class="preview-item-content">
																		<h6 class="preview-subject font-weight-normal">Settings</h6>
																		<p class="font-weight-light small-text text-muted mb-0"> Private message </p>
																</div>
														</a>
														<a class="dropdown-item preview-item">
																<div class="preview-thumbnail">
																		<div class="preview-icon bg-info">
																				<i class="ti-user mx-0"></i>
																		</div>
																</div>
																<div class="preview-item-content">
																		<h6 class="preview-subject font-weight-normal">New user registration</h6>
																		<p class="font-weight-light small-text text-muted mb-0"> 2 days ago </p>
																</div>
														</a>
												</div>
										</li>
										<li class="nav-item nav-profile dropdown">
												<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
														<img src="{{ asset('sky') }}/images/faces/face28.jpg" alt="profile" />
												</a>
												<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
														<a class="dropdown-item">
																<i class="ti-settings text-primary"></i> Settings </a>
														<a class="dropdown-item">
																<i class="ti-power-off text-primary"></i> Logout </a>
												</div>
										</li>
										<li class="nav-item nav-settings d-none d-lg-flex">
												<a class="nav-link" href="#">
														<i class="icon-ellipsis"></i>
												</a>
										</li>
								</ul>
								<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
										data-toggle="offcanvas">
										<span class="icon-menu"></span>
								</button>
						</div>
				</nav>
				<!-- partial -->
				<div class="container-fluid page-body-wrapper">
						<!-- partial:../../partials/_sidebar.html -->
						@include('components.layouts.partials.sidebar')
						<!-- partial -->
						<div class="main-panel">
								{{-- <div class="content-wrapper">
                                </div> --}}
								{{ $slot }}
								<!-- content-wrapper ends -->
								<!-- partial:../../partials/_footer.html -->
								<footer class="footer">
										<div class="d-sm-flex justify-content-center justify-content-sm-between">
												<span class="text-muted text-sm-left d-block d-sm-inline-block text-center">Copyright © 2023. Premium <a
																href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.
														All rights reserved.</span>
												<span class="float-sm-right d-block mt-sm-0 float-none mt-1 text-center">Hand-crafted & made with <i
																class="ti-heart text-danger ms-1"></i></span>
										</div>
								</footer>
								<!-- partial -->
						</div>
						<!-- main-panel ends -->
				</div>
				<!-- page-body-wrapper ends -->
		</div>
		<!-- container-scroller -->
		<!-- plugins:js -->
		<script src="{{ asset('sky') }}/vendors/js/vendor.bundle.base.js"></script>
		<!-- endinject -->
		<!-- Plugin js for this page -->
		<!-- End plugin js for this page -->
		<!-- inject:js -->
		<script src="{{ asset('sky') }}/js/off-canvas.js"></script>
		<script src="{{ asset('sky') }}/js/template.js"></script>
		<script src="{{ asset('sky') }}/js/settings.js"></script>
		<script src="{{ asset('sky') }}/js/todolist.js"></script>
		<!-- endinject -->
		<!-- Custom js for this page-->
		<!-- End custom js for this page-->
</body>

</html>

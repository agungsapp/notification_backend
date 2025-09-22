<!DOCTYPE html>
<html lang="en">

<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Skydash Admin</title>
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
		{{ $slot }} </div>
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
</body>

</html>

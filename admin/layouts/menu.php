<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Blank Page - Ninja Admin Template</title>

	<!-- Main Styles -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/nprogress.css">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<link rel="stylesheet" href="assets/css/style.min.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="assets/css/waves.min.css">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="assets/css/sweetalert.css">
	
	<!-- Color Picker -->
	<!-- <link rel="stylesheet" href="assets/color-switcher/color-switcher.min.css"> -->
</head>

<body>
<div class="main-menu">
	<header class="header">
		<a href="index.html" class="logo">NinjaTeam</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<a href="#" class="avatar"><img src="assets/img/avatar.png" alt=""><span class="status online"></span></a>
			<h5 class="name"><a href="profile.html">Emily Stanley</a></h5>
			<h5 class="position">Administrator</h5>
			<!-- /.name -->
			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
					<div class="control-item"><a href="profile.html"><i class="fa fa-user"></i> Profile</a></div>
					<div class="control-item"><a href="#"><i class="fa fa-gear"></i> Settings</a></div>
					<div class="control-item"><a href="#"><i class="fa fa-sign-out"></i> Log out</a></div>
				</div>
				<!-- /.control-list -->
			</div>
			<!-- /.control-wrap -->
		</div>
		<!-- /.user -->
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
			<h5 class="title">Navigation</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li>
					<a class="waves-effect" href="index.html"><i class="menu-icon fa fa-home"></i><span>Dashboard</span></a>
				</li>
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-flag"></i><span>Icons</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="icons-font-awesome-icons.html">Font Awesome</a></li>
						<li><a href="icons-fontello.html">Fontello</a></li>
						<li><a href="icons-material-icons.html">Material Design Icons</a></li>
						<li><a href="icons-material-design-iconic.html">Material Design Iconic Font</a></li>
						<li><a href="icons-themify-icons.html">Themify Icons</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-adjust"></i><span>User Interface</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="ui-buttons.html">Buttons</a></li>
						<li><a href="ui-cards.html">Cards</a></li>
						<li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
						<li><a href="ui-components.html">Components</a></li>
						<li><a href="ui-draggable-cards.html">Draggable Cards</a></li>
						<li><a href="ui-modals.html">Modals</a></li>
						<li><a href="ui-notification.html">Notification</a></li>
						<li><a href="ui-range-slider.html">Range Slider</a></li>
						<li><a href="ui-sweetalert.html">Sweet Alert</a></li>
						<li><a href="ui-treeview.html">Tree view</a></li>
						<li><a href="ui-typography.html">Typography</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				<li>
					<a class="waves-effect" href="widgets.html"><i class="menu-icon fa fa-code"></i><span>Widgets</span><span class="notice notice-yellow">6</span></a>
				</li>
			</ul>
			<!-- /.menu js__accordion -->
			<h5 class="title">Components</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-bar-chart"></i><span>Charts</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="chart-3d.html">3D Charts</a></li>
						<li><a href="chart-chartist.html">Chartist Charts</a></li>
						<li><a href="chart-chartjs.html">Chartjs Chart</a></li>
						<li><a href="chart-dynamic.html">Dynamic Chart</a></li>
						<li><a href="chart-flot.html">Flot Chart</a></li>
						<li><a href="chart-knob.html">Knob Chart</a></li>
						<li><a href="chart-morris.html">Morris Chart</a></li>
						<li><a href="chart-sparkline.html">Sparkline Chart</a></li>
						<li><a href="chart-other.html">Other Chart</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				<li>
					<a class="waves-effect" href="calendar.html"><i class="menu-icon fa fa-calendar"></i><span>Calendar</span></a>
				</li>
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-th-large"></i><span>Forms</span><span class="notice notice-blue">7</span></a>
					<ul class="sub-menu js__content">
						<li><a href="form-elements.html">General Elements</a></li>
						<li><a href="form-advanced.html">Advanced Form</a></li>
						<li><a href="form-fileupload.html">Form Uploads</a></li>
						<li><a href="form-validation.html">Form Validation</a></li>
						<li><a href="form-wizard.html">Form Wizard</a></li>
						<li><a href="form-wysiwig.html">Wysiwig Editors</a></li>
						<li><a href="form-xeditable.html">X-editable</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-table"></i><span>Tables</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="tables-basic.html">Basic Tables</a></li>
						<li><a href="tables-datatable.html">Data Tables</a></li>
						<li><a href="tables-responsive.html">Responsive Tables</a></li>
						<li><a href="tables-editable.html">Editable Tables</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
			</ul>
			<!-- /.menu js__accordion -->
			<h5 class="title">Additions</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li>
					<a class="waves-effect" href="profile.html"><i class="menu-icon fa fa-user"></i><span>Profile</span></a>
				</li>
				<li>
					<a class="waves-effect" href="inbox.html"><i class="menu-icon fa fa-envelope"></i><span>Mail</span><span class="notice notice-danger">New</span></a>
				</li>
				<li class="current active">
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-file-text"></i><span>Page</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li class="current"><a href="page-starter.html">Starter Page</a></li>
						<li><a href="page-login.html">Login</a></li>
						<li><a href="page-register.html">Register</a></li>
						<li><a href="page-recoverpw.html">Recover Password</a></li>
						<li><a href="page-lock-screen.html">Lock Screen</a></li>
						<li><a href="page-confirm-mail.html">Confirm Mail</a></li>
						<li><a href="page-404.html">Error 404</a></li>
						<li><a href="page-500.html">Error 500</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-folder-open"></i><span>Extra Pages</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="extras-contact.html">Contact list</a></li>
						<li><a href="extras-email-template.html">Email template</a></li>
						<li><a href="extras-faq.html">FAQ</a></li>
						<li><a href="extras-gallery.html">Gallery</a></li>
						<li><a href="extras-invoice.html">Invoice</a></li>
						<li><a href="extras-maps.html">Maps</a></li>
						<li><a href="extras-pricing.html">Pricing</a></li>
						<li><a href="extras-projects.html">Projects</a></li>
						<li><a href="extras-taskboard.html">Taskboard</a></li>
						<li><a href="extras-timeline.html">Timeline</a></li>
						<li><a href="extras-tour.html">Tour</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
			</ul>
			<!-- /.menu js__accordion -->
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>
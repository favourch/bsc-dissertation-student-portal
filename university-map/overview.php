<?php
include '../includes/session.php';
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <?php include '../assets/meta-tags.php'; ?>

    <title>University map | Overview</title>

    <?php include '../assets/css-paths/common-css-paths.php'; ?>

    <script src="https://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

    <script src="https://student-portal.co.uk/assets/js/university-map/overview-test.js"></script>

</head>
<body>
<div class="preloader"></div>

    <?php if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) : ?>

    <?php include '../includes/menus/portal_menu.php'; ?>

    <div id="university-map-portal" class="container">

    <ol class="breadcrumb breadcrumb-custom">
        <li><a href="../../overview/">Overview</a></li>
        <li><a href="../../university-map/">University Map</a></li>
        <li class="active">Overview</li>
    </ol>

    <form class="form-custom">

    <div class="siderbarmap">
    <ul>
    Building<input id="building_checkbox" type="checkbox" onclick="toggleGroup('building')" checked="checked"/>
    Student centre<input id="student_centre_checkbox" type="checkbox" onclick="toggleGroup('student_centre')" checked="checked"/>
    Lecture theatre<input id="lecture_theatre_checkbox" type="checkbox" onclick="toggleGroup('lecture_theatre')" checked="checked"/>
    Computer lab<input id="computer_lab_checkbox" type="checkbox" onclick="toggleGroup('computer_lab')" checked="checked"/>
    Library<input id="library_checkbox" type="checkbox" onclick="toggleGroup('library')" checked="checked"/>
    Cycle hire<input id="cycle_hire_checkbox" type="checkbox" onclick="toggleGroup('cycle_hire')" checked="checked"/>
    Cycle parking<input id="cycle_parking_checkbox" type="checkbox" onclick="toggleGroup('cycle_parking')" checked="checked"/>
    ATM<input id="atm_checkbox" type="checkbox" onclick="toggleGroup('atm')" checked="checked"/>

    </ul>
    </div>

    <div id="map"></div>

    </form>

    </div>

    <?php include '../includes/footers/footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../../assets/js/custom/sign-out-inactive.js"></script>

    <?php else : ?>

    <?php include '../includes/menus/menu.php'; ?>

    <div class="container">

	<form class="form-custom">

    <div class="form-logo text-center">
    <i class="fa fa-graduation-cap"></i>
    </div>

    <hr>

    <p class="feedback-sad text-center">Looks like you're not signed in yet. Please sign in before accessing this area.</p>

    <hr>

    <div class="text-center">
	<a class="btn btn-primary btn-lg ladda-button" data-style="slide-up" href="/"><span class="ladda-label">Sign In</span></a>
    </div>

    </form>

	</div>

	<?php include '../includes/footers/footer.php'; ?>

	<?php endif; ?>

    <?php include '../assets/js-paths/common-js-paths.php'; ?>

    <script>
    //Ladda
    Ladda.bind('.ladda-button', {timeout: 2000});

    </script>

</body>
</html>

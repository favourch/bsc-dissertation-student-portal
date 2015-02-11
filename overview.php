<?php
include 'includes/session.php';

    $stmt1 = $mysqli->prepare("SELECT system_lectures.lectureid FROM user_timetable LEFT JOIN system_modules ON user_timetable.moduleid=system_modules.moduleid LEFT JOIN system_lectures ON user_timetable.moduleid=system_lectures.moduleid WHERE user_timetable.userid = ? LIMIT 1");
	$stmt1->bind_param('i', $userid);
	$stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($lectureid);
    $stmt1->fetch();

    $lectures_count = $stmt1->num_rows;

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'assets/js-paths/pacejs-js-path.php'; ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Portal | Overview</title>

    <?php include 'assets/css-paths/common-css-paths.php'; ?>

</head>

<body>
	
	<div class="preloader"></div>

	<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'student') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div class="container">
    <div class="row">

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="../timetable/">
    <div class="tile large-tile">
    <i class="fa fa-table"></i>
	<p class="large-tile-text">Timetable<span class="badge"><?php echo $lectures_count; ?></span></p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<a href="../exams/">
    <div class="tile">
	<i class="fa fa-pencil"></i>
	<p class="tile-text">Exams</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
	<a href="../library/">
	<div class="tile">
    <i class="fa fa-book"></i>
	<p class="tile-text">Library</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
	<a href="../transport/">
    <div class="tile">
    <i class="fa fa-subway"></i>
	<p class="tile-text">Transport</p>
    </div>
    </a>
	</div>
	
	<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<a href="../calendar/">
	<div class="tile">
    <i class="fa fa-calendar"></i>
	<p class="tile-text">Calendar</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<a href="../events/">
    <div class="tile">
	<i class="fa fa-beer"></i>
	<p class="tile-text">Events</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
	<a href="../university-map/">
    <div class="tile">
    <i class="fa fa-map-marker"></i>
	<p class="tile-text">University Map</p>
    </div>
	<a>
	</div>

    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
	<a href="../feedback/">
    <div class="tile">
    <i class="fa fa-check-square-o"></i>
	<p class="tile-text">Feeback</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="../messenger/">
    <div class="tile">
    <i class="fa fa-comments"></i>
	<p class="tile-text">Messenger</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="../account/">
    <div class="tile">
    <i class="fa fa-user"></i>
	<p class="tile-text">Account</p>
    </div>
    </a>
	</div>
	
	</div><!-- /row -->
	
	</div> <!-- /container -->

	<?php include 'includes/footers/footer.php'; ?>
	
    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'lecturer') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div class="container">
    <div class="row">

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="../library/">
	<div class="tile">
    <i class="fa fa-book"></i>
	<p class="tile-text">Library</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="../transport/">
    <div class="tile">
    <i class="fa fa-subway"></i>
	<p class="tile-text">Transport</p>
    </div>
    </a>
	</div>
	
	<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<a href="../calendar/">
	<div class="tile">
    <i class="fa fa-calendar"></i>
	<p class="tile-text">Calendar</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<a href="../events/">
    <div class="tile">
	<i class="fa fa-beer"></i>
	<p class="tile-text">Events</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="university-map">
    <div class="tile">
    <i class="fa fa-map-marker"></i>
	<p class="tile-text">University Map</p>
    </div>
	<a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="../feedback/">
    <div class="tile">
    <i class="fa fa-check-square-o"></i>
	<p class="tile-text">Feeback</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<a href="../messenger/">
    <div class="tile">
    <i class="fa fa-comments"></i>
	<p class="tile-text">Messenger</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<a href="../account/">
    <div class="tile">
    <i class="fa fa-user"></i>
	<p class="tile-text">Account</p>
    </div>
    </a>
	</div>
	
	</div><!-- /row -->
    
	</div> <!-- /container -->

    <?php include 'includes/footers/footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'admin') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div id="overview-portal" class="container">

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	<div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingOne">
  	<h4 class="panel-title">
	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Dashboard - click to minimize or maximize</a>
  	</h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
  	<div class="panel-body">

    <div class="dashboard">
    <button class="btn btn-primary" type="button">
        Messages <span class="badge">4</span>
    </button>
    <button class="btn btn-primary" type="button">
        Messages <span class="badge">4</span>
    </button>
    <button class="btn btn-primary" type="button">
        Messages <span class="badge">4</span>
    </button>
    <button class="btn btn-primary" type="button">
        Messages <span class="badge">4</span>
    </button>
    </div>

    </div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
	</div><!-- /panel-default -->

	</div><!-- /.panel-group -->

    <div class="row">

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="../timetable/">
    <div class="tile large-tile">
    <i class="fa fa-table"></i>
	<p class="large-tile-text">Timetable</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<a href="../exams/">
    <div class="tile">
	<i class="fa fa-pencil"></i>
	<p class="tile-text">Exams</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
	<a href="../library/">
	<div class="tile">
    <i class="fa fa-book"></i>
	<p class="tile-text">Library</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
	<a href="../transport/">
    <div class="tile">
    <i class="fa fa-subway"></i>
	<p class="tile-text">Transport</p>
    </div>
    </a>
	</div>
	
	<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<a href="../calendar/">
	<div class="tile">
    <i class="fa fa-calendar"></i>
	<p class="tile-text">Calendar</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<a href="../events/">
    <div class="tile">
	<i class="fa fa-beer"></i>
	<p class="tile-text">Events</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
	<a href="../university-map/">
    <div class="tile">
    <i class="fa fa-map-marker"></i>
	<p class="tile-text">University Map</p>
    </div>
	<a>
	</div>

    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
	<a href="../feedback/">
    <div class="tile">
    <i class="fa fa-check-square-o"></i>
	<p class="tile-text">Feeback</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="../messenger/">
    <div class="tile">
    <i class="fa fa-comments"></i>
	<p class="tile-text">Messenger</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="../account/">
    <div class="tile">
    <i class="fa fa-user"></i>
	<p class="tile-text">Account</p>
    </div>
    </a>
	</div>
	
	</div><!-- /row -->
    
	</div><!-- /container -->

    <?php include 'includes/footers/footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>

	<?php else : ?>

    <?php include 'includes/menus/menu.php'; ?>
	
    <div class="container">
    
	<form class="form-custom text-center">

    <div class="form-logo">
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

    <?php include 'includes/footers/footer.php'; ?>

	<?php endif; ?>

    <?php include 'assets/js-paths/common-js-paths.php'; ?>
    <?php include 'assets/js-paths/tilejs-js-path.php'; ?>

	<script>
    Ladda.bind('.ladda-button', {timeout: 2000});
	</script>

</body>
</html>

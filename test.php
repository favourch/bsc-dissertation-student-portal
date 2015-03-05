<?php
include 'includes/session.php';
include 'includes/functions.php';

    global $mysqli;
    global $session_userid;
    global $timetable_count;
    global $exams_count;
    global $library_count;
    global $calendar_count;
    global $events_count;
    global $messenger_count;
    global $feedback_count;
    global $feedback_admin_count;

    GetDashboardData();

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'assets/meta-tags.php'; ?>

    <title>Student Portal | Overview</title>

    <?php include 'assets/css-paths/common-css-paths.php'; ?>

    <style>
        .timeline {
            position: relative;
            padding: 20px 0 20px;
            list-style: none;
        }

        .timeline:before {
            content: " ";
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 3px;
            margin-left: -1.5px;
            background-color: #eeeeee;
        }

        .timeline > li {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline > li:before,
        .timeline > li:after {
            content: " ";
            display: table;
        }

        .timeline > li:after {
            clear: both;
        }

        .timeline > li:before,
        .timeline > li:after {
            content: " ";
            display: table;
        }

        .timeline > li:after {
            clear: both;
        }

        .timeline > li > .timeline-panel {
            float: left;
            position: relative;
            width: 46%;
            padding: 20px;
            border: 1px solid #d4d4d4;
            border-radius: 2px;
            -webkit-box-shadow: 0 1px 6px rgba(0,0,0,0.175);
            box-shadow: 0 1px 6px rgba(0,0,0,0.175);
        }

        .timeline > li > .timeline-panel:before {
            content: " ";
            display: inline-block;
            position: absolute;
            top: 26px;
            right: -15px;
            border-top: 15px solid transparent;
            border-right: 0 solid #ccc;
            border-bottom: 15px solid transparent;
            border-left: 15px solid #ccc;
        }

        .timeline > li > .timeline-panel:after {
            content: " ";
            display: inline-block;
            position: absolute;
            top: 27px;
            right: -14px;
            border-top: 14px solid transparent;
            border-right: 0 solid #fff;
            border-bottom: 14px solid transparent;
            border-left: 14px solid #fff;
        }

        .timeline > li > .timeline-badge {
            z-index: 100;
            position: absolute;
            top: 16px;
            left: 50%;
            width: 50px;
            height: 50px;
            margin-left: -25px;
            border-radius: 50% 50% 50% 50%;
            text-align: center;
            font-size: 1.4em;
            line-height: 50px;
            color: #fff;
            background-color: #999999;
        }

        .timeline > li.timeline-inverted > .timeline-panel {
            float: right;
        }

        .timeline > li.timeline-inverted > .timeline-panel:before {
            right: auto;
            left: -15px;
            border-right-width: 15px;
            border-left-width: 0;
        }

        .timeline > li.timeline-inverted > .timeline-panel:after {
            right: auto;
            left: -14px;
            border-right-width: 14px;
            border-left-width: 0;
        }

        .timeline-badge.primary {
            background-color: #2e6da4 !important;
        }

        .timeline-badge.success {
            background-color: #3f903f !important;
        }

        .timeline-badge.warning {
            background-color: #f0ad4e !important;
        }

        .timeline-badge.danger {
            background-color: #d9534f !important;
        }

        .timeline-badge.info {
            background-color: #5bc0de !important;
        }

        .timeline-title {
            margin-top: 0;
            color: inherit;
        }

        .timeline-body > p,
        .timeline-body > ul {
            margin-bottom: 0;
        }

        .timeline-body > p + p {
            margin-top: 5px;
        }

        @media(max-width:767px) {
            ul.timeline:before {
                left: 40px;
            }

            ul.timeline > li > .timeline-panel {
                width: calc(100% - 90px);
                width: -moz-calc(100% - 90px);
                width: -webkit-calc(100% - 90px);
            }

            ul.timeline > li > .timeline-badge {
                top: 16px;
                left: 15px;
                margin-left: 0;
            }

            ul.timeline > li > .timeline-panel {
                float: right;
            }

            ul.timeline > li > .timeline-panel:before {
                right: auto;
                left: -15px;
                border-right-width: 15px;
                border-left-width: 0;
            }

            ul.timeline > li > .timeline-panel:after {
                right: auto;
                left: -14px;
                border-right-width: 14px;
                border-left-width: 0;
            }
        }
    </style>

</head>

<body>
	
	<div class="preloader"></div>

	<?php if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) : ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'student') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div id="overview-portal" class="container">

	                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Responsive Timeline
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-badge"><i class="fa fa-check"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                            <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago via Twitter</small>
                                            </p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero laboriosam dolor perspiciatis omnis exercitationem. Beatae, officia pariatur? Est cum veniam excepturi. Maiores praesentium, porro voluptas suscipit facere rem dicta, debitis.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge warning"><i class="fa fa-credit-card"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolorem quibusdam, tenetur commodi provident cumque magni voluptatem libero, quis rerum. Fugiat esse debitis optio, tempore. Animi officiis alias, officia repellendus.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium maiores odit qui est tempora eos, nostrum provident explicabo dignissimos debitis vel! Adipisci eius voluptates, ad aut recusandae minus eaque facere.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus numquam facilis enim eaque, tenetur nam id qui vel velit similique nihil iure molestias aliquam, voluptatem totam quaerat, magni commodi quisquam.</p>
                                        </div>
                                    </div>
                                </li>
                                <div class="timeline-badge danger"><i class="fa fa-bomb"></i>
                                </div>
                                <li class="timeline-inverted">
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates est quaerat asperiores sapiente, eligendi, nihil. Itaque quos, alias sapiente rerum quas odit! Aperiam officiis quidem delectus libero, omnis ut debitis!</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge info"><i class="fa fa-save"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis minus modi quam ipsum alias at est molestiae excepturi delectus nesciunt, quibusdam debitis amet, beatae consequuntur impedit nulla qui! Laborum, atque.</p>
                                            <hr>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Action</a>
                                                    </li>
                                                    <li><a href="#">Another action</a>
                                                    </li>
                                                    <li><a href="#">Something else here</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a href="#">Separated link</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fuga odio quibusdam. Iure expedita, incidunt unde quis nam! Quod, quisquam. Officia quam qui adipisci quas consequuntur nostrum sequi. Consequuntur, commodi.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt obcaecati, quaerat tempore officia voluptas debitis consectetur culpa amet, accusamus dolorum fugiat, animi dicta aperiam, enim incidunt quisquam maxime neque eaque.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

	</div> <!-- /container -->

	<?php include 'includes/footers/footer.php'; ?>
	
    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'lecturer') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div id="overview-portal" class="container">
    <div class="row">

    <a href="../library/">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<div class="tile">
    <i class="fa fa-book"></i>
	<p>Library<span class="badge"><?php echo ($library_count == '0' ? "" : "$library_count"); ?></p>
    </div>
	</div>
    </a>

    <a href="../transport/">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-subway"></i>
	<p>Transport</p>
    </div>
	</div>
    </a>

    <a href="../calendar/">
	<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<div class="tile">
    <i class="fa fa-calendar"></i>
	<p>Calendar<span class="badge"><?php echo ($calendar_count == '0' ? "" : "$calendar_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../events/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
	<i class="fa fa-ticket"></i>
	<p>Events<span class="badge"><?php echo ($events_count == '0' ? "" : "$events_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="university-map">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-map-marker"></i>
	<p>University Map</p>
    </div>
	</div>
    <a>

	<a href="../feedback/">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-check-square-o"></i>
    <p>Feedback<span class="badge"><?php echo ($feedback_count == '0' ? "" : "$feedback_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../messenger/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-comments"></i>
	<p>Messenger<span class="badge"><?php echo ($messenger_count == '0' ? "" : "$messenger_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../account/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-user"></i>
	<p>Account</p>
    </div>
	</div>
    </a>
	
	</div><!-- /row -->
    
	</div> <!-- /container -->

    <?php include 'includes/footers/footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'admin') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div id="overview-portal" class="container">
    <div class="row">

    <a href="../timetable/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile large-tile">
    <i class="fa fa-clock-o"></i>
	<p>Timetable</p>
    </div>
	</div>
    </a>

    <a href="../exams/">
    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
    <div class="tile">
	<i class="fa fa-pencil"></i>
	<p>Exams</p>
    </div>
	</div>
    </a>

    <a href="../results/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
	<i class="fa fa-trophy"></i>
	<p>Results</p>
    </div>
	</div>
    </a>

    <a href="../transport/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-subway"></i>
	<p>Transport</p>
    </div>
	</div>
    </a>

    <a href="../library/">
    <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
	<div class="tile">
    <i class="fa fa-book"></i>
	<p>Library</p>
    </div>
	</div>
    </a>

    <a href="../calendar/">
	<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	<div class="tile">
    <i class="fa fa-calendar"></i>
	<p>Calendar<span class="badge"><?php echo ($calendar_count == '0' ? "" : "$calendar_count"); ?></span></p>
    </div>
	</div>
    </a>

    <a href="../university-map/">
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-map-marker"></i>
	<p>University Map</p>
    </div>
	</div>
    <a>

    <a href="../events/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
	<i class="fa fa-ticket"></i>
	<p>Events</p>
    </div>
	</div>
    </a>

	<a href="../feedback/">
    <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
    <div class="tile">
    <i class="fa fa-check-square-o"></i>
	<p>Feedback<span class="badge"><?php echo ($feedback_admin_count == '0' ? "" : "$feedback_admin_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../messenger/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-comments"></i>
	<p>Messenger<span class="badge"><?php echo ($messenger_count == '0' ? "" : "$messenger_count"); ?></span></p>
    </div>
	</div>
    </a>

	<a href="../account/">
    <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
    <div class="tile">
    <i class="fa fa-user"></i>
	<p>Account</p>
    </div>
	</div>
    </a>
	
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

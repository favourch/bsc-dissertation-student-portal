<?php
include 'includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'assets/meta-tags.php'; ?>

    <?php include 'assets/css-paths/common-css-paths.php'; ?>

    <title>Student Portal | Forgotten Password</title>

</head>

<body>

	<div class="preloader"></div>

	<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>

    <?php include '../includes/menus/portal_menu.php'; ?>

    <div class="container">

    <form class="form-custom">

    <div class="form-logo text-center">
    <i class="fa fa-graduation-cap"></i>
    </div>

    <hr>
    <p class="feedback-sad text-center">You are already logged in. You don't have to log in again.</p>
    <hr>

	<div class="pull-left">
    <a class="btn btn-success btn-lg ladda-button" data-style="slide-up" href="overview/"><span class="ladda-label">Overview</span></a>
    </div>

    <div class="text-right">
    <a class="btn btn-danger btn-lg ladda-button" data-style="slide-up" href="sign-out/"><span class="ladda-label">Sign Out</span></a>
    </div>

    </form>

    </div>

    <?php include '../includes/footers/footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/sign-out-inactive.js"></script>

	<?php else : ?>

    <?php include 'includes/menus/menu.php'; ?>

    <div class="container">

    <form class="form-custom" method="post" name="forgotpassword_form">

    <div class="form-logo text-center">
    <i class="fa fa-lock"></i>
    </div>

    <hr>

    <p id="hide" class="feedback-custom text-justify">Please enter the email you used to register to the <b>Student Portal</b> and we will email you a link to reset your password.</p>

	<p id="error" class="feedback-sad text-center"></p>
	<p id="success" class="feedback-happy text-center"></p>

    <div id="hide">

	<label>Email address</label>
    <input class="form-control" type="email" name="email" id="email" placeholder="Email address">
    <p id="error1" class="feedback-sad text-center"></p>

    </div>

    <hr>

    <div id="extra-button" class="pull-left">
    <a class="btn btn-info btn-lg ladda-button" data-style="slide-up" href="/"><span class="ladda-label">Sign In</span></a>
    </div>

    <div id="extra-button" class="text-right">
    <button id="FormSubmit" class="btn btn-lg btn-primary ladda-button" data-style="slide-up"><span class="ladda-label">Continue</span></button>
    </div>

	<div id="success-button" class="text-center" style="display:none">
    <a class="btn btn-primary btn-lg ladda-button" data-style="slide-up" href="/"><span class="ladda-label">Continue</span></a>
    </div>

    </form>

    </div>

    <?php include 'includes/footers/footer.php'; ?>

	<?php endif; ?>

    <?php include 'assets/js-paths/common-js-paths.php'; ?>
    <?php include 'assets/js-paths/easing-js-path.php'; ?>
    <?php include 'assets/js-paths/tilejs-js-path.php'; ?>

	<script>
    $(document).ready(function() {

    //Ladda
    Ladda.bind('.ladda-button', {timeout: 2000});

    //Ajax call
    $("#FormSubmit").click(function (e) {
    e.preventDefault();

	var hasError;

	var email2 = $("#email").val();
	if(email2 === '') {
        $("#error").hide();
		$("#error1").show();
        $("#error1").empty().append("Please enter an email address.");
        $("#email").removeClass("success-style");
		$("#email").addClass("error-style");
		hasError = true;
		return false;
	} else {
        $("#error").hide();
        $("#error1").hide();
        $("#email").removeClass("error-style");
        $("#email").addClass("success-style");
        hasError = false;
    }

	if(hasError == false){
    jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/processes.php",
    data:'email2=' + email2,
    success:function(){
        $("#error").hide();
        $("#error1").hide();
		$("#hide").hide();
		$("#extra-button").hide();
		$("#FormSubmit").hide();
		$("#success").append('Please check your email account for instructions to reset your password.');
		$("#success-button").show();
    },
    error:function (xhr, ajaxOptions, thrownError){
        $("#success").hide();
        $("#error1").hide();
		$("#error").show();
        $("#error").empty().append(thrownError);
    }
	});
    }

	return true;

	});
	});
	</script>

</body>
</html>

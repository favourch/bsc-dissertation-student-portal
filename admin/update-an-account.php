<?php
include '../includes/signin.php';

if (isset($_POST["recordToUpdate"])) {

$idToUpdate = filter_input(INPUT_POST, 'recordToUpdate', FILTER_SANITIZE_NUMBER_INT);

$stmt1 = $mysqli->prepare("SELECT user_signin.email, user_details.gender, user_details.firstname, user_details.surname, user_details.studentno, user_details.dateofbirth, user_details.phonenumber, user_details.address1, user_details.address2, user_details.town, user_details.city, user_details.country, user_details.postcode FROM user_signin LEFT JOIN user_details ON user_signin.userid=user_details.userid WHERE user_signin.userid = ? LIMIT 1");
$stmt1->bind_param('i', $idToUpdate);
$stmt1->execute();
$stmt1->store_result();
$stmt1->bind_result($email, $gender, $firstname, $surname, $studentnumber, $dateofbirth, $phonenumber, $address1, $address2, $town, $city, $country, $postcode);
$stmt1->fetch();
$stmt1->close();

} else {
header('Location: ../../account/');
}

if ($dateofbirth == "0000-00-00") {
    $dateofbirth = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php include '../assets/js-paths/pacejs-js-path.php'; ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<?php include '../assets/css-paths/common-css-paths.php'; ?>
	<?php include '../assets/css-paths/datetimepicker-css-path.php'; ?>

    <title>Student Portal | Update Account</title>

    <style>
    #gender {
		color: #FFA500;
		background-color: #333333;
	}
    </style>

</head>

<body>

	<div class="preloader"></div>

	<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'student') : ?>

    <div class="container">

    <?php include '../includes/menus/portal_menu.php'; ?>

    <ol class="breadcrumb">
	<li><a href="../../overview/">Overview</a></li>
	<li><a href="../../account/">Account</a></li>
    <li class="active">Update an account</li>
    </ol>

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel panel-default">

	<div class="panel-heading" role="tab" id="headingOne">
	<h4 class="panel-title">
    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Update account</a>
	</h4>
    </div>

    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

	<div class="panel-body">

	<!-- Update account -->
    <div class="content-panel mb10" style="border: none;">

	<form class="form-custom" style="max-width: 800px; padding-top: 0px;" name="updateaccount_form" novalidate>

	<p id="error" class="feedback-sad text-center"></p>
	<p id="success" class="feedback-happy text-center"></p>

	<div id="hide">

	<div class="form-group">

    <div class="col-xs-12 col-sm-12 full-width">
    <label>Gender</label>
    <select class="form-control" name="gender" id="gender">
    <option <?php if($gender == "Male") echo "selected=selected"; ?> class="others">Male</option>
    <option <?php if($gender == "Female") echo "selected=selected"; ?> class="others">Female</option>
    <option <?php if($gender == "Other") echo "selected=selected"; ?> class="others">Other</option>
    </select>
    </div>

    </div>

    <div class="form-group">

    <div class="col-xs-6 col-sm-6 full-width">
    <label>First name</label>
    <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" placeholder="Enter your first name">
    <label>Surname</label>
    <input class="form-control" type="text" name="surname" id="surname" value="<?php echo $surname; ?>" placeholder="Enter your surname">
	<label>Date of Birth (YYYY-MM-DD)</label>
    <input type='text' class="form-control" type="text" name="dateofbirth" id="dateofbirth" data-date-format="YYYY-MM-DD" value="<?php echo $dateofbirth; ?>" placeholder="Select your date of birth"/>
	<label>Student number</label>
    <input class="form-control" type="text" name="studentno" id="studentno" value="<?php echo $studentno; ?>" placeholder="Enter your student number" disabled="disabled">
    <label>Email address</label>
    <input class="form-control" type="text" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter your email address">
	<label>Phone number</label>
    <input class="form-control" type="text" name="phonenumber" id="phonenumber" value="<?php echo $phonenumber; ?>" placeholder="Enter your phone number">
	</div>

    <div class="col-xs-6 col-sm-6 full-width">
	<label>Address line 1</label>
    <input class="form-control" type="text" name="address1" id="address1" value="<?php echo $address1; ?>" placeholder="Enter your address line 1">
    <label>Address 2 line (Optional)</label>
    <input class="form-control" type="text" name="address2" id="address2" value="<?php echo $address2; ?>" placeholder="Enter your address line 2 (Optional)">
	<label>Town</label>
    <input class="form-control" type="text" name="town" id="town" value="<?php echo $town; ?>" placeholder="Enter your town">
    <label>City</label>
    <input class="form-control" type="text" name="city" id="city" value="<?php echo $city; ?>" placeholder="Enter your city">
    <label>Country</label>
	<input class="form-control" type="text" name="country" id="country" value="United Kingdom" placeholder="Enter your country" readonly="readonly">
	<label>Postcode</label>
    <input class="form-control" type="text" name="postcode" id="postcode" value="<?php echo $postcode; ?>" placeholder="Enter your postcode">
	</div>

    </div>

	<div class="form-group">
	<div class="col-xs-12 col-sm-12 full-width">
	<label>Programme of Study</label>
    <input class="form-control" type="text" name="degree" id="degree" value="<?php echo $degree; ?>" placeholder="Enter your programme of study">
	</div>
	</div>

    <div class="text-right">
    <button id="FormSubmit" class="btn btn-custom btn-lg ladda-button mt10 mr5" data-style="slide-up" data-spinner-color="#FFA500"><span class="ladda-label">Update</span></button>
    </div>

	</div>

    </form>

    </div><!-- /content-panel -->
    <!-- End of Update account -->

    </div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
    </div><!-- /panel-default -->

	</div><!-- /panel-group -->

    </div> <!-- /container -->

	<?php include '../includes/footers/portal_footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

	<?php endif; ?>

	<?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'lecturer') : ?>

	<div class="container">

    <?php include '../includes/menus/portal_menu.php'; ?>

    <ol class="breadcrumb">
	<li><a href="../overview/">Overview</a></li>
	<li><a href="../account/">Account</a></li>
    <li class="active">Update account</li>
    </ol>

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel panel-default">

	<div class="panel-heading" role="tab" id="headingOne">
	<h4 class="panel-title">
    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Update account</a>
	</h4>
    </div>

    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

	<div class="panel-body">

	<!-- Update account -->
    <div class="content-panel mb10" style="border: none;">

	<form class="form-custom" style="max-width: 800px; padding-top: 0px;" name="updateaccount_form" novalidate>

	<p id="error" class="feedback-sad text-center"></p>
	<p id="success" class="feedback-happy text-center"></p>

	<div id="hide">

	<div class="form-group">

    <div class="col-xs-12 col-sm-12 full-width">
    <label>Gender</label>
    <select class="form-control" name="gender" id="gender">
    <option <?php if($gender == "Male") echo "selected=selected"; ?> class="others">Male</option>
    <option <?php if($gender == "Female") echo "selected=selected"; ?> class="others">Female</option>
    <option <?php if($gender == "Other") echo "selected=selected"; ?> class="others">Other</option>
    </select>
    </div>

    </div>

    <div class="form-group">

    <div class="col-xs-6 col-sm-6 full-width">
    <label>First name</label>
    <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" placeholder="Enter your first name">
    <label>Surname</label>
    <input class="form-control" type="text" name="surname" id="surname" value="<?php echo $surname; ?>" placeholder="Enter your surname">
	<label>Date of Birth</label>
    <input type='text' class="form-control" type="text" name="dateofbirth" id="dateofbirth" value="<?php echo $dateofbirth; ?>" placeholder="Select your date of birth"/>
	<label>Student number</label>
    <input class="form-control" type="text" name="studentno" id="studentno" value="<?php echo $studentno; ?>" placeholder="Enter your student number" disabled="disabled">
    <label>Email address</label>
    <input class="form-control" type="text" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter your email address">
	<label>Phone number</label>
    <input class="form-control" type="text" name="phonenumber" id="phonenumber" value="<?php echo $phonenumber; ?>" placeholder="Enter your phone number">
	</div>

    <div class="col-xs-6 col-sm-6 full-width">
	<label>Address line 1</label>
    <input class="form-control" type="text" name="address1" id="address1" value="<?php echo $address1; ?>" placeholder="Enter your address line 1">
    <label>Address 2 line (Optional)</label>
    <input class="form-control" type="text" name="address2" id="address2" value="<?php echo $address2; ?>" placeholder="Enter your address line 2 (Optional)">
	<label>Town</label>
    <input class="form-control" type="text" name="town" id="town" value="<?php echo $town; ?>" placeholder="Enter your town">
    <label>City</label>
    <input class="form-control" type="text" name="city" id="city" value="<?php echo $city; ?>" placeholder="Enter your city">
    <label>Country</label>
	<input class="form-control" type="text" name="country" id="country" value="United Kingdom" placeholder="Enter your country" readonly="readonly">
	<label>Postcode</label>
    <input class="form-control" type="text" name="postcode" id="postcode" value="<?php echo $postcode; ?>" placeholder="Enter your postcode">
	</div>

    </div>

    <input type="hidden" name="degree" id="degree">

    <div class="text-right">
    <button id="FormSubmit" class="btn btn-custom btn-lg ladda-button mt10 mr5" data-style="slide-up" data-spinner-color="#FFA500"><span class="ladda-label">Update</span></button>
    </div>

	</div>

    </form>

    </div><!-- /content-panel -->
    <!-- End of Update account -->

    </div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
    </div><!-- /panel-default -->

	</div><!-- /panel-group -->

    </div> <!-- /container -->

	<?php include '../includes/footers/portal_footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>

	<?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'admin') : ?>

	<div class="container">

    <?php include '../includes/menus/portal_menu.php'; ?>

    <ol class="breadcrumb">
	<li><a href="../overview/">Overview</a></li>
	<li><a href="../account/">Account</a></li>
    <li class="active">Update account</li>
    </ol>

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel panel-default">

	<div class="panel-heading" role="tab" id="headingOne">
	<h4 class="panel-title">
    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Update account</a>
	</h4>
    </div>

    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">

	<div class="panel-body">

	<!-- Update account -->
    <div class="content-panel mb10" style="border: none;">

	<form class="form-custom" style="max-width: 800px; padding-top: 0px;" name="updateaccount_form" novalidate>

	<p id="error" class="feedback-sad text-center"></p>
	<p id="success" class="feedback-happy text-center"></p>

	<div id="hide">

	<div class="form-group">

    <div class="col-xs-12 col-sm-12 full-width">
    <label>Gender</label>
    <select class="form-control" name="gender" id="gender">
    <option <?php if($gender == "Male") echo "selected=selected"; ?> class="others">Male</option>
    <option <?php if($gender == "Female") echo "selected=selected"; ?> class="others">Female</option>
    <option <?php if($gender == "Other") echo "selected=selected"; ?> class="others">Other</option>
    </select>
    </div>

    </div>

    <div class="form-group">

    <div class="col-xs-6 col-sm-6 full-width">
    <label>First name</label>
    <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" placeholder="Enter your first name">
    <label>Surname</label>
    <input class="form-control" type="text" name="surname" id="surname" value="<?php echo $surname; ?>" placeholder="Enter your surname">
	<label>Date of Birth (YYYY-MM-DD)</label>
    <input type='text' class="form-control" type="text" name="dateofbirth" id="dateofbirth" data-date-format="YYYY-MM-DD" value="<?php echo $dateofbirth; ?>" placeholder="Select your date of birth"/>
	<label>Student number</label>
    <input class="form-control" type="text" name="studentno" id="studentno" value="<?php echo $studentno; ?>" placeholder="Enter your student number" disabled="disabled">
    <label>Email address</label>
    <input class="form-control" type="text" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter your email address">
	<label>Phone number</label>
    <input class="form-control" type="text" name="phonenumber" id="phonenumber" value="<?php echo $phonenumber; ?>" placeholder="Enter your phone number">
	</div>

    <div class="col-xs-6 col-sm-6 full-width">
	<label>Address line 1</label>
    <input class="form-control" type="text" name="address1" id="address1" value="<?php echo $address1; ?>" placeholder="Enter your address line 1">
    <label>Address 2 line (Optional)</label>
    <input class="form-control" type="text" name="address2" id="address2" value="<?php echo $address2; ?>" placeholder="Enter your address line 2 (Optional)">
	<label>Town</label>
    <input class="form-control" type="text" name="town" id="town" value="<?php echo $town; ?>" placeholder="Enter your town">
    <label>City</label>
    <input class="form-control" type="text" name="city" id="city" value="<?php echo $city; ?>" placeholder="Enter your city">
    <label>Country</label>
	<input class="form-control" type="text" name="country" id="country" value="United Kingdom" placeholder="Enter your country" readonly="readonly">
	<label>Postcode</label>
    <input class="form-control" type="text" name="postcode" id="postcode" value="<?php echo $postcode; ?>" placeholder="Enter your postcode">
	</div>

    </div>

    <input type="hidden" name="degree" id="degree">

    <div class="text-right">
    <button id="FormSubmit" class="btn btn-custom btn-lg ladda-button mt10 mr5" data-style="slide-up" data-spinner-color="#FFA500"><span class="ladda-label">Update</span></button>
    </div>

	</div>

    </form>

    </div><!-- /content-panel -->
    <!-- End of Update account -->

    </div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
    </div><!-- /panel-default -->

	</div><!-- /panel-group -->

    </div> <!-- /container -->

	<?php include '../includes/footers/portal_footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

	<?php endif; ?>

	<?php else : ?>

	<style>
    html, body {
		height: 100% !important;
	}
    </style>

    <header class="intro">
    <div class="intro-body">

    <form class="form-custom orange-form">

	<div class="logo-custom animated fadeIn delay1">
    <i class="fa fa-graduation-cap"></i>
    </div>

    <hr class="mt10 hr-custom">
    <p class="feedback-sad text-center">Looks like you're not signed in yet. Please sign in before accessing this area.</p>
    <hr class="hr-custom">

    <div class="text-center">
    <a class="btn btn-custom btn-lg ladda-button" data-style="slide-up" data-spinner-color="#FFA500" href="/"><span class="ladda-label">Sign In</span></a>
	</div>

    </form>

    </div><!-- /intro-body -->
    </header>

	<?php endif; ?>

	<?php include '../assets/js-paths/common-js-paths.php'; ?>
	<?php include '../assets/js-paths/datetimepicker-js-path.php'; ?>

	<script>
    Ladda.bind('.ladda-button', {timeout: 1000});
	</script>

	<script>
	$(function () {
	$('#dateofbirth').datepicker({
		dateFormat: "yy-mm-dd",
		defaultDate: new Date(1985, 00, 01)
	});
	});
	</script>

	<script>
	val = $("#gender").val();
	if(val === '') { $("#gender").css("border-color", "#FF5454"); }
	val = $("#firstname").val();
	if(val === '') { $("#firstname").css("border-color", "#FF5454"); }
	val = $("#surname").val();
	if(val === '') { $("#surname").css("border-color", "#FF5454"); }
	val = $("#dateofbirth").val();
	if(val === '') { $("#dateofbirth").css("border-color", "#FF5454"); }
	val = $("#email").val();
	if(val === '') { $("#email").css("border-color", "#FF5454"); }
	val = $("#phonenumber").val();
	if(val === '') { $("#phonenumber").css("border-color", "#FF5454"); }
	val = $("#address1").val();
	if(val === '') { $("#address1").css("border-color", "#FF5454"); }
	val = $("#address2").val();
	if(val === '') { $("#address2").css("border-color", "#FF5454"); }
	val = $("#town").val();
	if(val === '') { $("#town").css("border-color", "#FF5454"); }
	val = $("#city").val();
	if(val === '') { $("#city").css("border-color", "#FF5454"); }
	val = $("#country").val();
	if(val === '') { $("#country").css("border-color", "#FF5454"); }
	val = $("#postcode").val();
	if(val === '') { $("#postcode").css("border-color", "#FF5454"); }
	val = $("#degree").val();
	if(val === '') { $("#degree").css("border-color", "#FF5454"); }
	</script>

	<script>
	$(document).ready(function() {
    $("#FormSubmit").click(function (e) {
    e.preventDefault();

	var hasError = false;

	gender1 = $("#gender").val();

	firstname1 = $("#firstname").val();
	if(firstname1 === '') {
		$("#error").show();
        $("#error").empty().append("Please enter a first name.");
		$("#firstname").css("border-color", "#FF5454");
		hasError  = true;
		return false;
	}

	surname1 = $("#surname").val();
	if(surname1 === '') {
		$("#error").show();
        $("#error").empty().append("Please enter a surname.");
		$("#surname").css("border-color", "#FF5454");
		hasError  = true;
		return false;
	}

	dateofbirth1 = $("#dateofbirth").val();

	studentno1 = $("#studentno").val();
	email1 = $("#email").val();
	if(email1 === '') {
		$("#error").show();
        $("#error").empty().append("Please enter an email address.");
		$("#email").css("border-color", "#FF5454");
		hasError  = true;
		return false;
	}

	phonenumber1 = $("#phonenumber").val();
	address11 = $("#address1").val();
	address21 = $("#address2").val();
	town1 = $("#town").val();
	city1 = $("#city").val();
	country1 = $("#country").val();
	postcode1 = $("#postcode").val();
	degree1 = $("#degree").val();

    jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/adminaccount_process.php",
    data:'gender1=' + gender1 + '&firstname=1' + firstname1 + '&surname1=' + surname1 + '&dateofbirth1=' + dateofbirth1 + '&studentno1=' + studentno1 + '&email1=' + email1 + '&phonenumber1=' + phonenumber1 + '&address11=' + address11 + '&address21=' + address21 + '&town1=' + town1 + '&city1=' + city1 + '&country1=' + country1 + '&postcode1=' + postcode1 + '&degree1=' + degree1,
    success:function(response){
		$("#error").hide();
		$("#hide").hide();
		$("#success").empty().append('Your personal details have been updated successfully.');
    },
    error:function (xhr, ajaxOptions, thrownError){
		$("#error").show();
        $("#error").empty().append(thrownError);
    }
	});

	return true;

	});
	});
	</script>

</body>
</html>


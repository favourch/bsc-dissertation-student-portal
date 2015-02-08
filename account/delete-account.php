<?php
include '../includes/session.php';

$stmt1 = $mysqli->prepare("SELECT user_signin.email, user_details.studentno, user_details.firstname, user_details.surname FROM user_signin LEFT JOIN user_details ON user_signin.userid = user_details.userid WHERE user_signin.userid = ? LIMIT 1");
$stmt1->bind_param('i', $userid);
$stmt1->execute();
$stmt1->store_result();
$stmt1->bind_result($email, $studentno, $firstname, $surname);
$stmt1->fetch();

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

    <title>Student Portal | Delete Account</title>

</head>

<body>
	
	<div class="preloader"></div>

	<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>

    <?php include '../includes/menus/portal_menu.php'; ?>

    <div class="container">

    <ol class="breadcrumb">
    <li><a href="../../overview/">Overview</a></li>
	<li><a href="../../account/">Account</a></li>
    <li class="active">Delete account</li>
    </ol>
	
    <!-- Delete account -->
	<form class="form-custom" style="max-width: 100%;" name="deleteaccount_form">

    <div class="form-group">
    
	<div class="col-xs-6 col-sm-6 full-width pl0">
    <label>First name</label>
    <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" placeholder="First name" readonly="readonly">
	<label>Student number</label>
    <input class="form-control" type="text" name="studentno" id="studentno" value="<?php echo $studentno; ?>" placeholder="Student Number" readonly="readonly">
	</div>

    <div class="col-xs-6 col-sm-6 full-width pr0">
	<label>Surname</label>
    <input class="form-control" type="text" name="surname" id="surname" value="<?php echo $surname; ?>" placeholder="Surname" readonly="readonly">
    <label>Email address</label>
    <input class="form-control" type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="Email address" readonly="readonly">
    </div>
    
	</div>

    <hr class="hr-custom">

    <div class="text-center">
    <a class="btn btn-primary btn-lg ladda-button" data-style="slide-up" data-toggle="modal" href="#deleteaccount-modal"><span class="ladda-label">Delete account</span></a>
    </div>

    </form>
    <!-- Delete Account Modal -->

    <div class="modal fade modal-custom" id="deleteaccount-modal" tabindex="-1" role="dialog" aria-labelledby="deleteaccount-modal-label" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    
	<div class="modal-header">
    <div class="form-logo text-center">
    <i class="fa fa-trash"></i>
    </div>
    </div>

    <div class="modal-body">

    <form class="form-custom" style="background: none; border: none;" name="deleteaccount_form">

    <input type="hidden" name="deleteaccount_button" id="deleteaccount_button">

    <p class="feedback-custom text-center">Are you sure you want to delete your account?</p>

    </div>
    
	<div class="modal-footer">
    
	<div class="pull-left">
    <button id="FormSubmit" class="btn btn-danger btn-lg ladda-button mt10 mr5" data-style="slide-up" type="submit"><span class="ladda-label">Yes</span></button>
    </div>
    <div class="text-right">
	<button class="btn btn-success btn-lg ladda-button" data-style="slide-up" data-dismiss="modal"><span class="ladda-label">No</span></button>
	</div>
    
	</div>

    </form>

    </div>
    </div>
    </div>

    </div> <!-- /container -->
	
	<?php include '../includes/footers/footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="https://student-portal.co.uk/assets/js/custom/sign-out-inactive.js"></script>

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
    $(document).ready(function() {

    //Ladda
    Ladda.bind('.ladda-button', {timeout: 1000});

    //Ajax call
    $("#FormSubmit").click(function (e) {
    e.preventDefault();

    var deleteaccount_button = $("#deleteaccount_button").val();

    jQuery.ajax({
    type: "POST",
    url: "https://student-portal.co.uk/includes/processes.php",
    data:'deleteaccount_button=' + deleteaccount_button,
    success:function(){
        window.location.href = "/account/account-deleted/";
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

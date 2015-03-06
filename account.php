<?php
include 'includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'assets/meta-tags.php'; ?>

    <?php include 'assets/css-paths/datatables-css-path.php'; ?>
    <?php include 'assets/css-paths/common-css-paths.php'; ?>

    <title>Student Portal | Account</title>

</head>

<body>
	
	<div class="preloader"></div>

	<?php if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) : ?>
	
    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'student') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div class="container">

	<ol class="breadcrumb">
    <li><a href="../overview/">Overview</a></li>
    <li class="active">Account</li>
    </ol>
			
    <div class="row">

    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
    <a href="/account/update-account/">
    <div class="tile">
    <i class="fa fa-pencil"></i>
	<p class="tile-text">Update account</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
	<a href="/account/change-password/">
    <div class="tile">
    <i class="fa fa-key"></i>
	<p class="tile-text">Change Password</p>
    </div>
    </a>
	</div>
				
	<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
	<a href="/account/pay-course-fees/">
    <div class="tile">
    <i class="fa fa-gbp"></i>
	<p class="tile-text">Pay course fees</p>
    </div>
	</a>
	</div>

    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
	<a href="/account/delete-account/">
    <div class="tile">
    <i class="fa fa-trash"></i>
	<p class="tile-text">Delete account</p>
	</div>
    </a>
	</div>

    </div><!-- /row -->
	
    </div><!-- /container -->
	
	<?php include 'includes/footers/footer.php'; ?>
		
	<!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>
	
	<?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'lecturer') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

    <div class="container">

	<ol class="breadcrumb">
    <li><a href="../overview/">Overview</a></li>
    <li class="active">Account</li>
    </ol>
			
    <div class="row">

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">

    <a href="/account/update-account/">
    <div class="tile">
    <i class="fa fa-refresh"></i>
	<p class="tile-text">Update account</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
	<a href="/account/change-password/">
    <div class="tile">
    <i class="fa fa-key"></i>
	<p class="tile-text">Change Password</p>
    </div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
	<a href="/account/delete-account/">
    <div class="tile">
    <i class="fa fa-trash"></i>
	<p class="tile-text">Delete account</p>
	</div>
    </a>
	</div>            

    </div><!-- /row -->
    </div><!-- /container -->
	
	<?php include 'includes/footers/footer.php'; ?>
		
	<!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>

    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'admin') : ?>

    <?php include 'includes/menus/portal_menu.php'; ?>

	<div id="account-admin-portal" class="container">
			
	<ol class="breadcrumb">
    <li><a href="../overview/">Overview</a></li>
	<li class="active">Account</li>
    </ol>
			
    <div class="row">

    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <a href="/account/update-account/">
    <div class="tile">
    <i class="fa fa-refresh"></i>
	<p class="tile-text">Update account</p>
    </div>
    </a>
	</div>

	<div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
	<a href="/account/change-password/">
    <div class="tile">
    <i class="fa fa-key"></i>
	<p class="tile-text">Change password</p>
	</div>
    </a>
	</div>

    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
	<a href="/account/delete-account/">
    <div class="tile">
    <i class="fa fa-trash"></i>
	<p class="tile-text">Delete account</p>
	</div>
    </a>
	</div>

    </div><!-- /row -->

    <h4>Perform actions against other accounts</h4>
    <hr>

    <a class="btn btn-success btn-lg ladda-button" style="margin-bottom: 10px;" data-style="slide-up" href="/admin/create-account/"><span class="ladda-label">Create account</span></a>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

    <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
  	<h4 class="panel-title">
	<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Users</a>
  	</h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
  	<div class="panel-body">

	<!-- Users-->
	<section id="no-more-tables">
	<table class="table table-condensed table-custom">

	<thead>
	<tr>
	<th>Full name</th>
	<th>Account type</th>
    <th>Created on</th>
	<th>Updated on</th>
	<th>Action</th>
    <th>Action</th>
    <th>Action</th>
	</tr>
	</thead>

	<tbody>
	<?php

	$stmt1 = $mysqli->query("SELECT user_signin.userid, user_signin.account_type, user_signin.email, DATE_FORMAT(user_signin.created_on,'%d %b %y %H:%i') as created_on, DATE_FORMAT(user_details.updated_on,'%d %b %y %H:%i') as updated_on, user_details.firstname, user_details.surname FROM user_signin LEFT JOIN user_details ON user_signin.userid=user_details.userid WHERE NOT user_signin.userid = '$session_userid'");

	while($row = $stmt1->fetch_assoc()) {

    $userid = $row["userid"];
    $account_type = ucfirst($row["account_type"]);
    $email = $row["email"];
    $created_on = $row["created_on"];
    $updated_on = $row["updated_on"];
    $firstname = $row["firstname"];
    $surname = $row["surname"];

	$account_type = ucfirst($row["account_type"]);

	echo '<tr id="user-'.$userid.'">

			<td data-title="Full name">'.$firstname.' '.$surname.'</td>
			<td data-title="Account type">'.$account_type.'</td>
			<td data-title="Created on">'.$created_on.'</td>
            <td data-title="Updated on">'.$updated_on.'</td>
			<td data-title="Action"><a class="btn btn-primary btn-md ladda-button" href="/admin/update-an-account?id='.$userid.'" data-style="slide-up"><span class="ladda-label">Update</span></a></td>
            <td data-title="Action"><a class="btn btn-primary btn-md ladda-button" href="/admin/change-account-password?id='.$userid.'" data-style="slide-up"><span class="ladda-label">Change password</span></a></td>
            <td data-title="Action"><a class="btn btn-primary btn-md ladda-button" href="#deactivate-'.$userid.'" data-toggle="modal" data-style="slide-up"><span class="ladda-label">Deactivate</span></a></td>
			</tr>

    		<div id="deactivate-'.$userid.'" class="modal modal-custom fade" tabindex="-1" role="dialog" aria-labelledby="modal-custom-label" aria-hidden="true">
    		<div class="modal-dialog">
    		<div class="modal-content">

			<div class="modal-header">
			<div class="form-logo text-center">
			<i class="fa fa-user-times"></i>
			</div>
			</div>

			<div class="modal-body">
			<p id="deactivate-question" class="feedback-sad text-center">Are you sure you want to deactivate '.$firstname.' '.$surname.'?</p>
            <p id="deactivate-question" class="feedback-happy text-center" style="display: none;">'.$firstname.' '.$surname.' has been deactivated successfully.</p>
			</div>

			<div class="modal-footer">
			<div id="deactivate-hide">
			<div class="pull-left">
			<a id="deactivate-'.$userid.'" class="btn btn-danger btn-lg deactivate-button ladda-button" data-style="slide-up">Yes</a>
			</div>
			<div class="text-right">
			<button type="button" class="btn btn-success btn-lg ladda-button" data-style="slide-up" data-dismiss="modal">No</button>
			</div>
			</div>
			<div class="text-center">
			<a id="deactivate-success-button" class="btn btn-primary btn-lg ladda-button" style="display: none;" data-style="slide-up">Continue</a>
			</div>
			</div>

			</div><!-- /modal -->
			</div><!-- /modal-dialog -->
			</div><!-- /modal-content -->';
	}

	$stmt1->close();
	?>
	</tbody>

	</table>
	</section>

  	</div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
	</div><!-- /panel-default -->

	<div class="panel panel-default">

    <div class="panel-heading" role="tab" id="headingTwo">
  	<h4 class="panel-title">
	<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> Users online now</a>
  	</h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
  	<div class="panel-body">

	<!-- Users online now -->
	<section id="no-more-tables">
	<table class="table table-condensed table-custom">

	<thead>
	<tr>
	<th>Full name</th>
	<th>Account type</th>
	<th>Created on</th>
	<th>Updated on</th>
	</tr>
	</thead>

	<tbody>
	<?php

	$stmt1 = $mysqli->query("SELECT user_signin.account_type, DATE_FORMAT(user_signin.created_on,'%d %b %y %H:%i') as created_on, DATE_FORMAT(user_details.updated_on,'%d %b %y %H:%i') as updated_on, user_details.surname, user_details.firstname FROM user_signin LEFT JOIN user_details ON user_signin.userid=user_details.userid WHERE NOT user_signin.userid = '$session_userid' AND user_signin.isSignedIn = '1'");

	while($row = $stmt1->fetch_assoc()) {

    $account_type = ucfirst($row["account_type"]);
    $created_on = $row["created_on"];
    $updated_on = $row["updated_on"];
    $firstname = $row["firstname"];
    $surname = $row["surname"];

	echo '<tr>

			<td data-title="Full name">'.$row["firstname"].' '.$row["surname"].'</td>
			<td data-title="Account type">'.$account_type.'</td>
			<td data-title="Created on">'.$row["created_on"].'</td>
			<td data-title="Updated on">'.$row["updated_on"].'</td>
			</tr>';
	}

	$stmt1->close();
	?>
	</tbody>

	</table>
	</section>

  	</div><!-- /panel-body -->
    </div><!-- /panel-collapse -->
	</div><!-- /panel-default -->

    </div><!-- /panel-group -->

    </div><!-- /container -->
	
	<?php include 'includes/footers/footer.php'; ?>
		
    <!-- Sign Out (Inactive) JS -->
    <script src="../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>
	
	<?php else : ?>

    <?php include 'includes/menus/menu.php'; ?>

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

    <?php include 'includes/footers/footer.php'; ?>

	<?php endif; ?>

	<?php include 'assets/js-paths/common-js-paths.php'; ?>
    <?php include 'assets/js-paths/tilejs-js-path.php'; ?>
    <?php include 'assets/js-paths/datatables-js-path.php'; ?>

    <script>

    //Ladda
    Ladda.bind('.ladda-button', {timeout: 2000});

	//DataTables
    $('.table-custom').dataTable({
        "iDisplayLength": 10,
		"paging": true,
		"ordering": true,
		"info": false,
		"language": {
			"emptyTable": "There are no users to display."
		}
	});

	//Deactivate record
	$("body").on("click", ".deactivate-button", function(e) {
    e.preventDefault();

	var clickedID = this.id.split('-');
    var userToDeactivate = clickedID[1];

	jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/processes.php",
	dataType:"text",
	data:'userToDeactivate='+ userToDeactivate,
	success:function(){
		$('#user-'+userToDeactivate).fadeOut();
        $('.form-logo i').removeClass('fa-trash');
        $('.form-logo i').addClass('fa-check-square-o');
        $('#deactivate-question').hide();
        $('#deactivate-confirmation').show();
        $('#deactivate-hide').hide();
        $('#deactivate-success-button').show();
        $("#deactivate-success-button").click(function () {
            location.reload();
        });
    },
	error:function (xhr, ajaxOptions, thrownError){
		$("#success").hide();
		$("#error").show();
		$("#error").empty().append(thrownError);
	}

	});
    });

    //Reactivate record
	$("body").on("click", ".reactivate-button", function(e) {
    e.preventDefault();

	var clickedID = this.id.split('-');
    var userToReactivate = clickedID[1];

	jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/processes.php",
	dataType:"text",
	data:'userToReactivate='+ userToReactivate,
	success:function(){
		$('#user-'+userToReactivate).fadeOut();
        $('.form-logo i').removeClass('fa-trash');
        $('.form-logo i').addClass('fa-check-square-o');
        $('#reactivate-question').hide();
        $('#reactivate-confirmation').show();
        $('#reactivate-hide').hide();
        $('#reactivate-success-button').show();
        $("#reactivate-success-button").click(function () {
            location.reload();
        });
    },
	error:function (xhr, ajaxOptions, thrownError){
		$("#success").hide();
		$("#error").show();
		$("#error").empty().append(thrownError);
	}

	});
    });

    //Delete record
	$("body").on("click", ".delete-button", function(e) {
    e.preventDefault();

	var clickedID = this.id.split('-');
    var userToDelete = clickedID[1];

	jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/processes.php",
	dataType:"text",
	data:'userToDelete='+ userToDelete,
	success:function(){
		$('#user-'+userToDelete).fadeOut();
        $('.form-logo i').removeClass('fa-trash');
        $('.form-logo i').addClass('fa-check-square-o');
        $('#delete-question').hide();
        $('#delete-confirmation').show();
        $('#delete-hide').hide();
        $('#delete-success-button').show();
        $("#delete-success-button").click(function () {
            location.reload();
        });
    },
	error:function (xhr, ajaxOptions, thrownError){
		$("#success").hide();
		$("#error").show();
		$("#error").empty().append(thrownError);
	}

	});
    });
    </script>

</body>
</html>

<?php
include 'includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php include 'assets/js-paths/pacejs-js-path.php'; ?>

	<?php include 'assets/meta-tags.php'; ?>

	<?php include 'assets/css-paths/datatables-css-path.php'; ?>
	<?php include 'assets/css-paths/common-css-paths.php'; ?>
	<?php include 'assets/css-paths/calendar-css-path.php'; ?>

    <title>Student Portal | Messenger</title>

</head>

<body>
<div class="preloader"></div>

	<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>

	<?php include 'includes/menus/portal_menu.php'; ?>

	<div id="library-portal" class="container">

	<ol class="breadcrumb">
    <li><a href="../overview/">Overview</a></li>
	<li class="active">Messenger</li>
    </ol>

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	<div class="panel panel-default">

	<?php
	$stmt1 = $mysqli->query("SELECT userid FROM user_signin WHERE userid IS NOT '$userid'");
	while($row = $stmt1->fetch_assoc()) {

	$userid1 = $row["userid"];

 	echo '<form id="message-user-form-'.$userid1.'" style="display: none;" action="/messenger/message-user/" method="POST">
		<input type="hidden" name="recordToMessage" id="recordToMessage" value="'.$userid1.'"/>
		</form>';
	}
	$stmt1->close();
	?>

    <div class="panel-heading" role="tab" id="headingOne">
  	<h4 class="panel-title">
	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Books - click to minimize or maximize</a>
  	</h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
  	<div class="panel-body">

	<!-- Books -->
	<section id="no-more-tables">
	<table class="table table-condensed table-custom books-table">

	<thead>
	<tr>
	<th>Name</th>
	<th>Author</th>
	<th>Notes</th>
	<th>Available</th>
	<th>Reserve</th>
	</tr>
	</thead>

	<tbody>
	<?php

	$stmt2 = $mysqli->query("SELECT user_signin.userid, user_signin.email, user_details.firstname, user_details.surname, user_details.studentno FROM user_signin ON user_signin.userid=user_details.userid WHERE user_signin.userid IS NOT '$userid'");

	while($row = $stmt2->fetch_assoc()) {

	$userid2 = $row["userid"];
	$email = $row["email"];
	$firstname = $row["firstname"];
	$surname = $row["surname"];
    $studentno = $row["studentno"];

	echo '<tr id="book-'.$userid.'">

			<td data-title="Name">'.$firstname.'</td>
			<td data-title="Surname">'.$surname.'</td>
			<td data-title="Student number">'.$studentno.'</td>
			<td data-title="Email address">'.$email.'</td>
			<td id="message-hide" data-title="Reserve"><a id="message-'.$userid2.'" class="message-button"><i class="fa fa-envelope"></i></a></td>
			</tr>';
	}

	$stmt2->close();
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
	$(document).ready(function () {

	//DataTables
    $('.user-table').dataTable({
        "iDisplayLength": 10,
		"paging": true,
		"ordering": true,
		"info": false,
		"language": {
			"emptyTable": "There are no books to display at the moment."
		}
	});

	//Book event form submit
	$("body").on("click", ".reserve-button", function(e) {
    e.preventDefault();

	var clickedID = this.id.split('-');
    var DbNumberID = clickedID[1];

	$("#reserve-book-form-" + DbNumberID).submit();

	});

	});
	</script>

</body>
</html>

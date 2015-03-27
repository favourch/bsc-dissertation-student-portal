<?php
include '../includes/session.php';

if (isset($_GET["id"])) {

    $eventToUpdate = $_GET["id"];

    $stmt1 = $mysqli->prepare("SELECT eventid, event_name, event_notes, event_url, DATE_FORMAT(event_from,'%d/%m/%Y %H:%i') as event_from, DATE_FORMAT(event_to,'%d %b %y %H:%i') as event_to, event_amount, event_ticket_no FROM system_event WHERE eventid = ? LIMIT 1");
    $stmt1->bind_param('i', $eventToUpdate);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($eventid, $event_name, $event_notes, $event_url, $event_from, $event_to, $event_amount, $event_ticket_no);
    $stmt1->fetch();
    $stmt1->close();

} else {
    header('Location: ../../events/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<?php include '../assets/meta-tags.php'; ?>

    <?php include '../assets/css-paths/select2-css-path.php'; ?>
    <?php include '../assets/css-paths/common-css-paths.php'; ?>
    <?php include '../assets/css-paths/datetimepicker-css-path.php'; ?>

    <title>Student Portal | Update event</title>
	
</head>

<body>

	<div class="preloader"></div>

	<?php if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) : ?>
	
    <?php if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'administrator') : ?>

	<?php include '../includes/menus/portal_menu.php'; ?>

	<div id="admin-timetable-portal" class="container">

    <ol class="breadcrumb breadcrumb-custom">
    <li><a href="../../overview/">Overview</a></li>
	<li><a href="../../events/">Events</a></li>
    <li class="active">Update event</li>
    </ol>

    <!-- Update event -->
	<form class="form-horizontal form-custom" style="max-width: 100%;" name="updateevent_form" id="updateevent_form" novalidate>

    <p id="error" class="feedback-sad text-center"></p>
	<p id="success" class="feedback-happy text-center"></p>

	<div id="hide">

    <input type="hidden" name="eventid" id="eventid" value="<?php echo $eventid; ?>">

	<div class="form-group">
	<div class="col-xs-12 col-sm-12 full-width">
	<label>Name</label>
    <input class="form-control" type="text" name="event_name" id="event_name" value="<?php echo $event_name; ?>" placeholder="Enter a name">
	</div>
    </div>
	<p id="error1" class="feedback-sad text-center"></p>

    <div class="form-group">
	<div class="col-xs-12 col-sm-12 full-width">
	<label>Notes</label>
    <textarea class="form-control" rows="5" name="event_notes" id="event_notes" placeholder="Enter notes"><?php echo $event_notes; ?></textarea>
	</div>
    </div>

	<div class="form-group">
	<div class="col-xs-12 col-sm-12 full-width">
	<label>URL</label>
    <input class="form-control" type="text" name="event_url" id="event_url" value="<?php echo $event_url; ?>" placeholder="Enter a URL">
	</div>
    </div>

	<div class="form-group">
	<div class="col-xs-6 col-sm-6 full-width">
	<label>From</label>
	<input type="text" class="form-control" name="event_from" id="event_from" value="<?php echo $event_from; ?>" placeholder="Select a date and time">
	</div>
	<div class="col-xs-6 col-sm-6 full-width">
	<label>To</label>
	<input type="text" class="form-control" name="event_to" id="event_to" value="<?php echo $event_to; ?>" placeholder="Select a date and time">
	</div>
	</div>

    <div class="form-group">
	<div class="col-xs-6 col-sm-6 full-width">
	<label>Price</label>
	<input type="text" class="form-control" name="event_amount" id="event_amount" value="<?php echo $event_amount; ?>" placeholder="Enter an amount">
	</div>
	<div class="col-xs-6 col-sm-6 full-width">
	<label>Ticket amount</label>
	<input type="text" class="form-control" name="event_ticket_no" id="event_ticket_no" value="<?php echo $event_ticket_no; ?>" placeholder="Enter a number">
	</div>
	</div>

	<hr>

    <div class="text-center">
    <button id="FormSubmit" class="btn btn-primary btn-lg ladda-button" data-style="slide-up"><span class="ladda-label">Update event</span></button>
    </div>

    </div>
	
    </form>
    <!-- End of Update book -->

	</div> <!-- /container -->
	
	<?php include '../includes/footers/footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../../assets/js/custom/sign-out-inactive.js"></script>

    <?php else : ?>

	<?php include '../includes/menus/portal_menu.php'; ?>

    <div class="container">

    <form class="form-horizontal form-custom">

	<div class="form-logo text-center">
    <i class="fa fa-graduation-cap"></i>
    </div>

    <hr>
	<p class="feedback-sad text-center">You need to have an admin account to access this area.</p>
    <hr>

    <div class="text-center">
    <a class="btn btn-primary btn-lg ladda-button" data-style="slide-up" href="/overview/"><span class="ladda-label">Overview</span></a>
    </div>

    </form>
    
	</div>

	<?php include '../includes/footers/footer.php'; ?>

    <!-- Sign Out (Inactive) JS -->
    <script src="../../assets/js/custom/sign-out-inactive.js"></script>

    <?php endif; ?>
	<?php else : ?>

	<?php include '../includes/menus/menu.php'; ?>

    <div class="container">
	
    <form class="form-horizontal form-custom">

	<div class="form-logo text-center">
    <i class="fa fa-graduation-cap"></i>
    </div>

    <hr>
    <p class="feedback-sad text-center">Looks like you're not signed in yet. Please Sign in before accessing this area.</p>
    <hr>

    <div class="text-center">
    <a class="btn btn-primary btn-lg ladda-button" data-style="slide-up" href="/"><span class="ladda-label">Sign in</span></a>
	</div>
	
    </form>

    </div>

	<?php include '../includes/footers/footer.php'; ?>

	<?php endif; ?>

    <?php include '../assets/js-paths/common-js-paths.php'; ?>
    <?php include '../assets/js-paths/select2-js-path.php'; ?>
	<?php include '../assets/js-paths/datetimepicker-js-path.php'; ?>

	<script>

	//Ladda
	Ladda.bind('.ladda-button', {timeout: 2000});

    // Date Time Picker


    //Ajax call
    $("#FormSubmit").click(function (e) {
    e.preventDefault();

	var hasError = false;

    //Events
    var eventid = $("#eventid").val();

	var event_name = $("#event_name").val();
	if(event_name === '') {
		$("#error1").show();
        $("#error1").empty().append("Please enter a name.");
		hasError  = true;
		return false;
    } else {
		$("#error1").hide();
	}

    var event_notes = $("#event_notes").val();
    var event_url = $("#event_url").val();

    var event_from = $("#event_from").val();
	if(event_from === '') {
		$("#error2").show();
        $("#error2").empty().append("Please select a date and time.");
		hasError  = true;
		return false;
    } else {
		$("#error2").hide();
	}

    var event_to = $("#event_to").val();
	if(event_to === '') {
		$("#error2").show();
        $("#error2").empty().append("Please select a date and time.");
		hasError  = true;
		return false;
    } else {
		$("#error2").hide();
	}

    var event_amount = $("#event_amount").val();
	if(event_amount === '') {
		$("#error2").show();
        $("#error2").empty().append("Please enter a price.");
		hasError  = true;
		return false;
    } else {
		$("#error2").hide();
	}

    var event_ticket_no = $("#event_ticket_no").val();
	if(event_ticket_no === '') {
		$("#error2").show();
        $("#error2").empty().append("Please enter a number.");
		hasError  = true;
		return false;
    } else {
		$("#error2").hide();
	}

    var event_category = $("#event_category option:selected").val();

	if(hasError == false){
    jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/processes.php",
    data:'eventid1='          + eventid +
         '&event_name1='       + event_name +
         '&event_notes1='     + event_notes +
         '&event_url1='       + event_url +
         '&event_from1='      + event_from +
         '&event_to1='        + event_to +
         '&event_amount1='    + event_amount +
         '&event_ticket_no1=' + event_ticket_no +
         '&event_category1='  + event_category,

    success:function(){
		$("#error").hide();
		$("#hide").hide();
		$("#success").show();
		$("#success").empty().append('Event updated successfully.');
	},
    error:function (xhr, ajaxOptions, thrownError){
		$("#success").hide();
		$("#error").show();
        $("#error").empty().append(thrownError);
    }
	});
    }

	return true;

	});
	</script>

</body>
</html>

<?php
include '../includes/session.php';

if (isset($_POST["recordToMessage"])) {

    $idToMessage = filter_input(INPUT_POST, 'recordToMessage', FILTER_SANITIZE_NUMBER_INT);

    $stmt1 = $mysqli->prepare("SELECT user_signin.userid, user_signin.email, user_details.studentno, user_details.firstname, user_details.surname FROM user_signin LEFT JOIN user_details ON user_signin.userid=user_details.userid WHERE user_signin.userid = ? LIMIT 1");
    $stmt1->bind_param('i', $userid);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($userid1, $email1, $studentno1, $firstname1, $surname1);
    $stmt1->fetch();

    $stmt1 = $mysqli->prepare("SELECT user_signin.userid, user_signin.email, user_details.studentno, user_details.firstname, user_details.surname FROM user_signin LEFT JOIN user_details ON user_signin.userid=user_details.userid WHERE user_signin.userid = ? LIMIT 1");
    $stmt1->bind_param('i', $idToMessage);
    $stmt1->execute();
    $stmt1->store_result();
    $stmt1->bind_result($userid2, $email2, $studentno2, $firstname2, $surname2);
    $stmt1->fetch();

} else {
    header('Location: ../../messenger/');
}

?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <?php include '../assets/js-paths/pacejs-js-path.php'; ?>

    <?php include '../assets/meta-tags.php'; ?>

    <title>Student Portal | Message a user</title>

    <?php include '../assets/css-paths/common-css-paths.php'; ?>

</head>

<body>

	<div class="preloader"></div>

	<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>

    <?php include '../includes/menus/portal_menu.php'; ?>

	<div id="messenger-portal" class="container">

    <ol class="breadcrumb">
    <li><a href="../../overview/">Overview</a></li>
	<li><a href="../../messenger/">Messenger</a></li>
    <li class="active">Message a user</li>
    </ol>

	<!-- Message user -->
    <form class="form-custom" style="max-width: 100%;" method="post" name="messageuser_form" id="messageuser_form" novalidate>

    <p id="success" class="feedback-happy text-center"></p>
    <p id="error" class="feedback-sad text-center"></p>

    <div id="hide">
    <input type="hidden" name="userid" id="userid" value="<?php echo $userid1; ?>">

    <h4>From</h4>
    <hr>

    <div class="form-group">
    <div class="col-xs-4 col-sm-4 full-width pl0">
    <label>First name</label>
    <input class="form-control" type="text" name="firstname1" id="firstname1" value="<?php echo $firstname1; ?>" readonly="readonly">
	</div>
    <div class="col-xs-4 col-sm-4 full-width pr0 pl0">
    <label>Surname</label>
    <input class="form-control" type="text" name="surname1" id="surname1" value="<?php echo $surname1; ?>" readonly="readonly">
    </div>
    <div class="col-xs-4 col-sm-4 full-width pr0 pl0">
    <label>Email address</label>
    <input class="form-control" type="email" name="email1" id="email1" value="<?php echo $email1; ?>" readonly="readonly">
	</div>
    </div>

    <h4>To</h4>
    <hr>

    <div class="form-group">
    <div class="col-xs-4 col-sm-4 full-width pl0">
    <label>First name</label>
    <input class="form-control" type="text" name="firstname2" id="firstname2" value="<?php echo $firstname2; ?>" readonly="readonly">
	</div>
    <div class="col-xs-4 col-sm-4 full-width pr0 pl0">
    <label>Surname</label>
    <input class="form-control" type="text" name="surname2" id="surname2" value="<?php echo $surname2; ?>" readonly="readonly">
    </div>
    <div class="col-xs-4 col-sm-4 full-width pr0 pl0">
    <label>Email address</label>
    <input class="form-control" type="email" name="email2" id="email2" value="<?php echo $email2; ?>" readonly="readonly">
	</div>
    </div>

    <hr>

    <div class="col-xs-12 col-sm-12 full-width pr0 pl0">
    <label>Subject</label>
    <input class="form-control" type="text" name="subject" id="subject">
	</div>
    </div>

    <div class="form-group">
    <div class="col-xs-12 col-sm-12 full-width pr0 pl0">
    <label>Message</label>
    <textarea class="form-control" rows="5" name="message" id="message"></textarea>
    </div>
    </div>

    <hr class="hr-custom">

    <div class="text-center">
    <button id="FormSubmit" class="btn btn-primary btn-lg ladda-button" data-style="slide-up"><span class="ladda-label">Mesasge user</span></button>
	</div>

    </div>

    </form>
    <!-- End of Book event -->

    </div><!-- /container -->

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
    $(document).ready(function () {

    //Ladda
    Ladda.bind('.ladda-button', {timeout: 2000});

    //Pay course fees form submit
    $("#FormSubmit").click(function (e) {
    e.preventDefault();

    var userid = $("#userid2").val();
    var firstname = $("#firstname2").val();
    var surname = $("#surname2").val();
    var email = $("#email2").val();
    var message = $("#message").val();
    var subject = $("#subject").val();

    jQuery.ajax({
	type: "POST",
	url: "https://student-portal.co.uk/includes/processes.php",
    data:'userid=' + userid + '&firstname=' + firstname + '&surname=' + surname + '&email=' + email + '&message=' + message + '&subject=' + subject,
    success:function(){
        $("#error").hide();
        $("#hide").hide();
        $("#success").empty().append('Message sent successfully.');
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

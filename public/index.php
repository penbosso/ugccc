<?php 
    include("../includes/initialize.php");
    //gets the content of the $_GET['page'] variable in to a variable $page
    $page = isset($_GET['page']) ? $_GET['page'] : "sessions";
    
    //TODO:: change to get the id of currently logged in user
    $user_id=2;

    //defines the path to the requested page's content
    switch ($page) {
        case 'make_announcement':
            $content = "contents/make_announcement.php";
            $class_ma="active";
            break;
        
        case 'register_student':
            $content = "contents/register_student.php";
            $class_rs="active";
            break;

        case 'book_session':
            $content = "contents/book_session.php";
            $class_bs="active";
            break;

        case 'sessions':
        default:
            $content = "contents/session_list.php";
            $class_s="active";
            break;
    }  
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Paper Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text">
                    UG-CCC
                </a>
            </div>

            <ul class="nav">
                <li class="<?php echo $class_ma; ?>">
                    <a href="?page=make_announcement">
                        <i class="ti-panel"></i>
                        <p>Make Announcement</p>
                    </a>
                </li>
                <li class="<?php echo $class_rs; ?>">
                    <a href="?page=register_student">
                        <i class="ti-user"></i>
                        <p>Register Student</p>
                    </a>
                </li>
                <li class="<?php echo $class_s; ?>">
                    <a href="?page=sessions">
                        <i class="ti-view-list-alt"></i>
                        <p>Session List</p>
                    </a>
                </li>
                <li class="<?php echo $class_bs; ?>">
                    <a href="?page=book_session">
                        <i class="ti-view-list-alt"></i>
                        <p>Book Session</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Make Announcement</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-panel"></i>
								<p>Stats</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-bell"></i>
                                    <p class="notification">5</p>
									<p>Notifications</p>
									<b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
						<li>
                            <a href="#">
								<i class="ti-settings"></i>
								<p>Settings</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <?php 
                $status = isset($_GET["status"]) ? $_GET["status"] : "";
                
                switch ($status) {
                    case "0":
                        output_message("operation successful", $class="success");
                        break;
                    
                    case "1":
                        output_message("operation failed", $class = "fail");
                        break;
                    
                    default:
                    break;
                }
            ?>
            <?php  include($content); ?>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>

                        <li>
                            <a href="http://www.creative-tim.com">
                                Creative Tim
                            </a>
                        </li>
                        <li>
                            <a href="http://blog.creative-tim.com">
                               Blog
                            </a>
                        </li>
                        <li>
                            <a href="http://www.creative-tim.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>
                </div>
            </div>
        </footer>

    </div>
</div>

            <!--Start Session modal-->
            <div class="modal fade" id="start_sess_modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                        <form method="POST" action="../includes/actions/start_counsel_session.php">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="defaultModalLabel">Start Session</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Are you sure you want to start this session?</h5>
                                                    <input type="hidden" name="complaint_id" id="complaint_id" value=""/>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="" id="approve_appt_confirm">CONFIRM</button>
                                                    <button type="button" class="" data-dismiss="modal">CLOSE</button>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
            </div>
    
            <!--End Session modal-->
            <div class="modal fade" id="end_sess_modal" class="" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <form method="POST" action="../includes/actions/end_counsel_session.php">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="defaultModalLabel">End Session</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>Are you sure you want to end this session?</h5>
                                                    <input type="hidden" name="complaint_id" id="complaint_id" value=""/>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="" id="approve_appt_confirm">CONFIRM</button>
                                                    <button type="button" class="" data-dismiss="modal">CLOSE</button>
                                                </div>
                                                </form>
                                        </div>
                                        </div>
            </div>
    
            <!--Remove Booking Session modal-->
            <div class="modal fade" id="remove_sess_modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="defaultModalLabel">Remove Booking Session</h4>
                                                </div>
                                                <form method="POST" action="../includes/actions/remove_booking_session.php">
                                                <div class="modal-body">
                                                    <h5>Are you sure you want to remove this session?</h5>
                                                    <input type="hidden" name="booking_id" id="assign_counsellor_id" value=""/>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="" id="approve_appt_confirm">CONFIRM</button>
                                                    <button type="button" class="" data-dismiss="modal">CLOSE</button>
                                                </div>
                                                </form>
                                        </div>
                                        </div>
            </div>
    
            <!--Add Booking Session modal-->
            <div class="modal fade" id="add_sess_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Add Booking Session</h4>
                        </div>
                        <div class="modal-body">
                                <form method="POST" action="../includes/actions/book_period.php">
                                    <!--div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="date" class="form-control border-input" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Location</label>
                                                <input type="text" class="form-control border-input" >
                                            </div>
                                        </div>
                                    </div-->
                                    <input type="hidden" name="assign_counsellor_id" id="assign_counsellor_id" value=""/>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Available Time</label>
                                                <select name="scheduled_date">
                                                <?php 
                                                    $sql = "SELECT c.* FROM counsellor c JOIN user u ON c.user_id=u.id "
                                                    ."WHERE u.id='$user_id'";
                                                   
                                                    $object = Counsellor::find_by_sql($sql);
                                                    $counsellor = array_shift($object);
                                                    $available_bookings = Counsellor::get_available_booking($counsellor->id);
                                                    
                                                        
                                                    foreach ($available_bookings as $available_booking) {
                                                 ?>
                                                    <option value="<?php echo $available_booking; ?>"><?php echo strftime("%a %d, %b %Y %H:%M GMT",$available_booking); ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <!--div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Short Description</label>
                                                <textarea rows="5" class="form-control border-input" placeholder="Here can be your description"></textarea>
                                            </div>
                                        </div>
                                    </div-->
                                    <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="" id="approve_appt_confirm">CONFIRM</button>
                            <button type="button" class="" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    
            <!--Refer Session modal-->
            <div class="modal fade" id="refer_sess_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Refer Session</h4>
                        </div>
                        <div class="modal-body">
                                <form method="POST" action="../includes/actions/refer_session.php">
                                    <!--div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input type="date" class="form-control border-input" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Location</label>
                                                <input type="text" class="form-control border-input" >
                                            </div>
                                        </div>
                                    </div-->
                                      <input type="hidden" name="complaint_id" id="complaint_id" value=""/>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Counsellor</label>
                                                <select name="counsel_id">
                                                <?php 
                                                    $sql = "SELECT c.* FROM counsellor c JOIN user u ON c.user_id = u.id"
                                                          ." WHERE NOT u.id='$user_id'";
                                                    $counsellors = Counsellor::find_by_sql($sql);
                                                    foreach ($counsellors as $counsellor ) {
                                                        $counsellor_details = User::find_by_id($counsellor->user_id);
                                                        $display_name = ucwords($counsellor_details->title." "
                                                                                .$counsellor_details->first_name." "
                                                                                .$counsellor_details->other_names." "
                                                                                .$counsellor_details->last_name);
                                                ?>
                                                    <option value="<?php echo $counsellor->id; ?>"><?php echo $display_name; ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="" id="approve_appt_confirm">CONFIRM</button>
                            <button type="button" class="" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <!--script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script-->
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<!--cript src="assets/js/chartist.min.js"></script-->

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script-->

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

        	//demo.initChartist();

        	$.notify({
            	icon: 'ti-gift',
            	message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for your next project."

            },{
                type: 'success',
                timer: 4000
            });

    	});

        $(document).ready(function () {
            window.setTimeout(function() {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove(); 
                });
            }, 5000);
        });

        $(document).on("click", ".startModal", function () {
            var myBookId = $(this).data('id');
            $("#start_sess_modal #complaint_id").val( myBookId );
        });

        $(document).on("click", ".endModal", function () {
            var myBookId = $(this).data('id');
            $("#end_sess_modal #complaint_id").val( myBookId );
        });

        $(document).on("click", ".referModal", function () {
            var myBookId = $(this).data('id');
            $("#refer_sess_modal #complaint_id").val( myBookId );
        });

         $(document).on("click", ".addModal", function () {
            var myBookId = $(this).data('id');
            $("#add_sess_modal #assign_counsellor_id").val( myBookId );
        });

        $(document).on("click", ".removeModal", function () {
            var myBookId = $(this).data('id');
            $("#remove_sess_modal #assign_counsellor_id").val( myBookId );
        });
	</script>

</html>

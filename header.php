<?php
session_start();

  require_once 'functions.php';

  $userstr = ' (Guest)';

  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
  }
  else $loggedin = FALSE;

echo <<<_END
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Courseware™</title>

    <!-- Bootstrap -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/moveme.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
    <script>

function sendRequest(u){
var obj=$.ajax({url:u,async:false});
var result=$.parseJSON(obj.responseText);
return result;	//return object
}

function profSearch(){
var search_text=txtSearch.value;
var strUrl="respond.php?cmd=2&id="+search_text;
var objResult=sendRequest(strUrl);
if(objResult.result==0){
$("#divStatus").text(objResult.message);
$('#divStatus').css({opacity: 0});
$('#divStatus').animate({opacity: 1}, 700 );
return;
}
if(objResult.courses.length <1){
$("#divStatus").text('Returned null set');
$('#divStatus').css({opacity: 0});
$('#divStatus').animate({opacity: 1}, 700 );
return;
}

displayCourse(objResult.courses);
$("#divStatus").text('Stay Tuned!');
}

function getProfProfile(id){
		var theUrl="respond.php?cmd=4&id="+id;
		var objResult=sendRequest(theUrl);
		if(!objResult.result==0)	{
			$("#divStatus").text('Error while getting Professor Profile');
			 $('#divStatus').css({opacity: 0});
             $('#divStatus').animate({opacity: 1}, 700 );
            return;
		}
        displayProfile(objResult);
}

function courseDetail(id){
		var theUrl="respond.php?cmd=3&id="+id;
		var objResult=sendRequest(theUrl);		//send request to the above url
		if(objResult.result==0){
        $("#divStatus").text('Error');
        $('#divStatus').css({opacity: 0});
        $('#divStatus').animate({opacity: 1}, 700 );
            return;
        }else{
            display_one_Course(objResult);
        }
}

function display_one_Course(theProducts){
old_th = document.getElementById("old_th");
var nh= "";
nh = nh +"<tr><td><h2>Course Details</h2></td></tr>";
old_tbody =document.getElementById("old_tbody");
var newcontent = "";
newcontent = newcontent +"<tr><td>Title</td><td>"+theProducts['title']+"</td></tr><tr><td>Objective</td><td>"+theProducts['objective']+"</td></tr><tr><td>Topics</td><td>"+theProducts['topics']+"</td></tr><tr><td>References</td><td>"+theProducts['course_references']+"</td></tr><tr><td>Prerequisite(s)</td><td>"+theProducts['prerequisite']+"</td></tr><tr><td>Time Frame</td><td>"+theProducts['time_frame']+"</td></tr><tr><td>Assessment</td><td>"+theProducts['assessment']+"</td></tr>";
$("#old_nh").html(nh);
$("#old_tbody").html(newcontent);	
}
	

	function displayProfile(profile){
			old_tbody =document.getElementById("old_tbody");
            var nh= "";
            nh = nh +"<tr><td><h2>Profile Information</h2></td></tr>";
			var prof = "";
			prof += "<tr><td>First Name</td><td>"+profile['first_name']+"</td></tr>";
			prof += "<tr><td>Last Name</td><td>"+profile['last_name']+"</td></tr>";
			prof += "<tr><td>Email</td><td>"+profile['email']+"</td></tr>";
			prof += "<tr><td>Qualifications</td><td>"+profile['qualifications']+"</td></tr>";
			prof += "<tr><td>Faculty</td><td>"+profile['faculty_id']+"</td></tr>";
            $("#old_nh").html(nh);
            $("#old_tbody").html(prof);
	}

function displayCourse(theProducts){
old_tbody = document.getElementById("old_tbody");
var nh= "";
nh = nh +"<tr><td>Professor ID</td><td>First Name</td><td>Last Name</td><td>Course Title</td><td>Course Objective</td><td>Faculty</td></tr>";
var newcontent = "";
for(i=0;i<theProducts.length;i++){
newcontent = newcontent +"<tr><td>"+theProducts[i]['first_name']+"</td><td>"+theProducts[i]['first_name']+"</td><td>"+theProducts[i]['last_name']+"</td><td>"+theProducts[i]['title']+"</td><td>"+theProducts[i]['objective']+"</td><td>"+theProducts[i]['faculty_name']+"</td></tr>";
}
$("#old_nh").html(nh);
$("#old_tbody").html(newcontent);

			
}
</script>
  </head>
  <body>
_END;

  if ($loggedin)
  {
echo <<<_END
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><span class='glyphicon glyphicon-education' aria-hidden='true'></span></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="home.php?view=$user">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <form class="navbar-form navbar-right">
  <div class="form-group">
    <input type="text" class="form-control" id="txtSearch" placeholder="Search">
  </div>
  <button type="button" onclick="profSearch()" class="btn btn-default">Search</button>
</form>

                </ul>
            </div>
            

      </nav>
            <div id="divStatus">Stay Tuned!</div>
      
      <!-- End Navigation -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
_END;
}
      
  else
  {
      echo "Please enter right details";
  }                                                                                  
?>
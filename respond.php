<?php
require_once 'functions.php';
//type of request
//1: get description of product
//2: delete product
//3: edit price
if(!isset($_REQUEST['cmd'])){
	echo '{"result":0,message:"unknown command"}';
	exit();
}
$cmd=$_REQUEST['cmd'];
switch($cmd)
{
	case 1:
		search_course();	
		break;
	case 2:
		search_id();
		break;
	case 3:
		course_detail();
		break;
	case 4:
	prof_profile();
		break;
    
    case 5:
        delete_course();
        break;
	default:
		echo '{"result":0,message:"unknown command"}';
		break;
}


function delete_course(){
	include("course.php");
	$obj=new course();
	$id=$_REQUEST['id'];
	if($obj->delete_course($id)){
		echo '{"result":1,"message": "deleted course"}';
	}else{
		echo '{"result":0,"message": "course not removed."}';
	}
	break;
}	

function search_course(){
	if(!isset($_REQUEST['id'])){
		//return error
		echo '{"result":0,"message": "search did not work."}';
	}
	$search_text=$_REQUEST['id'];
	include("course.php");
	$obj=new course();
	if(!$obj->get_row($search_text)){
		//return error
		echo '{"result":0,"message": "could not fetch desc"}';
		return;
	}
	//at this point the search has been successful. 
	//generate the JSON message to echo to the browser
	$row=$obj->fetch();
	echo '{"result":1,"courses":[';	//start of json object
	while($row){
		echo json_encode($row);			//convert the result array to json object
		$row=$obj->fetch();
		if($row){
			echo ",";					//if there are more rows, add comma 
		}
	}
	echo "]}";							//end of json array and object
}

function search_id(){
	if(!isset($_REQUEST['id'])){
		//return error
		echo '{"result":0,"message": "search did not work."}';
	}
	$search_id=$_REQUEST['id'];
	include("Professor.php");
	$obj=new Professor();
	if(!$obj->fill_table_dynamic($search_id)){
		//return error
		echo '{"result":0,"message": "search did not work."}';
		return;
	}
	//at this point the search has been successful. 
	//generate the JSON message to echo to the browser
	$data=$obj->fill_table_dynamic($search_id);
    $row=mysqli_fetch_assoc($data);
	echo '{"result":1,"courses":[';	//start of json object
	while($row){
		echo json_encode($row);			//convert the result array to json object
		$row=mysqli_fetch_assoc($data);
		if($row){
			echo ",";					//if there are more rows, add comma 
		}
	}
	echo "]}";							//end of json array and object
}

function prof_profile(){
	$id = $_REQUEST['id'];
	include ("Professor.php");
	$obj=new professor();
	if(!$obj->get_professor($id)){
		echo '{"result":0, "message": "Could not get Professor profile"}';
		return;
	}	
	$data=$obj->get_professor($id);
    $row=mysqli_fetch_assoc($data);
	echo json_encode($row);
}

//course details
function course_detail(){
    $id = $_REQUEST['id'];
	include ("Professor.php");
	$obj=new Professor();
	if(!$obj->get_row($id)){
		echo '{"result":0, "message": "Could not get Course details"}';
		return;
	}
	$data=$obj->get_row($id);
	$row= mysqli_fetch_assoc($data);	
	echo json_encode($row);
	}

?>
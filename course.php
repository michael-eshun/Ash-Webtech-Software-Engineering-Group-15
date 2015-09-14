<?php
	include_once("adb.php");
	class course extends adb{

		function create_course($course_title, $fac_id, $prof_id, $obj, $top, $ref, $time, $prq, $ass){
			$str_query="insert into Course set title='$course_title', faculty_id='$fac_id', professor_id='$prof_id',
				objective='$obj', topics='$top', course_references='$ref', time_frame='$time', prerequisite='$prq', assessment='$ass'";
			return $this->query($str_query);
		}

		function delete_course($course_id){
			$str_query="delete from Course where course_id='$id'";
			return $this->query($str_query);
		}

		function get_row($id){
			$str_query="select title, objective, topics, course_references, prerequisite, time_frame, 
			assessment, faculty_id, professor_id from Course where course_id='$id'"; 
			return $this->query($str_query);
		}

		function get_all(){
			$str_query="select title, objective, topics, course_preferences, prerequisite, time_frame,
				assessment, faculty_id, professor_id, from Course";
			return $this->query($str_query);
		}
        

		function search_faculty($search){
			$str_query="select title, objective, topics, course_preferences, prerequisite, time_frame, assessment, faculty_id, 
				professor_id, from Course where title like '%$search%' or objective like '%$search%' or topic like '%$search%' 
				or course_preferences like '%$search%' or time_frame like '%$search%' or Prerequisite like '%$search%' or 
				assessment like '%$search%'";
			return $this->query($str_query);
		}
	}
?>
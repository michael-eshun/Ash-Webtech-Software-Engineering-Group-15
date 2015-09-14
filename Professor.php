<?php
require_once 'adb.php';
require_once 'course.php';
require_once 'functions.php';
class Professor{
    public $course;
    public $user;
    public $professor_id;
    public $first_name;
    public $last_name;
	public $name;
	public $email;
	public $qualifications;
	public $username;
	public $password;

	public function __construct(){
			$course = new Course();
		}

	public function get_professor_id(){
		$query = "SELECT professor_id from Credentials WHERE username = '$this->username'";
        $result = queryMysql($query);
		return $result;

	}
    
    public function get_email($email){
        $query = "SELECT professor_id from Professor WHERE email='$email'";
        $result = queryMysql($query);
        return $result;
    }
   public function get_professor_name(){
        $query = "SELECT first_name, last_name from Professor WHERE professor_id = '$this->professor_id'";
        $result = queryMysql($query);
        return $result;
    }
    
    public function get_professor($id){
        $query = "SELECT first_name, last_name, email, qualifications, faculty_id from Professor WHERE professor_id = '$id'";
        $result = queryMysql($query);
        return $result;
    }
    
        function edit($a){
            $str_query="SELECT title, objective, topics, course_references, prerequisite, time_frame, assessment, faculty_id, professor_id from Course WHERE course_id ='$a' ";
            $result = queryMysql($str_query);
			return $result;
        }
    
    public function fill_table(){
        $query = "select Professor.professor_id, first_name, last_name, title, objective, faculty_name, course_id from Professor, Course, Faculty where Professor.professor_id = Course.professor_id AND Professor.faculty_id = Faculty.faculty_id";
        $result = queryMysql($query);
        return $result;
    }
    
        public function fill_table_dynamic($id){
        $query = "select Professor.professor_id, first_name, last_name, title, objective, faculty_name from Professor, Course, Faculty where Professor.professor_id = Course.professor_id AND Professor.faculty_id = Faculty.faculty_id AND Professor.professor_id='$id'";    
        $result = queryMysql($query);
        return $result;
    }



	public function make_course(){
		if (isset($POST['name']) && 
			isset($_POST['description_id']) && 
			isset($_POST['faculty_id']) && 
			isset($_POST['professor_id']) ){
			$get_title = get_post($connection, 'title');
		    $get_description_id = get_post($connection, 'description_id');
		    $get_faculty_id = get_post($connection, 'faculty_id');
		    $this->professor_id = get_post($connection, 'professor_id');
			$result = $course->create_course($get_title, $get_description_id, $get_faculty_id, $this->professor_id);
			if(!$result){ echo "ADD FAILED: $query<br>" .
				$connection->error . "<br><br>";
              }else{
                echo "add success";
            }

		}
	}

	public function edit_course($id){
        global $connection;
        global $name;
		if (isset($_POST['title']) &&
            isset($_POST['faculty']) && 
			isset($_POST['prof']) && 
			isset($_POST['obj']) && 
			isset($_POST['topics']) &&
            isset($_POST['ref']) &&
			isset($_POST['time']) && 
			isset($_POST['pre']) && 
			isset($_POST['assess']) ){
            $get_title= $this->get_post($connection, 'title'); 
		    $get_fac= $this->get_post($connection, 'faculty');   
		    $get_prof = $this->get_post($connection, 'prof');
		    $get_obj = $this->get_post($connection, 'obj');
            $get_topic = $this->get_post($connection, 'topics');
            $get_ref = $this->get_post($connection, 'ref');
            $get_time = $this->get_post($connection, 'time');
            $get_pre = $this->get_post($connection, 'pre');
            $get_assess = $this->get_post($connection, 'assess');
			$this->update_course($id, $get_title, $get_fac, $get_prof, $get_obj, $get_topic, $get_ref, $get_time, $get_pre, $get_assess);
echo <<<_END
                <script>
                $("#divStatus").text("Successfully Edited Course.");
                $('#divStatus').css({opacity: 0});
                $('#divStatus').animate({opacity: 1}, 700 );  
                </script>
_END;
			}
		}

	public function edit_professor(){
			if (isset($_POST['edit_prof']) && 
			isset($_POST['first_name']) && 
			isset($_POST['last_name']) && 
			isset($_POST['email']) && 
			isset($_POST['qualifications']) ){
			$this->first_name = $this->get_post($connection, 'first_name');
		    $this->last_name = $this->get_post($connection, 'last_name');
		    $this->email = $this->get_post($connection, 'email');
		    $this->qualifications = $this->get_post($connection, 'qualifications');
		}
	}
    
    	function add($name, $head){
			$str_query="insert into Faculty set faculty_name='$name', faculty_head='$head'";
			$result = queryMysql($str_query);
			return $result;
		}
    
        public function get_prof(){
        $query = "SELECT professor_id, first_name, last_name, email, qualifications, faculty_id from Professor";
        $result = queryMysql($query);

        return $result;
    }
    
    function update_course($id, $title, $fac_id, $prof_id, $obj, $top, $ref, $time, $prq, $ass){
			$str_query="update Course set title= '$title', faculty_id='$fac_id', professor_id='$prof_id', objective='$obj', topics='$top', course_references='$ref', time_frame='$time', prerequisite='$prq', assessment='$ass'
				where course_id = '$id'";
			return queryMysql($str_query);
		}
    
    public function get_faculty(){
    	$query="select faculty_id, faculty_name from Faculty";
    	$result = queryMysql($query);
        return $result;
    }
    
    public function account($prof,$usr,$pass){
        $query = "INSERT INTO Credentials set professor_id='$prof', username='$usr', password='$pass'";
        $result = queryMysql($query);
        return $result;
    }
    

	public function update_professor(){
		$query = "UPDATE Professor SET first_name = '$this->first_name', last_name = $this->last_name, email = $this->email, qualifications = $this->qualifications WHERE professor_Id = $this->professor_id";
	}
    
    public function addProfessor($fac_id,$fname,$lname,$email,$qual){
    	$query ="insert into Professor set faculty_id='$fac_id', first_name='$fname', last_name='$lname', email='$email',
    		qualifications='$qual'";
    		echo "$query";
   		$result = queryMysql($query);
        return $result;
    }

    public function create_course($course_title, $fac_id, $prof_id, $obj, $top, $ref, $time, $prq, $ass){
		$str_query="insert into Course set title='$course_title', faculty_id='$fac_id', professor_id='$prof_id',
				objective='$obj', topics='$top', course_references='$ref', time_frame='$time', prerequisite='$prq', assessment='$ass'";
   		$result = queryMysql($str_query);
        return $result;
	}



	public function get_post($connection, $var){
        global $connection;
		return $connection->real_escape_string($_POST[$var]);
	}
    
    function get_row($id){
        $str_query="select title, objective, topics, course_references, prerequisite, time_frame, 
        assessment, faculty_id, professor_id from Course where course_id='$id'"; 
        $result = queryMysql($str_query);
        return $result;
		}

}

?>
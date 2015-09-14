<?php
require_once 'header.php';
require_once 'Professor.php';

if (!$loggedin) die();

  if (isset($_GET['view']))
  {
    $user = sanitizeString($_GET['view']);
  }

$prof = new Professor();

$prof -> username = $user;

$id = $prof->get_professor_id();

$row = mysqli_fetch_assoc($id);

$prof-> professor_id = $row['professor_id'];

$name = $prof-> get_professor_name();

$x = mysqli_fetch_assoc($name);

$first = $x['first_name'];
$last = $x['last_name'];


$row = $prof -> fill_table();

$data = mysqli_fetch_assoc($row);
$status = $data['professor_id'];

echo <<<_END
<div class='row coleur' style="clear:both">
<div class='col-sm-1 mid-side' style="clear:both"><h2>Courseware<span class='glyphicon glyphicon-education' aria-hidden='true'></span></h2></div><div class='col-sm-2 left-side' style="clear:both"></div>
<div class='col-sm-9 right-side main' style="clear:both">
  
_END;
  
        if($prof->professor_id == 1){
        echo "<h1>Welcome $first $last<span class = 'admin' >admin</span></h1>";
        echo "<div class = 'edit'><a href='addFaculty.php'><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Add Faculty</a>";
        echo "<a href='addProfessor.php'><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Add Professor</a><a href='addCourse.php'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Add Course</a></div>";
        }else{
            echo "<h1>Welcome $first $last</h1>";}
echo <<<_END
  <table class='table' id='tableProducts'>
    <thead id='old_nh'>      
      <th>Professor ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Course Title</th>
        <th>Course ID</th>
        <th>Course Objective</th>
        <th>Faculty</th>      
    </thead>
_END;

echo "<tbody id='old_tbody'>";
    $style="";
    $i=0;
    while($data){
    echo "<tr $style >";
    echo "<td>{$data['professor_id']}</td>";
    echo "<td>{$data['first_name']}</td>";
    echo "<td>{$data['last_name']}</td>";                               
    echo "<td>{$data['title']}</td>";
    echo "<td>{$data['course_id']}</td>";
    $t=$data['course_id'];
    echo "<td>{$data['objective']}</td>";
    echo "<td>{$data['faculty_name']}</td>";
    echo "<td><a class='btn btn-default btn lg' style='float:right' onclick='courseDetail({$data['course_id']})' >Course Details</a></td>";
    echo "<td><a class='btn btn-primary btn lg' style='float:right' onclick='getProfProfile({$data['professor_id']})' >Prof Details</a></td>";
        if($data['professor_id'] == $prof->professor_id){
     echo "<td><a style='float:right' href='edit.php?view=$t'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
        }
            
    echo "</tr>";
$data = mysqli_fetch_assoc($row);
$i++;
    }
   echo "</tbody>";
  echo "</table>";
echo"</div></div></div>";


?>
</body>
</html>
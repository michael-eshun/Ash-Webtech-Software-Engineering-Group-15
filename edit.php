<?php
require_once 'Professor.php';
require_once 'header.php';
$obj = new Professor();
$user="";
  if (isset($_REQUEST['view'])){
      $user = sanitizeString($_REQUEST['view']);
  }
  else {
      $user = $_REQUEST['temp'];
  }
          
      

   
      $x = new Professor();
      $row = $x -> edit($user);
      $data = mysqli_fetch_assoc($row);

      $x -> edit_course($user);
      $x ->professor_id = $user;

echo <<<_END
<div class='col-sm-1 mid-side'><h2>Courseware<span class='glyphicon glyphicon-education' aria-hidden='true'></span></h2></div><div class='col-sm-2 left-side'></div>
<div class='col-sm-9 right-side main'>
<div class="container">
  <h2>Edit Course</h2>
  <p>Please type in the details of the Course to edit</p>
  <form method="post" action="edit.php">
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" value ='{$data['title']}' id="title" name="title"><br>
      <label for="faculty">Faculty:</label>
      <input type="text" class="form-control" value ='{$data['faculty_id']}' id="faculty" name="faculty"><br>
      <label for="prof">Professor:</label>
      <input type="text" class="form-control" value ='{$data['professor_id']}' id="prof" name="prof"><br>
      <label for="obj">Objective:</label>
      <input type="text" class="form-control" value ='{$data['objective']}' id="obj" name="obj"><br>
      <label for="topic">Topics:</label>
      <textarea type="text" class="form-control" rows="5" id="topics" name="topics">{$data['topics']}</textarea><br>
      <label for="ref">References:</label>
      <input type="text" class="form-control" value ='{$data['course_references']}' id="ref" name="ref"><br>
      <label for="time">Time:</label>
      <input type="text" class="form-control" value ='{$data['time_frame']}' id="time" name="time"><br>
      <label for="pre">Prerequisite(s):</label>
      <input type="text" class="form-control" value ='{$data['prerequisite']}' id="pre" name="pre"><br>
      <label for="assess">Assessment:</label>
      <textarea type="text" class="form-control" rows="5" id="assess" name="assess">{$data['assessment']}</textarea><br>
      <input type='hidden' value ='$user' name='temp'>
      <button type="submit" class="btn btn-primary btn-lg">Submit</button>
    </div>
  </form>
</div>
</div></div>
_END;
?>


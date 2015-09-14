<?php
  require_once 'Professor.php';
  require_once 'header.php';
  $obj = new Professor();
  $user="";
  if (isset($_REQUEST['view'])){
    $user = sanitizeString($_REQUEST['view']);
  }

  $x = new Professor();

echo <<<_END
<div class='col-sm-1 mid-side'><h2>Courseware<span class='glyphicon glyphicon-education' aria-hidden='true'></span></h2></div><div class='col-sm-2 left-side'></div>
<div class='col-sm-9 right-side main'>
<div class="container">
  <h2>Add Course</h2>
  <p>Please type in the details of the Course</p>
  <form method="post" action="addCourse.php">
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" name="title"><br>      
      <label for="obj">Objective:</label>
      <input type="text" class="form-control" id="obj" name="obj"><br>
      <label for="topic">Topics:</label>
      <textarea type="text" class="form-control" rows="5" id="topics" name="topics"></textarea><br>
      <label for="ref">References:</label>
      <textarea type="text" class="form-control" id="ref" name="ref"></textarea><br>
      <label for="time">Time:</label>
      <input type="text" class="form-control" id="time" name="time"><br>
      <label for="pre">Prerequisite(s):</label>
      <input type="text" class="form-control"  id="pre" name="pre"><br>
      <label for="assess">Assessment:</label>
      <textarea type="text" class="form-control" rows="5" id="assess" name="assess"></textarea><br>
      <label for="faculty">Faculty:</label>
      <select class="form-control" id="faculty" name="faculty"><br>
_END;
      $obj = new Professor();
        $row = $obj -> get_faculty();     
        $data = mysqli_fetch_assoc($row);
        while($data){
          echo "<option value='$data[faculty_id]'>$data[faculty_name] </option>";
          $data = mysqli_fetch_assoc($row);
        }
echo <<<_END
      </select><br>
      <label for="prof">Professor:</label>
      <select class="form-control" id="prof" name="prof"><br>
_END;
       $obj = new Professor();
        $row = $obj -> get_prof();     
        $data = mysqli_fetch_assoc($row);
        while($data){
          echo "<option value='$data[professor_id]'>
          $data[first_name] $data[last_name] </option>";
          $data = mysqli_fetch_assoc($row);
        }
echo <<<_END
      </select><br>
      <button type="submit" class="btn btn-primary btn-lg">Add Course</button>
    </div>
  </form>
</div>
</div></div>
_END;

if(isset($_REQUEST['title']) && (isset($_REQUEST['faculty'])) && (isset($_REQUEST['prof'])) &&
  (isset($_REQUEST['obj'])) && (isset($_REQUEST['topics'])) && (isset($_REQUEST['ref'])) &&
  (isset($_REQUEST['time'])) && (isset($_REQUEST['pre'])) && (isset($_REQUEST['assess'])) ){

 $row = $x -> create_course(($_REQUEST['title']), ($_REQUEST['faculty']),($_REQUEST['prof']),($_REQUEST['obj']),
      ($_REQUEST['topics']), ($_REQUEST['ref']), ($_REQUEST['time']),($_REQUEST['pre']),($_REQUEST['assess']));
if($row){
echo <<<_END
    <script>
        $("#divStatus").text("Successfully added Course");
        $('#divStatus').css({opacity: 0});
        $('#divStatus').animate({opacity: 1}, 700 );
    </script>
_END;
    }else{
      echo <<<_END
    <script>
        $("#divStatus").text("Add unsuccessful.");
        $('#divStatus').css({opacity: 0});
        $('#divStatus').animate({opacity: 1}, 700 );
    </script>
_END;
    }
}

?>


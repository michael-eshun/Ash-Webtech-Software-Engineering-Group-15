<?php
  require_once 'Professor.php';
  require_once 'header.php';
  $obj = new Professor();
  $user="";
  if (isset($_REQUEST['view'])){
      $user = sanitizeString($_REQUEST['view']);
  }
  // else {
  //     $user = $_REQUEST['temp'];
  // }
   
  $x = new Professor();
  
  // $data = mysqli_fetch_assoc($row);

  // $x -> edit_course($user);
  // $x ->professor_id = $user;

echo <<<_END
<div class='col-sm-1 mid-side'><h2>Courseware<span class='glyphicon glyphicon-education' aria-hidden='true'></span></h2></div><div class='col-sm-2 left-side'></div>
<div class='col-sm-9 right-side main'>
<div class="container">
  <h2>Add Faculty</h2>
  <p>Please type in the details of the Faculty</p>
  <form method="post" action="addFaculty.php">
    <div class="form-group">
      <label for="title">Faculty Name:</label>
      <input required type="text" class="form-control"  id="facultyname" name="name"><br>
      <label for="faculty">Faculty Head:</label>
      <select class="form-control" id="facultyhead" name="faculty">
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
 
      <button type="submit" class="btn btn-primary" onclick="add_Status()">Add Faculty</button>
    </div>
  </form>
</div>
</div></div>
_END;

if(isset($_REQUEST['name'])){
  $name = $_REQUEST['name'];
  $head = $_REQUEST['faculty'];
  $row = $x -> add($name, $head);
  if($row){
echo <<<_END
    <script>
        $("#divStatus").text("Successfully added Faculty.");
        $('#divStatus').css({opacity: 0});
        $('#divStatus').animate({opacity: 1}, 700 );
        
      
    </script>
_END;
    }


}

?>


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
  <h2>Add Professor</h2>
  <p>Please type in the details of the Professor</p>
  <form method="post" action="addProfessor.php">
    <div class="form-group">
      <label for="title">First Name:</label>
      <input type="text" class="form-control" id="fname" name="fname"><br>
      <label for="faculty">Last Name:</label>
      <input type="text" class="form-control" id="lname" name="lname"><br>
      <label for="prof">Email:</label>
      <input type="text" class="form-control" id="email" name="email"><br>
      <label for="obj">Qualification:</label>
      <input type="text" class="form-control" id="qual" name="qual"><br>
     <label for="usr">User:</label>
      <input type="text" class="form-control" id="usr" name="usr"><br>
    <label for="pass">Password:</label>
      <input type="text" class="form-control" id="pass" name="pass"><br>
      <label for="topic">Faculty:</label>
      <select class="form-control" id="facultyhead" name="faculty">
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
 
      <button type="submit" class="btn btn-primary btn-lg">Add Professor</button>
    </div>
  </form>
</div>
</div></div>
_END;

if(isset($_REQUEST['fname']) && (isset($_REQUEST['usr']))&& (isset($_REQUEST['pass'])) &&(isset($_REQUEST['lname'])) &&
  (isset($_REQUEST['email'])) && (isset($_REQUEST['qual'])) &&
  (isset($_REQUEST['faculty']))){
    
 

 $row = $x -> addProfessor(($_REQUEST['faculty']), ($_REQUEST['fname']),($_REQUEST['lname']),($_REQUEST['email']),
      ($_REQUEST['qual']));
  $y = $x->get_email($_REQUEST['email']);
    $data = mysqli_fetch_assoc($y);
    $x->account($data['professor_id'],$_REQUEST['usr'],$_REQUEST['pass']);
if($row){
echo <<<_END
    <script>
        $("#divStatus").text("Successfully added Professor.");
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


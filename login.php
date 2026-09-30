<?php
  session_start();
  include("db.php");
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
	 $username = $_POST["username"];
     $password = $_POST["password"];
     $role = $_POST["role"];
     
     $sql = "SELECT * FROM `user` where username='$username' and password = '$password' and role = '$role'";
     $result = mysqli_query($conn,$sql);
     if(!$result)
     {
        die("SQL Error : " . mysqli_error($conn));
     }		 
  
  if(mysqli_num_rows($result) == 1)
  {
      $user = mysqli_fetch_assoc($result);
	  $_SESSION["username"] = $user["username"];
	  $_SESSION["role"] = $user["role"];
	  if($role == "Admin")
	  {
		  header("Location:admin_dashboard.php");
		  exit();
	  }
	  if($role == "Teacher")
	  {
		  header("Locationn:teacher_dashboard.php");
		  exit();
	  }
	  if($role == "Student")
	  {
		  header("Location:student_dashboard.php");
		  exit();
	  }
  }	  
  else
  {
	  echo "<script>
	     alert('Invalid Username,Password or Role');
		 window.location='index.php';
		 </script>";
  }
}
?>
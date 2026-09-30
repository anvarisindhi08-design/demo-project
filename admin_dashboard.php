<?php
   session_start();
   if(!isset($_SESSION["username"]) || $_SESSION["role"] != "Admin")
   {
	   header("Location : index.php");
	   exit();
   }
 
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Admin Dahboard</title>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
	     body{
			 background:linear-gradient(
			 135deg,
			 #dbeafe,
			 #ede9fe,
			 #d1fae5
			 );
			 min-height:100vh;
		 }
		 .dashboard{
			 margin-top:60px;
		 }
		 .card{
			 border:none;
			 border-radius:15px;
			 box-shadow:0 5px 20px rgba(0,0,0,0.10);
		 }
	     .logout{
             float:right;
         }			 
			 
	  </style>
   </head>
   <body>
     <div class="container dashboard">
	    <div class="d-flex justify-content-between align-items-center mb-4">
		
		   <div>
		      <h2>Admin Dashboard</h2>
			  <p>Welcome,<?php echo $_SESSION["username"];?></p>
	       </div>
		   <a href="logout.php" class="btn btn-danger logout">
		     logout
		   </a>
		</div>
		<div class = "row g-4">
		   <div class="col-md-4">
		     <div class="card p-4 text-center">
			    <h4>Manage Students</h4>
				<p>Add, update and delete students.</p>
				<a href="manage_students.php" class="btn btn-primary">
				   Manage Students
				</a>
			 </div>
		   </div>
		   
		   <div class="col-md-4">
		     <div class="card p-4 text-center">
			    <h4>Manage Teachers</h4>
				<p>Add, update and delete teachers.</p>
				<a href="manage_teachers.php" class="btn btn-primary">
				   Manage Teachers
				</a>
			 </div>
		   </div>
		   <div class="col-md-4">
		     <div class="card p-4 text-center">
			    <h4>Attendance</h4>
				<p>View student attendance</p>
				<a href="#" class="btn btn-primary">
				   View Attendance
				</a>
			 </div>
		   </div>
		</div>
	 </div>
   </body>
</html>
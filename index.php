<html>
  <head>
     <title>Student Attendance Managment System</title>
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
			display:flex;
			align-items:center;
			justify-content:center;
		}
		.login-box{
			width:400px;
			background:white;
			padding:35px;
			border-radius:15px;
			box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);

		}
		.login-title{
			text-align:center;
			margin-bottom:25px;
		}
		.login-title h2{
			font-weight:bold;
		}
		.login-title p{
			color: #777;
		}
		.btn-login{
			 width:100%;
			 padding:10px;
			 font-weight:bold;
		}
		
	 </style>
  </head>
  <body>
   <div class="login-box">
           <div class="login-title">
           <h2>Student Attendance</h2>
		   <p>Management System</p>
        </div>		
	    <form action="login.php" method="POST">
		<div class="mb-3">
		   <label for="username" class="form-label">
		     Username
		   </label>
		   <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" required>
		   </div>
		   <br>
		<div class="mb-3">
		   <label for="password" class="form-label">
		     Password
		   </label>
		   <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" required>
		   
		</div>
		<br>
		<div class = "mb-3">
		   <label for="role" class="form-label">
		      Login As
		   </label>
		   <select class="form-select" id="role" name="role" required>
		     <option value="">Select Role</option>
		     <option value="Admin">Admin</option>
		     <option value="Teacher">Teacher</option>
		     <option value="Student">Student</option>
		   </select>
		</div>
		<br>
		
		<button type="submit" class="btn btn-primary btn-login">
		   login
		</button>
	 </form>
	</div>
  </body>
</html>
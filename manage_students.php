<?php

session_start();
include("db.php");

/* Admin access only */
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "Admin") {
    header("Location: index.php");
    exit();
}

/* ADD STUDENT */
if (isset($_POST["add_student"])) {

    $enrollment_no = $_POST["enrollment_no"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone_no = $_POST["phone_no"];
    $gender = $_POST["gender"];
    $div = $_POST["div"];
    $semester = $_POST["semester"];

    $sql = "INSERT INTO student
            (enrollment_no, full_name, email, phone_no, gender, `div`, semester)
            VALUES
            ('$enrollment_no', '$full_name', '$email', '$phone_no',
             '$gender', '$div', '$semester')";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Student Added Successfully');
                window.location='manage_students.php';
              </script>";
        exit();

    } else {

        die("INSERT ERROR: " . mysqli_error($conn));
    }
}


/* GET STUDENTS */
$result = mysqli_query($conn, "SELECT * FROM student ORDER BY stu_id ASC");

if (!$result) {
    die("SELECT ERROR: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Students - Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #1e3a8a, #2563eb);
            padding: 25px 15px;
            color: white;
        }

        .logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo h2 {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .logo p {
            font-size: 13px;
            opacity: 0.8;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: white;
            padding: 14px 18px;
            margin-bottom: 8px;
            border-radius: 10px;
            transition: 0.3s;
        }

        .menu a:hover,
        .menu .active {
            background: rgba(255,255,255,0.2);
        }

        /* MAIN */

        .main {
            margin-left: 250px;
            padding: 30px;
        }

        /* TOP BAR */

        .topbar {
            background: white;
            padding: 18px 25px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .topbar h3 {
            margin: 0;
            color: #1e293b;
        }

        .admin {
            color: #475569;
            font-weight: 500;
        }

        /* PAGE TITLE */

        .page-title {
            margin-bottom: 20px;
        }

        .page-title h2 {
            color: #1e293b;
            font-weight: bold;
        }

        .page-title p {
            color: #64748b;
        }

        /* ADD STUDENT CARD */

        .student-form {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        .student-form h4 {
            color: #1e3a8a;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px;
        }

        .btn-add {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-add:hover {
            background: #1d4ed8;
            color: white;
        }

        /* TABLE CARD */

        .table-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .table-card h4 {
            color: #1e3a8a;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .table {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table thead {
            background: #1e3a8a;
            color: white;
        }

        .table thead th {
            padding: 13px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 12px;
        }

        .table tbody tr:hover {
            background: #f1f5f9;
        }

        /* RESPONSIVE */

        @media(max-width: 900px) {

            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
            }

        }

        @media(max-width: 700px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 15px;
            }

        }

    </style>

</head>

<body>


<!-- SIDEBAR -->

<div class="sidebar">

    <div class="logo">

        <h2>📚 Attendance</h2>

        <p>Admin Panel</p>

    </div>


    <div class="menu">

        <a href="admin_dashboard.php">
            🏠 Dashboard
        </a>

        <a href="manage_students.php" class="active">
            👨‍🎓 Manage Students
        </a>

        <a href="manage_teachers.php">
            👨‍🏫 Manage Teachers
        </a>

        <a href="#">
            📋 Attendance
        </a>

        <a href="logout.php">
            🚪 Logout
        </a>

    </div>

</div>



<!-- MAIN CONTENT -->

<div class="main">


    <!-- TOP BAR -->

    <div class="topbar">

        <h3>Manage Students</h3>

        <div class="admin">
            👤 Admin: <?php echo $_SESSION["username"]; ?>
        </div>

    </div>


    <!-- PAGE TITLE -->

    <div class="page-title">

        <h2>Student Management</h2>

        <p>Add and view students in the attendance system.</p>

    </div>



    <!-- ADD STUDENT -->

    <div class="student-form">

        <h4>➕ Add New Student</h4>


        <form method="POST">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Enrollment No
                    </label>

                    <input type="text"
                           name="enrollment_no"
                           class="form-control"
                           placeholder="Enter enrollment number"
                           required>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Full Name
                    </label>

                    <input type="text"
                           name="full_name"
                           class="form-control"
                           placeholder="Enter full name"
                           required>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="Enter email"
                           required>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Phone Number
                    </label>

                    <input type="text"
                           name="phone_no"
                           class="form-control"
                           placeholder="Enter phone number"
                           required>

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Gender
                    </label>

                    <select name="gender"
                            class="form-select"
                            required>

                        <option value="">Select Gender</option>

                        <option value="Male">
                            Male
                        </option>

                        <option value="Female">
                            Female
                        </option>

                    </select>

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Division
                    </label>

                    <input type="text"
                           name="div"
                           class="form-control"
                           placeholder="e.g. A"
                           required>

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Semester
                    </label>

                    <input type="number"
                           name="semester"
                           class="form-control"
                           placeholder="e.g. 3"
                           min="1"
                           max="8"
                           required>

                </div>

            </div>


            <button type="submit"
                    name="add_student"
                    class="btn btn-add">

                ➕ Add Student

            </button>

        </form>

    </div>



    <!-- STUDENT TABLE -->

    <div class="table-card">

        <h4>👨‍🎓 Student List</h4>


        <?php if (mysqli_num_rows($result) > 0) { ?>

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Enrollment</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Division</th>
                        <th>Semester</th>
                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>

                        <td>
                            <?php echo $row["stu_id"]; ?>
                        </td>

                        <td>
                            <?php echo $row["enrollment_no"]; ?>
                        </td>

                        <td>
                            <?php echo $row["full_name"]; ?>
                        </td>

                        <td>
                            <?php echo $row["email"]; ?>
                        </td>

                        <td>
                            <?php echo $row["phone_no"]; ?>
                        </td>

                        <td>
                            <?php echo $row["gender"]; ?>
                        </td>

                        <td>
                            <?php echo $row["div"]; ?>
                        </td>

                        <td>
                            <?php echo $row["semester"]; ?>
                        </td>
                        <td>
						  <a href="edit_student.php?stu_id=<?php echo $row["stu_id"];?>"
						  class = "btn btn-sm btn-primary">
						  Edit 
						  </a>
						  <br><br>
						   <a href="delete_student.php?stu_id=<?php echo $row["stu_id"]; ?>"

                           onclick="return confirm('Are you sure you want to delete this student?');"
                           style="
                            display:inline-block;
                            background:#dc3545;
                            color:white;
                            padding:6px 14px;
                            border-radius:6px;
                            text-decoration:none;
                            font-weight:bold;
                            margin-left:5px;
                            ">
                             Delete
                           </a>
						</td>
                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

        <?php } else { ?>

            <div class="alert alert-info">
                No Students Found
            </div>

        <?php } ?>

    </div>


</div>


</body>
</html>
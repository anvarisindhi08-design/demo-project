<?php

session_start();
include("db.php");

/* Admin access only */
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "Admin") {
    header("Location: index.php");
    exit();
}

/* GET STUDENT ID */
if (!isset($_GET["stu_id"])) {
    header("Location: manage_students.php");
    exit();
}

$stu_id = $_GET["stu_id"];


/* UPDATE STUDENT */

if (isset($_POST["update_student"])) {

    $enrollment_no = $_POST["enrollment_no"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone_no = $_POST["phone_no"];
    $gender = $_POST["gender"];
    $div = $_POST["div"];
    $semester = $_POST["semester"];

    $sql = "UPDATE student SET
            enrollment_no='$enrollment_no',
            full_name='$full_name',
            email='$email',
            phone_no='$phone_no',
            gender='$gender',
            `div`='$div',
            semester='$semester'
            WHERE stu_id='$stu_id'";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Student Updated Successfully');
                window.location='manage_students.php';
              </script>";
        exit();

    } else {

        die("UPDATE ERROR: " . mysqli_error($conn));
    }
}


/* GET CURRENT STUDENT */

$result = mysqli_query($conn,
    "SELECT * FROM student WHERE stu_id='$stu_id'"
);

if (!$result) {
    die("SELECT ERROR: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) != 1) {
    die("Student Not Found");
}

$student = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Edit Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f7fb;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            height: 100vh;
            background: linear-gradient(180deg, #1e3a8a, #2563eb);
            color: white;
            padding: 25px 15px;
        }

        .logo {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .logo p {
            font-size: 13px;
            opacity: 0.8;
        }

        .menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 8px;
            border-radius: 8px;
        }

        .menu a:hover,
        .menu .active {
            background-color: rgba(255,255,255,0.20);
        }

        .main {
            margin-left: 240px;
            padding: 25px;
        }

        .topbar {
            background: white;
            padding: 18px 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);

            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }

        .topbar h3 {
            margin: 0;
            color: #1e293b;
        }

        .admin {
            color: #475569;
            font-weight: bold;
        }

        .edit-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        .edit-card h2 {
            color: #1e3a8a;
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: bold;
            color: #334155;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px;
        }

        .btn-update {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn-update:hover {
            background-color: #1d4ed8;
            color: white;
        }

        .btn-back {
            margin-left: 8px;
            padding: 10px 25px;
            border-radius: 8px;
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

        <a href="#">
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



<!-- MAIN -->

<div class="main">


    <!-- TOP BAR -->

    <div class="topbar">

        <h3>Edit Student</h3>

        <div class="admin">

            👤 Admin:
            <?php echo $_SESSION["username"]; ?>

        </div>

    </div>



    <!-- EDIT FORM -->

    <div class="edit-card">

        <h2>✏️ Edit Student Details</h2>


        <form method="POST">


            <div class="row">


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Enrollment No
                    </label>

                    <input type="text"
                           name="enrollment_no"
                           class="form-control"
                           value="<?php echo $student["enrollment_no"]; ?>"
                           required>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Full Name
                    </label>

                    <input type="text"
                           name="full_name"
                           class="form-control"
                           value="<?php echo $student["full_name"]; ?>"
                           required>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="<?php echo $student["email"]; ?>"
                           required>

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Phone Number
                    </label>

                    <input type="text"
                           name="phone_no"
                           class="form-control"
                           value="<?php echo $student["phone_no"]; ?>"
                           required>

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Gender
                    </label>

                    <select name="gender"
                            class="form-select"
                            required>

                        <option value="Male"
                            <?php if ($student["gender"] == "Male") echo "selected"; ?>>
                            Male
                        </option>

                        <option value="Female"
                            <?php if ($student["gender"] == "Female") echo "selected"; ?>>
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
                           value="<?php echo $student["div"]; ?>"
                           required>

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Semester
                    </label>

                    <input type="number"
                           name="semester"
                           class="form-control"
                           min="1"
                           max="8"
                           value="<?php echo $student["semester"]; ?>"
                           required>

                </div>


            </div>


            <button type="submit"
                    name="update_student"
                    class="btn btn-update">

                💾 Update Student

            </button>


            <a href="manage_students.php"
               class="btn btn-secondary btn-back">

                ← Back

            </a>


        </form>

    </div>


</div>


</body>

</html>
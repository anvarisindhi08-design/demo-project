<?php

session_start();
include("db.php");


/* Admin access only */

if (!isset($_SESSION["username"]) || $_SESSION["role"] != "Admin") {

    header("Location: index.php");
    exit();

}


/* ADD TEACHER */

if (isset($_POST["add_teacher"])) {

    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone_no = $_POST["phone_no"];
    $department = $_POST["department"];


    $sql = "INSERT INTO teacher
            (full_name, email, phone_no, department)
            VALUES
            ('$full_name', '$email', '$phone_no', '$department')";


    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Teacher Added Successfully');
                window.location='manage_teachers.php';
              </script>";

        exit();

    } else {

        die("INSERT ERROR: " . mysqli_error($conn));

    }

}


/* GET TEACHERS */

$result = mysqli_query(
    $conn,
    "SELECT * FROM teacher ORDER BY teacher_id ASC"
);


if (!$result) {

    die("SELECT ERROR: " . mysqli_error($conn));

}

?>


<!DOCTYPE html>

<html>

<head>

    <title>Manage Teachers</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <style>

        body {

            margin: 0;

            font-family: Arial, sans-serif;

            background-color: #f4f7fb;

        }


        /* SIDEBAR */

        .sidebar {

            position: fixed;

            left: 0;

            top: 0;

            width: 240px;

            height: 100vh;

            background: linear-gradient(
                180deg,
                #1e3a8a,
                #2563eb
            );

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


        /* MAIN */

        .main {

            margin-left: 240px;

            padding: 25px;

        }


        /* TOP BAR */

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


        /* TITLE */

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


        /* FORM */

        .teacher-form {

            background: white;

            padding: 25px;

            border-radius: 12px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.08);

            margin-bottom: 25px;

        }


        .teacher-form h4 {

            color: #1e3a8a;

            font-weight: bold;

            margin-bottom: 20px;

        }


        .form-label {

            font-weight: bold;

            color: #334155;

        }


        .form-control {

            border-radius: 8px;

            padding: 10px;

        }


        .btn-add {

            background-color: #2563eb;

            color: white;

            border: none;

            padding: 10px 25px;

            border-radius: 8px;

            font-weight: bold;

        }


        .btn-add:hover {

            background-color: #1d4ed8;

            color: white;

        }


        /* LIST */

        .teacher-list {

            background: white;

            padding: 25px;

            border-radius: 12px;

            box-shadow: 0 3px 12px rgba(0,0,0,0.08);

        }


        .teacher-list h4 {

            color: #1e3a8a;

            font-weight: bold;

            margin-bottom: 20px;

        }


        .table {

            vertical-align: middle;

        }


        .table thead {

            background-color: #1e3a8a;

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

            background-color: #f1f5f9;

        }


        /* EDIT */

        .btn-edit {

            background-color: #2563eb;

            color: white;

            border: none;

            padding: 6px 14px;

            border-radius: 6px;

            text-decoration: none;

            font-weight: bold;

        }


        .btn-edit:hover {

            background-color: #1d4ed8;

            color: white;

        }


        /* DELETE */

        .btn-delete {

            background-color: #dc3545;

            color: white;

            border: none;

            padding: 6px 14px;

            border-radius: 6px;

            text-decoration: none;

            font-weight: bold;

            margin-left: 5px;

        }


        .btn-delete:hover {

            background-color: #b02a37;

            color: white;

        }


        /* MOBILE */

        @media(max-width: 700px) {

            .sidebar {

                position: relative;

                width: 100%;

                height: auto;

            }


            .main {

                margin-left: 0;

            }


            .topbar {

                flex-direction: column;

                gap: 10px;

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


        <a href="manage_students.php">

            👨‍🎓 Manage Students

        </a>


        <a href="manage_teachers.php" class="active">

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

        <h3>

            Manage Teachers

        </h3>


        <div class="admin">

            👤 Admin:

            <?php echo $_SESSION["username"]; ?>

        </div>

    </div>



    <!-- PAGE TITLE -->

    <div class="page-title">

        <h2>

            Teacher Management

        </h2>


        <p>

            Add and manage teachers in the attendance system.

        </p>

    </div>



    <!-- ADD TEACHER -->

    <div class="teacher-form">


        <h4>

            ➕ Add Teacher

        </h4>


        <form method="POST">


            <div class="row">


                <!-- FULL NAME -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Full Name

                    </label>


                    <input
                        type="text"
                        name="full_name"
                        class="form-control"
                        required
                    >

                </div>



                <!-- EMAIL -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Email

                    </label>


                    <input
                        type="email"
                        name="email"
                        class="form-control"
                    >

                </div>



                <!-- PHONE -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Phone Number

                    </label>


                    <input
                        type="text"
                        name="phone_no"
                        class="form-control"
                        required
                    >

                </div>



                <!-- DEPARTMENT -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Department

                    </label>


                    <input
                        type="text"
                        name="department"
                        class="form-control"
                        placeholder="e.g. Computer Applications"
                        required
                    >

                </div>


            </div>


            <button
                type="submit"
                name="add_teacher"
                class="btn btn-add"
            >

                ➕ Add Teacher

            </button>


        </form>


    </div>



    <!-- TEACHER LIST -->

    <div class="teacher-list">


        <h4>

            👨‍🏫 Teacher List

        </h4>


        <?php if (mysqli_num_rows($result) > 0) { ?>


            <div class="table-responsive">


                <table class="table table-bordered table-striped">


                    <thead>

                        <tr>

                            

                            <th>ID</th>

                            <th>Full Name</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>Department</th>
							
							<th>Action</th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>


                        <tr>

                            <td>

                                <?php echo $row["teacher_id"]; ?>

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

                                <?php echo $row["department"]; ?>

                            </td>

                                                       <td>

                                <a
                                    href="edit_teacher.php?teacher_id=<?php echo $row["teacher_id"]; ?>"
                                    class="btn-edit"
                                >

                                    Edit

                                </a>


                                <a
                                    href="delete_teacher.php?teacher_id=<?php echo $row["teacher_id"]; ?>"
                                    class="btn-delete"
                                    onclick="return confirm('Are you sure you want to delete this teacher?');"
                                >

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

                No Teachers Found

            </div>


        <?php } ?>


    </div>


</div>


</body>

</html>
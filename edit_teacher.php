```php
<?php

session_start();
include("db.php");

/* Admin access only */
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "Admin") {
    header("Location: index.php");
    exit();
}


/* Check Teacher ID */

if (!isset($_GET["teacher_id"])) {
    header("Location: manage_teachers.php");
    exit();
}

$teacher_id = $_GET["teacher_id"];


/* Get Teacher Data */

$result = mysqli_query(
    $conn,
    "SELECT * FROM teacher WHERE teacher_id='$teacher_id'"
);

if (!$result) {
    die("SELECT ERROR: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    die("Teacher Not Found");
}

$row = mysqli_fetch_assoc($result);


/* UPDATE TEACHER */

if (isset($_POST["update_teacher"])) {

    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone_no = $_POST["phone_no"];
    $department = $_POST["department"];


    $sql = "UPDATE teacher SET
            full_name='$full_name',
            email='$email',
            phone_no='$phone_no',
            department='$department'
            WHERE teacher_id='$teacher_id'";


    if (mysqli_query($conn, $sql)) {

        echo "<script>
                alert('Teacher Updated Successfully');
                window.location='manage_teachers.php';
              </script>";

        exit();

    } else {

        die("UPDATE ERROR: " . mysqli_error($conn));

    }
}

?>


<!DOCTYPE html>

<html>

<head>

    <title>Edit Teacher</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <style>

        body {

            background: linear-gradient(
                135deg,
                #dbeafe,
                #ede9fe,
                #d1fae5
            );

            min-height: 100vh;

        }


        .container {

            margin-top: 50px;

        }


        .card {

            border: none;

            border-radius: 15px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.10);

        }


        .title {

            color: #4f46e5;

            font-weight: bold;

        }


        .form-label {

            font-weight: 600;

        }


        .btn-update {

            background-color: #4f46e5;

            color: white;

            border: none;

        }


        .btn-update:hover {

            background-color: #4338ca;

            color: white;

        }

    </style>

</head>


<body>


<div class="container">


    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="title">

            Edit Teacher

        </h2>


        <a
            href="manage_teachers.php"
            class="btn btn-secondary"
        >

            Back to Teachers

        </a>

    </div>



    <div class="card p-4">


        <h4 class="mb-4">

            Update Teacher Information

        </h4>


        <form method="POST">


            <!-- Full Name -->

            <div class="mb-3">

                <label class="form-label">

                    Full Name

                </label>


                <input
                    type="text"
                    name="full_name"
                    class="form-control"
                    value="<?php echo $row["full_name"]; ?>"
                    required
                >

            </div>



            <!-- Email -->

            <div class="mb-3">

                <label class="form-label">

                    Email

                </label>


                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="<?php echo $row["email"]; ?>"
                >

            </div>



            <!-- Phone -->

            <div class="mb-3">

                <label class="form-label">

                    Phone Number

                </label>


                <input
                    type="text"
                    name="phone_no"
                    class="form-control"
                    value="<?php echo $row["phone_no"]; ?>"
                    required
                >

            </div>



            <!-- Department -->

            <div class="mb-3">

                <label class="form-label">

                    Department

                </label>


                <input
                    type="text"
                    name="department"
                    class="form-control"
                    value="<?php echo $row["department"]; ?>"
                    required
                >

            </div>



            <button
                type="submit"
                name="update_teacher"
                class="btn btn-update"
            >

                Update Teacher

            </button>


            <a
                href="manage_teachers.php"
                class="btn btn-secondary"
            >

                Cancel

            </a>


        </form>


    </div>


</div>


</body>

</html>
```

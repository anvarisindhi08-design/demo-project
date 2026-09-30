<?php
session_start();
include("db.php");

/* Admin access only */
if (!isset($_SESSION["username"]) || $_SESSION["role"] != "Admin") {
    header("Location: index.php");
    exit();
}

/* Check student ID */
if (!isset($_GET["stu_id"])) {
    header("Location: manage_students.php");
    exit();
}

$stu_id = $_GET["stu_id"];

/* Delete student */
$sql = "DELETE FROM student WHERE stu_id='$stu_id'";

if (mysqli_query($conn, $sql)) {

    echo "<script>
            alert('Student Deleted Successfully');
            window.location='manage_students.php';
          </script>";

} else {

    die("DELETE ERROR: " . mysqli_error($conn));
}
?>
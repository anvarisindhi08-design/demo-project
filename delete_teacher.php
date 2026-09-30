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


/* Delete Teacher */

$sql = "DELETE FROM teacher
        WHERE teacher_id='$teacher_id'";


if (mysqli_query($conn, $sql)) {

    echo "<script>
            alert('Teacher Deleted Successfully');
            window.location='manage_teachers.php';
          </script>";

    exit();

} else {

    die("DELETE ERROR: " . mysqli_error($conn));

}

?>
```

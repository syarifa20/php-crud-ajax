<?php 

require 'dbcon.php';


if (isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $query = "DELETE FROM students WHERE id = '$student_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => "student Deleted successfully"
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 500,
            'message' => "student not deleted"
        ];
        echo json_encode($res);
        return false;
    }
}



if (isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    if ($name == NULL || $email == NULL || $phone == NULL || $course == NULL) {
        $res = [
            'status' => 422,
            'message' => "All fields are mandatory"
        ];
        echo json_encode($res);
        return false;
    }
    $query = "UPDATE students SET name='$name',email='$email',phone='$phone',course='$course'
              WHERE id='$student_id'";
    $query_run = mysqli_query($con,$query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => "student Updated successfully"
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 500,
            'message' => "student not update"
        ];
        echo json_encode($res);
        return false;
    }
}


if (isset($_GET['student_id'])) {
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

    $query = "SELECT * FROM students WHERE id = '$student_id'";
    $query_run = mysqli_query($con,$query);

    if (mysqli_num_rows($query_run) == 1) 
    {
        $student = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'message' => "Student fetch successfully by id",
            'data' => $student
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => "Student id not found"
        ];
        echo json_encode($res);
        return false;
    }
}


if (isset($_POST['save_student'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    if ($name == NULL || $email == NULL || $phone == NULL || $course == NULL) {
        $res = [
            'status' => 422,
            'message' => "All fields are mandatory"
        ];
        echo json_encode($res);
        return false;
    }
    $query = "INSERT INTO students (name,email,phone,course) VALUES ('$name','$email','$phone','$course')";
    $query_run = mysqli_query($con,$query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => "student created successfully"
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 500,
            'message' => "student not created"
        ];
        echo json_encode($res);
        return false;
    }
}

?>
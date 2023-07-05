<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("connect.php");

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $image = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];

    if ($password === $cpassword) {
        move_uploaded_file($tmp_name, "../uploads/$image");
        $insert = mysqli_query($connect, "INSERT INTO user (name, mobile, address, password, role, photo, status, votes) VALUES ('$name', '$mobile', '$address', '$password', '$role', '$image', 0, 0)");

        if ($insert) {
            echo '
                <script>
                    alert("Registration Successful!");
                    window.location = "../";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Some error occurred!");
                    window.location = "../routes/register.html";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Password and Confirm Password do not match!");
                window.location = "../routes/register.html";
            </script>
        ';
    }
} else {
    // Redirect back to the registration form if accessed directly without submitting the form
    header("Location: ../routes/register.html");
    exit;
}

?>

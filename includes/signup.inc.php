<?PHP
if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    //Error handlers
    //Check for empty fields
    if (empty($first) || empty($last) || empty($email) || empty($username) || empty($password)) {
        header("Location: ../signup.php?=empty");
        exit();
    } else {
        //Check if input chars are valid
        if (!preg_match("/^[a-zA-Z\s]*$/", $first) || !preg_match("/^[a-zA-Z\s]*$/", $last)) {
            header("Location: ../signup.php?=invalid");
            exit();
        } else {
            //Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../signup.php?=email");
                exit();
            } else {
                $sql = "SELECT * FROM users WHERE user_username='$username'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    header("Location: ../signup.php?=usertaken");
                    exit();
                } else {
                    //Hashing password
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    //Insert the user into the database
                    $sql = "INSERT INTO users (user_first, user_last, user_email, user_username, 
                        user_password) VALUES ('$first', '$last', '$email', '$username', '$hashedPwd');";
                    mysqli_query($conn, $sql);
                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }
        }
    }

} else {
    header("Location: ../signup.php");
    exit();
}


?>
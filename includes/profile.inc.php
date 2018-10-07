<?PHP

if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $oldpassword = mysqli_real_escape_string($conn, $_POST['oldpassword']);
    $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);
    
    //Check for empty fields
    if (empty($oldpassword) || empty($newpassword)) {
        header("Location: ../profile.php?=empty");
        exit();
    } else {
        //De-hashing password
        $sql = "SELECT * FROM users WHERE user_username='$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
      
        if ($resultCheck < 1) {
            header("Location: ../profile.php?=error");
            exit();
        } else {
            
            if ($row = mysqli_fetch_assoc($result)) {
                
                $hashedPwdCheck = password_verify($oldpassword, $row['user_password']);
                
                if ($hashedPwdCheck == false) {
                
                    header("Location: ../profile.php?password=invalid");
                    exit();
                
                } elseif ($hashedPwdCheck == true) {
                    //Update DB with new user password
                    $hashedPwd = password_hash($newpassword, PASSWORD_DEFAULT);
                    //Check new pwd != old pwd
                // $pwdNewAsOld = password_verify($newpassword, $row['user_password']);
                    $sql = "UPDATE users SET user_password='$hashedPwd' WHERE user_username='$username'";
                    mysqli_query($conn, $sql);
                    header("Location: ../profile.php?=passwordupdate=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../profile.php");
    exit();
}

?>
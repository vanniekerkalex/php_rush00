<?PHP

session_start();

if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';
    
    $username = $_SESSION['u_username'];
    $oldpassword = mysqli_real_escape_string($conn, $_POST['oldpassword']);
    $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);
    
    //Check for empty fields
    if (empty($oldpassword) || empty($newpassword)) {
        header("Location: ../profile.php?=empty");
        exit();
    } else {
        //De-hashing password
        $sql = "SELECT * FROM users WHERE user_username LIKE '$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
      
        if ($resultCheck < 1) {
            header("Location: ../profile.php?=error=nomatch");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                
                $hashedPwdCheck = password_verify($oldpassword, $row['user_password']);
                $pwdNewAsOld = password_verify($newpassword, $row['user_password']);
                if ($hashedPwdCheck == false ||  $pwdNewAsOld == true) {
                    if ($hashedPwdCheck == false)
                        header("Location: ../profile.php?password=invalid");
                    else
                        header("Location: ../profile.php?oldpassword!=newpassword");
                    exit();
                
                } elseif ($hashedPwdCheck == true ||  $pwdNewAsOld == false) {
                    //Update DB with new user password
                    $hashedPwd = password_hash($newpassword, PASSWORD_DEFAULT);
                    //Check new pwd != old pwd
                    
                    $sql = "UPDATE users SET user_password='$hashedPwd' WHERE user_username='$username'";
                    mysqli_query($conn, $sql);
                    $_SESSION['u_pwdchange'] = true;
                    header("Location: ../index.php?=passwordupdate=successful");
                    exit();
                }
            }
        }
    }
} elseif (isset($_POST['delete'])) {

    include_once 'dbh.inc.php';
    
    $username = $_SESSION['u_username'];
    $oldpassword = mysqli_real_escape_string($conn, $_POST['oldpassword']);
    
    //Check for empty fields
    if (empty($oldpassword)) {
        header("Location: ../profile.php?password=empty");
        exit();
    } else {
        //De-hashing password
        $sql = "SELECT * FROM users WHERE user_username LIKE '$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
      
        if ($resultCheck < 1) {
            header("Location: ../profile.php?user=notexist");
            exit();
        } else {
    
            if ($row = mysqli_fetch_assoc($result)) {
                
                $hashedPwdCheck = password_verify($oldpassword, $row['user_password']);
                if ($hashedPwdCheck == false) {
                    header("Location: ../profile.php?password=invalid");
                    exit();
                } elseif ($hashedPwdCheck == true) {
                    $sql = "DELETE FROM users WHERE user_username LIKE '$username'";
                    mysqli_query($conn, $sql);
                    session_start();
                    session_unset();
                    session_destroy();
                    header("Location: ../index.php?account=deleted");
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
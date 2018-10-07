<?PHP

session_start();

if (isset($_POST['submit'])) {

    include_once 'dbh.inc.php';
    
    $username = $_SESSION['u_username'];
    $prod_name = mysqli_real_escape_string($conn, $_POST['prod_name']);
    $prod_qty = mysqli_real_escape_string($conn, $_POST['prod_qty']);
    
    if (empty($prod_qty) || $prod_qty == 0) {
        header("Location: ../products.php?qty=empty");
        exit();
    } else {

        $sql = "SELECT prod_id FROM products WHERE prod_name LIKE '$prod_name'";
        $result = mysqli_query($conn, $sql);
        
        $sql = "INSERT INTO basket (user_name, prod_id, prod_qty) VALUES ('$username', '$prod_id', '$prod_qty');";
        mysqli_query($conn, $sql);

    }
} else {
    header("Location: ../products.php");
    exit();
}

?>
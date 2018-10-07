<?PHP
    include_once 'header.php';
    session_start();
?>

<section class="main-container">
	<div class="main-wrapper">
        <h2>Products</h2>
        <table>
        
        <?PHP
            include_once 'dbh.inc.php';

            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
           
            if ($resultCheck > 0) {
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $product_list = "";
                    $product_list .= "<tr>";
                    $product_list .= product_table($row['prod_img'], $row['prod_name'], $row['prod_price']);
                    $product_list .= "</tr>";
                    echo $product_list;
                    $product_list = "";
                }
                
            }
            
            function product_table($id, $name, $price)
            {
                return ("<td><h3>$name</h3><br/><img width='200' 
                height='200' src='$id'/><br/><p>$price</p></td>");
            }

        ?>
        </table>
	</div>
</section>

<?PHP
	include_once 'footer.php';
?>
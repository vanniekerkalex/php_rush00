<?PHP
	require_once 'install.php';
	// require_once 'add_products.php';
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>Home</h2>
			<?PHP							
				if (isset($_SESSION['u_id']) && $_SESSION['u_pwdchange'] == false) {
					header("Location: /products.php");
					exit();
				}
				if ($_SESSION['u_pwdchange'] == true) {
					echo "You're password has successfully been changed!";
					$_SESSION['u_pwdchange'] == false;
				}
			?>

	</div>
</section>

<?PHP
	include_once 'footer.php';
?>
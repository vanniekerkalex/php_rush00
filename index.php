<?PHP
	require_once 'install.php';
	include_once 'header.php';
?>

<section class="main-container">
	<div class="main-wrapper">
		<h2>Home</h2>
			<?PHP
				if (isset($_SESSION['u_id'])) {
					echo "You are logged in!";
				}

			?>
	</div>
</section>

<?PHP
	include_once 'footer.php';
?>
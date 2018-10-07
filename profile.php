<?PHP
    include_once 'header.php';
    session_start();
?>

<section class="main-container">
	<div class="main-wrapper">
        <h2>Edit Profile</h2>
        <form class="signup-form" action="includes/profile.inc.php" method="POST">
            <input type="text" name="first" readonly placeholder="<?PHP
            if(isset($_SESSION['u_first'])){echo $_SESSION['u_first'];}?>">
            <input type="text" name="last" readonly placeholder="<?PHP
            if(isset($_SESSION['u_last'])){echo $_SESSION['u_last'];}?>">
            <input type="text" name="email" readonly placeholder="<?PHP
            if(isset($_SESSION['u_email'])){echo $_SESSION['u_email'];}?>">
            <input type="text" name="username" placeholder="<?PHP
            if(isset($_SESSION['u_username'])){echo $_SESSION['u_username'];}?>">
            <input type="password" name="oldpassword" placeholder="Old Password">
            <input type="password" name="newpassword" placeholder="New Password">
            <div class="profile-button">
                <button type="submit" name="submit">Update</button>
                <button type="submit" name="delete">Delete</button>
            </div>
        </form>
	</div>
</section>

<?PHP
	include_once 'footer.php';
?>
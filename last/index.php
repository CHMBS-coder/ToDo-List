<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: welcome.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	
	
		<style>
		.div1 {
		  width: 300px;
		  background: #FFFFFF;
		/* Shadow 1 */

		  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
		  border-radius: 4px;
		  padding: 50px;
		  margin: 20px;
		}

		.myclass{
			font-family: Montserrat;
			font-style: normal;
			font-weight: bold;
			font-size: 16px;
			line-height: 14px;
			/* identical to box height, or 88% */

			letter-spacing: -0.005em;

			/* Brand Colors/CB Green */

			color: #0B4B36;
		}

		.div2 {
		  width: 300px;
		  background: #FFFFFF;
		/* Shadow 1 */

		  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16);
		  border-radius: 4px;
		  padding: 50px;
		  margin: 20px;
		}

		.placeholder{
			font-family: Fira Sans;
			font-style: normal;
			font-weight: normal;
			font-size: 16px;
			line-height: 19px;
			/* identical to box height, or 119% */


			/* Layout Colors/Basic/Brown Grey */

			color: #939393;
		}
		</style>

		<title>Login</title>
</head>
<body>
	<div class="div1">
		<form  method="POST" >
			<p  style="font-size: 2rem; font-weight: 800; color: #0B4B36;">Login</p>
			<div >
				<label class="myclass">Email</label>
				<input class="placeholder" type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div >
				<label class="myclass">Password</label>
				<input class="placeholder" type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required> 
			</div>
			<div >
				<button name="submit" class="btn">Login</button>
			</div>
			<p >Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
</body>
</html>